<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

final class BackendController extends BaseController
{
	protected $logger;
	protected $BackendModel;
	protected $view;

	public function __construct($logger, $BackendModel, $view)
	{
		$this->logger = $logger;
		$this->BackendModel = $BackendModel;
		$this->view = $view;
	}

//Send email
// return value : true, false
	public function send_mail($who, $code, $type){
		$mail = new PHPMailer(true);		
		try{
			//Server settings
			$mail->SMTPDebug = 2;
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';   
			$mail->SMTPAuth = true;
			$mail->Username = 'teamciot2019@gmail.com';   //SMTP username
			$mail->Password = 'ucsandiego2019';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;

			//Recipients
			$mail->setFrom('teamciot@gmail.com', "teamciot");
			$mail->addAddress($who);

			$mail->isHTML(true);

			//Body of email
			//deside by $type
			// 0 : certification mail, 1: forgotten password
			if($type == 0){
				//certification mail
				$mail->Subject = "Please check this mail to Certification!";
				$mail->Body = '<b><a href = '.'>http://teamc-iot.calit2.net/'.$code.'<'.'/a></br>This message is sent by team c, jane</b>';
				$mail->AltBody = 'Please click the link to activate your account.';
			}else if($type == 1){
				//forgotten password
				$mail->Subject = "If click this link, you can change the password";
				$mail->Body = '<b><a href = '.'>http://teamc-iot.calit2.net/'.$code.'<'.'/a></br>This message is sent by team c, jane</b>';
				$mail->AltBody = 'Please click the link to change your password.';
			}			
			

			$mail -> SMTPOptions = array(
				"ssl" => array("verify_peer" => false, "verify_peer_name" => false, "allow_self_signed" => true));
			$mail->send();

			return true;	
		} catch (Exception $e){
			print_r($e);
			return false;
		}
	}

//Make nonce code - 8char
	public function make_nonce(){
		//Create nonce code
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';		//nonce code

		for ($i = 0; $i < 8; $i++) {
		   	$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;
	}

//Sign_up
//0: sign_in success(send email), 1: already have account, 2: user db adding fail
	public function signup_proc(Request $request, Response $response, $args)
	{
		//Get the User's info in sign_up page
		$info = [];
		$info['email'] = $request->getParsedBody()['id'];
		$info['pw'] = $request->getParsedBody()['password'];
		$info['name'] = $request->getParsedBody()['name'];
		$info['gender'] = $request->getParsedBody()['gender'];		//gender:0 = male, gender:1 = female
		$info['birth'] = $request->getParsedBody()['birth'];
		$info['emergency_call'] = $request->getParsedBody()['emergency'];

		//Check the duplicate of email
		if($this->BackendModel->duplicateEmail($info['email']) == 0){
			//if there are not have a user, start to create account
			//Set the user's init setting
			$info['sign_state'] = 1;
			$info['is_admin'] = 1;

			//Hashing the password
			$hash = password_hash($info['pw'], PASSWORD_DEFAULT);
			$info['pw'] = $hash;

			//Array of put the result
			$result = [];

			//Insert the user's info in DB and Check, is success
			if($this->BackendModel->addUser($info) == 0){		
				$result['header'] = "Add user success";
				$result['message'] = "0";
			}else{
				$result['header'] = "Add user fail";
				$result['message'] = "2";
			}		
		}else{
			//already have a user
			$result['header'] = "Already have account";
			$result['message'] = "1";
		}
		
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//Sign_in
//0 : login success, 1: wrong password, 2: account not exsit, 3: not certificated
	public function signin_proc(Request $request, Response $response, $args)
	{
    	//Get the User's info in sign_in page(id, password)
		$info = [];
		$info['email'] = $request->getParsedBody()['id'];
		$info['pw'] = $request->getParsedBody()['pw'];

		//Array of put the result
		$result = [];
		$temp = $this->BackendModel->login($info['email']);

		//Insert the user's info in DB and Check, is success
		if(!$temp['hashed']){
			//Account is not exsit
			$result['header'] = "login_account is not exsit";
			$result['message'] = "2";
		}else{	
			if(password_verify($info['pw'], $temp['hashed'])){
				//Login success!!
				//Check this user are certificated
				//result of certificate
				$certificated = $this->BackendModel->checkCertifi($info['email']);
				
				if($certificated['certi_state'] == 1){
					//if user are not certificated can not sign_in
					$result['header'] = "Certificate is not done";
					$result['message'] = "3";
				}else{
					//Get authority and usn by email
					$userInfo = $this->BackendModel->getUserInfo_email($info['email']);

					$usn = $userInfo['USN'];
					$is_admin = $userInfo['is_admin'];

					//then make login state to 1
					if($this->BackendModel->changeSignin($info['email'])){
						$result['header'] = "login_success";
						$result['message'] = "0";
						$result['usn'] = $usn;
						$result['is_admin']	 = $is_admin;
					}
				}		
			}else{
				//Login fail!!
				$result['header'] = "login_password_wrong";
				$result['message'] = "1";
			}
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//Sign_out
//0: signout success, 1: signout fail
	public function signout_proc(Request $request, Response $response, $args)
	{
   		//Get the User's usn
		$info = [];
		$info['usn'] = $request->getParsedBody()['usn'];

		//Array of put the result
		$result = [];

		if($this->BackendModel->changeSignout($info['usn'])){
			$result['header'] = "Signout_success";
			$result['message'] = "0";	
		}else{
			//Sign_out fail!!
			$result['header'] = "Signout_fail";
			$result['message'] = "1";
		}	

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//Forgotten password - send email
//0: send mail success, 1: user is not exist, 2: send mail fail, 3: update certificate code fail
	public function forgot_password_check(Request $request, Response $response, $args)
	{
   		//Get the User's usn
		$info = [];
		$info['email'] = $request->getParsedBody()['id'];
		$info['birth'] = $request->getParsedBody()['birth'];

		//Array of put the result
		$result = [];

		//check the user info is correct
		if($this->BackendModel->checkUserinfo($info)){
			//user exist, send the link by email

			//Create a nonce code in certification tabel in DB
			$info['code'] = $this->make_nonce();

			//update user's certi_code in certification table
			if($this->BackendModel->updateCertifi($info)){
				//success
				//send password change eamil
				if($this->send_mail($info['email'], $info['code'], 1)){
					//success
					$result['header'] = "Send email success";
					$result['message'] = "0";	
				}else{
					//fail
					$result['header'] = "Send email fail";
					$result['message'] = "2";
				}
			}else{
				//fail
				$result['header'] = "Update certificate code fail";
				$result['message'] = "3";
			}			
		}else{
			//user not exist
			$result['header'] = "User is not exsit";
			$result['message'] = "1";
		}	

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//forgotten password - change the password
	public function forgot_password(Request $request, Response $response, $args)
	{
		$certi = [];

		//Get email using by certi_code
		$certi['code'] = $request->getParsedBody()['code'];
		$certi['email'] = $this->BackendModel->getCertifi($certi['code'])['certi_email'];		//user's email

		//Change the password
		//Get the password of input
		$password = $request->getParsedBody()['password'];
		//Hashing the password
		$certi['password'] = password_hash($password, PASSWORD_DEFAULT);

		if($this->BackendModel->changePassByemail($certi)){
			//change success
			$result['header'] = "Password change success";
			$result['message'] = "0";
		}else{
			//change fail
			$result['header'] = "Password change fail";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//change the password
	public function change_password(Request $request, Response $response, $args)
	{
		$certi = [];

		//Get usn
		$certi['usn'] = $request->getParsedBody()['usn'];

		//Change the password
		//Get the password of input
		$password = $request->getParsedBody()['password'];
		//Hashing the password
		$certi['password'] = password_hash($password, PASSWORD_DEFAULT);

		if($this->BackendModel->changePassByusn($certi)){
			//change success
			$result['header'] = "Password change success";
			$result['message'] = "0";
		}else{
			//change fail
			$result['header'] = "Password change fail";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//Send the certification eamil
//0: send email success, 1: already have account, 2: send email fail, 3: insert certification table fail, 4: update certification table fail--------------------------------------
	public function click_verify(Request $request, Response $response, $args)
	{
		//Store input email
		$email_address = $request->getParsedBody()['id'];
		//$email_address = 'xogusrla09@gmail.com';

		//Check the duplicate of email
		if($this->BackendModel->duplicateEmail($email_address) == 0){
			//if there are not have a user, start to create account
			$result = [];

			//Create nonce code
			$randomString = $this->make_nonce();
		    
		    echo($randomString);

		    //Data of certification
			$certi = [];		//certification data
			$certi['email'] = $email_address;
			$certi['code'] = $randomString;
			$certi['state'] = 1;		//default is 1

			//check the email, already certificated.
			if($this->BackendModel->alreadyCertifi($certi['email']) == 0){
				//already try certificate - update certification table
				if($this->BackendModel->updateCertifi($certi) == 0){
					//update certification table success
					//Send certification email
					if($this->send_mail($certi['email'], $certi['code'], 0)){
						$result['header'] = "Send email success";
						$result['message'] = "0";	
					}else{
						$result['header'] = "Send email fail";
						$result['message'] = "2";
					}				
			    }else{
					//update certification table fail
			    	$result['header'] = "Update certification table fail";
			    	$result['message'] = "4";
			    }
			}else{
				//Never been try certificate
				//Insert the user data in certification table in DB			
				if($this->BackendModel->addCertifi($certi) == 0){
					//Send certification email
					if($this->send_mail($certi['email'], $certi['code'], 0)){
						$result['header'] = "Send email success";
						$result['message'] = "0";	
					}else{
						$result['header'] = "Send email fail";
						$result['message'] = "2";
					}						
			    }else{
			    	$result['header'] = "Fail the insert data in certification table";
			    	$result['message'] = "3";				
			    }
			}
		}else{
			//already user have account
			$result['header'] = "Already have account";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//Check the user are certificated
	public function check_certification(Request $request, Response $response, $args)
	{
		//Store input email
		$email_address = $request->getParsedBody()['id'];
		$certi_state = $this->BackendModel->checkCertifi($email_address);

		//check the certi_state
		if($certi_state['certi_state'] == '0'){
			//certificated
			$result['header'] = "Certificated";
			$result['message'] = "0";
		}else{
			//Not certificated
			$result['header'] = "Not certificated";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//Change the certi_state in Certification table(In email Link)
	public function change_certification(Request $request, Response $response, $args)
	{
		//Store input email
		$certi_code = $request->getParsedBody()['code'];

		//Change the state
		if($this->BackendModel->changeCertifi($certi_code)){
			$result['header'] = "Change the state success";
			$result['message'] = "0";
		}else{
			$result['header'] = "Change the state fail";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//Check the user are exsit
	public function check_user(Request $request, Response $response, $args)
	{
   		//Get the User's email in sign_up page
		$info = [];
		$info['email'] = $request->getParsedBody()['id'];

		//Array of put the result
		$result = [];

		//Run the SQL
		//$this->BackendModel->getByEmail($info['email']);

		//Insert the user's info in DB and Check, is success
		if($this->BackendModel->getByEmail($info['email']) > 0){
			//Already exist the email, make response 1
			$result['header'] = "Already have account";
			$result['message'] = "1";
		}else{
			//Not exist the eamil, make response 0
			$result['header'] = "None account";
			$result['message'] = "0";	
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//user cancellation
	public function delete_account(Request $request, Response $response, $args)
	{
		$user = [];

		//Get user's usn and password
		$user['usn'] = $request->getParsedBody()['usn'];
		$user['password'] = $request->getParsedBody()['password'];

		//Get the user info in DB
		$user_info = $this->BackendModel->getUserInfo_email($user);
		
		//Check the password
		if(password_verify($user['password'], $user_info['hashed'])){
			//compare, then get the ssn in sensor table
			$userDB = $this->BackendModel->getSensorByusn($user['usn']);
			
			if(count($userDB) > 0){
				//sensor is exist, Store the ssn
				$user['ssn'] = $userDB['SSN'];
				//Delete data in air_value and polar_value
				if($this->BackendModel->getSensorByusn($user['ssn']) == 0){
					//delete ALL sensor data success
					//delete user data

					$result['header'] = "Delete ";
					$result['message'] = "1";
				}
			}else{
				//password not correct
				$result['header'] = "Sensor is not exsit";
				$result['message'] = "1";	
			}

		}else{
			//password not correct
			$result['header'] = "Password is not correct";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}


//inssert sensor data	
	public function insertSensor(Request $request, Response $response, $args)
	{
		$senosr = [];

		$sensor['ssn'] = $request->getParsedBody()['ssn'];
		$sensor['pm2_5'] = $request->getParsedBody()['pm2_5'];
		$sensor['pm10'] = $request->getParsedBody()['pm10'];
		$sensor['o3'] = $request->getParsedBody()['o3'];
		$sensor['co'] = $request->getParsedBody()['co'];
		$sensor['no2'] = $request->getParsedBody()['no2'];
		$sensor['so2'] = $request->getParsedBody()['so2'];
		$sensor['temperture'] = $request->getParsedBody()['temperture'];
		$sensor['latitude'] = $request->getParsedBody()['latitude'];
		$sensor['longitude'] = $request->getParsedBody()['longitude'];
		$sensor['time'] = $request->getParsedBody()['time'];


		if($this->BackendModel->insertSensorData($sensor) > 0){
			//Already exist the email, make response 1
			$result['header'] = "Miss";
			$result['message'] = "1";
		}else{
			//Not exist the eamil, make response 0
			$result['header'] = "success";
			$result['message'] = "0";	
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}
}