<?php

    include_once('class/Produto.php');
    include_once('class/Relatorio.php');
    include_once('class/Mensagem.php');
    
    $p = new Produto();
    $r = new Relatorio();
    $m = new Mensagem;
    
    $r->start();//reiniciando o relatório
    
    $delimitador = ',';//delimitador de dados
    $cerca = '"';//delimitador de linhas

    $linhas = 1;//primeira linha da planilha
    $erro = false;//variável que diz se ocorreu algum erro na importação

    // Abrir arquivo para leitura
    
    try{

        $csv_arquivo = $_FILES['arquivo']['tmp_name'];//pegando arquivo importado
        
        $planilha = fopen($csv_arquivo, 'r');//abrindo arquivo em forma de leitura
        
        if ($planilha) { 

            // Enquanto não terminar o arquivo
        
            while (!feof($planilha)) {

                // Ler uma linha do arquivo e separa seus dados em um array
                $celula = fgetcsv($planilha, 0, $delimitador, $cerca);
                
                if($linhas == 1){//se a linha atual for a primeira onde contém os títulos das colunas
                    
                    //verifica se os nomes das colunas estão corretos
                    if ($celula && $celula[0] == "Código" && $celula[1] == "Produto" && $celula[2] == "Categoria id" && $celula[3] == "Categoria" && $celula[4] == "Preço"){
                    
                        $linhas++;
                        
                        $html = "<table class='table table-striped'>";
                        $html .= "<tr>";
                        $html .= "<th>Código</th>";
                        $html .= "<th>Produto</th>";
                        $html .="<th>Categoria id</th>";
                        $html .="<th>Categoria</th>";
                        $html .= "<th>Preço</th>";
                        $html .= "</tr>";
                        
                        continue;
                        //se os nomes estiverem corretos a leitura irá prosseguir
                    }else{
                        
                        $m->set("Colunas com nomes incorretos!");
                        $erro = true;
                        break;
                        //senão a leitura será interrompida
                    }

                }else{
                    
                    if($celula && count($celula) == 5){
                    
                        //separando e colcando os dados em uma tabela
                        $codigo = $celula[0];
                        $produto = $celula[1];
                        $categoria_id = $celula[2];
                        $categoria = $celula[3];
                        $preco = $celula[4];
                    
                        $html .= "<tr>";
                        $html .= "<td>".$codigo."</td>";
                        $html .= "<td>".$produto."</td>";
                        $html .= "<td>".$categoria_id."</td>";
                        $html .= "<td>".$categoria."</td>";
                        $html .= "<td>".$preco."</td>";
                        $html .= "</tr>";
            
                        //verifica se a tentativa de inserção foi bem sucedida ou não
                        $result = $p->inserir_excel($linhas, $codigo, $produto, $categoria_id, $preco);
                    
                        if(!$result){//se ela não foi bem sucedida será inserida uma linha inválida no relatório
                        
                            $r->inserir($linhas, 3, "Linha inválida!");
                        
                        }
                        
                        $linhas++;
                    }
            
                }
                
            }
        
            $html .= "</table>";
        
            fclose($planilha);//fechando o arquivo
            
        }else{//se as colunas estiverem com os nomes incorretos a importação é cancelada e a mensagem é setada
            
            $m->set("Erro ao importar arquivo!");
            
        }
    
    }catch(Exception $e){
        
        $m->set($e->getMessage());
        $erro = true;
        
    }
    
    if($erro){//se ocorreu algum erro a planilha é fechada e voltamos para página de importação
        fclose($planilha);
        header("Location: importar.php");
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Produtos carregados</title>
        <meta charset="UTF-8">
        <!--importando a folha de estilos do bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        
        <!--importando nossa folha de estilos-->
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        
        <h2><a href="index.php"><<<<</a></h2>
        
        <div class="container">
            <nav class="navbar navbar-light">
                <h1>Produtos carregados</h1>
                <a class="navbar-brand" href="relatorio.php">
                    <button class="btn btn-primary">relatório</button>
                </a>
            </nav>
            <div id="div_tabela">
                <?php
                    echo($html);//imprimindo tabela
                ?>
            </div>
        </div>
    </body>
</html>

		
                    
               
