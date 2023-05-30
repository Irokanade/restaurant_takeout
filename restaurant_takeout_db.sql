CREATE DATABASE IF NOT EXISTS `restaurant_takeout_db`;

USE `restaurant_takeout_db`;

CREATE TABLE IF NOT EXISTS `restaurant` (
    `rest_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `rest_telp_num` VARCHAR(50),
    `rest_address` VARCHAR(50) NOT NULL,
    `rest_description` VARCHAR(255),
    `rest_open_status` VARCHAR(10) NOT NULL,
    `rest_name` VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `menu` (
    `menu_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `food_name` VARCHAR(50) NOT NULL,
    `food_price` INT NOT NULL,
    `food_description` VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS `order` (
    `order_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `order_total_cost` INT NOT NULL,
    `order_status` VARCHAR(50) NOT NULL,
    `pickup_time` DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS `login_cred` (
    `login_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(50) NOT NULL,
    `user_email` VARCHAR(50) NOT NULL,
    `user_password` VARCHAR(255) NOT NULL,
    `user_type` VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `customer` (
    `cust_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `cust_name` VARCHAR(50) NOT NULL,
    `cust_telp_num` VARCHAR(10)
);

CREATE TABLE IF NOT EXISTS `rest_login_cred` (
    `rest_id` INT NOT NULL,
    `login_id` INT NOT NULL,
    FOREIGN KEY (`rest_id`) REFERENCES `restaurant`(`rest_id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`login_id`) REFERENCES `login_cred`(`login_id`) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `cust_login_cred` (
    `cust_id` INT NOT NULL,
    `login_id` INT NOT NULL,
    FOREIGN KEY (`cust_id`) REFERENCES `customer`(`cust_id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`login_id`) REFERENCES `login_cred`(`login_id`) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `restaurant_menu` (
    `rest_id` INT NOT NULL,
    `menu_id` INT NOT NULL,
    FOREIGN KEY (`rest_id`) REFERENCES `restaurant`(`rest_id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`menu_id`) REFERENCES `menu`(`menu_id`) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `order_items` (
    `menu_id` INT NOT NULL,
    `order_id` INT NOT NULL,
    FOREIGN KEY (`menu_id`) REFERENCES `menu`(`menu_id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`order_id`) REFERENCES `order`(`order_id`) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `cust_order` (
    `cust_id` INT NOT NULL,
    `order_id` INT NOT NULL,
    FOREIGN KEY (`cust_id`) REFERENCES `customer`(`cust_id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`order_id`) REFERENCES `order`(`order_id`) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO `restaurant` (`rest_telp_num`, `rest_address`, `rest_description`, `rest_open_status`, `rest_name`) VALUES
    ('+886-2-12345678', '123 Taipei St., Taipei City', 'A cozy restaurant serving traditional Taiwanese cuisine.', 'open', 'Taipei Delights'),
    ('+886-2-98765432', '456 Kaohsiung Rd., Kaohsiung City', 'Experience the taste of southern Taiwan in our restaurant.', 'closed', 'Kaohsiung Bistro');

INSERT INTO `menu` (`food_name`, `food_price`, `food_description`) VALUES
    ('Braised Pork Rice', 120, 'Tender braised pork served over steamed rice.'),
    ('Beef Noodle Soup', 150, 'A hearty bowl of noodles with flavorful beef broth.'),
    ('Stinky Tofu', 80, 'Fermented tofu with a strong aroma, deep-fried to perfection.'),
    ('Oyster Omelette', 100, 'Fresh oysters cooked with eggs and topped with a tangy sauce.'),
    ('Bubble Milk Tea', 60, 'A popular Taiwanese drink with tapioca pearls and creamy milk tea.');

INSERT INTO `restaurant_menu` (`rest_id`, `menu_id`) VALUES
    ('1', '1'),
    ('1', '2'),
    ('1', '3'),
    ('2', '4'),
    ('2', '5');

INSERT INTO `order` (`order_total_cost`, `order_status`, `pickup_time`) VALUES
    (50, 'Pending', '2023-05-27 14:30:00'),
    (75, 'Confirmed', '2023-05-27 18:00:00'),
    (120, 'Delivered', '2023-05-28 12:15:00');

INSERT INTO `login_cred` (`user_name`, `user_email`, `user_password`, `user_type`) VALUES 
    ('John Doe', 'john@example.com', 'password123', 'customer'),
    ('Pizza Palace', 'info@pizzapalace.com', 'restaurantpass', 'restaurant');

INSERT INTO `customer` (`cust_name`, `cust_telp_num`) VALUES 
    ('John Doe', '1234567890');

INSERT INTO `cust_order` (`cust_id`, `order_id`) VALUES
    (1, 1),
    (1, 2);

INSERT INTO `order_items` (`menu_id`, `order_id`) VALUES
    (1, 1),
    (2, 1),
    (3, 2);

INSERT INTO `cust_login_cred` (`cust_id`, `login_id`) VALUES
    (1, 1);

INSERT INTO `rest_login_cred` (`rest_id`, `login_id`) VALUES
    (1, 2);