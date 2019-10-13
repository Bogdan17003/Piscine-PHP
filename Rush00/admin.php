<?php
	session_start();
	if ($_POST['name'] && $_POST['pict'] && $_POST['submit'] === "OK" && $_POST['info'] && $_POST['type'] && $_POST['price'])
	{
		if (file_exists("goods/".$_POST['pict']) === false)
			$Err = "Файл не обнаружен. Переместите файл в папку goods/";
		else
		{
			if (file_exists("file/list_of_goods") === false)
				file_put_contents("file/list_of_goods", null);
			$goods = unserialize(file_get_contents("file/list_of_goods"));
			$goods[] = $_POST;
			file_put_contents("file/list_of_goods", serialize($goods));
		}
	}
	if ($_POST['logout'] == "LOGOUT")
		header('Location: index.php');
	if ($_POST['del'] == "Delete")
	{
		$users = unserialize(file_get_contents("file/list_of_users"));
        foreach ($users as $u => $value)
        {
            if ($value['login'] == $_POST['login'])
            	unset($users[$u]);
            file_put_contents("file/list_of_users", serialize($users));
        }
	}
?>
<html>
<body>
	<form method="POST">
		Название продукта: <input type="text" name="name" value="" />
		<input type="file" name="pict"><br>
		Описание: <input type="text" name="info" value="" /><br>
		Цена: <input type="text" name="price" value="" /><br><br>
		Выберите категории:<br>
		Одежда - <input type="checkbox" name="clothes"><br>
		Обувь - <input type="checkbox" name="shoes"><br>
		Аксессуар - <input type="checkbox" name="accessory"><br>
		Premium - <input type="checkbox" name="premium"><br>
		Спорт - <input type="checkbox" name="sport"><br>
		Ж - <input type="radio" name="type" value="woman"> М - <input type="radio" name="type" value="man"><br><br>
		<input type="submit" name="submit" value="OK"><br><br>
		<input type="submit" name="logout" value="LOGOUT">
		<br><br>
		Удаление пользователя:<br>
		Login: <input type="text" name="login" value="" /><br>
		<input type="submit" name="del" value="Delete"><br><br>
	</form>
</body>
</html>