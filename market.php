<?php
session_start();
?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>Carrinho de compras PHP</title>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>

<body>
    <h2 class="title">Carrinho com PHP</h2>
    <div class="container-carrinho">
        <?php
        $items = array(
            ['nome' => 'Iphone 13', 'imagem' => './assets/iphone.jpg', 'preco' => '4500'],
            ['nome' => 'Televisão 40', 'imagem' => './assets/tv.jpg', 'preco' => '2800'],
            ['nome' => 'Macbook', 'imagem' => './assets/mac.jpg', 'preco' => '3500']
        );

        foreach ($items as $key => $value) {
            ?>
            <div class="div-img">
                <img src="<?php echo $value['imagem'] ?>" />
                <a href="?adicionar=<?php echo $key ?>">Adicionar ao carrinho</a>

            </div>
            <?php
        }

        ?>

    </div> <!--fim div container -->
    <?php
    if (isset($_GET['adicionar'])) {
        $id_produto = (int) $_GET['adicionar'];
        if (isset($items[$id_produto])) {
            if (isset($_SESSION['carrinho'][$id_produto])) {
                $_SESSION['carrinho'][$id_produto]['quantidade']++;

            } else {
                $_SESSION['carrinho'][$id_produto] = array('quantidade' => 1, 'nome' => $items[$id_produto]['nome'], 'preco' => $items[$id_produto]['preco']);
            }
            echo '<script>alert("O item foi adicionado ao carrinho")</script>';
        } else {
            die('Você nao pode adicionar um item que não existe ');
        }
    }
    ?>
    <h2 class='title2'> Carrinho: </h2>
    <?php
    foreach ($_SESSION['carrinho'] as $key => $value) {
        echo '<div class="carrinho-item">';
        echo '<p>Nome: ' . $value['nome'] . '| Quantidade: ' . $value['quantidade'] . '| Preço: R$' 
        . (number_format(($value['quantidade'] * $value['preco']), 2, ",", ".")) . '</p>';
        echo '<hr>';
        echo '</div>';
    }
    ?>
</body>

</html>