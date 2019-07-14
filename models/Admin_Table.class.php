<?php
include_once 'models/Table.class.php';

class Admin_Table extends Table {
	public function create ($email, $password){
		//check if email is available
		$this->checkEmail($email);
		// encrypt password with MDS
		$sql = "INSERT INTO admin (email, password)
				VALUES(?, MD5(?))";
		$data = array($email, $password);
		$this->makeStatement($sql, $data);
	}

	public function checkEmail($email){
		$sql = "SELECT email from admin WHERE email = ?";
		$data = array($email);
		$this->makeStatement($sql, $data);
		if($statement->rowCount() === 1){
			// throw an exception > do not create new admin user
			$e = new Exception("Error: '$email' already used!");
			throw $e;
		}
	}

	public function checkCredentials($email, $password){
		$sql = "SELECT email FROM admin
				WHERE email = ? AND password = MD5(?)";
		$data = array($email, $password);
		$statement = $this->makeStatement($sql, $data);
		if($statement->rowCount() === 1){
			$out = true;
		} else {
			$loginProblem = new Exception("login failed!");
		}
		return $out;
	}
}