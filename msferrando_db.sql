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

 Date: 14/09/2021 13:47:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_instructor
-- ----------------------------
DROP TABLE IF EXISTS `tbl_instructor`;
CREATE TABLE `tbl_instructor`  (
  `instructor_id` int(11) NOT NULL AUTO_INCREMENT,
  `instructor_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `instructor_username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `instructor_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `instructor_sched` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`instructor_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_instructor
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_pdc
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pdc`;
CREATE TABLE `tbl_pdc`  (
  `pdc_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NULL DEFAULT NULL,
  `instruc_id` int(5) NULL DEFAULT NULL,
  `pdc_stud_status` int(5) NULL DEFAULT 0,
  `pdc_stud_payment_status` int(5) NULL DEFAULT 0,
  `pdc_total_hours` int(5) NULL DEFAULT NULL,
  `pdc_notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pdc_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pdc
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_pdc_details
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pdc_details`;
CREATE TABLE `tbl_pdc_details`  (
  `pdc_id_details` int(11) NOT NULL AUTO_INCREMENT,
  `pdc_id` int(11) NULL DEFAULT NULL,
  `pdc_date_sched` date NULL DEFAULT NULL,
  `pdc_8_10` int(5) NULL DEFAULT 0,
  `pdc_10_12` int(5) NULL DEFAULT 0,
  `pdc_12_2` int(5) NULL DEFAULT 0,
  `pdc_2_4` int(5) NULL DEFAULT 0,
  `pdc_4_6` int(5) NULL DEFAULT 0,
  `pdc_6_8` int(5) NULL DEFAULT 0,
  PRIMARY KEY (`pdc_id_details`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pdc_details
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_student
-- ----------------------------
DROP TABLE IF EXISTS `tbl_student`;
CREATE TABLE `tbl_student`  (
  `stud_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_date_created` date NULL DEFAULT NULL,
  `stud_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stud_email_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stud_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stud_contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stud_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `stud_birthdate` date NULL DEFAULT NULL,
  PRIMARY KEY (`stud_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_student
-- ----------------------------
INSERT INTO `tbl_student` VALUES (3, '2021-07-13', 'Dave Malhin', 'malhindave@gmail.com', NULL, '09267881698', 'Boulevard', '1996-07-31');
INSERT INTO `tbl_student` VALUES (4, '2021-07-13', 'asd', 'asd', NULL, '213', 'adesa', '2021-07-13');
INSERT INTO `tbl_student` VALUES (5, '2021-07-13', 'sad', 'sad', NULL, '213', 'asdsa', '2021-07-13');
INSERT INTO `tbl_student` VALUES (6, '2021-07-14', 'asdf', 'asf', NULL, '123', 'asfds', '2021-07-14');
INSERT INTO `tbl_student` VALUES (7, '2021-07-14', 'asd', 'dasd', NULL, '12321', 'asd', '2021-07-14');
INSERT INTO `tbl_student` VALUES (8, '2021-07-15', 'asdf', 'asfd', NULL, '12321', 'asdf', '2021-07-15');
INSERT INTO `tbl_student` VALUES (9, '2021-07-15', 'asd', 'sasd', NULL, '213', 'asds', '2021-07-15');
INSERT INTO `tbl_student` VALUES (10, '2021-07-15', 'adsa', 'asdas', NULL, 'asdsa', 'asdasd', '2021-07-16');
INSERT INTO `tbl_student` VALUES (11, '2021-07-15', 'adsa', 'adas', NULL, 'dasd', 'asdasd', '2021-07-15');
INSERT INTO `tbl_student` VALUES (12, '2021-07-15', 'asdas', 'asdas', NULL, 'asdas', 'adasdas', '2021-07-15');
INSERT INTO `tbl_student` VALUES (14, '2021-07-15', 'asd', 'asdas', NULL, 'asdas', '21321', '2021-07-15');

-- ----------------------------
-- Table structure for tbl_tdc
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tdc`;
CREATE TABLE `tbl_tdc`  (
  `tdc_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NULL DEFAULT NULL,
  `tdc_first_day` date NULL DEFAULT NULL,
  `tdc_second_day` date NULL DEFAULT NULL,
  `tdc_stud_status` int(5) NULL DEFAULT 0,
  `tdc_stud_payment_status` int(5) NULL DEFAULT 0,
  `tdc_notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`tdc_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_tdc
-- ----------------------------

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

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (1, 'Administrator', 'admin', 'admin');

SET FOREIGN_KEY_CHECKS = 1;
