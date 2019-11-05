<?php
(!$_GET['page']) ? $page = 0 : $page = ($_GET['page'] - 1) * PRODUCTS_TO_SHOW; // Переменная номера страницы для запроса из БД
// Запрашиваем три товара из БД с учетом страницы
$query = $db -> query ('SELECT prod.id, prod_name, prod_price, prod_hurl, phot.file_name, phot.image_name FROM ' . PRODUCTS .
        ' prod LEFT JOIN ' . PHOTOS . ' phot ON prod.id = phot.prod_id GROUP BY prod.id ORDER BY prod.id ASC LIMIT '. $page . ', 3');

// Пагинатор
$count = $db -> query ('SELECT COUNT(id) FROM ' . PRODUCTS);
$counter = $count->fetch(PDO::FETCH_NUM);
$pages = $counter[0] / PRODUCTS_TO_SHOW;
$pageNum =[];
for ($i = 1; $i <= $pages; $i++) {
    array_push($pageNum, $i);
}

$list = [];
while ($row = $query -> fetch (PDO::FETCH_ASSOC)) {
    array_push ($list, $row);
}

$twigArr = array_merge ($twigArr,
    [
        'productsList'  =>  $list,
        'pages'         =>  $pageNum
    ]);