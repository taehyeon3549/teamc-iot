<?php
namespace App\Model;

final class BackendModel extends BaseModel
{
	//Check Duplicate of email
	public function duplicateEmail($email){
		$sql = "SELECT * FROM User WHERE email = ?";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($email));
		$result = $sth->fetchAll();
		$num = count($result);

		if($num == 0){
			//if user not exsit
			$val = "0";
			return $val;
		}else{
			//if user exsit
			$val = "1";
			return $val;
		}
	}

	//Insert User
    public function addUser($user) {        
		$sql = "INSERT into User (hashed, email, name, gender, birth, emergency_call ,sign_state, is_admin) values (?, ?, ?, ? , ?, ?, ?, ? )";
		$sth = $this->db->prepare($sql);

		if($sth->execute(array($user['pw'], $user['email'], $user['name'], $user['gender'], $user['birth'], $user['emergency_call'], $user['sign_state'], $user['is_admin']))){
			$val = "0";
			return $val;
		}else{
			$val = "1";
			return $val;
		}
    }

	//Check the user already exist
	public function getByEmail($email) {  
		$sql = "SELECT * FROM User WHERE email = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($email));

		$result = $sth->fetchAll();

		$num = count($result);

		return $num;
	}

	//Check user login
	public function login($email) {  
		$sql = "SELECT hashed FROM User WHERE email = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($email));
		$result = $sth->fetchAll();

		return $result[0];		
	}

	//Get Certification table info
	public function checkCertifi($email) {  
		$sql = "SELECT * FROM Certification WHERE certi_email = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($email));
		$result = $sth->fetchAll();

		return $result[0];
	}	

	//Get User's info in User table
	public function getUserInfo_email($email) {  
		$sql = "SELECT * FROM User WHERE email = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($email));
		$result = $sth->fetchAll();

		return $result[0];
	}

	//Change the signin_state in User table to 0
	public function changeSignin($email) {  
		$sql = "UPDATE User SET sign_state = '0' WHERE email = ?";
		$sth = $this->db->prepare($sql);

		if($sth->execute(array($email))){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//Change the signin_state in User table to 1
	public function changeSignout($usn) {  
		$sql = "UPDATE User SET sign_state = '1' WHERE USN = ?";
		$sth = $this->db->prepare($sql);

		if($sth->execute(array($usn))){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//Check User is exsit
	public function checkUserinfo($user) {  
		$sql = "SELECT * FROM User WHERE email = ? AND birth = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($user['email'], $user['birth']));
		$result = $sth->fetchAll();
		$num = count($result);

		if($num > 0){
			//user exist
			return TRUE;
		}else{
			//user not exist
			return FALSE;
		}
	}
	
	//Update certification code
	public function updateCertifi($info) {  
		$sql = "UPDATE Certification SET certi_code = ? WHERE certi_email = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($info['code'], $info['email']))){
			//success
			return TRUE;
		}else{
			//fail
			return FALSE;
		}
	}

	//Get User's info in User table
	public function getCertifi($code) {  
		$sql = "SELECT * FROM Certification WHERE certi_code = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($code));
		$result = $sth->fetchAll();

		return $result[0];
	}

	//Update user's password
	public function changePassByemail($certi) {  
		$sql = "UPDATE User SET hashed = ? WHERE email = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($certi['password'], $certi['email']))){

			//success
			return TRUE;
		}else{
			//fail
			return FALSE;
		}
	}

	//Update user's password
	public function changePassByusn($certi) {  
		$sql = "UPDATE User SET hashed = ? WHERE usn = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($certi['password'], $certi['usn']))){
			//success
			return TRUE;
		}else{
			//fail
			return FALSE;
		}
	}


}
