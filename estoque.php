<?php 
    session_start();
    include_once('index.php');

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <table>
        <tr>
            <td>Produto</td>
            <td>Quantidade</td>
        </tr>

<?php 
    for($i=0; $i<=24; $i++){
        $conexao = new mysqli('localhost', 'root', '', 'amvrosiadb');
        $select_prod = mysqli_query($conexao, "SELECT nomeProd, qtdProd FROM produtos WHERE id={$i}");

?>
        <tr>
            <td><?php echo $select_prod?></td>
            <td><?php echo $select_qtd?></td>
        </tr>



<?php 
    }
?>
    </table>
</body>
</html>