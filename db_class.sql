CREATE DATABASE IF NOT EXISTS `restaurant_takeout_db`;

USE `restaurant_takeout_db`;

CREATE TABLE IF NOT EXISTS `restaurant` (
    rest_id VARCHAR(10) PRIMARY KEY AUTO_INCREMENT,
    rest_telp_num VARCHAR(10),
    rest_address VARCHAR(50) NOT NULL,
    rest_description VARCHAR(50),
    rest_operating_hours VARCHAR(10) NOT NULL,
    rest_name VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `menu` (
    menu_id VARCHAR(10) PRIMARY KEY AUTO_INCREMENT,
    food_name VARCHAR(50) NOT NULL,
    food_price INT NOT NULL,
    food_description VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `order` (
    order_id VARCHAR(10) PRIMARY KEY AUTO_INCREMENT,
    order_total_cost INT NOT NULL,
    order_status VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `user` (
    user_id VARCHAR(10) PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(50) NOT NULL,
    user_telp_num VARCHAR(10),
    user_real_name VARCHAR(50) NOT NULL,
    user_email VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `restaurant_menu` (
    rest_id VARCHAR(10),
    menu_id VARCHAR(10),
    price INT NOT NULL,
    PRIMARY KEY (rest_id, menu_id),
    FOREIGN KEY (rest_id) REFERENCES `restaurant` (rest_id),
    FOREIGN KEY (menu_id) REFERENCES `menu` (menu_id)
);

CREATE TABLE IF NOT EXISTS `order_items` (
    menu_id VARCHAR(10),
    order_id VARCHAR(10),
    FOREIGN KEY (menu_id) REFERENCES `menu` (menu_id),
    FOREIGN KEY (order_id) REFERENCES `order` (order_id)
);

CREATE TABLE IF NOT EXISTS `user_order` (
    user_id VARCHAR(10),
    order_id VARCHAR(10),
    FOREIGN KEY (user_id) REFERENCES `user` (user_id),
    FOREIGN KEY (order_id) REFERENCES `order` (order_id)
);
