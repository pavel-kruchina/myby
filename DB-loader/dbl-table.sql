CREATE TABLE IF NOT EXISTS `dbl_log` (
  `file_name` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`file_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
