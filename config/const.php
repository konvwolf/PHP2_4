<?php

// MySQL connection section
const DRIVER = 'mysql';
const SITE = '127.0.0.1';
const ADMIN = 'root';
const PASS = '';
const DATABASE = 'shop';

// MySQL tables
const PRODUCTS = 'products_desc'; // товары
const PHOTOS = 'products_pics'; // картинки товаров
const USERS = 'users_table'; // пользователи
const CART = 'user_carts'; // покупки
const COMMENTS = 'users_comments'; // комментарии

// PATH section
const SITE_ROOT = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR; // корень
const PUBLIC_DIR = SITE_ROOT.'public'.DIRECTORY_SEPARATOR; // папка public
const IMAGES_PATH = PUBLIC_DIR.'img'.DIRECTORY_SEPARATOR; // папка img
const STYLES_PATH = PUBLIC_DIR.'css'.DIRECTORY_SEPARATOR; // папка css
const JS_PATH = PUBLIC_DIR.'JS'.DIRECTORY_SEPARATOR; // папка js
const TEMPLATES_PATH = SITE_ROOT.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR; // папка с HTML-шаблонами
const ENGINE_PATH = SITE_ROOT.'engine'.DIRECTORY_SEPARATOR; // папка с движком
const CACHE_PATH = SITE_ROOT.'cache'.DIRECTORY_SEPARATOR; // папка для кэша

//Site constants
const PRODUCTS_TO_SHOW = 3;