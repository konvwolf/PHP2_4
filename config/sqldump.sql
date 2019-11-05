-- MySQL 5.6

CREATE DATABASE IF NOT EXISTS shop DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE shop;

CREATE TABLE IF NOT EXISTS products_desc (
    id SERIAL,
    prod_brand VARCHAR(255),
    prod_name VARCHAR(255),
    prod_desc TEXT,
    prod_price DECIMAL(20,2),
    prod_hurl VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS products_pics (
    id SERIAL,
    prod_id BIGINT(20) UNSIGNED,
    file_name VARCHAR(255) NOT NULL,
    image_name VARCHAR(255),
    FOREIGN KEY (prod_id) REFERENCES products_desc (id) ON DELETE CASCADE
                                                        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS users_table (
    id SERIAL,
    email VARCHAR(255),
    login VARCHAR(64),
    name VARCHAR(32),
    password VARCHAR(128)
);

CREATE TABLE IF NOT EXISTS user_carts (
    shopping_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    login VARCHAR(64),
    prod_name VARCHAR(255),
    prod_id INT(20),
    quantity INT(10)
);

CREATE TABLE IF NOT EXISTS users_comments (
    id SERIAL,
    prod_name VARCHAR(255),
    user_name VARCHAR(64),
    user_comment TEXT,
    comment_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products_desc (prod_brand, prod_name, prod_desc, prod_price, prod_hurl)
    VALUES  ('Туполев',
             'Ту-22М3',
             '{ "Длина": "42,5 метра", "Размах крыла": "34,3 метра", "Высота": "11,1 метра", "Максимальная взлетная масса": "126 тонн", "Максимальная скорость": "2300 км/ч", "Дальность": "6800 км" }',
             12800000000,
             'tu22m3'),
            ('Туполев',
             'Ту-95МС',
             '{ "Длина": "49,1 метра", "Размах крыла": "50 метров", "Высота": "12,1 метра", "Максимальная взлетная масса": "188 тонн", "Максимальная скорость": "830 км/ч", "Дальность": "15000 км" }',
             14000000000,
             'tu95ms'),
            ('Туполев',
             'Ту-160М',
             '{ "Длина": "54,1 метра", "Размах крыла": "55,7 метра", "Высота": "13,1 метра", "Максимальная взлетная масса": "275 тонн", "Максимальная скорость": "2220 км/ч", "Дальность": "12300 км" }',
             16000000000,
             'tu160m'),
             ('Сухой',
             'Су-30СМ',
             '{ "Длина": "21,9 метра", "Размах крыла": "14,7 метра", "Высота": "6,4 метра", "Максимальная взлетная масса": "34,5 тонны", "Максимальная скорость": "2125 км/ч", "Дальность": "3000 км" }',
             3200000000,
             'su30sm'),
             ('Сухой',
             'Су-57',
             '{ "Длина": "19,4 метра", "Размах крыла": "14 метра", "Высота": "4,8 метра", "Максимальная взлетная масса": "35,5 тонн", "Максимальная скорость": "2800 км/ч", "Дальность": "4300 км" }',
             2236000000,
             'su57'),
             ('МиГ',
             'МиГ-35',
             '{ "Длина": "17,3 метра", "Размах крыла": "12 метра", "Высота": "4,4 метра", "Максимальная взлетная масса": "29,7 тонн", "Максимальная скорость": "2560 км/ч", "Дальность": "3500 км" }',
             2880000000,
             'mig35');

INSERT INTO products_pics (id, prod_id, file_name, image_name)
    VALUES
        (1, 1, 'tu22m3.jpg', 'Ту-22М3'),
        (2, 2, 'tu95ms.jpg', 'Ту-95МС'),
        (3, 2, 'tu95ms-2.jpg', 'Ту-95МС'),
        (4, 3, 'tu160m.jpg', 'Ту-160М'),
        (5, 4, 'su30sm.jpg', 'Су-30СМ'),
        (6, 5, 'su57.jpg', 'Су-57'),
        (7, 6, 'mig35.jpg', 'МиГ-35');