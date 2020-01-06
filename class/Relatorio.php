<?php

	include_once('Database.php');//importando a conexão com o banco de dados

	class Relatorio{
		
		private $database, $pdo;
		
		public function __construct(){//construtor da classe que inicia a conexão com o banco
			
				global $database, $pdo;
				
				$database = new Database();
				$pdo = $database->getPdo();
		}
		
		//função para exibir os registros do relatório de acordo com o filtro de busca
		public function exibir($tipo){
			
			global $pdo;
			
			$query = "SELECT * FROM vw_relatorio";
			
			if($tipo != ""){
				$tipo = (int) $tipo;
				$query .= " WHERE tipo_id = ".$tipo;
			}
			
			$sql = $pdo->prepare($query);
			$sql->execute();
			
			return $sql;
		}
		
		//função para exibir os tipos de resultado de uma tentativa de inserção de produto por planilha
		public function tipos_linha(){
			
			global $pdo;
			
			$sql = $pdo->prepare("SELECT * FROM tipos_linha");
			$sql->execute();
			
			return $sql;
		}
		
		//função para inserir um novo registro no relatório
		public function inserir($linha, $tipo, $valor){
			
			global $pdo;
			
			$sql = $pdo->prepare("CALL insert_relatorio(:linha, :tipo, :valor)");//chamando a procedure para inserir um novo registro no relatório
			$sql->bindValue(":linha", (int) $linha);
			$sql->bindValue(":tipo", (int) $tipo);
			$sql->bindValue(":valor", $valor);
			
			$sql->execute();
		}
		
		//função que deleta todos os registros do relatório de inserção anterior para iniciar outro
		public function start(){
			
			global $pdo;
			
			$sql = $pdo->prepare("DELETE FROM relatorio");
			$sql->execute();
		}
		
	}

?>
