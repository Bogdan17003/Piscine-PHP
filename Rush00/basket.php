<?php
    session_start();
    if (!isset($_SESSION['user']))
        header('Location: signup.php');
    if ($_POST['exit'] == "close")
        session_destroy();
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RUSH00.localhost:8080</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700&display=swap&subset=cyrillic" rel="stylesheet">
<!--    <link href="css/fontawesome/all.css" rel="stylesheet">-->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/content.css">
</head>
<body>
<header class="header">
<div class="container">
    <div class="nav">
        <h1>RUSH00.localhost:8080</h1>
        <div class="buttons">
<?php
    session_start(); 
    if ($_SESSION['user'])
    {
        echo '
                    <p>'. $_SESSION['user'] .'</p>
                    <form class="login" action="index.php" method="POST">
                        <button class="menu" type="submit" name="exit" value="close" >Выйти</button>
                    </form>
        ';
    }
    else
        echo '
                    <div class="logout">
                        <a class="text" href="login.php" >Регистрация</a>
                        <a class="text" href="signup.php" >Войти</a>
                    </div>
    ';
?>   
                <a class="text" href="basket.php">Корзина <!-- <i class="fas fa-certificate pointer" aria-hidden="true"></i>--></a>
            </div>
        </div>
    </div>
</header>
<section class="navigation">
    <div class="container">
        <form class="actions" action="content.php" method="POST">
            <button class="menu" type="submit" name="button" value="clothes">Одежда</button>
            <button class="menu" type="submit" name="button" value="shoes">Обувь</button>
            <button class="menu" type="submit" name="button" value="accessory">Аксессуары</button>
            <button class="menu" type="submit" name="button" value="premium">Premium</button>
            <button class="menu" type="submit" name="button" value="sport">Спорт</button>
        </form>
    </div>
</section>
<section>
        <div class="container">
        <div class="way">
          <a href="index.php"><h2>Главная</h2></a><h2> / <h2>Корзина</h2>
        </div>
    <div class="products">
<?php
session_start();
if ($_GET['add'])
{
    $ooo = unserialize(file_get_contents("file/list_of_goods"));
    foreach ($ooo as $clo => $value) {
        if ($_GET['add'] == $value['info'])
        {
            if (isset($_SESSION['basket'][$_GET['add']]))
                $_SESSION['basket'][$_GET['add']]['amount']++;
            else
            {
                $_SESSION['basket'][$_GET['add']] = $value;
                $_SESSION['basket'][$_GET['add']]['amount'] = 1;
            }
        }
    }
    header('Location: basket.php');
}
else if ( $_POST['buy'])
{
    if (file_exists("file/buy") === false)
        file_put_contents("file/buy", null);
    $buy = unserialize(file_get_contents("file/buy"));
    $user = $_SESSION['user'];
    
    foreach ($_SESSION['basket'] as $key => $value) {
        $buy[$user]['product'] = $value;
    }
    file_put_contents("file/buy", serialize($buy));
    $_SESSION['basket'] = array();
    header('Location: basket.php');
}
$goods = $_SESSION['basket'];
$all = 0;
$i = 1;
foreach ($goods as $u => $value)
{
    $all += $value['price'] * $value['amount'];
    $src = "goods/" . $value['pict'];
    echo '  <div class="product">
                <img class="images" src="'. $src .'" width="200" height="300">
                <div class="descriptio">
                    <p> '. $value['name'] .'</p>
                    <p> '. $value['info'] .'</p>
                    <h3>Цена: '. $value['price'] . ' * ' . $value['amount'] . ' = ' . $value['price'] * $value['amount']. 'грн.</h3>
                </div>
            </div>
        ';
    if (!($i % 3))
        echo '</div><div class="products">';
    $i++;
}
?>
    </div>
            <div class="knopka">
    <h2 class="TEXT">Общая сумма: <?php echo $all ." грн."?></h2>
    <form class="actionss" action="basket.php" method="POST">
        <button class="buy" type="submit" name="buy" value="OK">Заказать</button>
    </form>
            </div>
        </div>
</section>