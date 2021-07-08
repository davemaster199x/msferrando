/*
 Navicat Premium Data Transfer

 Source Server         : Database
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : accutest_db

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 09/02/2021 14:50:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_accutest
-- ----------------------------
DROP TABLE IF EXISTS `tbl_accutest`;
CREATE TABLE `tbl_accutest`  (
  `accutest_id` int(11) NOT NULL AUTO_INCREMENT,
  `accutest_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `accutest_price` double(255, 0) NULL DEFAULT NULL,
  `accutest_category` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `accutest_date_created` date NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`accutest_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_accutest
-- ----------------------------
INSERT INTO `tbl_accutest` VALUES (3, 'dasd', 0, 'Immunology-Serology', '2021-01-26', NULL);
INSERT INTO `tbl_accutest` VALUES (5, 'asd', 0, 'Immunology-Serology', '2021-01-26', NULL);
INSERT INTO `tbl_accutest` VALUES (6, 'asd', 0, 'Immunology-Serology', '2021-01-26', NULL);
INSERT INTO `tbl_accutest` VALUES (10, 'dfd', 0, 'Immunology-Serology', '2021-01-26', NULL);
INSERT INTO `tbl_accutest` VALUES (11, 'vd', 0, 'Immunology-Serology', '2021-01-26', NULL);
INSERT INTO `tbl_accutest` VALUES (12, 'vd', 0, 'Immunology-Serology', '2021-01-26', NULL);
INSERT INTO `tbl_accutest` VALUES (15, 'sdfsd', 0, 'Hematology', '2021-01-26', NULL);
INSERT INTO `tbl_accutest` VALUES (16, 'sdss', 0, 'Hematology', '2021-01-27', NULL);
INSERT INTO `tbl_accutest` VALUES (17, 'gfg', 0, 'Immunology-Serology', '2021-01-27', NULL);
INSERT INTO `tbl_accutest` VALUES (18, 'asd', 102, 'Hematology', '2021-01-27', NULL);
INSERT INTO `tbl_accutest` VALUES (19, 'asdsa', 222, 'Hematology', '2021-01-27', NULL);
INSERT INTO `tbl_accutest` VALUES (20, 'asdas', 1223, 'Hematology', '2021-01-28', 1);

-- ----------------------------
-- Table structure for tbl_patient
-- ----------------------------
DROP TABLE IF EXISTS `tbl_patient`;
CREATE TABLE `tbl_patient`  (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `patient_age` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `patient_sex` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `patient_physician` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `patient_birthdate` date NULL DEFAULT NULL,
  `patient_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `patient_date_created` date NULL DEFAULT NULL,
  `patient_photos` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `patient_status` int(11) NULL DEFAULT 0,
  `user_id` int(11) NULL DEFAULT NULL,
  `patient_discount` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`patient_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_patient
-- ----------------------------
INSERT INTO `tbl_patient` VALUES (4, 'Dave Malhin', '24', 'Male', 'Secrets', '1996-07-31', 'Boulevard', '2021-01-27', '115023-160585.JPEG', 1, NULL, 0);
INSERT INTO `tbl_patient` VALUES (6, 'asda', '232', 'adsa', 'dsa', '2021-01-27', 'asds', '2021-01-28', '162411-3.png.png', 0, 1, 0);
INSERT INTO `tbl_patient` VALUES (8, 'asdsa', '12', 'Male', 'asdsa', '2021-01-28', 'asdasd', '2021-01-29', '095703-echart.png', 1, 1, 0);
INSERT INTO `tbl_patient` VALUES (9, 'asdf', '123', 'asdf', 'asdf', '2021-02-16', 'asdfasd', '2021-02-09', '142229-IMG_61.JPG', 1, 1, 0);

-- ----------------------------
-- Table structure for tbl_technologist
-- ----------------------------
DROP TABLE IF EXISTS `tbl_technologist`;
CREATE TABLE `tbl_technologist`  (
  `technologist_id` int(11) NOT NULL AUTO_INCREMENT,
  `technologist_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `technologist_category` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `technologist_lic_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `technologist_date_created` date NULL DEFAULT NULL,
  PRIMARY KEY (`technologist_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_technologist
-- ----------------------------
INSERT INTO `tbl_technologist` VALUES (4, 'Hanna B. Adiong, RMT', 'Chief Medical Technologist', '0075568', '2021-02-04');
INSERT INTO `tbl_technologist` VALUES (5, 'Dave F. Malhin', 'Medical Technologist', '12345', '2021-02-04');

-- ----------------------------
-- Table structure for tbl_test_patient
-- ----------------------------
DROP TABLE IF EXISTS `tbl_test_patient`;
CREATE TABLE `tbl_test_patient`  (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NULL DEFAULT NULL,
  `accutest_id` int(11) NULL DEFAULT NULL,
  `accutest_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `accutest_price` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `accutest_category` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`test_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_test_patient
-- ----------------------------
INSERT INTO `tbl_test_patient` VALUES (42, 6, 19, 'asdsa', '222', 'Hematology');
INSERT INTO `tbl_test_patient` VALUES (43, 6, 18, 'asd', '102', 'Hematology');
INSERT INTO `tbl_test_patient` VALUES (44, 6, 15, 'sdfsd', '0', 'Hematology');
INSERT INTO `tbl_test_patient` VALUES (49, 4, 18, 'asd', '102', 'Hematology');
INSERT INTO `tbl_test_patient` VALUES (51, 4, 20, 'asdas', '1223', 'Hematology');
INSERT INTO `tbl_test_patient` VALUES (52, 4, 3, 'dasd', '0', 'Immunology-Serology');
INSERT INTO `tbl_test_patient` VALUES (53, 4, 5, 'asd', '0', 'Immunology-Serology');
INSERT INTO `tbl_test_patient` VALUES (54, 4, 17, 'gfg', '0', 'Immunology-Serology');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (1, 'Administrator', 'admin', 'admin');

SET FOREIGN_KEY_CHECKS = 1;
