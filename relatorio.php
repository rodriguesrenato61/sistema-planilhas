<!DOCTYPE html>
<html>
    <head>
        <title>Relatório</title>
        <meta charset="UTF-8">
        <!--importando a folha de estilos do bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        
        <!--importando nossa folha de estilos-->
        <link rel="stylesheet" href="css/relatorio.css">
    </head>
    <body>
	<?php
		include_once('class/Relatorio.php');
		
		$r = new Relatorio();
		
	?>
        
        <h2><a href="index.php"><<<<</a></h2>
        
        <div class="container">
            <nav class="navbar navbar-light">
		<h1>Relatório</h1>
		<a class="navbar-brand" href="importar.php">
			<button class="btn btn-primary">importar</button>
		</a>
	    </nav>
	    <form method="GET" class="form-inline" id="relatorio_search">  
		<div class="form-group mx-sm-3 mb-2">
			<select class="form-control" name="tipo" id="codigo">
				<option value="">--Tipo--</option>
				<?php
					$tipos = $r->tipos_linha();
					while($tipo = $tipos->fetch()){
						if(isset($_GET['tipo'])){
							if($tipo['id'] == $_GET['tipo']){
								echo("<option selected value='".$tipo['id']."'>".$tipo['descricao']."</option>");
							}else{
								echo("<option value='".$tipo['id']."'>".$tipo['descricao']."</option>");
							}

						}else{
							echo("<option value='".$tipo['id']."'>".$tipo['descricao']."</option>");
						}
					}
				?>
			</select>
		</div>
		<button type="submit" id="filtrar" class="btn btn-primary">Filtrar</button>
	    </form>
            <div id="div_tabela">
		<table class="table table-striped">
			<tr>
				<th>Linha</th>
				<th>Resultado</th>
				<th>Tipo</th>
			</tr>
			<?php
				if(isset($_GET['tipo'])){//se os filtros de busca foram setados os registros do relatório serão filtrados
					$tipo = $_GET['tipo'];
					$registros = $r->exibir($tipo);
				}else{//senão todos os registros serão exibidos
					$registros = $r->exibir("");
				}
				
				//imprimindo os registros
				while($registro = $registros->fetch()){
					echo("<tr>");
					echo("<td>".$registro['linha']."</td>");
					echo("<td>".$registro['valor']."</td>");
					echo("<td>".$registro['tipo']."</td>");
					echo("</tr>");
				}
			?>
		</table>
	    </div>
	</div>
    </body>
</html>
