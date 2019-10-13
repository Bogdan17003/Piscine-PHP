<?php
    session_start();
    if ($_POST['submit'] === "OK" && $_POST['login'] && $_POST['passwd'])
    {
        if ($_POST['login'] == "admin" && $_POST['passwd'] == "admin")
            header('Location: admin.php');
        else
        {
            $accounts = unserialize(file_get_contents("file/list_of_users"));
            foreach ($accounts as $u => $value)
            {
                if (($value['login'] == $_POST['login'] || $value['email'] == $_POST['login']) && hash("whirlpool", $_POST['passwd']) === $value['passwd'])
                {
                    $_SESSION['user'] = $_POST['login'];
                    header('Location: index.php');
                }
            }
        }
    }
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<form action="" method="POST">
    <h1 title="Вход на сайт">Вход</h1>
    <div class="group">
        <label for="">Имя пользователя</label>
        <input type="text" name="login" value="">
    </div>
    <div class="group">
        <label for="">Пароль</label>
        <input type="password" name="passwd" value="">
    </div>
    <div class="group">
        <center><button name="submit" value="OK">Вход</button></center>
    </div>
</form>
</body>
</html>