<?php
	session_start();
	if ($_POST['create'] === "OK" && $_POST['login'] && $_POST['passwd'] && $_POST['email'])
	{
		$ok = 1;
		if (file_exists("file/list_of_users") === false)
			file_put_contents("file/list_of_users", null);
		$users = unserialize(file_get_contents("file/list_of_users"));
		if ($users)
		{
			foreach ($users as $u => $value)
			{
				if ($value['login'] == $_POST['login'] || $value['email'] == $_POST['email'])
				{
					$ok = 0;
				}
			}
		}
		if ($ok == 1)
		{
			$user['login'] = $_POST['login'];
			$user['email'] = $_POST['email'];
			$user['passwd'] = hash("whirlpool", $_POST['passwd']);
			$users[] = $user;
			file_put_contents("file/list_of_users", serialize($users));
			$_SESSION['user'] = $_POST['login'];
			header('Location: index.php');
		}
	}
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<form action="" method="POST">
    <h1 title="Форма регистрации на сайте">Регистрация</h1>
    <div class="group">
        <label for="">Имя пользователя</label>
        <input type="text" name="login" value="">
    </div>
    <div class="group">
        <label for="">Пароль</label>
        <input type="password" name="passwd" value="">
    </div>
    <div class="group">
        <label for="">Адрес почты</label>
        <input type="email" name="email" value="">
    </div>
    <div class="group">
        <center><button name="create" value="OK">Регистрация</button></center>
    </div>
</form>
</body>
</html>