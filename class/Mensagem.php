<?php

	class Mensagem{
		
		//função para exibir uma mensagem em forma de alerta javascript
		public function alert($msg){
			
			echo("<script type='text/javascript'>");
			echo("alert('".$msg."');");
			echo("</script>");
		}
		
		//função para setar uma nova mensagem de sessão
		public function set($msg){
			if(isset($_SESSION['msg'])){
				$_SESSION['msg'] = $msg;
			}else{
				session_start();
				$_SESSION['msg'] = $msg;
			}
		}
		
		//função para exibir uma mensagem de sessão somente se existir
		public function get(){
			
			if(isset($_SESSION['msg'])){
				if($_SESSION['msg'] != "Nenhuma mensagem encontrada!"){ 
					$this->alert($_SESSION['msg']);
					$_SESSION['msg'] = "Nenhuma mensagem encontrada!";
				}
			}
		}
			
	}

?>
