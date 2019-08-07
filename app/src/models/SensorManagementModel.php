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


	//Check the empty ssn in sensor table
	public function checkEmptyssn(){   
		$sql = "SELECT min(SSN + 1) AS val FROM Sensor WHERE (SSN + 1) NOT IN (SELECT SSN FROM Sensor)";
		$sth = $this->db->prepare($sql);
		$sth->execute();
		
		$result = $sth->fetchAll();
		
		return $result[0];
	}
}
