<?php
include ('config/const.php');
include (ENGINE_PATH.'func.php');
include (ENGINE_PATH.'pdo.php');
require_once SITE_ROOT.'engine'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php'; // автолоадер Composer, Symphony и Twig
session_start();

try {
    $loader = new \Twig\Loader\FilesystemLoader (TEMPLATES_PATH);
    $twig = new \Twig\Environment ($loader, [
        'cache' => CACHE_PATH
    ]);
} catch (Exception $error) {
    die('Error: ' . $error->getMessage());
}

$styles = scanDir4Files(STYLES_PATH); // файлы стилей
$js = scanDir4Files(JS_PATH); // файлы JS-скриптов
$logged = false; // пользователь не залогинен
$twigArr = []; // Массив для шаблонизатора. Дополняется на других страницах сайта

if (isset ($_SESSION['login']) && isset ($_SESSION['logged'])) {
    $logged = true; // пользователь залогинился
}

if (isset($_GET['productHURL']) && !empty($_GET['productHURL'])) { // человекопонятный URL
    $productHURL = str_replace('/', '', $_GET['productHURL']);
} elseif (isset($_GET['productHURL']) && empty($_GET['productHURL'])) {
    $productHURL = '';
}

if (isset($productHURL)) { // Если выбран товар, показать его описание
    include (ENGINE_PATH.'product_desc.php');
    $page2show = 'product_desc';
} elseif ($_GET['lk']) { // Если выполнен переход в личный кабинет
    include (ENGINE_PATH.'user_page.php');
    $page2show = 'user_page';
} else {
    include (ENGINE_PATH.'products_list.php'); // Список товаров
    $page2show = 'products_list';
}

$twigArr = array_merge ($twigArr,
    [
        'title'         =>  'Магазин "Все для мира"',
        'styles'        =>  $styles,
        'js'            =>  $js,
        'logged'        =>  $logged,
        'productHURL'   =>  $productHURL,
        'userLogin'     =>  $_SESSION['login'],
        'page2show'     =>  $page2show
    ]);

echo $twig -> render('index.html',
$twigArr);