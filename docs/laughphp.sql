/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50528
Source Host           : localhost:3306
Source Database       : laughphp

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

Date: 2014-01-13 15:22:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `la_admin`
-- ----------------------------
DROP TABLE IF EXISTS `la_admin`;
CREATE TABLE `la_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `ukey` char(6) NOT NULL COMMENT '混淆加密字符串6位',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `ustate` varchar(32) NOT NULL DEFAULT '' COMMENT '登录状态码',
  `lastlogintime` int(10) DEFAULT '0',
  `lastloginip` int(11) DEFAULT '0',
  `logincount` tinyint(6) NOT NULL DEFAULT '0',
  `super` tinyint(1) DEFAULT '0' COMMENT '是否超级管理员0否1是',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `updatetime` int(10) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`adminname`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_admin
-- ----------------------------
INSERT INTO `la_admin` VALUES ('1', 'admin', '206423eb45af33c046db62575e2522b2', 'gmk4r2', '1', '206423eb45af33c046db62575e2522b2', '1387777972', '1884711009', '127', '1', '1323910052', '1389001929');

-- ----------------------------
-- Table structure for `la_adminloginlog`
-- ----------------------------
DROP TABLE IF EXISTS `la_adminloginlog`;
CREATE TABLE `la_adminloginlog` (
  `logid` int(10) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(20) NOT NULL,
  `loginip` bigint(15) DEFAULT NULL,
  `logintime` int(10) DEFAULT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_adminloginlog
-- ----------------------------

-- ----------------------------
-- Table structure for `la_admin_access`
-- ----------------------------
DROP TABLE IF EXISTS `la_admin_access`;
CREATE TABLE `la_admin_access` (
  `adminid` int(10) NOT NULL DEFAULT '0',
  `nodeid` mediumint(6) NOT NULL DEFAULT '0',
  KEY `userid` (`adminid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_admin_access
-- ----------------------------

