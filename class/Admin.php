<?php

	include_once 'Connect.php';

	class Admin{

		public $id;
		public $email;
		public $password;
		
		
		public function __construct($id = "1")
		{
			$this->id = $id;
			$connect = new Connect();
			$sql = "SELECT * FROM usuario_admin WHERE id=".$this->id.";";
			$return = $connect->sqlGet($sql);
			foreach($return as $admin){
				$this->email = $admin[1];
				$this->password = $admin[2];
			}
		}

		/*public function set($id){
			$this->id = $id;
			$connect = new Connect();
			$sql = "SELECT * FROM usuario_admin WHERE id=".$this->id.";";
			$return = $connect->sqlGet($sql);
			foreach($return as $admin){
				$this->email = $admin[1];
				$this->password = $admin[2];
			}
		}*/

		public function log($email, $password){
			$this->email = $email;
			$this->password = $password;
			if($this->existsEmailAndPassword()){
				$connect = new Connect();
				$sql = "SELECT * FROM usuario_admin WHERE email='$this->email' AND senha='$this->password';";
				foreach($connect->sqlGet($sql) as $admin){
					$this->id = $admin[0];
				}

				setcookie('logadoadmin', 'sim');
				setcookie('idadmin', $this->id);
				return true;
			}else{
				return false;
			}
		}

		public function logout(){
			unset($_COOKIE['logadoadmin']);
			unset($_COOKIE['idadmin']);
			setcookie("logadoadmin", null);
			setcookie("idadmin", null);
		}

		public function existsEmailAndPassword(){
			$connect = new Connect();
			$sql = "SELECT * FROM usuario_admin WHERE email='$this->email' AND senha='$this->password'";
			$return = $connect->sqlGet($sql);
			if($return){
				return true;
			}else{
				return false;
			}
		}
		
	}
?>