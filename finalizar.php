<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/finalizar.css">
    <title>Document</title>
</head>
<body>



<div class="mostra-produtos">
    <div class="cabecalho-produtos">
        <h1>PEDIDO EFETUADO!!!</h1>
        <p>A Amvrosía Food agradece a sua preferência!</p>
    </div><!--cabecalho-produtos-->
<?php

foreach($_SESSION['dados'] as $produtos){
    $conexao = new mysqli('localhost', 'root', '', 'amvrosiadb');
    mysqli_query($conexao, "UPDATE produtos SET qtdProd = qtdProd - '{$produtos['quantidade']}' WHERE nomeProd='{$produtos['nome']}'");
?>     



    <div class="itens">
        <p class="qtd"><?php echo $produtos['quantidade'];?></p>
        <p class="nome"><?php echo $produtos['nome'];?></p>
        <p class="preco">R$ <?php echo $produtos['preco'];?></p>
    </div><!--itens-->

   


<?php

}

?>
    <div class="total">
        <p>R$ <?php echo $produtos['total'];?></p>
    </div><!--total-->
</div><!--mostra-produtos-->
</body>
</html>

