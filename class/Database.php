<?php

	class Database{//classe responsável pelas operações feitas no banco de dados
		
		private $pdo;//guarda a instância de um objeto pdo da conexão com o banco de dados
		
		//construtor da classe
		public function __construct(){
			
			global $pdo;
			
			$host = "localhost";//host do banco
			$dbname = "comercio";//nome do banco
			$user = "root";//usuário do banco
			$password = "";//senha do banco
			
			try{
			
				$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password);//instânciando objeto pdo de conexão com banco
				
			}catch(Exception $e){
				
				echo("Erro ao conectar banco de dados!");//se não for possível conectar aparece essa mensagem de erro
				
			}
			
		}
		
		//retornando a instância pdo do banco
		public function getPdo(){
			
			global $pdo;
			
			return $pdo;
		}
	
		
	}

?>
