
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `admin_id` varchar(15) NOT NULL,
  `admin_nm` varchar(30) NOT NULL,
  `admin_pwd` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='관리자테이블';

INSERT INTO `tbl_admin` (`admin_id`, `admin_nm`, `admin_pwd`) VALUES
	('jerry', '관리자', '$2y$10$HhJfgvPmIVsnWrKvDzak7OUrqDf8ljSZoonFE0MdaNZ6xnvNir9OW');

