CREATE TABLE `conversation`(  
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT,
  `shop_user_id` INT,
  `title` VARCHAR(255),
  `create_date` DATETIME,
  `user_unread` ENUM('no','yes') NOT NULL,
  `shop_user_unread` ENUM('no','yes') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB;


CREATE TABLE `conversation_message`(  
  `id` INT NOT NULL AUTO_INCREMENT,
  `message` TEXT,
  `author_type` ENUM('user','shop_user'),
  `conversation_id` INT,
  `create_date` DATETIME,
  PRIMARY KEY (`id`)
) ENGINE=INNODB;
