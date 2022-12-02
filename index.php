<?php
error_reporting(0);
?>

<?php 
    session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/script.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0" />
    <title>Amvrosía Food</title>
</head>
<body>

    <div class="mercado">
        <h2>Amvrosía Food</h2>
    </div>

    <div class="container">
<?php 

    $itens = array(['imagem'=>'imagens/empadinha.jpeg', 'nome'=>'Empada' ,'preco'=>'3.00'],
        ['imagem'=>'imagens/paoQueijo.jpeg', 'nome'=>'Pão de Queijo' ,'preco'=>'1.50'],
        ['imagem'=>'imagens/enroladinho de salsicha.jpg', 'nome'=>'Enroladinho de Salsicha' ,'preco'=>'5.00'],
        ['imagem'=>'imagens/pastel-de-carne.jpg', 'nome'=>'Pastel de Carne' ,'preco'=>'7.00'],
        ['imagem'=>'imagens/pastel-de-frango.jpeg', 'nome'=>'Pastel de Frango' ,'preco'=>'7.00'],
        ['imagem'=>'imagens/pastel-de-presunto.jpg', 'nome'=>'Pastel de Presunto e Queijo' ,'preco'=>'7.00'],
        ['imagem'=>'imagens/coxinha-de-carne.jpg', 'nome'=>'Coxinha de Carne' ,'preco'=>'7.50'],
        ['imagem'=>'imagens/coxinha-de-frango.jpeg', 'nome'=>'Coxinha de Frango' ,'preco'=>'7.50'],
        ['imagem'=>'imagens/Brigadeiro.jpg', 'nome'=>'Brigadeiro' ,'preco'=>'4.00'],
        ['imagem'=>'imagens/torta-de-limao.jpg', 'nome'=>'Torta de Limão' ,'preco'=>'10.00'],
        ['imagem'=>'imagens/bolo-de-morango.jpg', 'nome'=>'Fatia de Bolo de Morango' ,'preco'=>'5.00'],
        ['imagem'=>'imagens/cookie.jpg', 'nome'=>'Cookie' ,'preco'=>'3.50'],
        ['imagem'=>'imagens/pe-de-moleque.jpg', 'nome'=>'Pé de Moleque' ,'preco'=>'2.50'],
        ['imagem'=>'imagens/pacoca.jpg', 'nome'=>'Paçoquinha' ,'preco'=>'1.00'],
        ['imagem'=>'imagens/torta-de-morango.jpg', 'nome'=>'Torta de Morango' ,'preco'=>'10.00'],
        ['imagem'=>'imagens/doce-de-leite.jpg', 'nome'=>'Doce de leite' ,'preco'=>'2.50'],
        ['imagem'=>'imagens/coca-350.jpg', 'nome'=>'Coca Cola 350ml' ,'preco'=>'4.50'],
        ['imagem'=>'imagens/fanta-laranja-350.jpg', 'nome'=>'Fanta Laranja 350ml' ,'preco'=>'4.50'],
        ['imagem'=>'imagens/fanta-uva-350.jpg', 'nome'=>'Fanta Uva 350ml' ,'preco'=>'4.50'],
        ['imagem'=>'imagens/guarana-350.jpg', 'nome'=>'Guaraná 350ml' ,'preco'=>'4.50'],
        ['imagem'=>'imagens/coca-600.jpeg', 'nome'=>'Coca Cola 600ml' ,'preco'=>'6.00'],
        ['imagem'=>'imagens/fanta-laranja-600.jpg', 'nome'=>'Fanta Laranja 600ml' ,'preco'=>'6.00'],
        ['imagem'=>'imagens/fanta-uva-600.jpg', 'nome'=>'Fanta Uva 600ml' ,'preco'=>'6.00'],
        ['imagem'=>'imagens/guarana-600.jpeg', 'nome'=>'Guaraná 350ml' ,'preco'=>'6.00']);

    foreach($itens as $key => $value) {
?>
    <div class="produtos">
        <div class="imagem-preco">
            <img src="<?php echo $value['imagem'] ?>" />
            <p>R$ <?php echo $value['preco'];?></p>
        </div><!--imagem-preco-->

        <a href="?adicionar=<?php echo $key ?>">ADICIONAR</a>
    </div><!--produtos-->

<?php
    };
?>

<?php 
        
?>
    </div><!--container-->

    <div class="teste">
    <?php 
            if(isset($_GET['adicionar'])){
                echo $itens['nome'];
                $idProduto = (int) $_GET['adicionar'];
                if(isset($itens[$idProduto])){
                    if(isset($_SESSION['carrinho'][$idProduto])){
                        $_SESSION['carrinho'][$idProduto]['quantidade']++;
                    }else {
                        $_SESSION['carrinho'][$idProduto] = array('quantidade'=>1, 'nome'=>$itens[$idProduto]['nome'], 
                        'preco'=>$itens[$idProduto]['preco']);
                    }
                    

                } else {
                    die('Você não pode adicionar um item que não existe.');
                }
            };
    ?>

    </div><!--teste-->
<?php 
    if(isset($_GET['remover'])){
        $idProduto = (int) $_GET['remover'];
        if(isset($_SESSION['carrinho'][$idProduto])){
            $_SESSION['carrinho'][$idProduto]['quantidade']--;
            if($_SESSION['carrinho'][$idProduto]['quantidade'] == 0){
                unset($_SESSION['carrinho'][$idProduto]);
            }
            
        }
    }
?>
    <div class="lista-produtos">
        <div class="container-compras">
            <p>Nova compra</p>
        </div>
<?php 

    $_SESSION['dados'] = array();

    foreach($_SESSION['carrinho'] as $key => $value){
?>
            
         

        <div class="nome-preco">
            <a href="?remover=<?php echo $key ?>"><span class="material-symbols-outlined">delete</span></a>
    
            <h2><?php echo $value['nome']?></h2>         
           
            <p><?php echo $value['quantidade'];?></p>


        </div><!--nome-preco-->
<?php 
    $preco += $value['preco']*$value['quantidade'];            
?>
   
   
<?php

    array_push($_SESSION['dados'], array('id_produto' => $idProduto, 'nome'=> $value['nome'] ,'quantidade' => $value['quantidade'],
    'preco' => number_format($value['preco']*$value['quantidade'],2,',','.'), 'total'=> number_format($preco,2,',','.')));

    
?>

<?php
    }
?>

    


        <div class="total">
            <p>TOTAL</p>
            <p class="preco-total">R$ <?php echo number_format($preco,2,',','.'); ?></p>
        </div><!--Total-->

        <a class="btn-finalizar" href="finalizar.php">FINALIZAR</a>

    </div><!--lista-produtos-->
    
    
    


<aside class="coluna-lateral">
    <div class="logo">
        <img class="cereal" src="logo/Cereal em cores 1.png" alt="">
        <img class="amvrosia" src="logo/Amvrosía.png" alt="">
        <img class="food" src="logo/Food.png" alt="">
    </div><!--logo-->
</aside><!--coluna-lateral-->
</body>
</html>