<?php

	class Planilha{
	
		//função que exporta e baixa os dados em uma planilha
		public function exportar($html, $arquivo){
			
			header("Content-Description: Php Generated Data");
			header("Content-Type: application/xls");
			header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
			header("Expires: 0");
			header("Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0");
			header("Pragma: no-cache");
            
			echo($html);
		}
	}
?>
