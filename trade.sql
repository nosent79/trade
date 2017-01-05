-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.1.19-MariaDB - mariadb.org binary distribution
-- 서버 OS:                        Win32
-- HeidiSQL 버전:                  9.4.0.5141
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- trade 데이터베이스 구조 내보내기
DROP DATABASE IF EXISTS `trade`;
CREATE DATABASE IF NOT EXISTS `trade` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `trade`;

-- 함수 trade.fnCodeNm 구조 내보내기
DROP FUNCTION IF EXISTS `fnCodeNm`;
DELIMITER //
CREATE DEFINER=`jerry`@`localhost` FUNCTION `fnCodeNm`(
	`_code` VARCHAR(30),
	`_id` VARCHAR(4)



) RETURNS varchar(30) CHARSET utf8
    COMMENT '코드명반환'
BEGIN
		declare rtn varchar(30);

		select name into rtn from tbl_code where code = _code and id = _id;
		
		return rtn;
END//
DELIMITER ;

-- 함수 trade.fnGetTradeCode 구조 내보내기
DROP FUNCTION IF EXISTS `fnGetTradeCode`;
DELIMITER //
CREATE DEFINER=`jerry`@`localhost` FUNCTION `fnGetTradeCode`() RETURNS bigint(20)
    COMMENT '거래번호생성'
BEGIN
		declare rtn bigint(20);

-- 		lock tables tbl_seq write;
		UPDATE tbl_seq SET seq = LAST_INSERT_ID(seq+1);
		select concat(date_format(now(), '%Y%m%d'), lpad(LAST_INSERT_ID(), 8, 0)) seq into rtn;		
-- 		unlock tables;		

		return rtn;
END//
DELIMITER ;

