<?php

// Размещение заказа на сайте
session_start();
header('Location: /');
include ($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'const.php'); // константы сайта
include (ENGINE_PATH.'func.php'); // функции сайта
include (ENGINE_PATH.'pdo.php'); // PDO

if (isset($_POST['cartContents'])) { // Получаем содержимое корзины в виде JSON-строки
    $postArr = (array) json_decode($_POST['cartContents']); // Разбираем JSON-строку на массив объектов
    foreach ($postArr as $place) { // Перебираем массив
        $id = $place->id; // Идентификатор товара из объекта
        $name = $place->name; // Название товара из объекта
        $quantity = $place->quantity; // Количество товара из объекта
        $login = $_SESSION['login']; // Если пользователь залогинен, товары будут сохранены за его логином
        $db -> exec ('INSERT INTO ' . CART . ' (login, prod_id, prod_name, quantity) VALUES (\'' .
            $login . '\', \'' . $id . '\', \'' . $name . '\', \'' . $quantity . '\')'); // Пишем в БД
    }
}