-- ----------------------------
-- Table structure for `la_archive`
-- ----------------------------
DROP TABLE IF EXISTS `la_archive`;
CREATE TABLE `la_archive` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '文档标题',
  `author` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '文档作者',
  `columnid` int(10) NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `thumbimage` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文章缩略图',
  `tag` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seotitle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keyword` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '文章状态 0:回收站 1:正常发布 2:草稿箱',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '评论状态 0:禁止评论 1:允许评论',
  `clicknum` int(6) DEFAULT '0' COMMENT '点击数',
  `commentnum` int(6) DEFAULT '0' COMMENT '评论数',
  `publishtime` int(10) DEFAULT '0' COMMENT '发布时间',
  `updatetime` int(10) DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `catalog` (`author`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of la_archive
-- ----------------------------

-- ----------------------------
-- Table structure for `la_attachment`
-- ----------------------------
DROP TABLE IF EXISTS `la_attachment`;
CREATE TABLE `la_attachment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `archiveid` int(10) NOT NULL DEFAULT '0' COMMENT '文档ID',
  `filepath` varchar(100) NOT NULL COMMENT '文件路径',
  `filename` varchar(100) NOT NULL COMMENT '原文件名',
  `savename` varchar(100) DEFAULT NULL COMMENT '文件保存名称',
  `filesize` int(10) NOT NULL DEFAULT '0' COMMENT '附件大小',
  `filetype` varchar(20) DEFAULT NULL COMMENT '文件类型(后缀名)',
  `downloadnum` int(10) NOT NULL DEFAULT '0' COMMENT '下载次数',
  `createtime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_attachment
-- ----------------------------

-- ----------------------------
-- Table structure for `la_group`
-- ----------------------------
DROP TABLE IF EXISTS `la_group`;
CREATE TABLE `la_group` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `sort` smallint(3) DEFAULT '0',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示0否1是',
  `createtime` int(11) unsigned DEFAULT '0',
  `updatetime` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_group
-- ----------------------------
INSERT INTO `la_group` VALUES ('1', '系统管理', '1', '1', '1332390538', '1381051070');
INSERT INTO `la_group` VALUES ('2', '会员中心', '2', '1', '1332390538', '1332390538');
INSERT INTO `la_group` VALUES ('3', '核心内容', '3', '1', '1332390538', '1332390538');
INSERT INTO `la_group` VALUES ('4', '系统插件', '4', '1', '1332390538', '1332390538');
INSERT INTO `la_group` VALUES ('5', '系统设置', '5', '1', '1353316335', '1353316335');

-- ----------------------------
-- Table structure for `la_images`
-- ----------------------------
DROP TABLE IF EXISTS `la_images`;
CREATE TABLE `la_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `imagepath` varchar(100) NOT NULL,
  `thumbpath` varchar(100) DEFAULT NULL,
  `imagetitle` varchar(100) DEFAULT NULL,
  `imagelink` varchar(100) DEFAULT NULL,
  `archiveid` int(10) NOT NULL DEFAULT '0' COMMENT '文档id',
  `imagename` varchar(100) DEFAULT NULL COMMENT '图片的原始名称',
  `savename` varchar(100) DEFAULT NULL COMMENT '图片的保存名称',
  `imagesize` int(10) DEFAULT '0' COMMENT '图片大小',
  `width` int(10) NOT NULL DEFAULT '0' COMMENT '图片宽度',
  `height` int(10) NOT NULL DEFAULT '0' COMMENT '图片高度',
  `createtime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_images
-- ----------------------------

-- ----------------------------
-- Table structure for `la_node`
-- ----------------------------
DROP TABLE IF EXISTS `la_node`;
CREATE TABLE `la_node` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `control` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父节点ID',
  `groupid` tinyint(3) unsigned DEFAULT '0' COMMENT '分组id',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '创建日期',
  `updatetime` int(10) NOT NULL DEFAULT '0' COMMENT '更新日期',
  `isshow` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示0否1是',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_node
-- ----------------------------
INSERT INTO `la_node` VALUES ('1', '角色管理', '管理角色信息 可编辑角色权限/改变用户的角色', '', '', '0', '1', '1352711650', '1381051169', '1');
INSERT INTO `la_node` VALUES ('2', '添加角色', '', 'Role', 'newRole', '1', '0', '1352711650', '1381051169', '1');
INSERT INTO `la_node` VALUES ('3', '管理角色', '', 'Role', 'manageRole', '1', '0', '1352711650', '1381051169', '1');
INSERT INTO `la_node` VALUES ('4', '日志管理', '', '', '', '0', '1', '1352711650', '1381051169', '1');
INSERT INTO `la_node` VALUES ('5', '管理员登录日志', '', 'Log', 'AdminLoginLog', '4', '0', '1352711650', '1381051169', '1');
INSERT INTO `la_node` VALUES ('6', '组管理', '', '', '', '0', '1', '1352711650', '1381051169', '1');
INSERT INTO `la_node` VALUES ('7', '管理组', '', 'Group', 'manageGroup', '6', '0', '1352711650', '1381051169', '1');
INSERT INTO `la_node` VALUES ('8', '节点管理', null, '', '', '0', '1', '1352711650', '1381051169', '1');
INSERT INTO `la_node` VALUES ('9', '添加节点', '', 'Node', 'newNode', '8', '0', '1352711650', '1381051169', '1');
INSERT INTO `la_node` VALUES ('10', '管理节点', '', 'Node', 'manageNode', '8', '0', '1352856214', '1381051169', '1');
INSERT INTO `la_node` VALUES ('11', '管理员用户管理', '管理员账号管理中心', '', '', '0', '1', '1352856238', '1381051169', '1');
INSERT INTO `la_node` VALUES ('12', '新管理员', '', 'Admin', 'newAdmin', '11', '0', '1352857554', '1381051169', '1');
INSERT INTO `la_node` VALUES ('13', '管理员列表', '', 'Admin', 'adminList', '11', '0', '1352858914', '1381051169', '1');
INSERT INTO `la_node` VALUES ('14', '会员管理', '', '', '', '0', '2', '1352944271', '1381051169', '1');
INSERT INTO `la_node` VALUES ('15', '会员列表', '', 'User', 'userList', '14', '0', '1353313113', '1381051169', '1');
INSERT INTO `la_node` VALUES ('16', '会员级别', '', 'User', 'userRank', '14', '0', '1353313186', '1381051169', '1');
INSERT INTO `la_node` VALUES ('17', '内容管理', '', '', '', '0', '3', '1353316415', '1381051169', '1');
INSERT INTO `la_node` VALUES ('18', '文章管理', '', 'Article', 'index', '17', '0', '1353316474', '1381051169', '1');
INSERT INTO `la_node` VALUES ('19', '常规插件', '', '', '', '0', '4', '1358999125', '1358999125', '1');
INSERT INTO `la_node` VALUES ('20', '基本设置', '', '', '', '0', '5', '1359011153', '1359011153', '1');
INSERT INTO `la_node` VALUES ('21', '系统基本参数', '', 'System', 'systemInfo', '20', '0', '1359011177', '1359011177', '1');
INSERT INTO `la_node` VALUES ('22', '系统日志管理', '', 'System', 'sysLog', '20', '0', '1359011220', '1359011220', '1');
INSERT INTO `la_node` VALUES ('23', '数据库管理', '', '', '', '0', '5', '1359011349', '1359011349', '1');
INSERT INTO `la_node` VALUES ('24', '数据库备份', '', 'DataBase', 'BackUp', '23', '0', '1359011410', '1359011410', '1');
INSERT INTO `la_node` VALUES ('25', 'SQL命令行工具', '', 'DataBase', 'SQLClient', '23', '0', '1359016018', '1359016018', '1');
INSERT INTO `la_node` VALUES ('26', '文件管理器', '', 'Plugin', 'fileManage', '19', '0', '1365562785', '1365562785', '1');

-- ----------------------------
-- Table structure for `la_role`
-- ----------------------------
DROP TABLE IF EXISTS `la_role`;
CREATE TABLE `la_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启用0否1是',
  `remark` varchar(255) DEFAULT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_role
