# Host: 127.0.0.1  (Version: 5.6.11)
# Date: 2013-05-23 16:59:23
# Generator: MySQL-Front 5.3  (Build 3.9)

/*!40101 SET NAMES utf8 */;

DROP DATABASE IF EXISTS `fitbody`;
CREATE DATABASE `fitbody` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fitbody`;

#
# Source for table "tb_items"
#

DROP TABLE IF EXISTS `tb_items`;
CREATE TABLE `tb_items` (
  `cl_itemid` varchar(8) NOT NULL COMMENT '監測項目id',
  `cl_itemname` varchar(150) NOT NULL COMMENT '監測項目名稱',
  `cl_itemunit` varchar(8) DEFAULT NULL COMMENT '監測項目單位',
  PRIMARY KEY (`cl_itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='監測項目信息';

#
# Data for table "tb_items"
#

/*!40000 ALTER TABLE `fitbody`.`tb_items` DISABLE KEYS */;
INSERT INTO `tb_items` VALUES ('1','体重','千克');
/*!40000 ALTER TABLE `fitbody`.`tb_items` ENABLE KEYS */;

#
# Source for table "tb_login"
#

DROP TABLE IF EXISTS `tb_login`;
CREATE TABLE `tb_login` (
  `cl_userid` varchar(8) NOT NULL COMMENT '用戶id',
  `cl_psw` varchar(50) NOT NULL COMMENT '密碼',
  `cl_authority` smallint(6) NOT NULL DEFAULT '1' COMMENT '權限，1-普通；99-管理員',
  PRIMARY KEY (`cl_userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='登錄表';

#
# Data for table "tb_login"
#

/*!40000 ALTER TABLE `fitbody`.`tb_login` DISABLE KEYS */;
INSERT INTO `tb_login` VALUES ('1','299792458',1);
/*!40000 ALTER TABLE `fitbody`.`tb_login` ENABLE KEYS */;

#
# Source for table "tb_mine_record"
#

DROP TABLE IF EXISTS `tb_mine_record`;
CREATE TABLE `tb_mine_record` (
  `user_id` varchar(8) NOT NULL,
  `time` datetime NOT NULL,
  `weight` double NOT NULL,
  `bike` double NOT NULL,
  `sit_up` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "tb_mine_record"
#

/*!40000 ALTER TABLE `fitbody`.`tb_mine_record` DISABLE KEYS */;
INSERT INTO `tb_mine_record` VALUES ('1','2013-05-22 22:45:25',56.4,0,0);
/*!40000 ALTER TABLE `fitbody`.`tb_mine_record` ENABLE KEYS */;

#
# Source for table "tb_record"
#

DROP TABLE IF EXISTS `tb_record`;
CREATE TABLE `tb_record` (
  `cl_userid` varchar(8) NOT NULL COMMENT '用戶id',
  `cl_itemid` varchar(8) NOT NULL COMMENT '監測項目id',
  `cl_time` datetime NOT NULL COMMENT '數據錄入時間戳',
  `cl_count` double NOT NULL DEFAULT '0' COMMENT '數據',
  `cl_group` double DEFAULT NULL COMMENT '組數',
  PRIMARY KEY (`cl_userid`,`cl_itemid`,`cl_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='數據記錄表';

#
# Data for table "tb_record"
#

/*!40000 ALTER TABLE `fitbody`.`tb_record` DISABLE KEYS */;
INSERT INTO `tb_record` VALUES ('1','1','2013-05-22 22:45:25',56.4,NULL);
/*!40000 ALTER TABLE `fitbody`.`tb_record` ENABLE KEYS */;

#
# Source for table "tb_register_confirm"
#

DROP TABLE IF EXISTS `tb_register_confirm`;
CREATE TABLE `tb_register_confirm` (
  `cl_userid` varchar(8) NOT NULL,
  `cl_code` char(15) NOT NULL,
  PRIMARY KEY (`cl_userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用戶註冊確認表';

#
# Data for table "tb_register_confirm"
#

/*!40000 ALTER TABLE `fitbody`.`tb_register_confirm` DISABLE KEYS */;
/*!40000 ALTER TABLE `fitbody`.`tb_register_confirm` ENABLE KEYS */;

#
# Source for table "tb_userinfo"
#

DROP TABLE IF EXISTS `tb_userinfo`;
CREATE TABLE `tb_userinfo` (
  `cl_userid` varchar(8) NOT NULL COMMENT '用戶id',
  `cl_username` varchar(150) NOT NULL COMMENT '用戶名',
  `cl_email` varchar(150) NOT NULL COMMENT '郵箱',
  `cl_sex` smallint(6) NOT NULL COMMENT '性別',
  `cl_birthday` date DEFAULT NULL COMMENT '出生日期',
  `cl_commit` smallint(6) NOT NULL DEFAULT '0' COMMENT '註冊是否確認',
  PRIMARY KEY (`cl_userid`),
  UNIQUE KEY `cl_username` (`cl_username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用戶信息表';

#
# Data for table "tb_userinfo"
#

/*!40000 ALTER TABLE `fitbody`.`tb_userinfo` DISABLE KEYS */;
INSERT INTO `tb_userinfo` VALUES ('1','AC筋斗雲','kingdoucloud@foxmail.com',1,NULL,1);
/*!40000 ALTER TABLE `fitbody`.`tb_userinfo` ENABLE KEYS */;

#
# Source for table "tb_useritems"
#

DROP TABLE IF EXISTS `tb_useritems`;
CREATE TABLE `tb_useritems` (
  `cl_userid` varchar(8) NOT NULL COMMENT '用戶id',
  `cl_itemid` varchar(8) NOT NULL COMMENT '監測項目id',
  `cl_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '目標有效時間',
  `cl_goal_count` double DEFAULT NULL,
  `cl_goal_group` double DEFAULT NULL,
  `cl_content` text,
  PRIMARY KEY (`cl_userid`,`cl_itemid`,`cl_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='監測項目用戶自定義信息表';

#
# Data for table "tb_useritems"
#

/*!40000 ALTER TABLE `fitbody`.`tb_useritems` DISABLE KEYS */;
INSERT INTO `tb_useritems` VALUES ('1','1','2013-05-22 00:00:00',60,NULL,NULL);
/*!40000 ALTER TABLE `fitbody`.`tb_useritems` ENABLE KEYS */;
