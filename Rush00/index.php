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
?>                  <form class="baske">
                        <button class="menu" type="submit" name="button" value="basket" formaction="basket.php">Корзина</button>
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
        <form class="choose" action="content.php" method="POST">
            <button class="image" type="submit" name="type" value="woman">
                <div class="women">
                    <h1>Для Женщин</h1>
                </div>
            </button>
            <button class="image" type="submit" name="type" value="man">
                <div class="men">
                    <h1>Для Мужчин</h1>
                </div>
            </button>
        </form>
    </section>
    <section>
        <div class="container">
            <div class="dignity">
                <div class="dignity_one">
                    <img src="Rush00-assets/P1.png">
                    <h3>Быстрая доставка по всей Украине</h3>
                    <p>Мы гарантируем, что Ваш заказ будет доставлен в любую точку Украины до 8 дней. Доставка бесплатная призаказе от 750 гривен.</p>
                </div>
                <div class="dignity_two">
                    <img src="Rush00-assets/P2.png">
                    <h3>Проверка качества перед покупкой</h3>
                    <p>Вы можете проверить качество вещей перед курьером и выкупить заказ только, если Вы им довольны. Оплачивайте только то, что Вам понравилось. </p>
                </div>
                <div class="dignity_three">
                    <img src="Rush00-assets/P3.png">
                    <h3>Подлинные товары известных брендов</h3>
                    <p>Мы гарантируем качество и подлинность каждой вещи, которую Вы у нас купите. И у Вас всегда есть 30 дней, чтобы вернуть товар со 100% возмещением.</p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="firms">
                <a href="https://www.underarmour.com" title="Under Armour"><img src="Rush00-assets/underarmor.png"></a>
                <a href="https://www.oodji.com" title="Oodji"><img src="Rush00-assets/oogji.png"></a>
                <a href="https://www.nike.com" title="Nike"><img src="Rush00-assets/nike.png"></a>
                <a href="https://www.adidas.com" title="Adidas"><img src="Rush00-assets/adidas.png"></a>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="bottom">
                <p>Все права защищены</p>
                <p>RUSH00.localhost:8080 / 2019</p>
                <p>@bdeomin @akuchina</p>
            </div>
        </div>
    </footer>
</body>
</html>