-- ----------------------------

-- ----------------------------
-- Table structure for `la_role_admin`
-- ----------------------------
DROP TABLE IF EXISTS `la_role_admin`;
CREATE TABLE `la_role_admin` (
  `roleid` smallint(6) NOT NULL DEFAULT '0',
  `adminid` int(11) NOT NULL DEFAULT '0',
  KEY `userid` (`adminid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_role_admin
-- ----------------------------

-- ----------------------------
-- Table structure for `la_role_node`
-- ----------------------------
DROP TABLE IF EXISTS `la_role_node`;
CREATE TABLE `la_role_node` (
  `roleid` smallint(6) NOT NULL DEFAULT '0',
  `nodeid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `access` tinyint(4) DEFAULT '0' COMMENT '是否具有操作权限 0只读 1操作',
  KEY `groupId` (`roleid`),
  KEY `nodeId` (`nodeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_role_node
-- ----------------------------

-- ----------------------------
-- Table structure for `la_system`
-- ----------------------------
DROP TABLE IF EXISTS `la_system`;
CREATE TABLE `la_system` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primarykey',
  `cfgname` varchar(50) NOT NULL COMMENT '参数名称',
  `cfginfo` varchar(100) NOT NULL COMMENT '参数描述',
  `cfgtype` varchar(20) DEFAULT NULL COMMENT '参数类型',
  `cfggroupid` int(1) DEFAULT '0' COMMENT '参数所属分组',
  `cfgvalue` varchar(500) DEFAULT NULL COMMENT '参数值',
  `cfgtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_system
-- ----------------------------
INSERT INTO `la_system` VALUES ('1', 'host', '网站地址', 'string', '1', 'http://localhost:85', '1368437340');
INSERT INTO `la_system` VALUES ('2', 'sitename', '网站名称', 'string', '1', 'LaughPHP', '1368437340');
INSERT INTO `la_system` VALUES ('3', 'keywords', '网站关键字', 'text', '1', 'LaughPHP', '1368437340');
INSERT INTO `la_system` VALUES ('4', 'description', '网站描述', 'text', '1', 'LaughPHP', '1368528355');
INSERT INTO `la_system` VALUES ('5', 'admin_path', '管理中心目录', 'string', '2', 'admin', '1368437340');
INSERT INTO `la_system` VALUES ('6', 'Version', '系统版本', 'string', '1', '1.0', '1369830358');

-- ----------------------------
-- Table structure for `la_tag`
-- ----------------------------
DROP TABLE IF EXISTS `la_tag`;
CREATE TABLE `la_tag` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(20) NOT NULL,
  `usecount` int(10) DEFAULT '0' COMMENT '使用次数',
  `searchcount` int(10) DEFAULT '0' COMMENT '搜索次数',
  PRIMARY KEY (`id`),
  KEY `tag` (`tagname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_tag
-- ----------------------------

-- ----------------------------
-- Table structure for `la_user`
-- ----------------------------
DROP TABLE IF EXISTS `la_user`;
CREATE TABLE `la_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nickname` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `ukey` char(6) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否正常用户 0已删除 1正常',
  `ustate` varchar(32) NOT NULL DEFAULT '',
  `urank` varchar(50) NOT NULL DEFAULT '0',
  `lastlogintime` int(10) DEFAULT '0' COMMENT '上次登录日期',
  `lastloginip` int(10) DEFAULT '0' COMMENT '上次登录IP',
  `logincount` int(10) DEFAULT '0' COMMENT '登录次数',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '创建日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of la_user
-- ----------------------------
