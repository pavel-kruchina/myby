CREATE TABLE `event`(		  
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100),
  `create_date` DATETIME,
  `processed` ENUM('no','yes') DEFAULT 'no',
  `data` TEXT,
  PRIMARY KEY (`id`),
  INDEX `name` (`name`)
) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci;