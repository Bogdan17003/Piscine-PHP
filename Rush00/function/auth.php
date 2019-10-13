<?php
function auth($login, $passwd)
{
	$accounts = unserialize(file_get_contents("../file/list_of_users"));
	if (!$accounts || !$login || !$passwd)
		return false;
	foreach ($accounts as $u => $value)
	{
		if ($value['reg_login'] == $login && hash("whirlpool", $passwd) === $value['reg_passwd'])
			return true;
	}
	return false;
}
?>
