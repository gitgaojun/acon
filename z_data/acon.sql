/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : acon

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2015-04-03 10:34:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for eload_sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `eload_sys_menu`;
CREATE TABLE `eload_sys_menu` (
  `m_id` int(12) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `m_parent_id` int(12) NOT NULL COMMENT '父id',
  `m_name` varchar(30) NOT NULL COMMENT '描述',
  `m_url` char(30) NOT NULL COMMENT '链接地址 #',
  `m_sort` int(2) NOT NULL DEFAULT '0' COMMENT '排序',
  `m_dis` int(1) NOT NULL DEFAULT '0' COMMENT '是否显示 0 1',
  PRIMARY KEY (`m_id`),
  UNIQUE KEY `m_name` (`m_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='系统菜单列表';

-- ----------------------------
-- Records of eload_sys_menu
-- ----------------------------
INSERT INTO `eload_sys_menu` VALUES ('1', '0', '系统设置', '#', '0', '1');
INSERT INTO `eload_sys_menu` VALUES ('2', '1', '系统菜单', 'sys_menu/index', '0', '1');
INSERT INTO `eload_sys_menu` VALUES ('3', '1', '用户列表', 'sys_user/index', '0', '1');
INSERT INTO `eload_sys_menu` VALUES ('4', '1', '用户组管理', 'sys_group/index', '0', '1');

-- ----------------------------
-- Table structure for eload_sys_user
-- ----------------------------
DROP TABLE IF EXISTS `eload_sys_user`;
CREATE TABLE `eload_sys_user` (
  `u_id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `u_name` char(20) NOT NULL COMMENT '用户名',
  `u_relname` char(20) NOT NULL COMMENT '真实姓名',
  `u_pwd` char(100) NOT NULL COMMENT '密码',
  `u_ip` char(15) NOT NULL COMMENT 'ip地址',
  `u_addtime` datetime NOT NULL COMMENT '创建用户时间',
  `u_lasttime` datetime NOT NULL COMMENT '上次登出时间',
  `u_count` smallint(5) DEFAULT NULL COMMENT '登录次数',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of eload_sys_user
-- ----------------------------
INSERT INTO `eload_sys_user` VALUES ('1', 'gaojun', 'gaojun', '123456', '127.0.0.0', '2009-09-09 23:22:11', '2009-09-09 23:22:11', '1');
