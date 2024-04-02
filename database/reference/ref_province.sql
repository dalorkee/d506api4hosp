/*
 Navicat Premium Data Transfer

 Source Server         : labenv220
 Source Server Type    : MySQL
 Source Server Version : 50733 (5.7.33)
 Source Host           : 203.157.103.220:3306
 Source Schema         : test_pj_d506api

 Target Server Type    : MySQL
 Target Server Version : 50733 (5.7.33)
 File Encoding         : 65001

 Date: 29/03/2024 15:26:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ref_province
-- ----------------------------
DROP TABLE IF EXISTS `ref_province`;
CREATE TABLE `ref_province`  (
  `province_id` int(2) UNSIGNED NOT NULL DEFAULT 0,
  `province_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `province_name_en` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `province_code` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `zone_id` int(2) UNSIGNED NULL DEFAULT NULL,
  `zone_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `region` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `province_status` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`province_id`) USING BTREE,
  INDEX `province_id_idx`(`province_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ref_province
-- ----------------------------
INSERT INTO `ref_province` VALUES (10, 'กรุงเทพมหานคร', 'bangkok', 'BKK', 13, 'สปคม', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (11, 'สมุทรปราการ', 'samutprakan', 'SPK', 6, 'สคร.6', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (12, 'นนทบุรี', 'nonthaburi', 'NBI', 4, 'สคร.4', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (13, 'ปทุมธานี', 'pathumthani', 'PTE', 4, 'สคร.4', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (14, 'พระนครศรีอยุธยา', 'phranakhonsiayutthaya', 'AYA', 4, 'สคร.4', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (15, 'อ่างทอง', 'angthong', 'ATG', 4, 'สคร.4', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (16, 'ลพบุรี', 'lopburi', 'LRI', 4, 'สคร.4', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (17, 'สิงห์บุรี', 'singburi', 'SBR', 4, 'สคร.4', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (18, 'ชัยนาท', 'chainat', 'CNT', 3, 'สคร.3', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (19, 'สระบุรี', 'saraburi', 'SRI', 4, 'สคร.4', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (20, 'ชลบุรี', 'chonburi', 'CBI', 6, 'สคร.6', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (21, 'ระยอง', 'rayong', 'RYG', 6, 'สคร.6', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (22, 'จันทบุรี', 'chanthaburi', 'CTI', 6, 'สคร.6', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (23, 'ตราด', 'trat', 'TRT', 6, 'สคร.6', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (24, 'ฉะเชิงเทรา', 'chachoengsao', 'CCO', 6, 'สคร.6', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (25, 'ปราจีนบุรี', 'prachinburi', 'PRI', 6, 'สคร.6', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (26, 'นครนายก', 'nakhonnayok', 'NYK', 4, 'สคร.4', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (27, 'สระแก้ว', 'sakaeo', 'SKW', 6, 'สคร.6', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (30, 'นครราชสีมา', 'nakhonratchasima', 'NMA', 9, 'สคร.9', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (31, 'บุรีรัมย์', 'buriram', 'BRM', 9, 'สคร.9', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (32, 'สุรินทร์', 'surin', 'SRN', 9, 'สคร.9', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (33, 'ศรีสะเกษ', 'sisaket', 'SSK', 10, 'สคร.10', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (34, 'อุบลราชธานี', 'ubonratchathani', 'UBN', 10, 'สคร.10', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (35, 'ยโสธร', 'yasothon', 'YST', 10, 'สคร.10', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (36, 'ชัยภูมิ', 'chaiyaphum', 'CPM', 9, 'สคร.9', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (37, 'อำนาจเจริญ', 'amnatcharoen', 'ACR', 10, 'สคร.10', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (38, 'บึงกาฬ', 'buengkan', 'BKN', 8, 'สคร.8', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (39, 'หนองบัวลำภู', 'nongbualamphu', 'NBP', 8, 'สคร.8', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (40, 'ขอนแก่น', 'khonkaen', 'KKN', 7, 'สคร.7', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (41, 'อุดรธานี', 'udonthani', 'UDN', 8, 'สคร.8', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (42, 'เลย', 'loei', 'LEI', 8, 'สคร.8', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (43, 'หนองคาย', 'nongkhai', 'NKI', 8, 'สคร.8', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (44, 'มหาสารคาม', 'mahasarakham', 'MKM', 7, 'สคร.7', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (45, 'ร้อยเอ็ด', 'roiet', 'RET', 7, 'สคร.7', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (46, 'กาฬสินธุ์', 'kalasin', 'KSN', 7, 'สคร.7', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (47, 'สกลนคร', 'sakonnakhon', 'SNK', 8, 'สคร.8', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (48, 'นครพนม', 'nakhonphanom', 'NPM', 8, 'สคร.8', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (49, 'มุกดาหาร', 'mukdahan', 'MDH', 10, 'สคร.10', 'ภาคตะวันออกเฉียงเหนือ', 1);
INSERT INTO `ref_province` VALUES (50, 'เชียงใหม่', 'chiangmai', 'CMI', 1, 'สคร.1', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (51, 'ลำพูน', 'lamphun', 'LPN', 1, 'สคร.1', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (52, 'ลำปาง', 'lampang', 'LPG', 1, 'สคร.1', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (53, 'อุตรดิตถ์', 'uttaradit', 'UTT', 2, 'สคร.2', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (54, 'แพร่', 'phrae', 'PRE', 1, 'สคร.1', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (55, 'น่าน', 'nan', 'NAN', 1, 'สคร.1', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (56, 'พะเยา', 'phayao', 'PYO', 1, 'สคร.1', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (57, 'เชียงราย', 'chiangrai', 'CRI', 1, 'สคร.1', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (58, 'แม่ฮ่องสอน', 'maehongson', 'MSN', 1, 'สคร.1', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (60, 'นครสวรรค์', 'nakhonsawan', 'NSN', 3, 'สคร.3', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (61, 'อุทัยธานี', 'uthaithani', 'UTI', 3, 'สคร.3', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (62, 'กำแพงเพชร', 'kamphaengphet', 'KPT', 3, 'สคร.3', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (63, 'ตาก', 'tak', 'TAK', 2, 'สคร.2', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (64, 'สุโขทัย', 'sukhothai', 'STI', 2, 'สคร.2', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (65, 'พิษณุโลก', 'phitsanulok', 'PLK', 2, 'สคร.2', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (66, 'พิจิตร', 'phichit', 'PCK', 3, 'สคร.3', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (67, 'เพชรบูรณ์', 'phetchabun', 'PNB', 2, 'สคร.2', 'ภาคเหนือ', 1);
INSERT INTO `ref_province` VALUES (70, 'ราชบุรี', 'ratchaburi', 'RBR', 5, 'สคร.5', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (71, 'กาญจนบุรี', 'kanchanaburi', 'KRI', 5, 'สคร.5', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (72, 'สุพรรณบุรี', 'suphanburi', 'SPB', 5, 'สคร.5', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (73, 'นครปฐม', 'nakhonpathom', 'NPT', 5, 'สคร.5', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (74, 'สมุทรสาคร', 'samutsakhon', 'SKN', 5, 'สคร.5', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (75, 'สมุทรสงคราม', 'samutsongkhram', 'SKM', 5, 'สคร.5', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (76, 'เพชรบุรี', 'phetchaburi', 'PBI', 5, 'สคร.5', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (77, 'ประจวบคีรีขันธ์', 'prachuapkhirikhan', 'PKN', 5, 'สคร.5', 'ภาคกลาง', 1);
INSERT INTO `ref_province` VALUES (80, 'นครศรีธรรมราช', 'nakhonsithammarat', 'NRT', 11, 'สคร.11', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (81, 'กระบี่', 'krabi', 'KBI', 11, 'สคร.11', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (82, 'พังงา', 'phangnga', 'PNA', 11, 'สคร.11', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (83, 'ภูเก็ต', 'phuket', 'PKT', 11, 'สคร.11', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (84, 'สุราษฎร์ธานี', 'suratthani', 'SNI', 11, 'สคร.11', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (85, 'ระนอง', 'ranong', 'RNG', 11, 'สคร.11', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (86, 'ชุมพร', 'chumphon', 'CPN', 11, 'สคร.11', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (90, 'สงขลา', 'songkhla', 'SKA', 12, 'สคร.12', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (91, 'สตูล', 'satun', 'STN', 12, 'สคร.12', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (92, 'ตรัง', 'trang', 'TRG', 12, 'สคร.12', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (93, 'พัทลุง', 'phatthalung', 'PLG', 12, 'สคร.12', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (94, 'ปัตตานี', 'pattani', 'PTN', 12, 'สคร.12', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (95, 'ยะลา', 'yala', 'YLA', 12, 'สคร.12', 'ภาคใต้', 1);
INSERT INTO `ref_province` VALUES (96, 'นราธิวาส', 'narathiwat', 'NWT', 12, 'สคร.12', 'ภาคใต้', 1);

SET FOREIGN_KEY_CHECKS = 1;
