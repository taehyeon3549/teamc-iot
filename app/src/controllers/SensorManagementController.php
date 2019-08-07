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

		//echo($sensor['mac']);
		//check duplicate of mac address
		$value = $this->SensorManagementModel->checkSensor($sensor);

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
				$result['header'] = "Registeration success";
				$result['message'] = "0";
			}else{
				//fail register the sensor
				$result['header'] = "Registeration fail";
				$result['message'] = "2";
			}						
		}else{
			//exist
			$result['header'] = "Already exist the sensor";
			$result['message'] = "1";
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

	//insert sensor data	
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


		if($this->SensorManagementModel->insertSensorData($sensor) > 0){
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