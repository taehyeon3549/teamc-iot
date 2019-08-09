<?php
namespace App\Model;

final class SensorManagementModel extends BaseModel
{
	//Check the duplicate of sensor
	public function checkSensor($sensor){
		$sql = "SELECT * FROM Sensor WHERE s_MAC = ?";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($sensor['mac']));

		$result = $sth->fetchAll();
		$num = count($result);

		if($num == 0){
			//sensor not exsit			
			$val = 0;
		}else{
			//sensor exsit
			$val = 1;	
		}
		return $val;		
	}

	//Registratioin sensor info
	public function regitSensor($sensor){
		$sql = "INSERT INTO Sensor (SSN, s_user, s_MAC, s_name, s_state) VALUES (?, ?, ?, ?, ?)";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['usn'], $sensor['mac'], $sensor['sensor_name'], $sensor['state']))){
			//insert success
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	
	//Get sensor info
	public function getSensorBymac($sensor){
		$sql = "SELECT * FROM Sensor WHERE s_MAC = ?";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($sensor));
		$result = $sth->fetchAll();

		return $result[0];
	}

	//Delete air sensor value
	public function deleteAir($sensor){
		$sql = "DELETE FROM Air_Sensor_value WHERE a_ssn = ? AND a_usn = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['usn']))){
			//insert success
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	//Delete Polar sensor value
	public function deletePolar($sensor){
		$sql = "DELETE FROM Polar_Sensor_value WHERE p_ssn = ? AND p_usn = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['usn']))){
			//insert success
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	//Deregistratioin sensor info
	public function deregitSensor($sensor){
		$sql = "DELETE FROM Sensor WHERE SSN = ? AND s_user = ?";
		
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['usn']))){
			//insert success
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	//Get sensor list by usn
	public function getSensorByusn($sensor){   
		$sql = "SELECT * FROM Sensor WHERE s_user = ? ";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($sensor['usn']));		
		$result = $sth->fetchAll();		
		return $result;
	}


	//Check the empty ssn in sensor table
	public function checkEmptyssn(){   
		$sql = "SELECT min(SSN + 1) AS val FROM Sensor WHERE (SSN + 1) NOT IN (SELECT SSN FROM Sensor)";
		$sth = $this->db->prepare($sql);
		$sth->execute();
		
		$result = $sth->fetchAll();
		
		return $result[0];
	}

	//Insert airdata
	public function insertAirdata($sensor){   
		$sql = "INSERT INTO Air_Sensor_value (a_ssn, a_PM2_5, a_PM10, a_O3, a_CO, a_NO2, a_SO2, a_Temperture, a_latitude, a_longitude, a_time, a_usn) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['pm2_5'], $sensor['pm10'], $sensor['o3'], $sensor['co'], $sensor['no2'], $sensor['so2'], $sensor['temperture'], $sensor['latitude'], $sensor['longitude'], $sensor['time'], $sensor['usn']))){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//Insert polardata
	public function insertPolardata($sensor){   
		$sql = "INSERT INTO Polar_Sensor_value (p_ssn, p_heartrate, p_RR_interval, p_latitude, p_longitude, p_time, p_usn) VALUES (?, ?, ?, ?, ?, ?, ?);";
		
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['heartrate'], $sensor['RR_interval'], $sensor['latitude'], $sensor['longitude'], $sensor['time'], $sensor['usn']))){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//show airdata
	public function showRealdata($sensor){
		$str = explode('_', $sensor['sensor_name']);

		if($str[0] == "Air"){
			$sql = "SELECT * FROM Air_Sensor_value WHERE a_ssn = ? ORDER BY a_no DESC LIMIT 1";
		}else{
			$sql = "SELECT * FROM Polar_Sensor_value WHERE p_ssn = ? ORDER BY p_no DESC LIMIT 1";
		}
		$sth = $this->db->prepare($sql);

		$sth->execute(array($sensor['ssn']));

		$result = $sth->fetchAll();
		
		return $result[0];
	}


}
