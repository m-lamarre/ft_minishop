<?php

function db_connect()
{
	static $connection;

	if (!isset($connection))
		$connection = mysqli_connect('localhost', 'root', '12345678');
	if ($connection === false)
		die (mysqli_connect_error());
	else
		return ($connection);
}

function db_query($query)
{
	$connection = db_connect();
	$result = mysqli_query($connection, $query);
	if ($result === false)
		return (false);
	return $result;
}

function db_error()
{
	$connection = db_connect();
	return (mysqli_error($connection));
}

function db_select($query)
{
	$rows = array();
	$result = db_query($query);
	while ($line = mysqli_fetch_assoc($result))
		$rows[] = $line;
	return ($rows);
}

function drop_table($table)
{
	if (db_query("DROP TABLE " . $table) === false)
		echo db_error();
}

function create_user_table()
{
	if (db_query("CREATE TABLE `users`(`id` INT NOT NULL AUTO_INCREMENT , `login` VARCHAR(255) NOT NULL , `passwd` VARCHAR(10000) NOT NULL , PRIMARY KEY (`id`) , UNIQUE `login` (`login`)) ENGINE = InnoDB") === false)
		echo "Not working";
}

//drop_table("users");
//create_user_table();
//if (db_query("INSERT INTO `users` (`login`, `passwd`) VALUES ('Vern', '1234')") === false)
//	echo db_error();
//else
//{
	$rw = db_select("SELECT `login` FROM `users`");
	print_r($rw);
//}
unset($connection);
?>
