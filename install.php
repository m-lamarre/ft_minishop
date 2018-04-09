<?php

function db_server()
{
	static $connection;

	if (!isset($connection))
		$connection = mysqli_connect('localhost', 'root', '12345678');
	if ($connection === false)
		die ("Could not get server connection.\n");
	else
		return ($connection);
}

function db_create_database($db)
{
	$connection = db_server();
	if (mysqli_query($connection, "CREATE DATABASE " . $db) === false)
		die ("Failded to create database\n");
}

function db_create_table($db, $ut, $data)
{
	$connection = db_server();
	if (mysqli_query($connection, "CREATE TABLE `" . $db . "`.`" . $ut . $data) === false)
		die ("Failded to create table\n");
}
$db = "nerds";
$ut = "users";
$ud = "`(`id` INT NOT NULL AUTO_INCREMENT , `login` VARCHAR(255) NOT NULL , `passwd` VARCHAR(10000) NOT NULL , PRIMARY KEY (`id`) , UNIQUE `login` (`login`)) ENGINE = InnoDB";
db_create_database($db);
db_create_table($db, $ut, $ud);

?>
