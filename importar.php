<?php
    include_once('class/Mensagem.php');
    session_start();
    $m = new Mensagem;
    $m->get();//se houver alguma mensagem de sessão para ser exibida como algum erro ao importar a planilha ela será exibida
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Importar</title>
        <meta charset="UTF-8">
        <!--importando a folha de estilos do bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        
        <!--importando nossa folha de estilos-->
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        
        <h2><a href="index.php"><<<<</a></h2>
        
        <div class="container">

            <h1>Carregar produtos</h1><br>
            <h5>Carregue um arquivo no formato csv</h5><br>
            <!--formulário de carregamento de arquivo-->
            <form method="POST" action="csv_produtos.php" enctype="multipart/form-data">
                <input type="file" class="btn" name="arquivo">
                <br>
                <br>
                <input type="submit" class="btn btn-primary" value="Enviar">
            </form>
        </div>

    </body>

</html>
