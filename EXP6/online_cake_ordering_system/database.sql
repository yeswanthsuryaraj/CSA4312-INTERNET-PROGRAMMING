CREATE DATABASE IF NOT EXISTS cake_ordering CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cake_ordering;
CREATE TABLE users(
 id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(120) NOT NULL,
 email VARCHAR(160) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL,
 is_admin TINYINT(1) DEFAULT 0, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE categories(
 id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(80) NOT NULL UNIQUE
);
CREATE TABLE subcategories(
 id INT AUTO_INCREMENT PRIMARY KEY, category_id INT NOT NULL, name VARCHAR(80) NOT NULL,
 FOREIGN KEY(category_id) REFERENCES categories(id)
);
CREATE TABLE cakes(
 id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(140) NOT NULL,
 category_id INT NOT NULL, subcategory_id INT NULL, flavor VARCHAR(80) NOT NULL,
 occasion VARCHAR(80) DEFAULT 'All occasions', description TEXT NOT NULL,
 price DECIMAL(10,2) NOT NULL, image VARCHAR(255) DEFAULT '',
 stock INT NOT NULL DEFAULT 0, active TINYINT(1) DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(category_id) REFERENCES categories(id),
 FOREIGN KEY(subcategory_id) REFERENCES subcategories(id)
);
CREATE TABLE orders(
 id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL,
 total DECIMAL(10,2) NOT NULL, status VARCHAR(40) DEFAULT 'Order placed',
 payment_status VARCHAR(30) DEFAULT 'Pending',
 shipping_name VARCHAR(120) NOT NULL, phone VARCHAR(30) NOT NULL,
 address TEXT NOT NULL, city VARCHAR(100) NOT NULL, postal_code VARCHAR(20) NOT NULL,
 delivery_note VARCHAR(255) DEFAULT '', created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id)
);
CREATE TABLE order_items(
 id INT AUTO_INCREMENT PRIMARY KEY, order_id INT NOT NULL, cake_id INT NOT NULL,
 cake_name VARCHAR(140) NOT NULL, quantity INT NOT NULL, unit_price DECIMAL(10,2) NOT NULL,
 cake_size VARCHAR(30) NOT NULL, message_text VARCHAR(180) DEFAULT '',
 FOREIGN KEY(order_id) REFERENCES orders(id), FOREIGN KEY(cake_id) REFERENCES cakes(id)
);
INSERT INTO users(name,email,password,is_admin) VALUES
('Cake Administrator','admin@cake.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2yp5fS5Z7eK',1);
INSERT INTO categories(name) VALUES ('Birthday'),('Wedding'),('Chocolate'),('Designer'),('Photo Cakes');
INSERT INTO subcategories(category_id,name) VALUES
(1,'Kids Birthday'),(1,'Adult Birthday'),(2,'Wedding Tier Cakes'),(3,'Dark Chocolate'),(3,'White Chocolate'),(4,'Fondant Cakes'),(5,'Photo Print Cakes');
INSERT INTO cakes(name,category_id,subcategory_id,flavor,occasion,description,price,image,stock) VALUES
('Chocolate Truffle Cake',3,4,'Chocolate','Birthday','Rich chocolate sponge layered with smooth truffle ganache.',650,'',12),
('Vanilla Celebration Cake',1,1,'Vanilla','Birthday','Soft vanilla sponge with creamy vanilla frosting.',550,'',10),
('Red Velvet Cake',4,NULL,'Red Velvet','Anniversary','Classic red velvet layers with cream cheese frosting.',850,'',8),
('Wedding Tier Cake',2,3,'Vanilla','Wedding','Elegant multi-tier celebration cake. Contact store for custom design.',3500,'',3);
