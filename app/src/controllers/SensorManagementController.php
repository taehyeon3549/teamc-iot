<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class SensorManagementController extends BaseController
{
	protected $logger;
	protected $SensorManagementModel;
	protected $view;

	public function __construct($logger, $SensorManagementModel, $view)
	{
		$this->logger = $logger;
		$this->SensorManagementModel = $SensorManagementModel;
		$this->view = $view;
	}

	//Registratioin sensor info
	//0: success, 1: Already exist the sensor, 2: Registeration fail
	public function registrationSensor(Request $request, Response $response, $args)
	{
		$sensor = [];

		$sensor['usn'] = $request->getParsedBody()['usn'];
		$sensor['mac'] = $request->getParsedBody()['mac'];
		$sensor['sensor_name'] = $request->getParsedBody()['sensor_name'];
		$sensor['state'] = 1;

		//check duplicate of mac address	
		if($this->SensorManagementModel->checkSensor($sensor) == 0){
			//not exist go ahead
			//Check the empty ssn
			$empty_ssn = $this->SensorManagementModel->checkEmptyssn();
			$num = count($empty_ssn);			

			if($num > 0){
				//exsit empty ssn
				$sensor['ssn'] = $empty_ssn['val'];
			}

			//Register the sensor
			if($this->SensorManagementModel->regitSensor($sensor)){
				//success register the sensor
				//get Insert sensor's info
				$info = $this->SensorManagementModel->getSensorBymac($sensor['mac']);
				
				$result['header'] = "Registeration success";
				$result['message'] = [];
				$result['message']['result'] = 0;
				$result['message']['ssn'] = $info['SSN'];
				$result['message']['mac'] = $info['s_MAC'];
				$result['message']['sensor_name'] = $info['s_name'];
			}else{
				//fail register the sensor
				$result['header'] = "Registeration fail";
				$result['message'] = [];
				$result['message']['result'] = 2;
			}						
		}else{
			//exist
			$result['header'] = "Already exist the sensor";
			$result['message'] = [];
			$result['message']['result'] = 1;
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

	//Deregistratioin sensor info	
	//0: Delete sensor success, 1: Delete Air sensor value fail, 2: Delete Polar sensor value fail
	public function deregistrationSensor(Request $request, Response $response, $args)
	{
		$sensor = [];
		//Get usn, ssn
		$sensor['usn'] = $request->getParsedBody()['usn'];
		$sensor['ssn'] = $request->getParsedBody()['ssn'];

		//delete air sensor value
		if($this->SensorManagementModel->deleteAir($sensor)){
			//delete air success
			if($this->SensorManagementModel->deletePolar($sensor)){
				//delete polar success
				//deregit sensor
				if($this->SensorManagementModel->deregitSensor($sensor)){
					//delete ALL data
					$result['header'] = "Delete sensor success";
					$result['message'] = "0";
				}
			}else{
				//delete polar fail
				$result['header'] = "Delete Polar sensor value fail";
				$result['message'] = "2";
			}
		}else{
			//delete air fail
			$result['header'] = "Delete Air sensor value fail";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

	//Sensor List
	public function sensorList(Request $request, Response $response, $args)
	{
		$sensor = [];
		$sensor['usn'] = $request->getParsedBody()['usn'];
		$sensor_val = $this->SensorManagementModel->getSensorByusn($sensor);
		
		//결과 넣은 값
		$num = count($sensor_val);
		//echo($num);

		$result['header'] = "Sensor List ";
		$result['message'] = [];
		
		for($i = 0; $i< $num; $i++){
			$result['message'][$i]['ssn'] = $sensor_val[$i]['SSN'];
			$result['message'][$i]['mac'] = $sensor_val[$i]['s_MAC'];
			$result['message'][$i]['name'] = $sensor_val[$i]['s_name'];
			$result['message'][$i]['state'] = $sensor_val[$i]['s_state'];
		}

		$result['result'] = 0;

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));

	}

	//insert sensor data	
	public function insertAirSensor(Request $request, Response $response, $args)
	{
		$senosr = [];

		$sensor['usn'] = $request->getParsedBody()['usn'];
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
		$sensor['ap_pm2_5'] = $request->getParsedBody()['aq_pm2_5'];
		$sensor['ap_o3'] = $request->getParsedBody()['ap_o3'];
		$sensor['ap_co'] = $request->getParsedBody()['ap_co'];
		$sensor['ap_no2'] = $request->getParsedBody()['ap_no2'];
		$sensor['ap_so2'] = $request->getParsedBody()['ap_so2'];
		
		if($this->SensorManagementModel->insertAirdata($sensor)){
			$result['header'] = "success";
			$result['message'] = "0";
		}else{
			$result['header'] = "fail";
			$result['message'] = "1";	
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

	//insert sensor data	
	public function insertPolarSensor(Request $request, Response $response, $args)
	{
		$senosr = [];

		$sensor['usn'] = $request->getParsedBody()['usn'];
		$sensor['ssn'] = $request->getParsedBody()['ssn'];
		$sensor['heartrate'] = $request->getParsedBody()['heartrate'];
		$sensor['RR_interval'] = $request->getParsedBody()['RR_interval'];
		$sensor['latitude'] = $request->getParsedBody()['latitude'];
		$sensor['longitude'] = $request->getParsedBody()['longitude'];
		$sensor['time'] = $request->getParsedBody()['time'];

		if($this->SensorManagementModel->insertPolardata($sensor)){
			$result['header'] = "success";
			$result['message'] = "0";
		}else{
			$result['header'] = "fail";
			$result['message'] = "1";	
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

	//showRealair	
	public function showRealdata(Request $request, Response $response, $args)
	{
		$senosr = [];

		$sensor['ssn'] = $request->getParsedBody()['ssn'];
		$sensor['sensor_name'] = $request->getParsedBody()['sensor_name'];

		$data = $this->SensorManagementModel->showRealdata($sensor);
		$num = count($data);

		if($num > 0){
			$result['header'] = "success";
			$result['message'] = [];
			
			$str = explode('_', $sensor['sensor_name']);

			if($str[0] == "Air"){
				$result['message']['PM2_5'] = $data['a_PM2_5'];
				$result['message']['PM10'] = $data['a_PM10'];
				$result['message']['o3'] = $data['a_O3'];
				$result['message']['co'] = $data['a_CO'];
				$result['message']['no2'] = $data['a_NO2'];
				$result['message']['so2'] = $data['a_SO2'];
				$result['message']['temperture'] = $data['a_Temperture'];
				$result['message']['latitude'] = $data['a_latitude'];
				$result['message']['longitude'] = $data['a_longitude'];
				$result['message']['time'] = $data['a_time'];

				$result['result'] = "0";
			}else{
				$result['message']['heartrate'] = $data['p_heartrate'];
				$result['message']['rr_interval'] = $data['p_RR_interval'];
				$result['message']['latitude'] = $data['p_longitude'];
				$result['message']['longitude'] = $data['p_longitude'];
				$result['message']['time'] = $data['p_time'];
			}	
		}else{
			$result['header'] = "fail";
			$result['message'] = "1";	
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

	//showHistodata	
	public function showHistodata(Request $request, Response $response, $args)
	{
		$senosr = [];

		$sensor['ssn'] = $request->getParsedBody()['ssn'];
		$sensor['sensor_name'] = $request->getParsedBody()['sensor_name'];

		$data = $this->SensorManagementModel->showHistodata($sensor);
		$num = count($data);

		if($num > 0){
			$result['header'] = "success";
			$result['message'] = [];
			
			$str = explode('_', $sensor['sensor_name']);

			if($str[0] == "Air"){
				for($i = 0 ; $i<$num; $i++){
					$result['message'][$i]['PM2_5'] = $data[$i]['a_PM2_5'];
					$result['message'][$i]['PM10'] = $data[$i]['a_PM10'];
					$result['message'][$i]['o3'] = $data[$i]['a_O3'];
					$result['message'][$i]['co'] = $data[$i]['a_CO'];
					$result['message'][$i]['no2'] = $data[$i]['a_NO2'];
					$result['message'][$i]['so2'] = $data[$i]['a_SO2'];
					$result['message'][$i]['temperture'] = $data[$i]['a_Temperture'];
					$result['message'][$i]['latitude'] = $data[$i]['a_latitude'];
					$result['message'][$i]['longitude'] = $data[$i]['a_longitude'];
					$result['message'][$i]['time'] = $data[$i]['a_time'];
				}
				$result['result'] = "0";
			}else{
				for($i = 0; $i<$num; $i++){
					$result['message'][$i]['heartrate'] = $data[$i]['p_heartrate'];
					$result['message'][$i]['rr_interval'] = $data[$i]['p_RR_interval'];
					$result['message'][$i]['latitude'] = $data[$i]['p_latitude'];
					$result['message'][$i]['longitude'] = $data[$i]['p_longitude'];
					$result['message'][$i]['time'] = $data[$i]['p_time'];
				}
				$result['result'] = "0";
			}	
		}else{
			$result['header'] = "fail";
			$result['message'] = "1";	
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

	//getGPS	
	public function getGPS(Request $request, Response $response, $args)
	{
		$data = $this->SensorManagementModel->getGPS();
		$num = count($data);
		$result = [];	
		
		//센서 이름 : {...}, 센서 위치 : {위도,경도}
		if($num > 0){		
			for ($i=0; $i < $num; $i++) { 
				$name = $data[$i]['p_ssn'];
				$sensor_name = $this->SensorManagementModel->getSensorByssn($name)['s_name'];
				array_push($result, '"name" :"'.$sensor_name.'", "location" :['.$data[$i]["p_latitude"].','.$data[$i]["p_longitude"].']'); 			  
			}
		}else{
			$result['header'] = "fail";
			$result['message'] = "1";	
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}
}