--
-- Table structure for table `users`
--


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `picture` BLOB DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `user_id` int(11) ,
  `category_id` int(11), 
  `image` BLOB DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES category(id),
  PRIMARY KEY (`id`)
);

--
-- Table structure for table `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE `picture`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11),
  `photo` BLOB DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  FOREIGN KEY (post_id) REFERENCES post(id),
  PRIMARY KEY (`id`)
);

-- 
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO category (name, created_at) VALUES ('Cars', now());
INSERT INTO category (name, created_at) VALUES ('Books', now());
INSERT INTO category (name, created_at) VALUES ('Free Stuff', now());
INSERT INTO category (name, created_at) VALUES ('Electronics', now());
INSERT INTO category (name, created_at) VALUES ('Home', now());
INSERT INTO category (name, created_at) VALUES ('Garden', now());
INSERT INTO category (name, created_at) VALUES ('Fashion', now());
INSERT INTO category (name, created_at) VALUES ('Tickets', now());
INSERT INTO category (name, created_at) VALUES ('Baby and Child', now());
INSERT INTO category (name, created_at) VALUES ('Furniture', now());
INSERT INTO category (name, created_at) VALUES ('Carpool', now());
INSERT INTO category (name, created_at) VALUES ('Arts', now());
INSERT INTO category (name, created_at) VALUES ('Clothes', now());
INSERT INTO category (name, created_at) VALUES ('Others', now());



-- database: user
-- 		username, password, email address/phone number(contact info), time， picture
-- 	         item	
-- 		username, title, date, quantity, condition(new/used), description, price, picture, category, time
--    	  	 post
--    title, item_name,price, description,username, picture, email, create_at 

-- major: 	search method
-- 	posting 
-- 	login 
-- 	account management

-- minor: 	filter
-- 	mark as sold
-- back to top buttom
-- let user insert their picture and upload the file
