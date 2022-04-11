<?php

	include_once 'Connect.php';

	class Doador{

		public $id;
		public $nome;
		public $celular;
		public $email;
		public $password;
		public $endereco;
		public $numerocasa;
		public $sexo;
		
		public $iderror;

		public $list;

		public function __construct($id = "1")
		{
			$this->id = $id;
			$connect = new Connect();
			$sql = "SELECT * FROM usuario_doador WHERE id=".$this->id.";";
			$return = $connect->sqlGet($sql);
			foreach($return as $doador){
				$this->nome = $doador[1];
				$this->celular = $doador[2];
				$this->email = $doador[3];
				$this->senha = $doador[4];
				$this->endereco = $doador[5];
				$this->numerocasa = $doador[6];
				$this->sexo = $doador[7];
			}
		}

		public function log($email, $password){
			$this->email = $email;
			$this->password = $password;
			if($this->existsEmailAndPassword()){
				$connect = new Connect();
				$sql = "SELECT * FROM usuario_doador WHERE email='$this->email' AND senha='$this->password';";
				$return = $connect->sqlGet($sql);
				foreach($return as $doador){
					$this->id = $doador[0];
					$this->nome = $doador[1];
					$this->celular = $doador[2];
					$this->endereco = $doador[5];
					$this->numerocasa = $doador[6];
					$this->sexo = $doador[7];
				}

				setcookie('logadodoador', 'sim');
				setcookie('iddoador', $this->id);

				return true;
			}else{
				return false;
			}
		}

		public function reg($nome, $celular, $email, $password, $endereco, $numerocasa, $sexo){
			$this->nome = $nome;
			$this->celular = $celular;
			$this->email = $email;
			$this->password = $password;
			$this->endereco = $endereco;
			$this->numerocasa = $numerocasa;
			$this->sexo = $sexo;
			if($this->existsEmail()){
				//CÓDIGO DE ERRO CASO TENHA EMAIL EXISTENTE
				$this->iderror = 2;
				return false;
			}else{
				if($this->existsCelular()){
					//CÓDIGO DE ERRO CASO TENHA CELULAR EXISTENTE
					$this->iderror = 3;
					return false;
				}else{
					$connect = new Connect();
					$sql = "INSERT INTO usuario_doador (nome, celular, email, senha, endereco, numerocasa, sexo) 
					VALUES('$this->nome', '$this->celular', '$this->email', '$this->password', '$this->endereco', '$this->numerocasa', '$this->sexo')";
					$return = $connect->sqlSet($sql);
					
					if($return){
						return true;
					}else{
						//CÓDIGO DE ERRO CASO DÊ PROBLEMA NO MYSQL
						$this->iderror = 1;
						return false;
					}
				}
			}
		}

		public function logout(){
			unset($_COOKIE['logadodoador']);
			unset($_COOKIE['iddoador']);
			setcookie("logadodoador", null);
			setcookie("iddoador", null);
		}

		public function edit($endereco, $numerocasa, $sexo){
			$this->endereco = $endereco;
			$this->numerocasa = $numerocasa;
			$this->sexo = $sexo;
			$connect = new Connect();
			$sql = "UPDATE usuario_doador SET endereco='$this->endereco',numerocasa='$this->numerocasa',sexo='$this->sexo' WHERE id=$this->id;";
			$return = $connect->sqlSet($sql);
			if($return){
				return true;
			}else{
				return false;
			}
		}

		public function getDonate($id_doacao){
			$connect = new Connect();
			$sql = "SELECT * FROM doacao_doador WHERE id=$id_doacao;";
			$return = $connect->sqlGet($sql);
			if($return){
				return $return;
			}else{
				return null;
			}
		}

		public function addDonate($tipo, $detalhes){
			$connect = new Connect();
			$sql = "INSERT INTO doacao_doador (id_doador, tipo, datadoacao, detalhes) 
			VALUES('$this->id', '$tipo', CURDATE(), '$detalhes');";
			$return = $connect->sqlSet($sql);
			if($return){
				return true;
			}else{
				return false;
			}
		}

		public function editDonate($id_doacao, $tipo, $detalhes){
			$connect = new Connect();
			$sql = "UPDATE doacao_doador SET tipo='$tipo',detalhes='$detalhes' WHERE id=$id_doacao;";
			$return = $connect->sqlSet($sql);
			if($return){
				return true;
			}else{
				return false;
			}
		}

		public function deleteDonate($id_doacao){
			$connect = new Connect();
			$sql = "DELETE FROM doacao_doador WHERE id=$id_doacao;";
			$return = $connect->sqlSet($sql);
			if($return){
				return true;
			}else{
				return false;
			}
		}

		public function historyDonate(){
			$connect = new Connect();
			$sql = "SELECT * FROM doacao_doador WHERE id_doador=$this->id;";
			$return = $connect->sqlGet($sql);
			if($return){
				$this->list = $return;
				return true;
			}else{
				return false;
			}
		}

		public function list(){
			$connect = new Connect();
			$sql = "SELECT * FROM usuario_doador;";
			$return = $connect->sqlGet($sql);
			if($return){
				$this->list = $return;
				return true;
			}else{
				return false;
			}
		}

		public function searchByEmail($email){
			$connect = new Connect();
			$sql = "SELECT * FROM usuario_doador WHERE email LIKE '%$email%';";
			$return = $connect->sqlGet($sql);
			if($return){
				$this->list = $return;
				return true;
			}else{
				return false;
			}
		}

		public function searchByName($nome){
			$connect = new Connect();
			$sql = "SELECT * FROM usuario_doador WHERE nome LIKE '%$nome%';";
			$return = $connect->sqlGet($sql);
			if($return){
				$this->list = $return;
				return true;
			}else{
				return false;
			}
		}

		public function existsEmailAndPassword(){
			$connect = new Connect();
			$sql = "SELECT * FROM usuario_doador WHERE email='$this->email' AND senha='$this->password'";
			$return = $connect->sqlGet($sql);
			if($return){
				return true;
			}else{
				return false;
			}
		}

		public function existsEmail(){
			$connect = new Connect();
			$sql = "SELECT * FROM usuario_doador WHERE email='$this->email'";
			$return = $connect->sqlGet($sql);
			if($return){
				return true;
			}else{
				return false;
			}
		}

		public function existsCelular(){
			$connect = new Connect();
			$sql = "SELECT * FROM usuario_doador WHERE celular='$this->celular'";
			$return = $connect->sqlGet($sql);
			if($return){
				return true;
			}else{
				return false;
			}
		}

		public function exists(){
			$connect = new Connect();
			$sql = "SELECT * FROM usuario_doador WHERE id='$this->id'";
			$return = $connect->sqlGet($sql);
			if($return){
				return true;
			}else{
				return false;
			}
		}

		public function existsDonate($id_doacao){
			$connect = new Connect();
			$sql = "SELECT * FROM doacao_doador WHERE id=$id_doacao";
			$return = $connect->sqlGet($sql);
			if($return){
				return true;
			}else{
				return false;
			}
		}
	}
?>