# Importando e exportando planilhas

Essa aplicação feita com Php, MySQL, HTML, CSS e Javascript faz importação e exportação de dados com planilhas. Ela é capaz de importar os dados de uma planilha para o banco fazendo as devidas verificações para não inserir um dado repetido ou inválido, além disso é capaz de exportar os dados do banco para uma planilha. Para utilizá-la importe o banco de dados comercio.sql para seu SGBD e faça as configurações de conexão com o banco no método construtor da classe Database.

## Exibindo dados dos produtos

Podemos visualizar os dados dos produtos e fazer filtragem de registros de acordo com a categoria, nome ou código. Além disso essa filtragem também define quais dados serão exportados para a planilha.

![produtos](https://github.com/rodriguesrenato61/sistema-planilhas/blob/master/img/produtos.png)

## Exportando produtos

Exporta os dados dos produtos em uma planilha.

![exportar](https://github.com/rodriguesrenato61/sistema-planilhas/blob/master/img/planilha.png)

## Importando produtos

Importa um arquivo de planilha dos produtos no formato csv para preencher o banco de dados

![importar](https://github.com/rodriguesrenato61/sistema-planilhas/blob/master/img/importar.png)

## Exibindo planilha

Exibe os dados da planilha importada.

![produtos_carregados](https://github.com/rodriguesrenato61/sistema-planilhas/blob/master/img/produtos_carregados.png)

## Exibindo relatório

Exibe o resultado da importação, para ver quais linhas foram inseridas, rejeitadas e inválidas.

![relatorio](https://github.com/rodriguesrenato61/sistema-planilhas/blob/master/img/relatorio.png)
