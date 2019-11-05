<?php
include ($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'const.php'); // константы сайта
include (ENGINE_PATH.'pdo.php');

if (!empty($productHURL)) { // Человекопонятный URL не должен быть пустым
    // Запрашиваем данные о товаре из БД
    $query = $db -> query ('SELECT prod.id, prod_brand, prod_name, prod_desc, prod_price, phot.file_name, phot.image_name
        FROM ' . PRODUCTS . ' prod '.
        'JOIN ' . PHOTOS . ' phot ON prod.id = phot.prod_id AND prod.prod_hurl = '.'\''.$productHURL.'\'');
    
    $description = []; // массив с данными о товаре
    while ($row = $query -> fetch(PDO::FETCH_ASSOC)) {
        array_push ($description, $row);
    }

    /* Подробная информация о товаре, хранящаяся в колонке prod_desc в таблице products_desc.
    Информация хранится в виде JSON-строки. */
    $characteristics = (array) json_decode($description[0]['prod_desc']);

    $comments = $db -> query ('SELECT user_name, user_comment, comment_time FROM ' . COMMENTS . ' WHERE prod_name = ' . '\'' . $productHURL . '\''); // Читаем комментарии из БД

    $twigArr = array_merge ($twigArr,
        [
            'product'       =>  $description,
            'description'   =>  $characteristics,
            'comments'      =>  $comments,
            'productBrand'  =>  $description[0]['prod_brand'],
            'productName'   =>  $description[0]['prod_name'],
            'productPrice'  =>  $description[0]['prod_price']
        ]);
} else {
    // Если зашли в /product/ без указания человекопонятного URL, то будут показаны последние десять товаров
    $query = $db -> query ('SELECT prod_name, prod_hurl FROM ' . PRODUCTS . ' ORDER BY id DESC LIMIT 10');
    $whatWeHave = []; // Массив товаров
    while ($row = $query -> fetch (PDO::FETCH_ASSOC)) {
        array_push ($whatWeHave, $row);
    }
    $twigArr = array_merge ($twigArr,
        [
            'whatWeHave'    =>  $whatWeHave
        ]);
}