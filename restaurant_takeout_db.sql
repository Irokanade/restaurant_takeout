CREATE DATABASE IF NOT EXISTS `restaurant_takeout_db`;

USE `restaurant_takeout_db`;

CREATE TABLE IF NOT EXISTS `restaurant` (
    rest_id INT PRIMARY KEY AUTO_INCREMENT,
    rest_telp_num VARCHAR(255),
    rest_address VARCHAR(50) NOT NULL,
    rest_description VARCHAR(255),
    rest_open_status VARCHAR(10) NOT NULL,
    rest_name VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `menu` (
    menu_id INT PRIMARY KEY AUTO_INCREMENT,
    food_name VARCHAR(50) NOT NULL,
    food_price INT NOT NULL,
    food_description VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS `order` (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    order_total_cost INT NOT NULL,
    order_status VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `user` (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(50) NOT NULL,
    user_telp_num VARCHAR(10),
    user_real_name VARCHAR(50) NOT NULL,
    user_email VARCHAR(50) NOT NULL,
    user_password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `restaurant_menu` (
    rest_id INT,
    menu_id INT,
    price INT NOT NULL,
    PRIMARY KEY (rest_id, menu_id),
    FOREIGN KEY (rest_id) REFERENCES `restaurant` (rest_id),
    FOREIGN KEY (menu_id) REFERENCES `menu` (menu_id)
);

CREATE TABLE IF NOT EXISTS `order_items` (
    menu_id INT,
    order_id INT,
    FOREIGN KEY (menu_id) REFERENCES `menu` (menu_id),
    FOREIGN KEY (order_id) REFERENCES `order` (order_id)
);

CREATE TABLE IF NOT EXISTS `user_order` (
    user_id INT,
    order_id INT,
    FOREIGN KEY (user_id) REFERENCES `user` (user_id),
    FOREIGN KEY (order_id) REFERENCES `order` (order_id)
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

INSERT INTO `restaurant_menu` (`rest_id`, `menu_id`, `price`) VALUES
    ('1', '1', 120),
    ('1', '2', 150),
    ('1', '3', 80),
    ('2', '4', 100),
    ('2', '5', 60);

INSERT INTO `user` (`user_name`, `user_telp_num`, `user_real_name`, `user_email`, `user_password`) VALUES
    ('john_doe', '+1-123-4567890', 'John Doe', 'john.doe@example.com', 'password123'),
    ('jane_smith', '+1-987-6543210', 'Jane Smith', 'jane.smith@example.com', 'securepass456'),
    ('mark_johnson', '+1-555-1234567', 'Mark Johnson', 'mark.johnson@example.com', 'letmein789');
