-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2013 年 08 月 08 日 16:35
-- 服务器版本: 5.5.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `app_fitbody`
--

-- --------------------------------------------------------

--
-- 表的结构 `tb_items`
--

CREATE TABLE IF NOT EXISTS `tb_items` (
  `cl_itemid` varchar(8) NOT NULL COMMENT '監測項目id',
  `cl_itemname` varchar(150) NOT NULL COMMENT '監測項目名稱',
  `cl_itemunit` varchar(8) DEFAULT NULL COMMENT '監測項目單位',
  PRIMARY KEY (`cl_itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='監測項目信息';

--
-- 转存表中的数据 `tb_items`
--

INSERT INTO `tb_items` (`cl_itemid`, `cl_itemname`, `cl_itemunit`) VALUES
('3', '中飯', '元'),
('2', '体重', '公斤'),
('4', '晚飯', '元'),
('5', '零花', '元'),
('6', '血汗錢啊', '元');

-- --------------------------------------------------------

--
-- 表的结构 `tb_login`
--

CREATE TABLE IF NOT EXISTS `tb_login` (
  `cl_userid` varchar(8) NOT NULL COMMENT '用戶id',
  `cl_psw` varchar(50) NOT NULL COMMENT '密碼',
  `cl_authority` smallint(6) NOT NULL DEFAULT '1' COMMENT '權限，1-普通；99-管理員',
  PRIMARY KEY (`cl_userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='登錄表';

--
-- 转存表中的数据 `tb_login`
--

INSERT INTO `tb_login` (`cl_userid`, `cl_psw`, `cl_authority`) VALUES
('1', '23da39b4df4d8b2cbdd976edd4df4301', 1),
('2', 'bda7069a6ac3481b27c9986c9bc51e49', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tb_mine_record`
--

CREATE TABLE IF NOT EXISTS `tb_mine_record` (
  `user_id` varchar(8) NOT NULL,
  `time` datetime NOT NULL,
  `weight` double NOT NULL,
  `bike` double NOT NULL,
  `sit_up` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tb_mine_record`
--

INSERT INTO `tb_mine_record` (`user_id`, `time`, `weight`, `bike`, `sit_up`) VALUES
('1', '2013-05-22 22:45:25', 56.4, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tb_record`
--

CREATE TABLE IF NOT EXISTS `tb_record` (
  `cl_userid` varchar(8) NOT NULL COMMENT '用戶id',
  `cl_itemid` varchar(8) NOT NULL COMMENT '監測項目id',
  `cl_time` datetime NOT NULL COMMENT '數據錄入時間戳',
  `cl_count` double NOT NULL DEFAULT '0' COMMENT '數據',
  `cl_content` varchar(150) DEFAULT ' ' COMMENT '備註',
  PRIMARY KEY (`cl_userid`,`cl_itemid`,`cl_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='數據記錄表';

--
-- 转存表中的数据 `tb_record`
--

INSERT INTO `tb_record` (`cl_userid`, `cl_itemid`, `cl_time`, `cl_count`, `cl_content`) VALUES
('1', '2', '2013-06-17 20:56:45', 57.1, ' '),
('1', '2', '2013-06-16 22:22:14', 57.2, NULL),
('1', '2', '2013-06-15 20:15:57', 56.8, NULL),
('1', '2', '2013-06-14 21:48:59', 56.8, NULL),
('1', '2', '2013-06-13 21:19:50', 56.3, NULL),
('1', '2', '2013-06-12 20:59:25', 56.5, NULL),
('1', '2', '2013-06-11 20:39:29', 56.7, NULL),
('1', '2', '2013-06-10 20:24:09', 56.3, NULL),
('1', '2', '2013-06-09 20:20:50', 55.9, NULL),
('1', '2', '2013-06-08 21:03:42', 56, NULL),
('1', '2', '2013-06-07 20:41:14', 55.7, NULL),
('1', '2', '2013-06-04 22:55:11', 57, NULL),
('1', '2', '2013-06-03 21:24:58', 56.3, NULL),
('1', '2', '2013-06-02 20:28:09', 56.6, NULL),
('1', '2', '2013-06-01 20:38:49', 57.1, NULL),
('1', '2', '2013-05-31 22:31:56', 57, NULL),
('1', '2', '2013-05-29 21:08:03', 56.9, NULL),
('1', '2', '2013-05-28 20:39:36', 56.6, NULL),
('1', '2', '2013-05-27 23:07:43', 56.4, NULL),
('1', '2', '2013-05-26 21:39:29', 55.5, NULL),
('1', '2', '2013-05-25 21:39:29', 57.1, NULL),
('1', '2', '2013-05-24 22:45:25', 57.1, NULL),
('1', '2', '2013-05-23 20:45:25', 57.1, NULL),
('1', '2', '2013-05-21 00:00:00', 55, NULL),
('1', '2', '2013-05-22 22:45:25', 56.4, NULL),
('1', '2', '2013-06-19 20:52:13', 56.4, ' '),
('2', '2', '2013-06-19 13:38:19', 52, ''),
('1', '2', '2013-06-18 20:56:45', 57.1, ' '),
('1', '2', '2013-06-20 21:12:55', 56.5, ''),
('1', '2', '2013-06-21 20:50:46', 57.1, ''),
('1', '2', '2013-06-22 23:59:22', 57.3, ''),
('1', '2', '2013-06-23 21:31:31', 56.9, ''),
('1', '2', '2013-06-24 20:48:24', 56.6, ''),
('1', '2', '2013-06-25 20:30:41', 56, '還沒吃晚飯呢'),
('1', '2', '2013-06-26 20:51:45', 57.2, '我就說嘛，沒吃晚飯的緣故'),
('1', '2', '2013-06-27 20:57:08', 56.5, ''),
('1', '2', '2013-06-30 21:05:02', 56.5, ''),
('1', '2', '2013-07-01 20:10:29', 56.7, ''),
('1', '2', '2013-07-02 20:55:07', 55.9, '唉……唉……唉……唉……唉……唉……唉……唉……唉……唉……唉……唉……唉……唉……'),
('1', '2', '2013-07-03 20:27:51', 55.5, ''),
('1', '3', '2013-07-04 14:30:00', 18, '第一天哦……'),
('1', '2', '2013-07-04 20:25:32', 56.1, ''),
('1', '4', '2013-07-04 20:25:43', 15, ''),
('1', '5', '2013-07-04 20:25:50', 0, ''),
('1', '2', '2013-07-05 20:55:18', 55.5, ''),
('1', '3', '2013-07-05 20:55:25', 9, ''),
('1', '4', '2013-07-05 20:55:35', 15, ''),
('1', '5', '2013-07-05 20:55:42', 0, ''),
('1', '6', '2013-07-06 12:33:18', 2755, ''),
('1', '6', '2013-06-06 12:33:18', 2691, ' '),
('1', '2', '2013-07-07 20:27:09', 55.8, ''),
('1', '2', '2013-07-09 21:41:27', 56.7, ''),
('1', '2', '2013-07-10 21:34:24', 55.4, ''),
('1', '2', '2013-07-11 21:35:49', 56, ''),
('1', '2', '2013-07-12 20:24:26', 54.7, ''),
('1', '2', '2013-07-12 20:24:29', 54.7, ''),
('1', '2', '2013-07-13 23:31:51', 55.5, ''),
('1', '2', '2013-07-14 22:33:27', 55.6, ''),
('1', '2', '2013-07-15 21:12:03', 55.6, ''),
('1', '2', '2013-07-16 21:22:57', 55.5, ''),
('1', '2', '2013-07-17 22:41:28', 55.2, ''),
('1', '2', '2013-07-18 22:11:06', 55, ''),
('1', '2', '2013-07-19 22:38:52', 55.1, ''),
('1', '2', '2013-07-20 22:23:01', 55.5, ''),
('1', '2', '2013-07-22 20:46:35', 55, ''),
('1', '2', '2013-07-21 20:47:18', 56, ' '),
('1', '2', '2013-07-23 21:01:40', 55.1, ''),
('1', '2', '2013-07-24 22:45:09', 55, ''),
('1', '2', '2013-07-25 22:49:48', 54.2, ''),
('1', '2', '2013-07-28 00:06:43', 55, ''),
('1', '2', '2013-07-28 23:24:52', 55.1, ''),
('1', '2', '2013-07-29 22:22:40', 55.1, ''),
('1', '2', '2013-07-30 23:07:06', 55.7, ''),
('1', '2', '2013-07-31 21:36:40', 55.1, ''),
('1', '2', '2013-08-01 23:32:01', 55.6, ''),
('1', '2', '2013-08-02 23:33:08', 55.2, ''),
('1', '2', '2013-08-04 20:04:44', 55.2, ''),
('1', '2', '2013-08-05 21:28:35', 55.3, ''),
('1', '2', '2013-08-06 20:31:47', 55.5, ''),
('1', '6', '2013-08-07 09:30:59', 2845, ''),
('1', '2', '2013-08-07 23:08:19', 55.1, '');

-- --------------------------------------------------------

--
-- 表的结构 `tb_register_confirm`
--

CREATE TABLE IF NOT EXISTS `tb_register_confirm` (
  `cl_userid` varchar(8) NOT NULL,
  `cl_code` char(15) NOT NULL,
  PRIMARY KEY (`cl_userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用戶註冊確認表';

--
-- 转存表中的数据 `tb_register_confirm`
--


-- --------------------------------------------------------

--
-- 表的结构 `tb_userinfo`
--

CREATE TABLE IF NOT EXISTS `tb_userinfo` (
  `cl_userid` varchar(8) NOT NULL COMMENT '用戶id',
  `cl_username` varchar(150) NOT NULL COMMENT '用戶名',
  `cl_email` varchar(150) NOT NULL COMMENT '郵箱',
  `cl_sex` smallint(6) NOT NULL COMMENT '性別',
  `cl_birthday` date DEFAULT NULL COMMENT '出生日期',
  `cl_commit` smallint(6) NOT NULL DEFAULT '0' COMMENT '註冊是否確認',
  PRIMARY KEY (`cl_userid`),
  UNIQUE KEY `cl_username` (`cl_username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用戶信息表';

--
-- 转存表中的数据 `tb_userinfo`
--

INSERT INTO `tb_userinfo` (`cl_userid`, `cl_username`, `cl_email`, `cl_sex`, `cl_birthday`, `cl_commit`) VALUES
('1', 'AC筋斗云', 'kingdoucloud@foxmail.com', 1, NULL, 1),
('2', '张钰婷', '88014386@qq.com', 2, '1990-05-21', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tb_useritems`
--

CREATE TABLE IF NOT EXISTS `tb_useritems` (
  `cl_userid` varchar(8) NOT NULL COMMENT '用戶id',
  `cl_itemid` varchar(8) NOT NULL COMMENT '監測項目id',
  `cl_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '目標有效時間',
  `cl_goal_count` double DEFAULT NULL,
  `cl_content` text,
  PRIMARY KEY (`cl_userid`,`cl_itemid`,`cl_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='監測項目用戶自定義信息表';

--
-- 转存表中的数据 `tb_useritems`
--

INSERT INTO `tb_useritems` (`cl_userid`, `cl_itemid`, `cl_time`, `cl_goal_count`, `cl_content`) VALUES
('1', '3', '2013-07-04 14:29:11', NULL, ''),
('1', '2', '2013-06-19 20:51:23', NULL, ''),
('2', '2', '2013-06-19 13:37:50', 50, ''),
('1', '4', '2013-07-04 14:29:25', NULL, ''),
('1', '5', '2013-07-04 14:30:25', NULL, ''),
('1', '6', '2013-07-06 12:32:59', NULL, '');
