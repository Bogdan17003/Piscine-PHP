<?php
    session_start(); 
    if ($_POST['exit'] == "close")
    {
        session_destroy();
    }
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
                        <button class="menu" type="submit" name="exit" value="close">Выйти</button>
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
            <form class="baske">
                <button class="menu" type="submit" name="products" value="basket" formaction="basket.php">Корзина</button>
            </form>
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
            <a href="index.php"><h2>Главная</h2></a><h2> / </h2><h2 class="name_products"><?php echo $_POST['button'];?></h2>
        </div>
        <div class="products">
<?php
session_start();
$goods = unserialize(file_get_contents("file/list_of_goods"));
$i = 1;
foreach ($goods as $u => $value)
{
    if ($value[$_POST['button']] == "on" || $_POST['type'] == $value['type'])
    {
        $src = "goods/" . $value['pict'];
        echo '  <div class="product">
                    <img class="images" src="'.$src .'" width="200" height="300">
                    <div class="description">
                        <p> '. $value['name'] .'</p>
                        <p> '. $value['info'] .'</p>
                        <h3>Цена: '. $value['price'] .' грн.</h3>
                        <form action="basket.php" method="SESSION">
                            <button class="basket" type="submit" name="add" value="' . $value['info'] .'">В корзину</button>
                        </form>
                    </div>
                </div>
            ';
        if (!($i % 3))
            echo '</div><div class="products">';
        $i++;
    }
}
?>
        </div>
    </div>
</section>