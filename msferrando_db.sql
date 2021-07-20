/*
 Navicat Premium Data Transfer

 Source Server         : Database
 Source Server Type    : MySQL
 Source Server Version : 100419
 Source Host           : localhost:3306
 Source Schema         : msferrando_db

 Target Server Type    : MySQL
 Target Server Version : 100419
 File Encoding         : 65001

 Date: 16/07/2021 00:35:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_schedule
-- ----------------------------
DROP TABLE IF EXISTS `tbl_schedule`;
CREATE TABLE `tbl_schedule`  (
  `sched_id` int(11) NOT NULL AUTO_INCREMENT,
  `sched_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sched_price` double(10, 0) NULL DEFAULT NULL,
  `sched_date_created` date NULL DEFAULT NULL,
  `sched_course` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sched_status` int(5) NULL DEFAULT 1,
  `sched_status_website` int(5) NULL DEFAULT 0,
  PRIMARY KEY (`sched_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_schedule_copy1
-- ----------------------------
DROP TABLE IF EXISTS `tbl_schedule_copy1`;
CREATE TABLE `tbl_schedule_copy1`  (
  `sched_id` int(11) NOT NULL AUTO_INCREMENT,
  `sched_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sched_price` double(10, 0) NULL DEFAULT NULL,
  `sched_date_created` date NULL DEFAULT NULL,
  `sched_course` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sched_status` int(5) NULL DEFAULT 1,
  `sched_status_website` int(5) NULL DEFAULT 0,
  PRIMARY KEY (`sched_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_student
-- ----------------------------
DROP TABLE IF EXISTS `tbl_student`;
CREATE TABLE `tbl_student`  (
  `stud_id` int(11) NOT NULL AUTO_INCREMENT,
  `sched_id` int(11) NULL DEFAULT NULL,
  `stud_date_created` date NULL DEFAULT NULL,
  `stud_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stud_email_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stud_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stud_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `stud_birthdate` date NULL DEFAULT NULL,
  `stud_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `stud_payment` int(5) NULL DEFAULT 0,
  `stud_status` int(5) NULL DEFAULT 0,
  PRIMARY KEY (`stud_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_student_copy1
-- ----------------------------
DROP TABLE IF EXISTS `tbl_student_copy1`;
CREATE TABLE `tbl_student_copy1`  (
  `stud_id` int(11) NOT NULL AUTO_INCREMENT,
  `sched_id` int(11) NULL DEFAULT NULL,
  `stud_date_created` date NULL DEFAULT NULL,
  `stud_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stud_email_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stud_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stud_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `stud_birthdate` date NULL DEFAULT NULL,
  `stud_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `stud_payment` int(5) NULL DEFAULT 0,
  `stud_status` int(5) NULL DEFAULT 0,
  PRIMARY KEY (`stud_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userpass` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;
