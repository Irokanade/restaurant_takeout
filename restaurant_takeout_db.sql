CREATE DATABASE IF NOT EXISTS `restaurant_takeout_db`;

USE `restaurant_takeout_db`;

CREATE TABLE IF NOT EXISTS `restaurant` (
    `rest_id` VARCHAR(10) NOT NULL PRIMARY KEY,
    `rest_telp_num` VARCHAR(50),
    `rest_address` VARCHAR(50) NOT NULL,
    `rest_description` VARCHAR(255),
    `rest_open_status` VARCHAR(10) NOT NULL,
    `rest_name` VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `menu` (
    `menu_id` VARCHAR(10) NOT NULL PRIMARY KEY,
    `food_name` VARCHAR(50) NOT NULL,
    `food_price` INT NOT NULL,
    `food_description` VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS `order` (
    `order_id` VARCHAR(10) NOT NULL PRIMARY KEY,
    `order_total_cost` INT NOT NULL,
    `order_status` VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `login_cred` (
    `login_id` VARCHAR(50) NOT NULL PRIMARY KEY,
    `user_name` VARCHAR(50) NOT NULL,
    `user_email` VARCHAR(50) NOT NULL,
    `user_password` VARCHAR(255) NOT NULL,
    `user_type` VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `customer` (
    `cust_id` VARCHAR(10) NOT NULL PRIMARY KEY,
    `cust_name` VARCHAR(50) NOT NULL,
    `cust_telp_num` VARCHAR(10)
);

CREATE TABLE IF NOT EXISTS `rest_login_cred` (
    `rest_id` VARCHAR(10) NOT NULL,
    `login_id` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`rest_id`, `login_id`),
    FOREIGN KEY (`rest_id`) REFERENCES `restaurant`(`rest_id`),
    FOREIGN KEY (`login_id`) REFERENCES `login_cred`(`login_id`)
);

CREATE TABLE IF NOT EXISTS `cust_login_cred` (
    `cust_id` VARCHAR(10) NOT NULL,
    `login_id` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`cust_id`, `login_id`),
    FOREIGN KEY (`cust_id`) REFERENCES `customer`(`cust_id`),
    FOREIGN KEY (`login_id`) REFERENCES `login_cred`(`login_id`)
);

CREATE TABLE IF NOT EXISTS `restaurant_menu` (
    `rest_id` VARCHAR(10) NOT NULL,
    `menu_id` VARCHAR(10) NOT NULL,
    `price` INT NOT NULL,
    PRIMARY KEY (`rest_id`, `menu_id`),
    FOREIGN KEY (`rest_id`) REFERENCES `restaurant`(`rest_id`),
    FOREIGN KEY (`menu_id`) REFERENCES `menu`(`menu_id`)
);

CREATE TABLE IF NOT EXISTS `order_items` (
    `menu_id` VARCHAR(10) NOT NULL,
    `order_id` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`menu_id`, `order_id`),
    FOREIGN KEY (`menu_id`) REFERENCES `menu`(`menu_id`),
    FOREIGN KEY (`order_id`) REFERENCES `order`(`order_id`)
);

CREATE TABLE IF NOT EXISTS `cust_order` (
    `cust_id` VARCHAR(10) NOT NULL,
    `order_id` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`cust_id`, `order_id`),
    FOREIGN KEY (`cust_id`) REFERENCES `customer`(`cust_id`),
    FOREIGN KEY (`order_id`) REFERENCES `order`(`order_id`)
);

INSERT INTO `restaurant` (`rest_id`, `rest_telp_num`, `rest_address`, `rest_description`, `rest_open_status`, `rest_name`) VALUES
    ('R001', '+886-2-12345678', '123 Taipei St., Taipei City', 'A cozy restaurant serving traditional Taiwanese cuisine.', 'open', 'Taipei Delights'),
    ('R002', '+886-2-98765432', '456 Kaohsiung Rd., Kaohsiung City', 'Experience the taste of southern Taiwan in our restaurant.', 'closed', 'Kaohsiung Bistro');

INSERT INTO `menu` (`menu_id`, `food_name`, `food_price`, `food_description`) VALUES
    ('M001', 'Braised Pork Rice', 120, 'Tender braised pork served over steamed rice.'),
    ('M002', 'Beef Noodle Soup', 150, 'A hearty bowl of noodles with flavorful beef broth.'),
    ('M003', 'Stinky Tofu', 80, 'Fermented tofu with a strong aroma, deep-fried to perfection.'),
    ('M004', 'Oyster Omelette', 100, 'Fresh oysters cooked with eggs and topped with a tangy sauce.'),
    ('M005', 'Bubble Milk Tea', 60, 'A popular Taiwanese drink with tapioca pearls and creamy milk tea.');

INSERT INTO `restaurant_menu` (`rest_id`, `menu_id`, `price`) VALUES
    ('R001', 'M001', 120),
    ('R001', 'M002', 150),
    ('R001', 'M003', 80),
    ('R002', 'M004', 100),
    ('R002', 'M005', 60);


INSERT INTO `login_cred` (`login_id`, `user_name`, `user_email`, `user_password`, `user_type`) VALUES 
    ('cust_login1', 'John Doe', 'john@example.com', 'password123', 'customer'),
    ('rest_login1', 'Pizza Palace', 'info@pizzapalace.com', 'restaurantpass', 'restaurant');

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_telp_num`) VALUES 
    ('cust1', 'John Doe', '1234567890');