<?php

	include_once('Database.php');

	class Produto{
		
		private $database, $pdo;//objetos derivados da conexão com o banco
		
		//construtor da classe
		public function __construct(){
			
			global $pdo, $database;
			
			$database = new Database();//objeto da classe Database
			
			$pdo = $database->getPdo();//instância pdo da conexão com o banco
		}
		
		//função que retorna os registros do banco de acordo com os parâmetros de consulta
		public function exibir($codigo, $nome, $categoria){
			
			global $pdo, $database;
			
			$query = "SELECT * FROM vw_produtos";//instrução a ser enviada para o banco
			
			$clausula[] = array();//armazena as clausulas de consulta
			$clausulas = 0;
			
			//para filtrar pelo código ele precisa ser diferente de null e de 0
			if($codigo != null && $codigo != "0"){
				$codigo = (int) $codigo;
				$clausula[$clausulas] = "codigo = ".$codigo;
				$clausulas++;
			}
			
			//para filtrar pelo nome ele precisa ser diferente de null 
			if($nome != null){
				$clausula[$clausulas] = "produto LIKE '%".$nome."%'";
				$clausulas++;
			}
			
			//para filtrar pela categoria seu id precisa ser diferente de 0
			if($categoria != "0"){
				$categoria = (int) $categoria;
				$clausula[$clausulas] = "categoria_id = ".$categoria;
				$clausulas++;
			}
			
			//adicionando as cláusulas de consulta a query
			for($i = 0; $i < $clausulas; $i++){
				if($i == 0){
					$query .= " WHERE ".$clausula[$i];
				}else{
					$query .= " AND ".$clausula[$i];
				}
			}
			
			$sql = $pdo->prepare($query);//enviando a instrução para o banco
			
			$sql->execute();//executando instrução
			
			return $sql;//retornando registros
			
		}
		
		//função que retorna as categorias dos produtos do banco
		public function categorias(){
			
			global $pdo;
			
			$sql = $pdo->prepare("SELECT * FROM categorias");
			
			$sql->execute();
			
			return $sql;
			
		}

		//função para inserir um produto pela planilha. Retorna true para sucesso de execução e false caso aconteça um erro
		public function inserir_excel($linha, $codigo, $produto, $categoria, $preco){
            
            global $pdo;
            
            $sql = $pdo->prepare("CALL insert_produto_excel(:linha, :codigo, :nome, :categoria, :preco)");//chamando a procedure que insere o novo produto verificando se ele pode ou não ser inserido e também colocando o resultado da operação no relatório 
            $sql->bindValue(":linha", (int) $linha);
            $sql->bindValue(":codigo", (int) $codigo);
            $sql->bindValue(":nome", $produto);
            $sql->bindValue(":categoria", (int) $categoria);
            $sql->bindValue(":preco", (float) $preco);
            
            try{
                $sql->execute();
                $retorno = true;
            }catch(Exception $e){
                $retorno = false;
            }
            
            return $retorno;
        }
		
	}

?>
