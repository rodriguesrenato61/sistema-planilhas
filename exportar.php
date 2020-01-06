<!DOCTYPE html>
<html>
    <head>
        <title>Exportar produtos</title>
        <meta charset="UTF-8">
    </head>
    <body>
    
        <?php

            include_once('class/Produto.php');
            include_once('class/Planilha.php');
    
            $p = new Produto();
            $pl = new Planilha;
            $arquivo = "produtos.xls";//nome da planilha a ser baixada
    
            //se todos os filtros de busca foram setados somente esses registros irão para a planilha
            if(isset($_GET['codigo']) && isset($_GET['produto']) && isset($_GET['categoria'])){
        
                $codigo = $_GET['codigo'];
                $produto = $_GET['produto'];
                $categoria = $_GET['categoria'];
        
                $produtos = $p->exibir($codigo, $produto, $categoria);
        
            }else{//se os filtros de busca não foram setados todos os registros serão carregados
        
                $produtos = $p->exibir(0, null, 0);
        
            }
    
            //colocando a tabela com os dados na variável
            $html = "<table border=1>";
            $html .= "<tr>";
            $html .= "<th>Código</th>";
            $html .= "<th>Produto</th>";
            $html .= "<th>Categoria id</th>";
            $html .= "<th>Categoria</th>";
            $html .= "<th>Preço</th>";
            $html .= "</tr>";
    
            while($produto = $produtos->fetch()){
        
                $html .= "<tr>";
                $html .= "<td>".$produto['codigo']."</td>";
                $html .= "<td>".$produto['produto']."</td>";
                $html .= "<td>".$produto['categoria_id']."</td>";
                $html .= "<td>".$produto['categoria']."</td>";
                $html .= "<td>".$produto['preco']."</td>";
                $html .= "</tr>";
                
            }
    
            $html .= "</table>";
            
            $pl->exportar($html, $arquivo);//exportando planilha

        ?>
   
    </body>
</html>

