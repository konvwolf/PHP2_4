<?php
if (isset($_SESSION['login']) && $_SESSION['logged'] === true){
    $query = $db -> query ('SELECT u.id, u.login, u.name, c.shopping_date, c.prod_id, c.prod_name, c.quantity, p.prod_price FROM '
    . USERS . ' u LEFT JOIN '. CART . ' c ON u.login = c.login LEFT JOIN ' . PRODUCTS . ' p ON c.prod_id = p.id WHERE
    u.login = ' . '\'' . $_SESSION['login'] . '\' ORDER BY c.shopping_date DESC');

    $userData = [];
    while ($row = $query -> fetch (PDO::FETCH_ASSOC)) {
        array_push ($userData, $row);
    }

    $twigArr = array_merge ($twigArr,
        [
            'userName'      =>  $userData[0]['name'],
            'userId'        =>  $userData[0]['id'],
            'ifBought'      =>  $userData[0]['prod_id'],
            'boughtList'    =>  $userData
        ]);
}