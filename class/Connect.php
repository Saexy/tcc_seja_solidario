<?php

	class Connect{

        public $host = 'localhost';
		public $database = 'db_sejasolidario';
	    public $user = 'root';
	    public $password = 'root';

	    public $connection;

		public $command;
	  
	    public function openConnection(){

		    $this->connection = @mysqli_connect($this->host, $this->user, $this->password, $this->database);
			
			if(!$this->connection){
				echo 'Problemas com o banco de dados.';
			}
	    }
	
		public function closeConnection()
		{
			mysqli_close($this->connection);
		}
		
		public function sqlSet($command)
		{
			$this->command = $command;
			$this->openConnection();
			try{
				$return = mysqli_query($this->connection, $this->command);
				return TRUE; 
			}catch(Exception $e){
				return FALSE;
			}
			$this->closeConnection();
		}
		
		public function sqlGet($command)
		{
			$this->command = $command;
			$this->openConnection();
			$return = mysqli_query($this->connection, $this->command);
			try{
				$list = mysqli_fetch_all($return);
				return $list;
			}catch(Exception $e){
				return null;
			}
			$this->closeConnection();
		}
	}

?>