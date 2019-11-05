<?php
try
{
	$connect_str = DRIVER . ':host='. SITE . ';dbname=' . DATABASE;
    $db = new PDO($connect_str, ADMIN, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}

catch(PDOException $error)
{
	die("Error: ".$error->getMessage());
}