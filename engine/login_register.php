<?php
session_start(); // Начинаем сессию
header('Location: /'); // Редирект на главную страницу
include ($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'const.php'); // константы сайта
include (ENGINE_PATH.'func.php'); // функции сайта
include (ENGINE_PATH.'pdo.php');

if (isset($_POST['loging'])) { // Если логинимся
    if (isset($_POST['login']) && isset($_POST['pwd'])) { // Проверяем, введены ли логин и пароль
        $getLogData = $db -> query ('SELECT password FROM ' . USERS . ' WHERE login = \'' . $_POST['login'] . '\'');
        $userData = $getLogData -> fetch (PDO::FETCH_ASSOC);
        if (password_verify ($_POST['pwd'], $userData['password'])) { // Проверяем пароль
                $_SESSION['login'] = $_POST['login']; // Сохраняем логин в сессию
                $_SESSION['logged'] = true; // Означает, что залогинились. Дополнительная проверка
        }
    }
}

if (isset($_POST['register'])) { // Если регистрируемся
    if (preg_match ('/[a-zA-Zа-яА-Я]/', $_POST['name']) && // Регулярка имени (русские и латинские буквы)
    filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && // Почта
    preg_match ('/^[a-zA-Z0-9]+$/', $_POST['login']) && // Регулярка логина (русские и латинские буквы, цифры)
    preg_match ('/^[a-zA-z0-9]{8,}$/', $_POST['pwd'])) { // Регулярка пароля (латинские буквы, цифры, минимум восемь символов)
        $pass = password_hash ($_POST['pwd'], PASSWORD_DEFAULT);    
        $count = $db -> exec ('INSERT INTO ' . USERS . ' (name, login, email, password) VALUES (\'' .
            $_POST['name'] . '\', \'' . $_POST['login'] . '\', \'' . $_POST['email'] . '\', \'' . $pass . '\')'); // Пишем в БД
        if ($count !== false) {
            $_SESSION['login'] = $_POST['login']; // Сохраняем логин в сессию
            $_SESSION['logged'] = true; // После регистрации пользователь сразу залогинен
        }
    }
}