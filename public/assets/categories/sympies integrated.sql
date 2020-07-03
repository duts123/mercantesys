/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : sympies

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 11/04/2019 22:12:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2018_08_19_080805_r_affiliate_infos', 1);
INSERT INTO `migrations` VALUES (2, '2018_08_19_080917_create_users_table', 1);
INSERT INTO `migrations` VALUES (3, '2018_08_19_082203_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (4, '2018_08_19_093235_r_tax_table_profiles', 1);
INSERT INTO `migrations` VALUES (5, '2018_08_19_093240_r_product_type', 1);
INSERT INTO `migrations` VALUES (6, '2018_08_19_093314_r_product_infos', 1);
INSERT INTO `migrations` VALUES (7, '2018_08_19_093319_t_product_variance', 1);
INSERT INTO `migrations` VALUES (8, '2018_08_19_093702_t_orders', 1);
INSERT INTO `migrations` VALUES (9, '2018_08_19_093737_t_order_items', 1);
INSERT INTO `migrations` VALUES (10, '2018_08_19_093824_t_invoices', 1);
INSERT INTO `migrations` VALUES (11, '2018_08_19_093903_t_payments', 1);
INSERT INTO `migrations` VALUES (12, '2018_08_19_093951_t_shipments', 1);
INSERT INTO `migrations` VALUES (13, '2018_08_19_094029_t_shipment_orderitems', 1);
INSERT INTO `migrations` VALUES (14, '2018_09_16_913349_r_inventory_info', 1);
INSERT INTO `migrations` VALUES (15, '2019_02_16_115200_r_reg_ecommerce', 1);
INSERT INTO `migrations` VALUES (16, '2019_02_18_014830_r_currency', 1);
INSERT INTO `migrations` VALUES (17, '2019_02_18_024928_t_setup', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE,
  CONSTRAINT `password_resets_email_foreign` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_account_credentials
-- ----------------------------
DROP TABLE IF EXISTS `r_account_credentials`;
CREATE TABLE `r_account_credentials`  (
  `rac_accountid` int(11) NOT NULL AUTO_INCREMENT,
  `rac_username` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rac_profilepicture` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'userid_1.jpg',
  `rac_userbackgroundcover` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'defaultcover.jpg',
  `rac_password` varbinary(50) NOT NULL,
  `rac_email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rac_pnumb` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rac_shortbio` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rac_credentialsadded` datetime(0) NOT NULL,
  `rac_mobileverification` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rac_credentialsmodified` datetime(0) NOT NULL,
  `rac_useraddress` varchar(1500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Address 1, block 1 lot 1',
  PRIMARY KEY (`rac_accountid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_account_credentials
-- ----------------------------
INSERT INTO `r_account_credentials` VALUES (1, 'zheuswalker', 'us2.jpg', 'defaultcover.jpg', 0x3566346463633362356161373635643631643833323764656238383263663939, 'thndrwrth@gmail.com', '0950061784', 'This is my bio', '2018-06-19 00:00:00', NULL, '2018-06-19 00:00:00', 'Address 1, block 1 lot 1');
INSERT INTO `r_account_credentials` VALUES (2, 'Andrew Steuwarts', 'us2.jpg', 'defaultcover.jpg', 0x3566346463633362356161373635643631643833323764656238383263663939, 'Andrew_Steuwarts@gmail.com', '09500617845', '\nBloodtype : abaey+', '2018-06-19 00:00:00', NULL, '2018-06-19 00:00:00', 'Address 1, block 1 lot 1');
INSERT INTO `r_account_credentials` VALUES (3, 'PUPQC', 'us2.jpg', 'defaultcover.jpg', 0x3566346463633362356161373635643631643833323764656238383263663939, 'samplemail', '6645664', 'This is my bio', '2018-06-20 00:00:00', NULL, '2018-06-20 00:00:00', 'Address 1, block 1 lot 1');
INSERT INTO `r_account_credentials` VALUES (4, 'Sympies', 'us2.jpg', 'defaultcover.jpg', 0x3566346463633362356161373635643631643833323764656238383263663939, 'Sympies@Sympies.Sympies', '09090909', 'This is my bio', '2018-09-29 19:10:15', NULL, '2018-09-29 19:10:15', 'Address 1, block 1 lot 1');
INSERT INTO `r_account_credentials` VALUES (5, 'Lowell', 'us2.jpg', 'defaultcover.jpg', 0x3566346463633362356161373635643631643833323764656238383263663939, 'Lowell', '09090909', 'This is my bio', '2018-09-29 19:30:34', NULL, '2018-09-29 19:30:34', 'Address 1, block 1 lot 1');
INSERT INTO `r_account_credentials` VALUES (6, 'keitheyvan', 'us2.jpg', 'defaultcover.jpg', 0x3566346463633362356161373635643631643833323764656238383263663939, 'keitheyvan', '0909988871', NULL, '2018-06-04 00:00:00', NULL, '2018-06-04 00:00:00', 'Address 1, block 1 lot 1');
INSERT INTO `r_account_credentials` VALUES (22, 'sol', 'us2.jpg', 'defaultcover.jpg', 0x3533336335626138333638303735646238663665663230313534366264373161, 'cris12va', '1234567', NULL, '2019-01-10 17:26:58', NULL, '2019-01-10 17:26:58', 'Address 1, block 1 lot 1');
INSERT INTO `r_account_credentials` VALUES (28, 'keith', 'us2.jpg', 'defaultcover.jpg', 0x3566346463633362356161373635643631643833323764656238383263663939, 'keith', '999', NULL, '2019-02-09 15:57:59', NULL, '2019-02-09 15:57:59', 'Address 1, block 1 lot 1');
INSERT INTO `r_account_credentials` VALUES (29, 'user', 'us2.jpg', 'defaultcover.jpg', 0x3161316463393163393037333235633639323731646466306339343462633732, 'em', '9', NULL, '2019-02-09 16:05:11', NULL, '2019-02-09 16:05:11', 'Address 1, block 1 lot 1');
INSERT INTO `r_account_credentials` VALUES (30, 'us1', 'us2.jpg', 'defaultcover.jpg', 0x6137323263363364623865633836323561663663663731636238633264393339, 'emsil', '999', NULL, '2019-02-09 17:30:25', NULL, '2019-02-09 17:30:25', 'Address 1, block 1 lot 1');
INSERT INTO `r_account_credentials` VALUES (31, 'us2', 'us2.jpg', 'defaultcover.jpg', 0x6331353732643035343234643065636232613635656336613832616561636266, 'email1', '999', NULL, '2019-02-09 17:32:30', NULL, '2019-02-09 17:32:30', 'Address 1, block 1 lot 1');

-- ----------------------------
-- Table structure for r_account_notification
-- ----------------------------
DROP TABLE IF EXISTS `r_account_notification`;
CREATE TABLE `r_account_notification`  (
  `ran_notificationid` int(11) NOT NULL AUTO_INCREMENT,
  `ran_postid` int(11) NOT NULL,
  `ran_notifywho` int(11) NOT NULL,
  `ran_notifyby` int(11) NOT NULL,
  `ran_notificationbody` varchar(10000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ran_activitydate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ran_notificationid`) USING BTREE,
  INDEX `ran_postid`(`ran_postid`) USING BTREE,
  INDEX `ran_notifywho`(`ran_notifywho`) USING BTREE,
  INDEX `ran_notifyby`(`ran_notifyby`) USING BTREE,
  CONSTRAINT `r_account_notification_ibfk_1` FOREIGN KEY (`ran_postid`) REFERENCES `t_account_feeds` (`tafd_postid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `r_account_notification_ibfk_2` FOREIGN KEY (`ran_notifywho`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `r_account_notification_ibfk_3` FOREIGN KEY (`ran_notifyby`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_account_notification
-- ----------------------------
INSERT INTO `r_account_notification` VALUES (4, 3, 1, 1, ' zheuswalker ,relates to your post:', '2019-03-27 16:21:40');
INSERT INTO `r_account_notification` VALUES (7, 49, 1, 2, ' zheuswalker ,Relates to your post!', '2019-03-30 19:52:40');
INSERT INTO `r_account_notification` VALUES (8, 4, 1, 3, ' zheuswalker ,Relates to your post!', '2019-03-30 19:53:34');
INSERT INTO `r_account_notification` VALUES (9, 6, 1, 1, ' zheuswalker ,Relates to your post!', '2019-04-05 17:53:15');

-- ----------------------------
-- Table structure for r_affiliate_infos
-- ----------------------------
DROP TABLE IF EXISTS `r_affiliate_infos`;
CREATE TABLE `r_affiliate_infos`  (
  `AFF_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `AFF_CODE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AFF_NAME` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AFF_DESC` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AFF_PAYMENT_INSTRUCTION` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AFF_PAYMENT_MODE` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AFF_DISPLAY_STATUS` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`AFF_ID`) USING BTREE,
  UNIQUE INDEX `r_affiliate_infos_aff_code_unique`(`AFF_CODE`) USING BTREE,
  UNIQUE INDEX `r_affiliate_infos_aff_name_unique`(`AFF_NAME`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_affiliate_infos
-- ----------------------------
INSERT INTO `r_affiliate_infos` VALUES (1, 'SYMP-2019-1', 'Sympies', 'Sympies Description', 'Instruction', 'Bank', 1, '2019-02-19 05:43:42', '2019-02-19 05:43:42');
INSERT INTO `r_affiliate_infos` VALUES (2, 'ISL-2019-1', 'Island Rose', 'Island Rose Description', 'Instruction', 'Bank', 1, '2019-02-19 05:43:42', '2019-02-19 05:43:42');

-- ----------------------------
-- Table structure for r_comment_replies
-- ----------------------------
DROP TABLE IF EXISTS `r_comment_replies`;
CREATE TABLE `r_comment_replies`  (
  `rcr_replyid` int(11) NOT NULL AUTO_INCREMENT,
  `rcr_replyparent` int(11) NOT NULL,
  `rcr_replyactor` int(11) NOT NULL,
  `rcr_replybody` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rcr_replydate` datetime(0) NOT NULL,
  `rcr_isdeleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`rcr_replyid`) USING BTREE,
  INDEX `rcr_replyparent`(`rcr_replyparent`) USING BTREE,
  INDEX `rcr_replyactor`(`rcr_replyactor`) USING BTREE,
  CONSTRAINT `r_comment_replies_ibfk_1` FOREIGN KEY (`rcr_replyparent`) REFERENCES `r_feeds_comments` (`rfc_commentid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `r_comment_replies_ibfk_2` FOREIGN KEY (`rcr_replyactor`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_currencies
-- ----------------------------
DROP TABLE IF EXISTS `r_currencies`;
CREATE TABLE `r_currencies`  (
  `CURR_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `TAXP_ID` int(10) UNSIGNED NOT NULL,
  `CURR_NAME` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CURR_COUNTRY` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CURR_SYMBOL` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CURR_ACR` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CURR_RATE` double(10, 2) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`CURR_ID`) USING BTREE,
  INDEX `r_currencies_taxp_id_foreign`(`TAXP_ID`) USING BTREE,
  CONSTRAINT `r_currencies_taxp_id_foreign` FOREIGN KEY (`TAXP_ID`) REFERENCES `r_tax_table_profiles` (`TAXP_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_currencies
-- ----------------------------
INSERT INTO `r_currencies` VALUES (1, 2, 'Peso', 'Philippines', '₱', 'PHP', 41.50, '2019-02-19 05:44:28', '2019-02-19 05:44:28');

-- ----------------------------
-- Table structure for r_feeds_comments
-- ----------------------------
DROP TABLE IF EXISTS `r_feeds_comments`;
CREATE TABLE `r_feeds_comments`  (
  `rfc_commentid` int(11) NOT NULL AUTO_INCREMENT,
  `rfc_feedparent` int(11) NOT NULL,
  `rfc_commentcreator` int(11) NOT NULL,
  `rfc_commentbody` mediumtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rfc_reported` int(11) NOT NULL DEFAULT 0,
  `rfc_dateadded` datetime(0) NOT NULL,
  `rfc_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`rfc_commentid`) USING BTREE,
  INDEX `rfc_feedparent`(`rfc_feedparent`) USING BTREE,
  INDEX `rfc_commentcreator`(`rfc_commentcreator`) USING BTREE,
  CONSTRAINT `r_feeds_comments_ibfk_1` FOREIGN KEY (`rfc_feedparent`) REFERENCES `t_account_feeds` (`tafd_postid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `r_feeds_comments_ibfk_2` FOREIGN KEY (`rfc_commentcreator`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_feeds_comments
-- ----------------------------
INSERT INTO `r_feeds_comments` VALUES (5, 6, 2, 'Ay ang ang ganda , bet , Pak na pak!', 0, '2018-11-10 22:45:03', 0);
INSERT INTO `r_feeds_comments` VALUES (9, 3, 2, 'Hello', 0, '2018-11-14 17:01:57', 0);
INSERT INTO `r_feeds_comments` VALUES (15, 6, 2, 'cutie', 0, '2018-11-21 13:42:40', 0);
INSERT INTO `r_feeds_comments` VALUES (25, 49, 2, 'You have such beautiful eyes!', 0, '2019-01-04 21:56:27', 0);
INSERT INTO `r_feeds_comments` VALUES (31, 49, 2, 'baliw ka', 0, '2019-02-13 16:56:45', 0);
INSERT INTO `r_feeds_comments` VALUES (32, 49, 1, 'loko', 0, '2019-02-13 16:57:24', 0);
INSERT INTO `r_feeds_comments` VALUES (33, 49, 1, 'pretty', 0, '2019-02-23 18:05:02', 0);
INSERT INTO `r_feeds_comments` VALUES (34, 49, 1, 'ganda eyes', 0, '2019-02-28 18:40:43', 0);
INSERT INTO `r_feeds_comments` VALUES (35, 3, 1, 'awe cute', 0, '2019-03-02 01:05:52', 0);
INSERT INTO `r_feeds_comments` VALUES (36, 49, 1, 'beautiful', 0, '2019-03-02 01:08:10', 0);
INSERT INTO `r_feeds_comments` VALUES (37, 6, 1, 'huhujue', 0, '2019-03-05 11:39:49', 0);
INSERT INTO `r_feeds_comments` VALUES (38, 4, 1, 'kzkdkdkf', 0, '2019-03-05 15:51:02', 0);
INSERT INTO `r_feeds_comments` VALUES (39, 49, 1, 'great eye', 0, '2019-03-06 03:07:58', 0);
INSERT INTO `r_feeds_comments` VALUES (40, 6, 1, 'i miss you too', 0, '2019-03-06 03:08:32', 0);
INSERT INTO `r_feeds_comments` VALUES (41, 6, 1, 'haha', 0, '2019-04-05 18:20:48', 0);
INSERT INTO `r_feeds_comments` VALUES (42, 6, 1, 'jaha', 0, '2019-04-05 18:20:48', 0);

-- ----------------------------
-- Table structure for r_imotions_details
-- ----------------------------
DROP TABLE IF EXISTS `r_imotions_details`;
CREATE TABLE `r_imotions_details`  (
  `rid_imotionid` int(11) NOT NULL AUTO_INCREMENT,
  `rid_imotionname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rid_imotionimagepath` varchar(1500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rid_imotionadded` datetime(0) NULL DEFAULT NULL,
  `rid_imotionremove` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`rid_imotionid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_imotions_details
-- ----------------------------
INSERT INTO `r_imotions_details` VALUES (1, 'Angry', 'imotion_01_angry', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (2, 'Anxious', 'imotion_02_anxious', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (3, 'Bullied', 'imotion_03_bullied', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (4, 'Confused', 'imotion_04_confused', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (5, 'Depressed', 'imotion_05_depressed', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (6, 'Determined', 'imotion_06_determined', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (7, 'Disgusted', 'imotion_07_disgusted', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (8, 'Faith', 'imotion_08_faith', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (9, 'Alone', 'imotion_09_alone', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (10, 'Sick', 'imotion_10_sick', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (11, 'Grateful', 'imotion_11_grateful', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (12, 'Grief', 'imotion_12_grief', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (13, 'Happy', 'imotion_13_happy', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (14, 'Heartbroken', 'imotion_14_heartbroken', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (15, 'Hopeful', 'imotion_15_hopeful', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (16, 'Love', 'imotion_16_love', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (17, 'Jealous', 'imotion_17_jealous', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (18, 'LGBT', 'imotion_18_lgbt', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (19, 'Marriage', 'imotion_19_marriage', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (20, 'Mommy', 'imotion_20_mommy', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (21, 'Moody', 'imotion_21_moody', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (22, 'Moving On', 'imotion_22_movingon', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (23, 'Addiction', 'imotion_23_addiction', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (24, 'Pets', 'imotion_24_pets', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (25, 'Stressed', 'imotion_25_stressed', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (26, 'Suggestions', 'imotion_26_suggestions', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (27, 'Surprised', 'imotion_27_surprised', '2018-06-23 01:19:00', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (28, 'Trust', 'imotion_28_trust', '2018-06-23 01:19:44', '2018-06-23 01:19:44');
INSERT INTO `r_imotions_details` VALUES (29, 'HAHA', 'imotion_29_myloves', '2018-06-23 16:26:59', '2018-06-23 16:26:59');
INSERT INTO `r_imotions_details` VALUES (30, 'romance', 'mem', '2018-08-23 16:10:52', '2018-08-23 16:10:52');

-- ----------------------------
-- Table structure for r_inventory_infos
-- ----------------------------
DROP TABLE IF EXISTS `r_inventory_infos`;
CREATE TABLE `r_inventory_infos`  (
  `INV_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `PROD_ID` int(10) UNSIGNED NOT NULL,
  `PRODV_ID` int(10) UNSIGNED NULL DEFAULT NULL,
  `INV_QTY` int(11) NOT NULL DEFAULT 0,
  `INV_TYPE` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'add',
  `ORDI_ID` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`INV_ID`) USING BTREE,
  INDEX `r_inventory_infos_ordi_id_foreign`(`ORDI_ID`) USING BTREE,
  INDEX `r_inventory_infos_prod_id_foreign`(`PROD_ID`) USING BTREE,
  INDEX `r_inventory_infos_prodv_id_foreign`(`PRODV_ID`) USING BTREE,
  CONSTRAINT `r_inventory_infos_ordi_id_foreign` FOREIGN KEY (`ORDI_ID`) REFERENCES `t_order_items` (`ORDI_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `r_inventory_infos_prod_id_foreign` FOREIGN KEY (`PROD_ID`) REFERENCES `r_product_infos` (`PROD_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `r_inventory_infos_prodv_id_foreign` FOREIGN KEY (`PRODV_ID`) REFERENCES `t_product_variances` (`PRODV_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_inventory_infos
-- ----------------------------
INSERT INTO `r_inventory_infos` VALUES (1, 1, NULL, 10, 'CAPITAL', NULL, '2019-02-20 05:46:38', '2019-02-20 05:46:38');
INSERT INTO `r_inventory_infos` VALUES (6, 5, NULL, 100, 'CAPITAL', NULL, '2019-02-22 00:59:10', '2019-02-22 00:59:10');
INSERT INTO `r_inventory_infos` VALUES (7, 6, NULL, 100, 'CAPITAL', NULL, '2019-02-22 01:00:56', '2019-02-22 01:00:56');
INSERT INTO `r_inventory_infos` VALUES (8, 7, NULL, 100, 'CAPITAL', NULL, '2019-02-22 01:02:32', '2019-02-22 01:02:32');
INSERT INTO `r_inventory_infos` VALUES (9, 8, NULL, 100, 'CAPITAL', NULL, '2019-02-22 01:05:44', '2019-02-22 01:05:44');
INSERT INTO `r_inventory_infos` VALUES (10, 9, NULL, 100, 'CAPITAL', NULL, '2019-02-22 01:07:48', '2019-02-22 01:07:48');
INSERT INTO `r_inventory_infos` VALUES (11, 10, NULL, 100, 'CAPITAL', NULL, '2019-02-22 01:10:31', '2019-02-22 01:10:31');
INSERT INTO `r_inventory_infos` VALUES (12, 11, NULL, 100, 'CAPITAL', NULL, '2019-02-22 01:29:55', '2019-02-22 01:29:55');
INSERT INTO `r_inventory_infos` VALUES (13, 11, 7, 10, 'CAPITAL', NULL, '2019-02-22 01:31:07', '2019-02-22 01:31:07');
INSERT INTO `r_inventory_infos` VALUES (14, 1, NULL, 2, 'ORDER', 7, '2019-02-26 16:07:47', '2019-02-26 16:07:47');
INSERT INTO `r_inventory_infos` VALUES (16, 1, NULL, 1, 'ORDER', 9, '2019-02-26 17:37:47', '2019-02-26 17:37:47');
INSERT INTO `r_inventory_infos` VALUES (17, 5, NULL, 2, 'ORDER', 10, '2019-02-26 17:39:37', '2019-02-26 17:39:37');
INSERT INTO `r_inventory_infos` VALUES (18, 11, 7, 2, 'ORDER', 11, '2019-03-01 17:39:50', '2019-03-01 17:39:50');
INSERT INTO `r_inventory_infos` VALUES (19, 8, NULL, 5, 'ORDER', 12, '2019-03-01 22:30:14', '2019-03-01 22:30:14');
INSERT INTO `r_inventory_infos` VALUES (20, 11, 7, 10, 'ADD', NULL, '2019-03-05 23:36:12', NULL);
INSERT INTO `r_inventory_infos` VALUES (21, 8, NULL, 25, 'ADD', NULL, '2019-03-06 19:31:16', '2019-03-06 19:31:16');
INSERT INTO `r_inventory_infos` VALUES (22, 8, NULL, 10, 'DISPOSE', NULL, '2019-03-06 19:33:17', '2019-03-06 19:33:17');
INSERT INTO `r_inventory_infos` VALUES (23, 11, 7, 10, 'ADD', NULL, '2019-03-06 19:38:50', '2019-03-06 19:38:50');
INSERT INTO `r_inventory_infos` VALUES (24, 6, NULL, 3, 'ORDER', 13, '2019-03-06 20:38:16', '2019-03-06 20:38:16');
INSERT INTO `r_inventory_infos` VALUES (25, 11, NULL, 2, 'ORDER', 14, '2019-03-06 20:59:15', '2019-03-06 20:59:15');
INSERT INTO `r_inventory_infos` VALUES (26, 1, 6, 19, 'ADD', NULL, '2019-03-08 17:50:13', '2019-03-08 17:50:13');
INSERT INTO `r_inventory_infos` VALUES (27, 1, 6, 2, 'DISPOSE', NULL, '2019-03-08 17:50:27', '2019-03-08 17:50:27');
INSERT INTO `r_inventory_infos` VALUES (28, 10, NULL, 2, 'ORDER', 15, '2019-03-30 05:59:50', '2019-03-30 05:59:50');
INSERT INTO `r_inventory_infos` VALUES (29, 7, NULL, 0, 'DISPOSE', NULL, '2019-03-30 09:15:40', '2019-03-30 09:15:40');
INSERT INTO `r_inventory_infos` VALUES (30, 7, NULL, 120, 'DISPOSE', NULL, '2019-03-30 09:15:54', '2019-03-30 09:15:54');
INSERT INTO `r_inventory_infos` VALUES (31, 7, NULL, 30, 'DISPOSE', NULL, '2019-03-30 09:16:13', '2019-03-30 09:16:13');
INSERT INTO `r_inventory_infos` VALUES (32, 8, NULL, 120, 'DISPOSE', NULL, '2019-03-30 09:16:28', '2019-03-30 09:16:28');
INSERT INTO `r_inventory_infos` VALUES (33, 4, NULL, 2, 'ORDER', 16, '2019-03-30 11:38:04', '2019-03-30 11:38:04');
INSERT INTO `r_inventory_infos` VALUES (34, 11, 7, 30, 'DISPOSE', NULL, '2019-04-03 02:19:02', '2019-04-03 02:19:02');
INSERT INTO `r_inventory_infos` VALUES (35, 11, NULL, 200, 'DISPOSE', NULL, '2019-04-03 02:21:39', '2019-04-03 02:21:39');
INSERT INTO `r_inventory_infos` VALUES (38, 6, NULL, 10, 'DISPOSE', NULL, '2019-04-03 02:26:28', '2019-04-03 02:26:28');
INSERT INTO `r_inventory_infos` VALUES (39, 3, NULL, 3, 'ORDER', 17, '2019-04-03 02:43:41', '2019-04-03 02:43:41');

-- ----------------------------
-- Table structure for r_post_getyou
-- ----------------------------
DROP TABLE IF EXISTS `r_post_getyou`;
CREATE TABLE `r_post_getyou`  (
  `rpg_postrelate` int(11) NOT NULL,
  `rpg_actormakeget` int(11) NOT NULL,
  `rpg_getyoudateadded` datetime(0) NULL DEFAULT NULL,
  `rpg_isremoved` int(11) NOT NULL,
  INDEX `rpg_postrelate`(`rpg_postrelate`) USING BTREE,
  INDEX `rpg_actormakeget`(`rpg_actormakeget`) USING BTREE,
  CONSTRAINT `r_post_getyou_ibfk_1` FOREIGN KEY (`rpg_postrelate`) REFERENCES `t_account_feeds` (`tafd_postid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `r_post_getyou_ibfk_2` FOREIGN KEY (`rpg_actormakeget`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_post_getyou
-- ----------------------------
INSERT INTO `r_post_getyou` VALUES (3, 1, '2019-03-27 16:21:40', 0);
INSERT INTO `r_post_getyou` VALUES (49, 1, '2019-03-30 19:52:39', 0);
INSERT INTO `r_post_getyou` VALUES (4, 1, '2019-03-30 19:53:34', 0);
INSERT INTO `r_post_getyou` VALUES (6, 1, '2019-04-05 17:53:15', 0);

-- ----------------------------
-- Table structure for r_product_infos
-- ----------------------------
DROP TABLE IF EXISTS `r_product_infos`;
CREATE TABLE `r_product_infos`  (
  `PROD_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `PRODT_ID` int(10) UNSIGNED NULL DEFAULT NULL,
  `AFF_ID` int(10) UNSIGNED NOT NULL,
  `PROD_DESC` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `PROD_NOTE` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `PROD_IMG` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `PROD_CODE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PROD_NAME` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PROD_INIT_QTY` int(11) NOT NULL DEFAULT 500,
  `PROD_DISCOUNT` int(11) NOT NULL DEFAULT 0,
  `PROD_CRITICAL` int(11) NOT NULL DEFAULT 100,
  `PROD_BASE_PRICE` double(10, 2) NOT NULL,
  `PROD_MY_PRICE` double(10, 2) NOT NULL,
  `PROD_AVAILABILITY` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `PROD_IS_APPROVED` tinyint(1) NULL DEFAULT NULL,
  `PROD_APPROVED_AT` datetime(0) NULL DEFAULT NULL,
  `PROD_DISPLAY_STATUS` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`PROD_ID`) USING BTREE,
  UNIQUE INDEX `r_product_infos_prod_code_unique`(`PROD_CODE`) USING BTREE,
  INDEX `r_product_infos_prodt_id_foreign`(`PRODT_ID`) USING BTREE,
  INDEX `r_product_infos_aff_id_foreign`(`AFF_ID`) USING BTREE,
  CONSTRAINT `r_product_infos_aff_id_foreign` FOREIGN KEY (`AFF_ID`) REFERENCES `r_affiliate_infos` (`AFF_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `r_product_infos_prodt_id_foreign` FOREIGN KEY (`PRODT_ID`) REFERENCES `r_product_types` (`PRODT_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_product_infos
-- ----------------------------
INSERT INTO `r_product_infos` VALUES (1, 6, 2, 'One Dozen White Roses + Three Red Roses', '<p><strong>Be my Valentine!&nbsp; Can&#39;t decide between 3 red roses or 1 dozen roses?&nbsp; Send her both! Celebrate Valentine&#39;s day by sending her three beautiful red roses surrounded by a dozen white roses.&nbsp; The perfect Valentine&#39;s Day surprise!</strong></p>\r\n\n<p>Flowers are arranged and shipped in exclusive Island Rose packaging. Vase is not included. Special add-on gift items are available upon checkout.<br />\r\nAbsolutely no hidden fees! For your convenience, all our prices already include Service Charges, Taxes, and Delivery Fees. Happy Shopping!&nbsp;</p>\r\n\n<p>*Our priority is to deliver your flowers on time!&nbsp; If certain flowers unexpectedly become unavailable, Island Rose will replace them with flowers of equal or greater value.<br />\r\n**Island Rose offers next day delivery nationwide! Same day delivery is available in Metro Manila.</p>', 'uploads/2019-ISL-00002-1.jpg', '2019-ISL-00002-1', 'Be My Valentine!', 500, 0, 100, 1890.00, 2100.00, NULL, 1, '2019-02-20 05:39:14', 1, '2019-02-19 05:43:44', '2019-02-24 15:25:35');
INSERT INTO `r_product_infos` VALUES (2, 6, 2, '3-Stem White Roses', '<h2><strong>White roses are meant to reaffirm one&#39;s commitment, fidelity </strong><strong>and</strong><strong> loyalty. Write your message in our special Island Rose greeting card and we&#39;ll send it with long stem white roses. Express your deepest feelings - say it best with roses!<br />\r\nFlowers are arranged in exclusive Island Rose packaging and delivered in special gift boxes.</strong><strong>Vase</strong><strong> is not included. Special add-on gift items are available upon checkout.</strong><br />\r\n<br />\r\nAbsolutely no hidden fees! For your convenience, all our prices already include Service Charges, Taxes, and Delivery fees. Happy Shopping!&nbsp;<br />\r\n*Our priority is to deliver your flowers on time!&nbsp; If certain flowers unexpectedly become unavailable, Island Rose will replace them with flowers of equal or greater value.<br />\r\n<br />\r\n**Island Rose offers next day delivery nationwide! Same day delivery is available in Metro Manila.</h2>', 'uploads/2019-ISL-00002-2.jpg', '2019-ISL-00002-2', 'Pure White', 500, 0, 100, 695.00, 700.00, '02/17/2019 to 02/28/2019', 1, '2019-02-20 05:22:02', 1, '2019-02-19 05:43:44', '2019-02-21 16:04:10');
INSERT INTO `r_product_infos` VALUES (3, 4, 1, 'One Dozen Red Roses, Teddy Bear, Pralines', '<p><strong>Wake her up to a lovely surprise! There&#39;s no gift sweeter than a fresh bunch of flowers together with a box of chocolates and a bear that says &quot;I Love You&quot;. Let this special day be a reminder of how much you love her. Whether it&#39;s your anniversary, her birthday or just an ordinary day - let this intimate gift package say your deepest feelings!<br />\r\nFlowers are arranged in exclusive Island Rose packaging and delivered in special gift boxes. Special add-on gift items are available upon checkout.</strong></p>\r\n\n<p>Absolutely no hidden fees! For your convenience, all our prices already include Service Charges, Taxes, and Delivery fees. Happy Shopping!&nbsp; *Our priority is to deliver your flowers on time!&nbsp; If certain flowers unexpectedly become unavailable, Island Rose will replace them with flowers of equal or greater value.**Island Rose offers next day delivery nationwide! Same day delivery is available in Metro Manila.</p>', 'uploads/2019-SYM-00001-3.jpg', '2019-SYM-00001-3', 'Forever', 500, 0, 100, 1000.00, 1200.00, NULL, 1, '2019-02-20 03:53:20', 1, '2019-02-19 05:43:44', '2019-02-23 02:04:14');
INSERT INTO `r_product_infos` VALUES (4, 6, 2, 'White & Orange Roses In An Orange Keepsake Box', '<h2><strong>The sweetest rose combination for the special people in your life. Send a box of cheerful orange and white roses - a flawless fit for happy occasions!<br />\r\nAbsolutely no hidden fees! For your convenience, all our prices already include Service Charges, Taxes, and Delivery Fees. Happy Shopping!&nbsp;</strong><br />\r\n&nbsp;</h2>\r\n\n<p>*Our priority is to deliver your flowers on time! If certain flowers unexpectedly become unavailable, Island Rose will replace them with flowers of equal or greater value.</p>\r\n\n<p>**Island Rose offers next day delivery nationwide! Same day delivery is available to most of Metro Manila except CAMANAVA (Caloocan, Malabon, Navotas, and Valenzuela).</p>', 'uploads/2019-SYM-00001-4.jpg', '2019-SYM-00001-4', 'Orange Candy Rose', 500, 0, 100, 1000.00, 1200.00, NULL, 1, '2019-02-21 15:32:21', 1, '2019-02-19 05:43:44', '2019-02-21 16:09:56');
INSERT INTO `r_product_infos` VALUES (5, 9, 2, 'One Dozen White Roses and White Messenger Bear™', '<h2><strong>The Love and Blooms package is made up of a dozen white roses and a white Messenger Bear</strong><strong>&trade; .</strong><strong>&nbsp;</strong></h2>\r\n\n<p><br />\r\nThe white rose variety used in this arrangement is imported from Europe and grown in the most sophisticated flower farm in the Philippines.&nbsp;<br />\r\nOur 12 inch Messenger Bear&trade; is made with high quality ivory white fabric, stuffed with a very soft material, and all wrapped up in a shirt with your message of love.&nbsp;<br />\r\nThe Love and Blooms package comes in exclusive Island Rose packaging for delivery anywhere in the Philippines.</p>', 'uploads/2019-ISL-00002-5.jpg', '2019-ISL-00002-5', 'Love and Blooms', 100, 0, 50, 3379.00, 3500.00, NULL, 1, '2019-02-22 00:59:10', 1, '2019-02-22 00:59:10', '2019-02-22 00:59:10');
INSERT INTO `r_product_infos` VALUES (6, 6, 2, 'One Dozen Red Roses, Open Heart Pendant, and Belgian Chocolate Bars', '<h3><strong>The SweetHeart Blooms package is made of a dozen red roses, a sterling silver open heart pendant with necklace, and Belgian chocolate bars.&nbsp;</strong></h3>\r\n\n<p><br />\r\nThe red rose variety used in this arrangement is imported from Europe and grown in the most sophisticated flower farm in the Philippines.&nbsp;<br />\r\nThe Open Heart pendant is made of sterling silver and comes with an 18-inch chain also in sterling silver. This set will arrive in a custom jewelry box tied with a satin ribbon appropriate to the season.&nbsp;<br />\r\nThe delighful set of Belgian chocolate bars are made only with the finest ingredients from exclusive local and international suppliers.&nbsp;<br />\r\nThe SweetHeart Blooms package comes in exclusive Island Rose packaging for delivery anywhere in the Philippines.</p>\r\n\n<p>&nbsp;</p>', 'uploads/2019-ISL-00002-6.jpg', '2019-ISL-00002-6', 'SweetHeart Blooms', 100, 0, 50, 4429.00, 4500.00, NULL, 1, '2019-02-22 01:00:56', 1, '2019-02-22 01:00:56', '2019-02-22 07:34:37');
INSERT INTO `r_product_infos` VALUES (7, 6, 2, 'Five 3-Stem Rose Bouquets', '<h2><strong>The Group Hug package is made of five 3-stem bouquets in five different </strong><strong>colours</strong><strong>.&nbsp;</strong></h2>\r\n\n<p><br />\r\nThe rose varieties used in this arrangement are imported from Europe and grown in the most sophisticated flower farm in the Philippines.&nbsp;<br />\r\nThe Group Hug package comes in exclusive Island Rose packaging for delivery anywhere in the Philippines.</p>\r\n\n<p>&nbsp;</p>', 'uploads/2019-ISL-00002-7.jpg', '2019-ISL-00002-7', 'Group Hug', 100, 0, 10, 3199.00, 3500.00, NULL, 1, '2019-02-22 01:02:32', 1, '2019-02-22 01:02:32', '2019-02-22 01:02:32');
INSERT INTO `r_product_infos` VALUES (8, 6, 2, 'Classic Black Rose Gift Box and Limited Edition Rajo! Greeting Cards', '<h2><strong>The Thoughts of Love package is made of the Classic Black Rose Gift Box and a set of 10 limited </strong><strong>edition</strong><strong> Rajo! Greeting Cards.&nbsp;</strong></h2>\r\n\n<p><br />\r\nThe red and white rose varieties used in this arrangement are imported from Europe and grown in the most sophisticated flower farm in the Philippines.&nbsp;<br />\r\nThe Thoughts of Love package comes in exclusive Island Rose packaging for delivery anywhere in the Philippines.</p>', 'uploads/2019-ISL-00002-8.jpg', '2019-ISL-00002-8', 'Thoughts of Love', 100, 23, 10, 2989.00, 3000.00, NULL, 1, '2019-02-22 01:05:44', 1, '2019-02-22 01:05:44', '2019-03-01 22:28:51');
INSERT INTO `r_product_infos` VALUES (9, 5, 2, 'One Dozen Red Roses & Pralines', '<p>Flowers and chocolates when combined becomes the sweetest gift. Any one will be surprised and turned on by this special gift package composed of a bunch of farm fresh flowers and a box of classic truffles and praline chocolates. The red roses used in our this fresh bouquet are imported from Europe and grown in the most sophisticated flower farm in the Philippines. The C Collection Bruges Belgian Chocolates are made only with the finest ingredients from exclusive local and international suppliers. Every box of this chocolate goodness together with the bouquet of flowers comes in special Island Rose packaging with greeting card for personalized message, available for delivery anywhere in the Philippines.</p>', 'uploads/2019-ISL-00002-9.jpg', '2019-ISL-00002-9', 'Sweet Fantasy', 100, 0, 10, 2509.00, 3000.00, NULL, 1, '2019-02-22 01:07:48', 1, '2019-02-22 01:07:48', '2019-02-22 01:07:48');
INSERT INTO `r_product_infos` VALUES (10, 10, 2, 'Caramel Chocolate Pralines', '<p>A dozen-piece collection specifically concocted for caramel lovers, the C Collection is made up of six 64 percent dark chocolate-covered vanilla-flavored caramel and six espresso-infused 43 percent milk chocolate-covered caramel. These different flavors of chocolate caramels are meant to entice the palate at every bite.</p>\r\n\n<p>Our C Collection Bruges Belgian Chocolates are made only with the finest ingredients from exclusive local and international suppliers. Every box of this chocolate goodness comes in a special Island Rose packaging with greeting card for personalized message, available for delivery anywhere in the Philippines.</p>', 'uploads/2019-ISL-00002-10.jpg', '2019-ISL-00002-10', 'The C Collection', 100, 0, 10, 1059.00, 1500.00, NULL, 1, '2019-02-22 01:10:31', 1, '2019-02-22 01:10:31', '2019-02-22 01:10:31');
INSERT INTO `r_product_infos` VALUES (11, 11, 1, 'Teddy Bear with Customised Message', '<p>Made with finest fabric and stuffing, our 12 inch Messenger Bear&trade; features a soft light brown textile coupled with hand-embroidered messages. Ranging from the classic &quot;I Love You&quot; shirt to simple &quot;Thank You&quot; shirt, this cute and lovable stuffed toy can assist you on saying those words of endearment or any simple greetings. Choose from a list of readily available shirt messages and we&#39;ll take care of the rest.</p>\r\n\n<p>Each Messenger Bear&trade; Light Brown comes in premium Island Rose gift packaging for delivery anywhere in the Philippines.</p>', 'uploads/2019-SYM-00001-11.jpg', '2019-SYM-00001-11', 'Messenger Bear™ Light Brown', 100, 0, 10, 1069.00, 1500.00, NULL, 0, '2019-03-30 09:14:50', 1, '2019-02-22 01:29:55', '2019-03-30 09:14:50');

-- ----------------------------
-- Table structure for r_product_types
-- ----------------------------
DROP TABLE IF EXISTS `r_product_types`;
CREATE TABLE `r_product_types`  (
  `PRODT_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `PRODT_TITLE` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRODT_ICON` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `PRODT_DESC` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRODT_PARENT` int(10) UNSIGNED NULL DEFAULT NULL,
  `PRODT_DISPLAY_STATUS` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`PRODT_ID`) USING BTREE,
  INDEX `r_product_types_prodt_parent_foreign`(`PRODT_PARENT`) USING BTREE,
  CONSTRAINT `r_product_types_prodt_parent_foreign` FOREIGN KEY (`PRODT_PARENT`) REFERENCES `r_product_types` (`PRODT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_product_types
-- ----------------------------
INSERT INTO `r_product_types` VALUES (1, 'Food', NULL, 'Description', NULL, 1, '2019-02-19 05:43:43', '2019-02-19 05:43:43');
INSERT INTO `r_product_types` VALUES (2, 'Flowers', '/uploads/categories/assets_item_categories_flower.png', 'Description', NULL, 1, '2019-02-19 05:43:43', '2019-02-19 05:43:43');
INSERT INTO `r_product_types` VALUES (3, 'Chocolates', '/uploads/categories/assets_item_categories_chocolate.png', 'Description', NULL, 1, '2019-02-19 05:43:43', '2019-02-19 05:43:43');
INSERT INTO `r_product_types` VALUES (4, 'Almond Chocolate', NULL, 'Description', 3, 1, '2019-02-19 05:43:43', '2019-02-19 05:43:43');
INSERT INTO `r_product_types` VALUES (5, 'Chocolates and Flowers', NULL, 'Description', 2, 1, '2019-02-19 05:43:43', '2019-02-22 01:07:04');
INSERT INTO `r_product_types` VALUES (6, 'Flowers Bouquet', NULL, 'Description', 2, 1, '2019-02-19 05:43:43', '2019-02-19 05:43:43');
INSERT INTO `r_product_types` VALUES (7, 'Fruit Salad', NULL, 'Description', 1, 0, '2019-02-19 05:43:43', '2019-02-22 00:42:59');
INSERT INTO `r_product_types` VALUES (8, 'Stuffed toys', '/uploads/categories/assets_item_categories_plush.png', 'Stuffed toys Description', NULL, 1, '2019-02-22 00:55:29', '2019-02-22 00:55:29');
INSERT INTO `r_product_types` VALUES (9, 'Teddy Bear with Flowers', NULL, 'Teddy Bear with Flowers Description', 8, 1, '2019-02-22 00:56:24', '2019-02-22 00:56:24');
INSERT INTO `r_product_types` VALUES (10, 'Chocolate Collection', NULL, 'Chocolate Collection Description', 3, 1, '2019-02-22 01:09:15', '2019-02-22 01:09:15');
INSERT INTO `r_product_types` VALUES (11, 'Bear', NULL, 'Bear Description', 8, 1, '2019-02-22 01:27:10', '2019-02-22 01:27:10');

-- ----------------------------
-- Table structure for r_reg_ecommerce
-- ----------------------------
DROP TABLE IF EXISTS `r_reg_ecommerce`;
CREATE TABLE `r_reg_ecommerce`  (
  `REG_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `REG_ACCRE_CODE` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `REG_SERIAL_CODE` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`REG_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_report_types
-- ----------------------------
DROP TABLE IF EXISTS `r_report_types`;
CREATE TABLE `r_report_types`  (
  `rrt_reporttypeid` int(11) NOT NULL AUTO_INCREMENT,
  `rrt_reportvalue` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rrt_reporticon` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rrt_criticallevel` int(11) NOT NULL,
  `rrt_reporttypestamp` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`rrt_reporttypeid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_report_types
-- ----------------------------
INSERT INTO `r_report_types` VALUES (1, 'Abusive', 'abusive.jpg', 5, '2019-02-23 15:06:47');
INSERT INTO `r_report_types` VALUES (2, 'Suicidal', 'abusive.jpg', 5, '2019-02-26 18:30:02');

-- ----------------------------
-- Table structure for r_tax_table_profiles
-- ----------------------------
DROP TABLE IF EXISTS `r_tax_table_profiles`;
CREATE TABLE `r_tax_table_profiles`  (
  `TAXP_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `TAXP_NAME` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TAXP_DESC` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TAXP_RATE` double(10, 2) NOT NULL,
  `TAXP_TYPE` tinyint(1) NOT NULL,
  `TAXP_DISPLAY_STATUS` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`TAXP_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_tax_table_profiles
-- ----------------------------
INSERT INTO `r_tax_table_profiles` VALUES (1, 'VAT@12', 'VALUE ADDED TAX AT 12 PERCENT', 12.00, 0, 1, '2019-02-28 04:21:11', '2019-02-28 04:21:11');
INSERT INTO `r_tax_table_profiles` VALUES (2, 'VAT@ 10', 'VALUE ADDED TAX AT 10 PERCENT', 10.00, 0, 1, '2019-02-28 04:21:47', '2019-02-28 04:21:47');

-- ----------------------------
-- Table structure for t_account_feeds
-- ----------------------------
DROP TABLE IF EXISTS `t_account_feeds`;
CREATE TABLE `t_account_feeds`  (
  `tafd_postid` int(11) NOT NULL AUTO_INCREMENT,
  `tafd_postcontent` varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tafd_postimage_source` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'empty',
  `tafd_postadded` datetime(0) NOT NULL,
  `tafd_imotion` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'imotion_13_happy',
  `tafd_igetyoucount` int(11) NOT NULL DEFAULT 0,
  `tafd_giftcount` int(11) NOT NULL DEFAULT 0,
  `tafd_commentcount` int(11) NOT NULL DEFAULT 0,
  `tafd_postcreator` int(11) NOT NULL,
  `tafd_postaudience` int(11) NOT NULL,
  PRIMARY KEY (`tafd_postid`) USING BTREE,
  INDEX `tafd_postcreator`(`tafd_postcreator`) USING BTREE,
  CONSTRAINT `t_account_feeds_ibfk_1` FOREIGN KEY (`tafd_postcreator`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_account_feeds
-- ----------------------------
INSERT INTO `t_account_feeds` VALUES (3, 'This is my first time using this app, hope to find new friends here in Sympies! <3 ', '', '2018-06-20 00:00:00', 'imotion_13_happy', 17, 0, 3, 1, 1);
INSERT INTO `t_account_feeds` VALUES (4, 'This is the official Sympies Account of the Polytechnic University of the Philippines, further announcement can be fetched directly to this page. Plese visit our official facebook page at Facebook.com/PolytechnicUniversityofthePhilippines', '', '2018-06-20 00:00:00', 'imotion_28_trust', 18, 0, 19, 3, 1);
INSERT INTO `t_account_feeds` VALUES (6, 'I miss you.\r\n#alone', '', '2018-06-23 14:42:11', 'imotion_05_depressed', 0, 0, 0, 1, 1);
INSERT INTO `t_account_feeds` VALUES (49, ' Eyes: 15 Facts You Probably Didn\'t Know About Them\r\n\r\nYou’ve had your peepers since you were born, so you may think you know them pretty well, but here are some fun facts you may not know about eyes:\r\n\r\n    The average blink lasts for about 1/10th of a second.\r\n    While it takes some time for most parts of your body to warm up to their full potential, your eyes are on their “A game” 24/7.\r\n    Eyes heal quickly. With proper care, it only takes about 48 hours for the eye to repair a corneal scratch.\r\n    Seeing is such a big part of everyday life that it requires about half of the brain to get involved.\r\n    Newborns don’t produce tears. They make crying sounds, but the tears don’t start flowing until they are about 4-13 weeks old.\r\n    Around the world, about 39 million people are blind and roughly 6 times that many have some kind of vision impairment.\r\n    Doctors have yet to find a way to transplant an eyeball. The optic nerve that connects the eye to the brain is too sensitive to reconstruct successfully.\r\n    The cells in your eye come in different shapes. Rod-shaped cells allow you to see shapes, and cone-shaped cells allow you to see color.\r\n    You blink about 12 times every minute.\r\n    Your eyes are about 1 inch across and weigh about 0.25 ounce.\r\n    Some people are born with two differently colored eyes. This condition is heterochromia.\r\n    Even if no one in the past few generations of your family had blue or green eyes, these recessive traits can still appear in later generations.\r\n    Each of your eyes has a small blind spot in the back of the retina where the optic nerve attaches. You don’t notice the hole in your vision because your eyes work together to fill in each other’s blind spot.\r\n    Out of all the muscles in your body, the muscles that control your eyes are the most active.\r\n    80% of vision problems worldwide are avoidable or even curable.\r\n', 'uploads.jpg', '2019-01-04 21:53:52', 'imotion_13_happy', 0, 0, 0, 2, 1);

-- ----------------------------
-- Table structure for t_account_friends
-- ----------------------------
DROP TABLE IF EXISTS `t_account_friends`;
CREATE TABLE `t_account_friends`  (
  `tafr_makefriendtranscationid` int(11) NOT NULL AUTO_INCREMENT,
  `tafr_userprofileid` int(11) NOT NULL,
  `tafr_friendlyuserid` int(11) NOT NULL,
  `tafr_dateaccompanied` datetime(0) NOT NULL,
  `tafr_isfollowed` int(11) NOT NULL DEFAULT 1,
  `tafd_isaccepted` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tafr_makefriendtranscationid`) USING BTREE,
  INDEX `taf_userprofileid`(`tafr_userprofileid`) USING BTREE,
  INDEX `taf_friendlyuserid`(`tafr_friendlyuserid`) USING BTREE,
  CONSTRAINT `t_account_friends_ibfk_1` FOREIGN KEY (`tafr_userprofileid`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_account_friends_ibfk_2` FOREIGN KEY (`tafr_friendlyuserid`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_account_friends
-- ----------------------------
INSERT INTO `t_account_friends` VALUES (5, 1, 4, '2018-11-22 00:00:00', 1, 0);
INSERT INTO `t_account_friends` VALUES (14, 1, 3, '2019-04-01 00:00:00', 1, 0);

-- ----------------------------
-- Table structure for t_ai_brainrank
-- ----------------------------
DROP TABLE IF EXISTS `t_ai_brainrank`;
CREATE TABLE `t_ai_brainrank`  (
  `tab_airelationid` int(11) NOT NULL AUTO_INCREMENT,
  `tab_imotionidtorel` int(11) NOT NULL,
  `tab_value` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tab_dateadded` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tab_airelationid`) USING BTREE,
  INDEX `tab_imotionidtorel`(`tab_imotionidtorel`) USING BTREE,
  CONSTRAINT `t_ai_brainrank_ibfk_1` FOREIGN KEY (`tab_imotionidtorel`) REFERENCES `r_imotions_details` (`rid_imotionid`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_ai_brainrank
-- ----------------------------
INSERT INTO `t_ai_brainrank` VALUES (1, 1, 'annoyed\r\nbitter\r\nenraged\r\nexasperated\r\nfurious\r\nasdfgh\r\ncellphone', '2018-10-29 15:10:23');
INSERT INTO `t_ai_brainrank` VALUES (2, 2, 'afraid\r\napprehensive\r\ncareful\r\nconcerned\r\ndistressed', '2018-10-29 15:15:01');
INSERT INTO `t_ai_brainrank` VALUES (3, 3, 'oppress\r\npersecute\r\nterrorize\r\nthreaten\r\ntorment', '2018-10-29 15:15:01');
INSERT INTO `t_ai_brainrank` VALUES (4, 4, 'baffled\r\nbefuddled\r\nbewildered\r\ndazed\r\ndisorganized', '2018-10-29 15:15:01');
INSERT INTO `t_ai_brainrank` VALUES (5, 5, 'despondent\r\nmorose\r\npessimistic\r\nsad\r\nunhappy', '2018-10-29 15:15:01');
INSERT INTO `t_ai_brainrank` VALUES (6, 6, 'decisive\r\ndogged\r\npurposeful\r\nresolute\r\nresolved', '2018-10-29 15:15:01');
INSERT INTO `t_ai_brainrank` VALUES (7, 7, 'appalled\r\noutraged\r\nqueasy\r\ntired\r\nunhappy', '2018-10-29 15:15:01');
INSERT INTO `t_ai_brainrank` VALUES (8, 8, 'affectionate\r\nardent\r\nconscientious\r\ndependable\r\ndevoted', '2018-10-29 15:15:01');
INSERT INTO `t_ai_brainrank` VALUES (9, 9, 'only\r\nunattended\r\nsolo\r\nunaccompanied\r\nabandoned', '2018-10-29 15:15:01');
INSERT INTO `t_ai_brainrank` VALUES (10, 10, 'confined\r\ndebilitated\r\ndeclining\r\ndisordered\r\nill', '2018-10-29 15:15:01');
INSERT INTO `t_ai_brainrank` VALUES (26, 11, 'beholden\r\nindebted\r\npleased\r\nthankful\r\ngratified', '2018-10-29 15:23:47');
INSERT INTO `t_ai_brainrank` VALUES (27, 12, 'ache\r\ncry\r\nlament\r\nregret\r\nwail\r\nweep', '2018-10-29 15:23:59');
INSERT INTO `t_ai_brainrank` VALUES (28, 13, 'cheerful\r\ncontented\r\ndelighted\r\necstatic\r\nelated', '2018-10-29 15:24:09');
INSERT INTO `t_ai_brainrank` VALUES (29, 14, 'grief-stricken\r\nsad\r\nsorrowful\r\ndoleful\r\nheartsick', '2018-10-29 15:24:18');
INSERT INTO `t_ai_brainrank` VALUES (30, 15, 'buoyant\r\ncheerful\r\ncomfortable\r\nconfident\r\neager', '2018-10-29 15:24:28');
INSERT INTO `t_ai_brainrank` VALUES (31, 16, 'affection\r\nappreciation\r\ndevotion\r\nemotion\r\nfondness', '2018-10-29 15:24:37');
INSERT INTO `t_ai_brainrank` VALUES (32, 17, 'anxious\r\napprehensive\r\nattentive\r\nenvious\r\nintolerant', '2018-10-29 15:24:47');
INSERT INTO `t_ai_brainrank` VALUES (33, 19, 'wedding\r\nmatrimony\r\nespousal\r\nwedlock\r\ncoupling', '2018-10-29 15:24:57');
INSERT INTO `t_ai_brainrank` VALUES (34, 20, 'ma\r\nmama\r\nmommy\r\nmum\r\nmumsy', '2018-10-29 15:25:06');
INSERT INTO `t_ai_brainrank` VALUES (35, 21, 'cross\r\ndowncast\r\nmelancholy\r\nsulky\r\nangry', '2018-10-29 15:25:20');
INSERT INTO `t_ai_brainrank` VALUES (36, 22, 'advance\r\ncontinue\r\nkeep going\r\nproceed\r\ndash', '2018-10-29 15:25:28');
INSERT INTO `t_ai_brainrank` VALUES (37, 23, 'craving\r\ndependence\r\nenslavement\r\nfixation\r\nobsession', '2018-10-29 15:25:36');
INSERT INTO `t_ai_brainrank` VALUES (38, 24, 'craving\r\ndependence\r\nenslavement\r\nfixation\r\nobsession', '2018-10-29 15:25:43');
INSERT INTO `t_ai_brainrank` VALUES (39, 25, 'strain\r\nstretch\r\ntense\r\ntraumatize\r\nworry', '2018-10-29 15:25:51');
INSERT INTO `t_ai_brainrank` VALUES (40, 26, 'indication\r\nnotion\r\nsuspicion\r\nthought\r\nallusion', '2018-10-29 15:25:58');
INSERT INTO `t_ai_brainrank` VALUES (41, 27, 'amaze\r\nastound\r\nawe\r\nbewilder\r\nconfound', '2018-10-29 15:26:08');
INSERT INTO `t_ai_brainrank` VALUES (42, 28, 'confidence\r\nexpectation\r\nfaith\r\nhope\r\nassurance', '2018-10-29 15:26:17');

-- ----------------------------
-- Table structure for t_chat_rooms
-- ----------------------------
DROP TABLE IF EXISTS `t_chat_rooms`;
CREATE TABLE `t_chat_rooms`  (
  `tcr_chatroomid` int(11) NOT NULL AUTO_INCREMENT,
  `tcr_chatroomname` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tcr_dateadded` datetime(0) NULL DEFAULT NULL,
  `tcr_creator` int(11) NOT NULL,
  `tcr_pairtowho` int(11) NOT NULL,
  `tcr_roomtype` int(11) NOT NULL,
  PRIMARY KEY (`tcr_chatroomid`) USING BTREE,
  INDEX `tcr_creator`(`tcr_creator`) USING BTREE,
  INDEX `tcr_pairtowho`(`tcr_pairtowho`) USING BTREE,
  INDEX `tcr_roomtype`(`tcr_roomtype`) USING BTREE,
  CONSTRAINT `t_chat_rooms_ibfk_1` FOREIGN KEY (`tcr_creator`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_chat_rooms_ibfk_2` FOREIGN KEY (`tcr_pairtowho`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_chat_rooms_ibfk_3` FOREIGN KEY (`tcr_roomtype`) REFERENCES `t_chat_rooms_type` (`tcrt_roomtypeid`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_chat_rooms
-- ----------------------------
INSERT INTO `t_chat_rooms` VALUES (1, 'Private Room ', '2018-10-30 22:09:54', 1, 2, 1);
INSERT INTO `t_chat_rooms` VALUES (2, 'Private Chat', '2018-10-31 20:36:23', 3, 1, 1);
INSERT INTO `t_chat_rooms` VALUES (3, 'Private with Sympies', '2018-11-02 14:54:37', 1, 4, 1);

-- ----------------------------
-- Table structure for t_chat_rooms_messages
-- ----------------------------
DROP TABLE IF EXISTS `t_chat_rooms_messages`;
CREATE TABLE `t_chat_rooms_messages`  (
  `tcrm_messageid` int(11) NOT NULL AUTO_INCREMENT,
  `tcrm_chatroomid` int(11) NOT NULL,
  `tcrm_messagecontent` varchar(10000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tcrm_messagetimestamp` datetime(0) NULL DEFAULT NULL,
  `tcrm_messenger` int(11) NOT NULL,
  `tcrm_reciver` int(11) NOT NULL,
  `tcrm_isarchived` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tcrm_messageid`) USING BTREE,
  INDEX `tcrm_chatroomid`(`tcrm_chatroomid`) USING BTREE,
  INDEX `tcrm_messenger`(`tcrm_messenger`) USING BTREE,
  INDEX `tcrm_reciver`(`tcrm_reciver`) USING BTREE,
  CONSTRAINT `t_chat_rooms_messages_ibfk_1` FOREIGN KEY (`tcrm_chatroomid`) REFERENCES `t_chat_rooms` (`tcr_chatroomid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_chat_rooms_messages_ibfk_2` FOREIGN KEY (`tcrm_messenger`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_chat_rooms_messages_ibfk_3` FOREIGN KEY (`tcrm_reciver`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_chat_rooms_messages
-- ----------------------------
INSERT INTO `t_chat_rooms_messages` VALUES (17, 3, 'oyyyyyy', '2018-11-03 12:32:02', 1, 4, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (18, 3, 'test', '2018-11-03 13:14:57', 1, 4, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (20, 3, 'asdkjahskdlsa', '2018-11-05 13:51:52', 1, 4, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (21, 3, 'asdkjahskdlsa', '2018-11-05 13:51:56', 1, 4, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (22, 2, 'heloooo', '2018-11-05 14:07:18', 1, 3, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (23, 2, 'hoy', '2018-11-09 16:25:39', 1, 3, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (24, 2, 'raa', '2018-11-14 18:23:48', 1, 3, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (27, 2, 'hello', '2018-11-21 16:18:49', 1, 3, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (28, 2, 'anneyong', '2018-11-22 17:30:55', 1, 3, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (29, 3, 'hehe', '2018-11-22 17:31:05', 1, 4, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (30, 3, 'psst miss nakita', '2018-11-27 21:13:30', 1, 4, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (31, 3, 'asda', '2018-11-27 21:14:22', 4, 1, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (32, 2, 'hola', '2019-01-03 18:04:36', 1, 3, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (33, 2, 'howdy', '2019-01-03 18:05:18', 1, 3, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (34, 2, 'marga is here', '2019-01-03 18:05:51', 1, 3, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (35, 2, 'Hello from server!', '2019-01-03 18:06:10', 3, 1, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (36, 1, 'Hello!', '2019-01-09 19:33:14', 1, 2, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (37, 1, 'Hello zheus!', '2019-01-09 19:34:54', 2, 1, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (38, 1, 'Hello!', '2019-01-09 19:48:15', 1, 2, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (39, 1, 'ggb', '2019-01-10 15:47:53', 1, 2, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (40, 1, 'ggb', '2019-01-10 15:47:59', 1, 2, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (41, 1, 'Hello from server -keith', '2019-01-10 15:48:30', 2, 1, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (42, 1, 'sol are u there?', '2019-01-10 17:30:22', 1, 2, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (43, 1, 'Im at the moon! ', '2019-01-10 17:30:29', 2, 1, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (44, 1, 'bdhdjdjfk', '2019-03-05 15:52:12', 1, 2, 0);
INSERT INTO `t_chat_rooms_messages` VALUES (45, 1, 'bdhdjdjfk', '2019-03-05 15:52:13', 1, 2, 0);

-- ----------------------------
-- Table structure for t_chat_rooms_type
-- ----------------------------
DROP TABLE IF EXISTS `t_chat_rooms_type`;
CREATE TABLE `t_chat_rooms_type`  (
  `tcrt_roomtypeid` int(11) NOT NULL AUTO_INCREMENT,
  `tcrt_roomtypevalue` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tcrt_dateadded` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tcrt_roomtypeid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_chat_rooms_type
-- ----------------------------
INSERT INTO `t_chat_rooms_type` VALUES (1, 'Private', '2018-10-30 22:09:27');

-- ----------------------------
-- Table structure for t_invoices
-- ----------------------------
DROP TABLE IF EXISTS `t_invoices`;
CREATE TABLE `t_invoices`  (
  `INV_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ORD_ID` int(10) UNSIGNED NOT NULL,
  `INV_NO` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `INV_STATUS` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `INV_DETAILS` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`INV_ID`) USING BTREE,
  INDEX `t_invoices_ord_id_foreign`(`ORD_ID`) USING BTREE,
  CONSTRAINT `t_invoices_ord_id_foreign` FOREIGN KEY (`ORD_ID`) REFERENCES `t_orders` (`ORD_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_invoices
-- ----------------------------
INSERT INTO `t_invoices` VALUES (5, 10, 'SYMPIES-5c755f5cdeacb', 'completed', 'Thank you for purchasing on SympiesShop', '2019-02-26 16:07:46', '2019-02-26 16:07:46');
INSERT INTO `t_invoices` VALUES (7, 12, 'SYMPIES-5c75792628d22', 'pending', 'Thank you for purchasing on SympiesShop', '2019-02-26 17:37:47', '2019-02-26 17:37:47');
INSERT INTO `t_invoices` VALUES (8, 13, 'SYMPIES-5c7579a94dc94', 'pending', 'Thank you for purchasing on SympiesShop', '2019-02-26 17:39:37', '2019-02-26 17:39:37');
INSERT INTO `t_invoices` VALUES (9, 14, 'SYMPIES-5c796d2c4d3b0', 'pending', 'Thank you for purchasing on SympiesShop', '2019-03-01 17:39:49', '2019-03-01 17:39:49');
INSERT INTO `t_invoices` VALUES (10, 15, 'SYMPIES-5c79b24586af7', 'pending', 'Thank you for purchasing on SympiesShop', '2019-03-01 22:30:12', '2019-03-01 22:30:12');
INSERT INTO `t_invoices` VALUES (11, 16, 'SYMPIES-5c802f7668a5a', 'pending', 'Thank you for purchasing on SympiesShop', '2019-03-06 20:38:15', '2019-03-06 20:38:15');
INSERT INTO `t_invoices` VALUES (12, 17, 'SYMPIES-5c80347f1c1bf', 'pending', 'Thank you for purchasing on SympiesShop', '2019-03-06 20:59:15', '2019-03-06 20:59:15');
INSERT INTO `t_invoices` VALUES (13, 18, 'SYMPIES-5c9f056897115', 'pending', 'Thank you for purchasing on SympiesShop', '2019-03-30 05:59:49', '2019-03-30 05:59:49');
INSERT INTO `t_invoices` VALUES (14, 19, 'SYMPIES-5c9f54e494815', 'pending', 'Thank you for purchasing on SympiesShop', '2019-03-30 11:38:03', '2019-03-30 11:38:03');
INSERT INTO `t_invoices` VALUES (15, 20, 'SYMPIES-5ca41d9082e1f', 'pending', 'Thank you for purchasing on SympiesShop', '2019-04-03 02:43:41', '2019-04-03 02:43:41');

-- ----------------------------
-- Table structure for t_order_items
-- ----------------------------
DROP TABLE IF EXISTS `t_order_items`;
CREATE TABLE `t_order_items`  (
  `ORDI_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ORD_ID` int(10) UNSIGNED NOT NULL,
  `PROD_ID` int(10) UNSIGNED NOT NULL,
  `PRODV_ID` int(10) UNSIGNED NULL DEFAULT NULL,
  `ORDI_QTY` int(11) NOT NULL DEFAULT 1,
  `ORDI_NOTE` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `PROD_NAME` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PROD_DESC` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PROD_MY_PRICE` double(10, 2) NOT NULL,
  `PROD_SKU` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ORDI_SOLD_PRICE` double(10, 2) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ORDI_ID`) USING BTREE,
  INDEX `t_order_items_ord_id_foreign`(`ORD_ID`) USING BTREE,
  INDEX `t_order_items_prod_id_foreign`(`PROD_ID`) USING BTREE,
  INDEX `t_order_items_prodv_id_foreign`(`PRODV_ID`) USING BTREE,
  CONSTRAINT `t_order_items_ord_id_foreign` FOREIGN KEY (`ORD_ID`) REFERENCES `t_orders` (`ORD_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `t_order_items_prod_id_foreign` FOREIGN KEY (`PROD_ID`) REFERENCES `r_product_infos` (`PROD_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `t_order_items_prodv_id_foreign` FOREIGN KEY (`PRODV_ID`) REFERENCES `t_product_variances` (`PRODV_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_order_items
-- ----------------------------
INSERT INTO `t_order_items` VALUES (7, 10, 1, NULL, 2, 'Sample Note', 'Be My Valentine!', 'One Dozen White Roses + Three Red Roses', 2100.00, '2019-ISL-00002-1', 4724.00, '2019-02-26 16:07:46', '2019-02-26 16:07:46');
INSERT INTO `t_order_items` VALUES (9, 12, 1, NULL, 1, 'Item note', 'Be My Valentine!', 'One Dozen White Roses + Three Red Roses', 2100.00, '2019-ISL-00002-1', 2372.00, '2019-02-26 17:37:47', '2019-02-26 17:37:47');
INSERT INTO `t_order_items` VALUES (10, 13, 5, NULL, 2, NULL, 'Love and Blooms!', 'One Dozen White Roses and White Messenger Bear™', 3500.00, '2019-ISL-00002-5', 7860.00, '2019-02-26 17:39:37', '2019-02-26 17:39:37');
INSERT INTO `t_order_items` VALUES (11, 14, 11, 7, 2, NULL, 'Dark Bear', 'Dark Bear', 1510.00, '2019-SYM-00001-11-DARvnv', 3342.00, '2019-03-01 17:39:49', '2019-03-01 17:39:49');
INSERT INTO `t_order_items` VALUES (12, 15, 8, NULL, 5, 'thankyou patrick', 'Thoughts of Love', 'Classic Black Rose Gift Box and Limited Edition Rajo! Greeting Cards', 3000.00, '2019-ISL-00002-8', 12725.00, '2019-03-01 22:30:10', '2019-03-01 22:30:10');
INSERT INTO `t_order_items` VALUES (13, 16, 6, NULL, 3, 'thankyou', 'SweetHeart Blooms', 'One Dozen Red Roses, Open Heart Pendant, and Belgian Chocolate Bars', 4500.00, '2019-ISL-00002-6', 14870.00, '2019-03-06 20:38:15', '2019-03-06 20:38:15');
INSERT INTO `t_order_items` VALUES (14, 17, 11, NULL, 2, 'note', 'Messenger Bear™ Light Brown', 'Teddy Bear with Customised Message', 1500.00, '2019-SYM-00001-11', 3320.00, '2019-03-06 20:59:15', '2019-03-06 20:59:15');
INSERT INTO `t_order_items` VALUES (15, 18, 10, NULL, 2, NULL, 'The C Collection', 'Caramel Chocolate Pralines', 1500.00, '2019-ISL-00002-10', 3320.00, '2019-03-30 05:59:49', '2019-03-30 05:59:49');
INSERT INTO `t_order_items` VALUES (16, 19, 4, NULL, 2, 'asd', 'Orange Candy Rose', 'White & Orange Roses In An Orange Keepsake Box', 1200.00, '2019-SYM-00001-4', 2660.00, '2019-03-30 11:38:03', '2019-03-30 11:38:03');
INSERT INTO `t_order_items` VALUES (17, 20, 3, NULL, 3, 'pashwords', 'Forever', 'One Dozen Red Roses, Teddy Bear, Pralines', 1200.00, '2019-SYM-00001-3', 3980.00, '2019-04-03 02:43:41', '2019-04-03 02:43:41');

-- ----------------------------
-- Table structure for t_orders
-- ----------------------------
DROP TABLE IF EXISTS `t_orders`;
CREATE TABLE `t_orders`  (
  `ORD_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `SYMPIES_ID` int(10) UNSIGNED NULL DEFAULT NULL,
  `ORD_SYMP_TRANS_CODE` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ORD_TRANS_CODE` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ORD_PAY_CODE` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ORD_FROM_NAME` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ORD_TO_NAME` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ORD_FROM_EMAIL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ORD_TO_EMAIL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ORD_FROM_CONTACT` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ORD_TO_CONTACT` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ORD_TO_ADDRESS` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ORD_FUNDING` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ORD_DISCOUNT` double(10, 2) NOT NULL DEFAULT 0.00,
  `ORD_STATUS` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `ORD _VOUCHER_CODE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ORD_COMPLETE` datetime(0) NULL DEFAULT NULL,
  `ORD_CANCELLED` datetime(0) NULL DEFAULT NULL,
  `ORD_DISPLAY_STATUS` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ORD_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_orders
-- ----------------------------
INSERT INTO `t_orders` VALUES (10, 1, 'TRANSACT-5c756452bec49', '3UD59089U58880420', 'PAYID-LR2V6YQ80B32453YA940542W', 'John Patrick Loyola', 'test buyer', 'loyolapat04@gmail.com', 'loyolapat04-receiver@gmail.com', '0930975810', '09309758130', '1 Main St, San Jose, CA, 95131, US', 'paypal', 0.00, 'Void', NULL, NULL, NULL, 1, '2019-02-26 16:07:46', '2019-03-01 17:31:35');
INSERT INTO `t_orders` VALUES (12, 1, 'TRANSACT-5c75796b032ed', '55K385062E569073X', 'PAYID-LR2XSMI9MV63889PW0743335', 'John Patrick Loyola', 'test buyer', 'loyolapat04@gmail.com', 'loyolapat04-receiver@gmail.com', '0930975810', '09309758130', '1 Main St, San Jose, CA, 95131, US', 'paypal', 0.00, 'Completed', NULL, '2019-03-01 17:54:10', NULL, 1, '2019-02-26 17:37:47', '2019-03-01 17:54:10');
INSERT INTO `t_orders` VALUES (13, 1, 'TRANSACT-5c7579d964645', '4XN012416T179471L', 'PAYID-LR2XTLI57H54523PK008550L', 'John Patrick Loyola', 'test buyer', 'loyolapat04@gmail.com', 'loyolapat04-receiver@gmail.com', '0930975810', '09309758130', '1 Main St, San Jose, CA, 95131, US', 'paypal', 0.00, 'Completed', NULL, '2019-03-30 11:31:51', NULL, 1, '2019-02-26 17:39:37', '2019-03-30 11:31:51');
INSERT INTO `t_orders` VALUES (14, 1, 'TRANSACT-5c796e64de2b2', '7H780468JM429191A', 'PAYID-LR4W2MQ9SL5516285543825X', 'John Patrick Loyola', 'test buyer', 'loyolapat04@gmail.com', 'loyolapat04@gmail.com', '0930975810', '093097581', '1 Main St, San Jose, CA, 95131, US', 'paypal', 0.00, 'Completed', NULL, '2019-03-30 11:31:51', NULL, 1, '2019-03-01 17:39:48', '2019-03-30 11:31:51');
INSERT INTO `t_orders` VALUES (15, 1, 'TRANSACT-5c79b272b4fde', '6UY21322HS082791K', 'PAYID-LR43ESQ9JE47693RB1450345', 'John Patrick Loyola', 'test buyer', 'loyolapat04@gmail.com', 'loyolapat04@gmail.com', '0930975810', '09309758130', '1 Main St, San Jose, CA, 95131, US', 'paypal', 23.00, 'Completed', NULL, '2019-03-01 22:32:26', NULL, 1, '2019-03-01 22:30:10', '2019-03-01 22:32:26');
INSERT INTO `t_orders` VALUES (16, 1, 'TRANSACT-5c802fb77b383', '0YA26007YR2908825', 'PAYID-LSAC66Y1UG91707K63414511', 'John Patrick Loyola', 'test buyer', 'loyolapat04@gmail.com', 'loyolapat04@gmail.com', '09995251071', '09995251071', '1 Main St, San Jose, CA, 95131, US', 'paypal', 0.00, 'Completed', NULL, '2019-03-06 21:29:54', NULL, 1, '2019-03-06 20:38:15', '2019-03-06 21:29:54');
INSERT INTO `t_orders` VALUES (17, 1, 'TRANSACT-5c8034a2ec906', '27C5424636244251N', 'PAYID-LSADJAI12M41505S9593582B', 'John Patrick Loyola', 'test buyer', 'loyolapat04@gmail.com', 'loyolapat04@gmail.com', '09995251071', '09995251071', '1 Main St, San Jose, CA, 95131, US', 'paypal', 0.00, 'Completed', NULL, '2019-03-06 21:30:34', NULL, 1, '2019-03-06 20:59:14', '2019-03-06 21:30:34');
INSERT INTO `t_orders` VALUES (18, 1, 'TRANSACT-5c9f05d58f4a9', '30376297164644615', 'PAYID-LSPQK2Y3D5516286L367061W', 'zheuswalker', 'test buyer', 'thndrwrth@gmail.com', 'loyolapat04@gmail.com', '0950061784', '0999999999', '1 Main St, San Jose, CA, 95131, US', 'paypal', 0.00, 'Completed', NULL, '2019-03-30 11:31:51', NULL, 1, '2019-03-30 05:59:49', '2019-03-30 11:31:51');
INSERT INTO `t_orders` VALUES (19, 1, 'TRANSACT-5c9f551b3560c', '7ES59882HU360631Y', 'PAYID-LSPVJ2Q03F02666TS874343D', 'zheuswalker', 'test buyer', 'thndrwrth@gmail.com', 'loyolapat04@gmail.com', '0950061784', '0901923', '1 Main St, San Jose, CA, 95131, US', 'paypal', 0.00, 'Completed', NULL, '2019-03-30 11:38:59', NULL, 1, '2019-03-30 11:38:03', '2019-03-30 11:38:59');
INSERT INTO `t_orders` VALUES (20, 1, 'TRANSACT-5ca41ddd12083', '8FB559728A425324E', 'PAYID-LSSB3FQ8XT11009C5761014A', 'zheuswalker', 'test buyer', 'thndrwrth@gmail.com', 'loyolapat04@gmail.com', '0950061784', 'password', '1 Main St, San Jose, CA, 95131, US', 'paypal', 0.00, 'pending', NULL, NULL, NULL, 1, '2019-04-03 02:43:41', '2019-04-03 02:43:41');

-- ----------------------------
-- Table structure for t_payments
-- ----------------------------
DROP TABLE IF EXISTS `t_payments`;
CREATE TABLE `t_payments`  (
  `PAY_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `INV_ID` int(10) UNSIGNED NOT NULL,
  `PAY_RECIEVED_BY` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PAY_AMOUNT_DUE` double(10, 2) NOT NULL,
  `PAY_SUB_TOTAL` double(10, 2) NOT NULL,
  `PAY_SALES_TAX` double(10, 2) NOT NULL,
  `PAY_DELIVERY_CHARGE` double(10, 2) NOT NULL,
  `PAY_CAPTURED_AT` datetime(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`PAY_ID`) USING BTREE,
  INDEX `t_payments_inv_id_foreign`(`INV_ID`) USING BTREE,
  CONSTRAINT `t_payments_inv_id_foreign` FOREIGN KEY (`INV_ID`) REFERENCES `t_invoices` (`INV_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_payments
-- ----------------------------
INSERT INTO `t_payments` VALUES (4, 5, 'SympiesShop', 4640.00, 4200.00, 420.00, 20.00, '2019-02-26 16:07:46', '2019-02-26 16:07:46', '2019-02-26 16:07:46');
INSERT INTO `t_payments` VALUES (6, 7, 'SympiesShop', 2330.00, 2100.00, 210.00, 20.00, '2019-02-26 17:37:47', '2019-02-26 17:37:47', '2019-02-26 17:37:47');
INSERT INTO `t_payments` VALUES (7, 8, 'SympiesShop', 7720.00, 7000.00, 700.00, 20.00, '2019-02-26 17:39:37', '2019-02-26 17:39:37', '2019-02-26 17:39:37');
INSERT INTO `t_payments` VALUES (8, 9, 'SympiesShop', 3342.00, 3020.00, 302.00, 20.00, '2019-03-30 20:32:17', '2019-03-01 17:39:49', '2019-03-01 17:39:49');
INSERT INTO `t_payments` VALUES (9, 10, 'SympiesShop', 12725.00, 11550.00, 1155.00, 20.00, '2019-03-31 20:32:17', '2019-03-01 22:30:13', '2019-03-01 22:30:13');
INSERT INTO `t_payments` VALUES (10, 11, 'SympiesShop', 14870.00, 13500.00, 1350.00, 20.00, '2019-03-31 20:32:17', '2019-03-06 20:38:16', '2019-03-06 20:38:16');
INSERT INTO `t_payments` VALUES (11, 12, 'SympiesShop', 3320.00, 3000.00, 300.00, 20.00, '2019-03-31 20:32:17', '2019-03-06 20:59:15', '2019-03-06 20:59:15');
INSERT INTO `t_payments` VALUES (12, 13, 'SympiesShop', 3320.00, 3000.00, 300.00, 20.00, '2019-04-01 20:32:17', '2019-03-30 05:59:49', '2019-03-30 05:59:49');
INSERT INTO `t_payments` VALUES (13, 14, 'SympiesShop', 2660.00, 2400.00, 240.00, 20.00, '2019-04-02 20:32:17', '2019-03-30 11:38:03', '2019-03-30 11:38:03');
INSERT INTO `t_payments` VALUES (14, 15, 'SympiesShop', 3980.00, 3600.00, 360.00, 20.00, NULL, '2019-04-03 02:43:41', '2019-04-03 02:43:41');

-- ----------------------------
-- Table structure for t_product_variances
-- ----------------------------
DROP TABLE IF EXISTS `t_product_variances`;
CREATE TABLE `t_product_variances`  (
  `PRODV_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `PROD_ID` int(10) UNSIGNED NOT NULL,
  `PRODV_NAME` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRODV_SKU` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRODV_DESC` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRODV_INIT_QTY` int(11) NOT NULL,
  `PRODV_ADD_PRICE` double(10, 2) NOT NULL DEFAULT 0.00,
  `PRODV_IMG` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`PRODV_ID`) USING BTREE,
  INDEX `t_product_variances_prod_id_foreign`(`PROD_ID`) USING BTREE,
  CONSTRAINT `t_product_variances_prod_id_foreign` FOREIGN KEY (`PROD_ID`) REFERENCES `r_product_infos` (`PROD_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_product_variances
-- ----------------------------
INSERT INTO `t_product_variances` VALUES (6, 1, 'Red Flowers', '2019-ISL-00002-1-REDzis', 'Red Flowers', 20, 29.00, 'uploads/2019-ISL-00002-1-REDzis.jpg', '2019-02-21 05:07:03', '2019-02-21 05:07:03');
INSERT INTO `t_product_variances` VALUES (7, 11, 'Dark Bear', '2019-SYM-00001-11-DARvnv', 'Dark Bear', 10, 10.00, 'uploads/2019-SYM-00001-11-DARvnv.jpg', '2019-02-22 01:31:07', '2019-02-22 04:04:36');

-- ----------------------------
-- Table structure for t_report_queries
-- ----------------------------
DROP TABLE IF EXISTS `t_report_queries`;
CREATE TABLE `t_report_queries`  (
  `trq_queryid` int(11) NOT NULL AUTO_INCREMENT,
  `trq_sender` int(11) NOT NULL,
  `trq_reportedpost` int(11) NOT NULL,
  `trq_reporttype` int(11) NOT NULL,
  `trq_reportstamp` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`trq_queryid`) USING BTREE,
  INDEX `trq_sender`(`trq_sender`) USING BTREE,
  INDEX `trq_reportedpost`(`trq_reportedpost`) USING BTREE,
  INDEX `trq_reporttype`(`trq_reporttype`) USING BTREE,
  CONSTRAINT `t_report_queries_ibfk_1` FOREIGN KEY (`trq_sender`) REFERENCES `r_account_credentials` (`rac_accountid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_report_queries_ibfk_2` FOREIGN KEY (`trq_reportedpost`) REFERENCES `t_account_feeds` (`tafd_postid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_report_queries_ibfk_3` FOREIGN KEY (`trq_reporttype`) REFERENCES `r_report_types` (`rrt_reporttypeid`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_setups
-- ----------------------------
DROP TABLE IF EXISTS `t_setups`;
CREATE TABLE `t_setups`  (
  `SET_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CURR_ID` int(10) UNSIGNED NOT NULL,
  `SET_DEL_CHARGE` double(10, 2) NOT NULL,
  `SET_SERVICE_FEE` double(10, 2) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`SET_ID`) USING BTREE,
  INDEX `t_setups_curr_id_foreign`(`CURR_ID`) USING BTREE,
  CONSTRAINT `t_setups_curr_id_foreign` FOREIGN KEY (`CURR_ID`) REFERENCES `r_currencies` (`CURR_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_setups
-- ----------------------------
INSERT INTO `t_setups` VALUES (1, 1, 30.00, 20.00, '2019-02-22 10:09:29', NULL);
INSERT INTO `t_setups` VALUES (2, 1, 20.00, 100.00, '2019-02-22 10:19:44', NULL);

-- ----------------------------
-- Table structure for t_shipment_orderitems
-- ----------------------------
DROP TABLE IF EXISTS `t_shipment_orderitems`;
CREATE TABLE `t_shipment_orderitems`  (
  `SHIPORDI_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `SHIP_ID` int(10) UNSIGNED NOT NULL,
  `ORDI_ID` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`SHIPORDI_ID`) USING BTREE,
  INDEX `t_shipment_orderitems_ship_id_foreign`(`SHIP_ID`) USING BTREE,
  INDEX `t_shipment_orderitems_ordi_id_foreign`(`ORDI_ID`) USING BTREE,
  CONSTRAINT `t_shipment_orderitems_ordi_id_foreign` FOREIGN KEY (`ORDI_ID`) REFERENCES `t_order_items` (`ORDI_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `t_shipment_orderitems_ship_id_foreign` FOREIGN KEY (`SHIP_ID`) REFERENCES `t_shipments` (`SHIP_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_shipment_orderitems
-- ----------------------------
INSERT INTO `t_shipment_orderitems` VALUES (1, 4, 7, '2019-02-26 16:07:46', '2019-02-26 16:07:46');
INSERT INTO `t_shipment_orderitems` VALUES (3, 6, 9, '2019-02-26 17:37:47', '2019-02-26 17:37:47');
INSERT INTO `t_shipment_orderitems` VALUES (4, 7, 10, '2019-02-26 17:39:37', '2019-02-26 17:39:37');
INSERT INTO `t_shipment_orderitems` VALUES (5, 8, 11, '2019-03-01 17:39:50', '2019-03-01 17:39:50');
INSERT INTO `t_shipment_orderitems` VALUES (6, 9, 12, '2019-03-01 22:30:14', '2019-03-01 22:30:14');
INSERT INTO `t_shipment_orderitems` VALUES (7, 10, 13, '2019-03-06 20:38:16', '2019-03-06 20:38:16');
INSERT INTO `t_shipment_orderitems` VALUES (8, 11, 14, '2019-03-06 20:59:15', '2019-03-06 20:59:15');
INSERT INTO `t_shipment_orderitems` VALUES (9, 12, 15, '2019-03-30 05:59:50', '2019-03-30 05:59:50');
INSERT INTO `t_shipment_orderitems` VALUES (10, 13, 16, '2019-03-30 11:38:04', '2019-03-30 11:38:04');
INSERT INTO `t_shipment_orderitems` VALUES (11, 14, 17, '2019-04-03 02:43:41', '2019-04-03 02:43:41');

-- ----------------------------
-- Table structure for t_shipments
-- ----------------------------
DROP TABLE IF EXISTS `t_shipments`;
CREATE TABLE `t_shipments`  (
  `SHIP_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ORD_ID` int(10) UNSIGNED NOT NULL,
  `INV_ID` int(10) UNSIGNED NOT NULL,
  `SHIP_TRACKING_NO` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SHIP_STATUS` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `SHIP_DESC` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`SHIP_ID`) USING BTREE,
  INDEX `t_shipments_ord_id_foreign`(`ORD_ID`) USING BTREE,
  INDEX `t_shipments_inv_id_foreign`(`INV_ID`) USING BTREE,
  CONSTRAINT `t_shipments_inv_id_foreign` FOREIGN KEY (`INV_ID`) REFERENCES `t_invoices` (`INV_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `t_shipments_ord_id_foreign` FOREIGN KEY (`ORD_ID`) REFERENCES `t_orders` (`ORD_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_shipments
-- ----------------------------
INSERT INTO `t_shipments` VALUES (4, 10, 5, 'SHIP-5c756452e6bc1', 'Pending', 'The item will be delivered soon', '2019-02-26 16:07:46', '2019-02-26 16:07:46');
INSERT INTO `t_shipments` VALUES (6, 12, 7, 'SHIP-5c75796b89244', 'Pending', 'The item will be delivered soon', '2019-02-26 17:37:47', '2019-02-26 17:37:47');
INSERT INTO `t_shipments` VALUES (7, 13, 8, 'SHIP-5c7579d98f187', 'Pending', 'The item will be delivered soon', '2019-02-26 17:39:37', '2019-02-26 17:39:37');
INSERT INTO `t_shipments` VALUES (8, 14, 9, 'SHIP-5c796e65b26fb', 'pending', 'The item will delivered soon', '2019-03-01 17:39:49', '2019-03-01 17:39:49');
INSERT INTO `t_shipments` VALUES (9, 15, 10, 'SHIP-5c79b275b0723', 'pending', 'The item will delivered soon', '2019-03-01 22:30:13', '2019-03-01 22:30:13');
INSERT INTO `t_shipments` VALUES (10, 16, 11, 'SHIP-5c802fb81d4e4', 'pending', 'The item will delivered soon', '2019-03-06 20:38:16', '2019-03-06 20:38:16');
INSERT INTO `t_shipments` VALUES (11, 17, 12, 'SHIP-5c8034a366907', 'pending', 'The item will delivered soon', '2019-03-06 20:59:15', '2019-03-06 20:59:15');
INSERT INTO `t_shipments` VALUES (12, 18, 13, 'SHIP-5c9f05d605b3d', 'pending', 'The item will delivered soon', '2019-03-30 05:59:50', '2019-03-30 05:59:50');
INSERT INTO `t_shipments` VALUES (13, 19, 14, 'SHIP-5c9f551bf2c10', 'pending', 'The item will delivered soon', '2019-03-30 11:38:03', '2019-03-30 11:38:03');
INSERT INTO `t_shipments` VALUES (14, 20, 15, 'SHIP-5ca41ddd3c296', 'pending', 'The item will delivered soon', '2019-04-03 02:43:41', '2019-04-03 02:43:41');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `AFF_ID` int(10) UNSIGNED NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `USER_DisplayStat` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `users_aff_id_foreign`(`AFF_ID`) USING BTREE,
  CONSTRAINT `users_aff_id_foreign` FOREIGN KEY (`AFF_ID`) REFERENCES `r_affiliate_infos` (`AFF_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'John Patrick Loyola', 'loyolapat04@gmail.com', '$2y$10$Db7L7QsQJIFOB2uZ8c1UA.9cY17t.mJ6lBNBSLYaRqFeJTnXIDEYK', 'admin', 1, 'NjFk1nhGBLS7JJ6OK8yhbbqNMDapFy88tgjHWhVlSvxiFUuU5HW9lxPavAHc', 1, '2019-02-19 05:43:41', '2019-02-19 05:43:41');
INSERT INTO `users` VALUES (2, 'Cristina - Island Rose', 'islandrose@gmail.com', '$2y$10$A9/5NAMx3UxL9/jxAuTgCe.9FNSyJBjoHFB93QGD.RXVkKfz421am', 'member', 2, NULL, 1, '2019-02-19 05:43:41', '2019-02-19 05:43:41');

SET FOREIGN_KEY_CHECKS = 1;
