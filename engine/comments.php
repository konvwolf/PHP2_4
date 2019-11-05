<?php
header('Location: /product/' . $_POST['prod_name'] . '/');
include ($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'const.php'); // константы сайта
include (ENGINE_PATH.'pdo.php'); // PDO

$name = $_POST['name'];
$product = $_POST['prod_name'];
$comment = $_POST['comm'];
$dataString = '\'' . $product . '\', \'' . $name . '\', \'' . $comment .'\'';
if ($name) {
    $db -> exec ('INSERT INTO ' . COMMENTS . ' (prod_name, user_name, user_comment) VALUES (' . $dataString . ')');
}