-- 테이블 trade.tbl_assess 구조 내보내기
DROP TABLE IF EXISTS `tbl_assess`;
CREATE TABLE IF NOT EXISTS `tbl_assess` (
  `assessor_id` int(10) NOT NULL COMMENT '평가자아이디',
  `target_id` int(10) NOT NULL COMMENT '피평가자아이디',
  `point` tinyint(4) NOT NULL DEFAULT '0' COMMENT '점수',
  `comment` varchar(200) NOT NULL DEFAULT '' COMMENT '코멘트',
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  PRIMARY KEY (`assessor_id`,`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='평가테이블';

-- 테이블 데이터 trade.tbl_assess:~0 rows (대략적) 내보내기
DELETE FROM `tbl_assess`;
/*!40000 ALTER TABLE `tbl_assess` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_assess` ENABLE KEYS */;

-- 테이블 trade.tbl_code 구조 내보내기
DROP TABLE IF EXISTS `tbl_code`;
CREATE TABLE IF NOT EXISTS `tbl_code` (
  `code` varchar(15) NOT NULL COMMENT '코드',
  `id` varchar(4) NOT NULL COMMENT '코드값',
  `name` varchar(50) DEFAULT NULL COMMENT '코드명',
  PRIMARY KEY (`code`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='코드성 데이터';

-- 테이블 데이터 trade.tbl_code:~81 rows (대략적) 내보내기
DELETE FROM `tbl_code`;
/*!40000 ALTER TABLE `tbl_code` DISABLE KEYS */;
INSERT INTO `tbl_code` (`code`, `id`, `name`) VALUES
	('education', '10', '중졸'),
	('education', '20', '고졸'),
	('education', '30', '전문대졸'),
	('education', '40', '대졸'),
	('education', '50', '석사'),
	('education', '60', '박사'),
	('education', '99', '기타'),
	('hobby', '10', '등산'),
	('hobby', '11', '독서'),
	('hobby', '12', '음악감상'),
	('hobby', '13', '헬스'),
	('hobby', '14', '영화관람'),
	('hobby', '15', '스포츠'),
	('hobby', '16', '낚시'),
	('hobby', '17', '게임'),
	('hobby', '18', '산책'),
	('hobby', '19', '여행'),
	('hobby', '20', '십자수'),
	('hobby', '21', '사진'),
	('hobby', '22', '악기연주'),
	('hobby', '23', '봉사활동'),
	('hobby', '24', '자전거'),
	('job', '10', '사무직'),
	('job', '11', '프리랜서'),
	('job', '12', '학생'),
	('job', '13', '전문직'),
	('job', '14', '의료직'),
	('job', '15', '언론직'),
	('job', '16', '교육직'),
	('job', '17', '공무원'),
	('job', '18', '사업가'),
	('job', '19', '금융직'),
	('job', '20', '연구기술직'),
	('location', '10', '서울'),
	('location', '20', '강원'),
	('location', '30', '대전'),
	('location', '31', '충남'),
	('location', '33', '세종'),
	('location', '36', '충북'),
	('location', '40', '인천'),
	('location', '41', '경기'),
	('location', '50', '광주'),
	('location', '51', '전남'),
	('location', '56', '전북'),
	('location', '60', '부산'),
	('location', '62', '경남'),
	('location', '68', '울산'),
	('location', '69', '제주'),
	('location', '70', '대구'),
	('location', '71', '경북'),
	('location', '99', '해외'),
	('mileage_gubun', 'M', '차감'),
	('mileage_gubun', 'P', '적립'),
	('salary', '10', '2200'),
	('salary', '11', '2400'),
	('salary', '12', '2600'),
	('salary', '13', '2800'),
	('salary', '14', '3000'),
	('salary', '15', '3200'),
	('salary', '16', '3400'),
	('salary', '17', '3600'),
	('salary', '18', '3800'),
	('salary', '19', '4000'),
	('salary', '20', '4300'),
	('salary', '21', '4500'),
	('salary', '22', '5000'),
	('salary', '23', '5500'),
	('salary', '24', '6000'),
	('trade_cate', '10', '리니지1'),
	('trade_cate', '20', '리니지2'),
	('trade_cate', '30', '리니지3'),
	('trade_cate', '40', '리니지4'),
	('trade_cate', '50', '리니지5'),
	('trade_cate', '60', '리니지6'),
	('trade_gubun', 'B', '구매'),
	('trade_gubun', 'S', '판매'),
	('trade_kind', 'E', '기타'),
	('trade_kind', 'I', '아이템'),
	('trade_kind', 'M', '게임머니'),
	('trade_state', 'C', '거래취소'),
	('trade_state', 'P', '거래중'),
	('trade_state', 'S', '거래완료'),
	('trade_state', 'W', '거래대기');
/*!40000 ALTER TABLE `tbl_code` ENABLE KEYS */;

-- 테이블 trade.tbl_member 구조 내보내기
DROP TABLE IF EXISTS `tbl_member`;
CREATE TABLE IF NOT EXISTS `tbl_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '회원아이디',
  `email` varchar(50) NOT NULL COMMENT '이메일',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '이름',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '비밀번호',
  `birth_year` varchar(4) NOT NULL DEFAULT '' COMMENT '생년',
  `location` varchar(4) NOT NULL DEFAULT '' COMMENT '지역',
  `cellphone` varchar(15) NOT NULL DEFAULT '' COMMENT '연락처',
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  `upd_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '수정일자',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='회원';

-- 테이블 데이터 trade.tbl_member:~11 rows (대략적) 내보내기
DELETE FROM `tbl_member`;
/*!40000 ALTER TABLE `tbl_member` DISABLE KEYS */;
INSERT INTO `tbl_member` (`id`, `email`, `name`, `password`, `birth_year`, `location`, `cellphone`, `reg_date`, `upd_date`) VALUES
	(1, 'nosent_1@gmail.com', '최진욱1', '$2y$10$7I/0p0htwUh6VI.IueCdLOiR3Mk61S8h6whGfhnJty7.Rlab90oCi', '1986', '10', '01041921325', '2016-12-28 11:45:29', '2016-12-28 11:45:29'),
	(2, 'nosent_2@gmail.com', '최진욱2', '$2y$10$ZIZwEBXsORJJdHQdqYgtTOqqldbATyDQKleCshH9ovu2Phw3RSrj2', '1990', '10', '01041921325', '2016-12-28 11:45:29', '2016-12-28 11:45:29'),
	(3, 'nosent_3@gmail.com', '최진욱3', '$2y$10$W1gdQSZu61AbotNfy/vhNOlnBLT8A9lvgR.pGEzaOkwOOjlrtECTO', '1986', '10', '01041921325', '2016-12-28 11:45:29', '2016-12-28 11:45:29'),
	(4, 'nosent_4@gmail.com', '최진욱4', '$2y$10$5rjp9B4/B8rKgdGBImL3YuXU7E5ogOEZspFMXQA6Yn6XTUATDf24m', '1984', '10', '01041921325', '2016-12-28 11:45:29', '2016-12-28 11:45:29'),
	(5, 'nosent_5@gmail.com', '최진욱5', '$2y$10$mwiCbHA3uVOAklBTxuutuu7VCdpXwwxlAUKNAkXtr4pPZEW1qg36a', '1980', '40', '01041921325', '2016-12-28 11:45:29', '2016-12-28 11:45:29'),
	(6, 'nosent_6@gmail.com', '최진욱6', '$2y$10$kMIwr6Zyd4YmeAqq68DSLeHRib1/0baso5y75EoIOhGCpb54kb71.', '1986', '40', '01041921325', '2016-12-28 11:45:29', '2016-12-28 11:45:29'),
	(7, 'nosent_7@gmail.com', '최진욱7', '$2y$10$aOwHvTQUh17swCjytaXxM.AEW55cLyCXNL5ypg8OpQFAO5y1H3cE6', '1986', '10', '01041921325', '2016-12-28 11:45:29', '2016-12-28 11:45:29'),
	(8, 'nosent_8@gmail.com', '최진욱8', '$2y$10$yNlhFp6qKjgU0vAZ9xMwB.WL6TKDuNwkx0TdhJdSdj0HQu5H3dGTq', '1986', '10', '01041921325', '2016-12-28 11:45:29', '2016-12-28 11:45:29'),
	(9, 'nosent_9@gmail.com', '최진욱9', '$2y$10$GCEFFKkgVETNuh9R7GDs8uZHSe9.Be2ax1CTAarwaKu9DJV3tTCQa', '1980', '31', '01041921325', '2016-12-28 11:45:29', '2016-12-28 11:45:29'),
	(10, 'nosent_10@gmail.com', '최진욱10', '$2y$10$XTlCNq6sKy0mlaGS4.7H9eJexH0pqRWZN3Wu3M8rd4hEZ3aD.LyoO', '1989', '20', '01041921325', '2016-12-28 11:45:29', '2016-12-28 11:45:29'),
	(24, 'nosent@naver.com', '1983', '$2y$10$fkfscY.pmgKWQPxNgdlc7egZWNINMq4DldVdy/ZxUIbZIpaAKUX5m', '1983', '10', '01041921325', '2017-01-03 19:22:20', '2017-01-03 19:22:20');
/*!40000 ALTER TABLE `tbl_member` ENABLE KEYS */;

-- 테이블 trade.tbl_mileage 구조 내보내기
DROP TABLE IF EXISTS `tbl_mileage`;
CREATE TABLE IF NOT EXISTS `tbl_mileage` (
  `seq` int(11) NOT NULL AUTO_INCREMENT COMMENT '시퀀스',
  `m_id` int(10) DEFAULT NULL COMMENT '회원번호',
  `amount` int(11) DEFAULT NULL COMMENT '마일리지',
  `m_gubun` enum('P','M') DEFAULT NULL COMMENT '적립/차감구분',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  PRIMARY KEY (`seq`),
  KEY `m_id` (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='마일리지';

-- 테이블 데이터 trade.tbl_mileage:~9 rows (대략적) 내보내기
DELETE FROM `tbl_mileage`;
/*!40000 ALTER TABLE `tbl_mileage` DISABLE KEYS */;
INSERT INTO `tbl_mileage` (`seq`, `m_id`, `amount`, `m_gubun`, `reg_date`) VALUES
	(1, 24, 100000, 'P', '2017-01-04 16:18:48'),
	(2, 24, 5000, 'M', '2017-01-04 16:20:48'),
	(3, 24, 5000, 'M', '2017-01-04 16:20:48'),
	(4, 24, 3000, 'P', '2017-01-04 16:21:48'),
	(5, 24, 8000, 'P', '2017-01-04 16:22:48'),
	(6, 24, 7000, 'M', '2017-01-04 16:23:48'),
	(7, 24, 2000, 'M', '2017-01-04 16:24:48'),
	(12, 24, 500, 'P', '2017-01-04 17:36:48'),
	(13, 24, 3, 'P', '2017-01-04 17:38:23');
/*!40000 ALTER TABLE `tbl_mileage` ENABLE KEYS */;

-- 테이블 trade.tbl_seq 구조 내보내기
DROP TABLE IF EXISTS `tbl_seq`;
CREATE TABLE IF NOT EXISTS `tbl_seq` (
  `seq` bigint(20) NOT NULL COMMENT '시퀀스',
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='거래번호 추출테이블';

-- 테이블 데이터 trade.tbl_seq:~1 rows (대략적) 내보내기
DELETE FROM `tbl_seq`;
/*!40000 ALTER TABLE `tbl_seq` DISABLE KEYS */;
INSERT INTO `tbl_seq` (`seq`) VALUES
	(2);
/*!40000 ALTER TABLE `tbl_seq` ENABLE KEYS */;

-- 테이블 trade.tbl_trade 구조 내보내기
DROP TABLE IF EXISTS `tbl_trade`;
CREATE TABLE IF NOT EXISTS `tbl_trade` (
  `tr_code` bigint(20) NOT NULL COMMENT '거래번호',
  `tr_gubun` char(1) NOT NULL COMMENT '거래구분',
  `tr_cate` varchar(4) NOT NULL COMMENT '카테고리',
  `tr_kind` varchar(4) NOT NULL COMMENT '거래품목분류',
  `qty` smallint(6) NOT NULL COMMENT '거래수량',
  `price` int(11) NOT NULL COMMENT '거래금액',
  `tr_title` varchar(200) NOT NULL COMMENT '거래제목',
  `tr_desc` varchar(2000) NOT NULL COMMENT '거래상세',
  `reg_id` int(10) NOT NULL COMMENT '등록자',
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일시',
  PRIMARY KEY (`tr_code`),
  KEY `tr_gubun` (`tr_gubun`),
  KEY `tr_gubun_reg_id` (`tr_gubun`,`reg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='거래마스터';

-- 테이블 데이터 trade.tbl_trade:~2 rows (대략적) 내보내기
DELETE FROM `tbl_trade`;
/*!40000 ALTER TABLE `tbl_trade` DISABLE KEYS */;
INSERT INTO `tbl_trade` (`tr_code`, `tr_gubun`, `tr_cate`, `tr_kind`, `qty`, `price`, `tr_title`, `tr_desc`, `reg_id`, `reg_date`) VALUES
	(2017010400000001, 'B', '20', 'I', 1, 55555, 'ㅈㅂㅈㄷㅂㅈㄷ', 'ㄷㄷㄷㄷㄷ', 1, '2017-01-04 11:09:59'),
	(2017010400000002, 'S', '30', 'E', 1, 222222, 'ㄷㄷㄷㄷㄷ', 'ㅋㅋㅋㅋㅋ', 24, '2017-01-04 11:12:16');
/*!40000 ALTER TABLE `tbl_trade` ENABLE KEYS */;

-- 테이블 trade.tbl_trade_member 구조 내보내기
DROP TABLE IF EXISTS `tbl_trade_member`;
CREATE TABLE IF NOT EXISTS `tbl_trade_member` (
  `tr_code` bigint(20) NOT NULL COMMENT '거래번호',
  `send_m_id` int(10) DEFAULT NULL COMMENT '신청자아이디',
  `receive_m_id` int(10) DEFAULT NULL COMMENT '접수자아이디',
  PRIMARY KEY (`tr_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='거래대상자';

-- 테이블 데이터 trade.tbl_trade_member:~0 rows (대략적) 내보내기
DELETE FROM `tbl_trade_member`;
/*!40000 ALTER TABLE `tbl_trade_member` DISABLE KEYS */;
INSERT INTO `tbl_trade_member` (`tr_code`, `send_m_id`, `receive_m_id`) VALUES
	(2017010400000001, 24, 1);
/*!40000 ALTER TABLE `tbl_trade_member` ENABLE KEYS */;

-- 테이블 trade.tbl_trade_state 구조 내보내기
DROP TABLE IF EXISTS `tbl_trade_state`;
CREATE TABLE IF NOT EXISTS `tbl_trade_state` (
  `seq` int(11) NOT NULL AUTO_INCREMENT COMMENT '시퀀스',
  `tr_code` bigint(20) NOT NULL COMMENT '거래번호',
  `tr_state` varchar(4) NOT NULL COMMENT '거래상태',
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일시',
  PRIMARY KEY (`seq`),
  KEY `tr_code_tr_state` (`tr_code`,`tr_state`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='거래상태';

-- 테이블 데이터 trade.tbl_trade_state:~5 rows (대략적) 내보내기
DELETE FROM `tbl_trade_state`;
/*!40000 ALTER TABLE `tbl_trade_state` DISABLE KEYS */;
INSERT INTO `tbl_trade_state` (`seq`, `tr_code`, `tr_state`, `reg_date`) VALUES
	(9, 2017010400000001, 'W', '2017-01-04 11:09:59'),
	(10, 2017010400000002, 'W', '2017-01-04 11:12:16'),
	(41, 2017010400000001, 'P', '2017-01-05 11:00:06'),
	(45, 2017010400000001, 'S', '2017-01-05 18:31:42');
/*!40000 ALTER TABLE `tbl_trade_state` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
