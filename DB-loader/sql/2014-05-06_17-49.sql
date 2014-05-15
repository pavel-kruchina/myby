CREATE TABLE `quick_link`(		/* Table name not specified */  
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `link` VARCHAR(255),
  `code` VARCHAR(255),
  `create_date` DATETIME,
  `user_id` INT(11),
  PRIMARY KEY (`id`),
  INDEX `code_index` (`code`)
) ENGINE=INNODB;
