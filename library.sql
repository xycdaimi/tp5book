/*
 Navicat Premium Data Transfer

 Source Server         : php
 Source Server Type    : MySQL
 Source Server Version : 80031
 Source Host           : localhost:3306
 Source Schema         : library

 Target Server Type    : MySQL
 Target Server Version : 80031
 File Encoding         : 65001

 Date: 25/12/2023 14:09:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book`  (
  `groups` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `author` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `press` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `price` double(10, 2) NOT NULL DEFAULT 0.00,
  `quantity` int NOT NULL DEFAULT 0,
  `isbn` varchar(13) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `total` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`isbn`) USING BTREE,
  INDEX `name`(`name` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES ('地理', '房龙地理', '房龙', '文汇出版社', 29.00, 10, '9780000000001', 10);
INSERT INTO `book` VALUES ('地理', '地理学与生活', '[美] 阿瑟·格蒂斯 ', '世界图书出版公司', 49.00, 10, '9780000000002', 10);
INSERT INTO `book` VALUES ('地理', '古老阳光的末日', 'Thom Hartmann', '上海远东出版社', 20.00, 10, '9780000000003', 10);
INSERT INTO `book` VALUES ('法律', '洞穴奇案', '[美] 萨伯', '生活.读书.新知三联书店', 18.00, 10, '9780000000004', 10);
INSERT INTO `book` VALUES ('法律', '西窗法雨', '刘星', '法律出版社', 24.00, 10, '9780000000005', 10);
INSERT INTO `book` VALUES ('法律', '审判为什么不公正', '[英] 卡德里', '新星出版社', 49.50, 10, '9780000000006', 10);
INSERT INTO `book` VALUES ('军事', '亮剑（舒适阅读版）', '都梁', '北京联合出版公司', 45.00, 10, '9780000000007', 10);
INSERT INTO `book` VALUES ('军事', '二战记忆 安妮日记', '[德] 安妮·弗兰克', '人民文学出版社', 23.00, 10, '9780000000008', 10);
INSERT INTO `book` VALUES ('军事', '亮剑', '都梁', '解放军文艺出版社', 25.00, 10, '9780000000009', 10);
INSERT INTO `book` VALUES ('历史', '历史是什么？', '爱德华·霍列特·卡尔', '商务印书馆', 19.00, 10, '9780000000010', 10);
INSERT INTO `book` VALUES ('历史', '中国史学史', '金毓黻', '商务印书馆', 19.00, 10, '9780000000011', 10);
INSERT INTO `book` VALUES ('历史', '史记选', '[清] 储欣', '商务印书馆', 48.00, 10, '9780000000012', 10);
INSERT INTO `book` VALUES ('计算机', 'Java从入门到精通 ', '明日科技', '清华大学出版社', 69.00, 10, '9780000000013', 10);
INSERT INTO `book` VALUES ('计算机', 'C++从入门到精通', '李伟明', '清华大学出版社', 49.00, 10, '9780000000014', 10);
INSERT INTO `book` VALUES ('计算机', 'PHP从入门到精通', '千锋教育高教产品研发部', '清华大学出版社', 59.00, 10, '9780000000015', 10);

-- ----------------------------
-- Table structure for book_type
-- ----------------------------
DROP TABLE IF EXISTS `book_type`;
CREATE TABLE `book_type`  (
  `type_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`type_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of book_type
-- ----------------------------
INSERT INTO `book_type` VALUES ('军事');
INSERT INTO `book_type` VALUES ('历史');
INSERT INTO `book_type` VALUES ('地理');
INSERT INTO `book_type` VALUES ('数学');
INSERT INTO `book_type` VALUES ('法律');
INSERT INTO `book_type` VALUES ('计算机');

-- ----------------------------
-- Table structure for borrow
-- ----------------------------
DROP TABLE IF EXISTS `borrow`;
CREATE TABLE `borrow`  (
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `isbn` varchar(13) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `id_card` varchar(9) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `phone` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `r_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name`(`name` ASC) USING BTREE,
  INDEX `isbn`(`isbn` ASC) USING BTREE,
  INDEX `username`(`username` ASC) USING BTREE,
  INDEX `phone`(`phone` ASC) USING BTREE,
  CONSTRAINT `isbn` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `name` FOREIGN KEY (`name`) REFERENCES `book` (`name`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `phone` FOREIGN KEY (`phone`) REFERENCES `user` (`phone`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of borrow
-- ----------------------------

-- ----------------------------
-- Table structure for operation_record
-- ----------------------------
DROP TABLE IF EXISTS `operation_record`;
CREATE TABLE `operation_record`  (
  `time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `book_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bookname`(`book_name`) USING BTREE,
  INDEX `name`(`name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of operation_record
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `Id` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `groups` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'user',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `gender` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `id_card` varchar(9) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '0',
  `phone` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '0',
  `identity` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '学生',
  `book_count` int NOT NULL DEFAULT 3,
  `had_count` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`Id`) USING BTREE,
  INDEX `username`(`username` ASC) USING BTREE,
  INDEX `phone`(`phone` ASC) USING BTREE,
  INDEX `id_card`(`id_card` ASC) USING BTREE,
  INDEX `name`(`name` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '管理员', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '男', '212106052', '13700000000', '管理员', 100000, 100000);
INSERT INTO `user` VALUES ('67e97fa3-55f3-e29b-f416-4b855634', 'user', '罗航', 'lh', 'e10adc3949ba59abbe56e057f20f883e', '男', '212106038', '18778540012', '学生', 3, 3);
INSERT INTO `user` VALUES ('dfdbd759-c88e-bc72-30ea-4a5c163d', 'user', '张博晨', 'zbc', 'e10adc3949ba59abbe56e057f20f883e', '男', '212106056', '18778545012', '学生', 3, 3);

SET FOREIGN_KEY_CHECKS = 1;
