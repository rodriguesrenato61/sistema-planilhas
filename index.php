<!DOCTYPE html>
<html>
	<head>
		<title>Produtos</title>
		<meta charset="UTF-8">
		
		<!--importando a folha de estilos do bootstrap-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        
		<!--importando nossa folha de estilos-->
		<link rel="stylesheet" href="css/styles.css">
        
	</head>
	<body>
		<?php
			include_once('class/Produto.php');
			
			$p = new Produto();//instanciando um objeto da classe produto já conectado com o banco de dados
		?>
		
		<div class="container" id="produtos">
			<h1 id="title">Produtos</h1>
			
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="importar.php">Importar</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" 
						<?php
							//se todos os filtros de busca foram setados e pesquisados o link de exportação também incluirá esses filtros na planilha
							if(isset($_GET['codigo']) && isset($_GET['produto']) && isset($_GET['categoria'])){
								$codigo = $_GET['codigo'];
								$produto = $_GET['produto'];
								$categoria = $_GET['categoria'];
                                    
								echo("href='exportar.php?codigo=".$codigo."&produto=".$produto."&categoria=".$categoria."'>");
							}else{
								echo("href='exportar.php'>");
							}
						?>
						Exportar</a>
					</li>
				</ul>
			</nav>
                <form method="GET" class="form-inline" id="produtos_search">  
			<!--campo do código--> 
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" class="form-control" name="codigo" id="codigo" placeholder="codigo"
                        <?php
                            if(isset($_GET['codigo'])){
                                $codigo = $_GET['codigo'];
                                echo('value='.$codigo);
                            }
                        ?>
                        >
                        
                    </div>
                    <!--campo do produto-->
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" name="produto" id="produto" placeholder="produto"
                        <?php
                            if(isset($_GET['produto'])){
                                $produto = $_GET['produto'];
                                echo('value='.$produto);
                            }
                        ?>
                        >
                    </div>
                    <!--campo da categoria-->
                    <div class="form-group mx-sm-3 mb-2">
                        <select class="form-control" name="categoria" id="codigo">
							<option value="0">--Categoria--</option>
							<?php
								$categorias = $p->categorias();
								//imprimindo as categorias retornadas do banco como opções
								while($categoria = $categorias->fetch()){
									if(isset($_GET['categoria'])){
										if($_GET['categoria'] == $categoria['id']){
											echo("<option selected value='".$categoria['id']."'>".$categoria['nome']."</option>");
										}else{
											echo("<option value='".$categoria['id']."'>".$categoria['nome']."</option>");
										}
									}else{
										echo("<option value='".$categoria['id']."'>".$categoria['nome']."</option>");
									}
								}
							?>
                        </select>
                    </div>
                    <button type="submit" id="pesquisar" class="btn btn-primary mb-2">Pesquisar</button>
                </form>
                <div id="div_tabela">
			<table class="table table-striped" id="table_disciplinas">
				<tr>
					<th>Código</th>
					<th>Produto</th>
					<th>Categoria</th>
					<th>Preço</th>
				</tr>
					<?php
						
						//se todos os filtros foram pesquisados os registros serão filtrados
						if(isset($_GET['codigo']) && isset($_GET['produto']) && isset($_GET['categoria'])){
							
							$codigo = $_GET['codigo'];
							$nome = $_GET['produto'];
							$categoria = $_GET['categoria'];
								
							$produtos = $p->exibir($codigo, $nome, $categoria);//filtrando os registros
								
						}else{//se os filtros não foram pesquisados todos os registros serão carregados
								
							$produtos = $p->exibir(null, null, 0);//carregando registros sem filtros
								
						}
							
						//imprimindo registros
						while($produto = $produtos->fetch()){
							echo("<tr>");
							echo("<td>".$produto['codigo']."</td>");
							echo("<td>".$produto['produto']."</td>");
							echo("<td>".$produto['categoria']."</td>");
							echo("<td>R$ ".$produto['preco']."</td>");
							echo("</tr>");
						}
					?>
                
			</table>
			<br>
		</div>
	</body>
</html>

