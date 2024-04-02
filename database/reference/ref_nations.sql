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

 Date: 29/03/2024 15:26:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ref_nations
-- ----------------------------
DROP TABLE IF EXISTS `ref_nations`;
CREATE TABLE `ref_nations`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nation` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 270 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ref_nations
-- ----------------------------
INSERT INTO `ref_nations` VALUES (1, '002', 'โปรตุเกส');
INSERT INTO `ref_nations` VALUES (2, '003', 'ดัตช์');
INSERT INTO `ref_nations` VALUES (3, '004', 'เยอรมัน');
INSERT INTO `ref_nations` VALUES (4, '005', 'ฝรั่งเศส');
INSERT INTO `ref_nations` VALUES (5, '006', 'เดนมาร์ก');
INSERT INTO `ref_nations` VALUES (6, '007', 'สวีเดน');
INSERT INTO `ref_nations` VALUES (7, '008', 'สวิส');
INSERT INTO `ref_nations` VALUES (8, '009', 'อิตาลี');
INSERT INTO `ref_nations` VALUES (9, '010', 'นอร์เวย์');
INSERT INTO `ref_nations` VALUES (10, '011', 'ออสเตรีย');
INSERT INTO `ref_nations` VALUES (11, '012', 'ไอริช');
INSERT INTO `ref_nations` VALUES (12, '013', 'ฟินแลนด์');
INSERT INTO `ref_nations` VALUES (13, '014', 'เบลเยียม');
INSERT INTO `ref_nations` VALUES (14, '015', 'สเปน');
INSERT INTO `ref_nations` VALUES (15, '016', 'รัสเซีย');
INSERT INTO `ref_nations` VALUES (16, '017', 'โปแลนด์');
INSERT INTO `ref_nations` VALUES (17, '018', 'เช็ก');
INSERT INTO `ref_nations` VALUES (18, '019', 'ฮังการี');
INSERT INTO `ref_nations` VALUES (19, '020', 'กรีก');
INSERT INTO `ref_nations` VALUES (20, '021', 'ยูโกสลาฟ');
INSERT INTO `ref_nations` VALUES (21, '022', 'ลักเซมเบิร์ก');
INSERT INTO `ref_nations` VALUES (22, '023', 'วาติกัน');
INSERT INTO `ref_nations` VALUES (23, '024', 'มอลตา');
INSERT INTO `ref_nations` VALUES (24, '025', 'ลีซู');
INSERT INTO `ref_nations` VALUES (25, '026', 'บัลแกเรีย');
INSERT INTO `ref_nations` VALUES (26, '027', 'โรมาเนีย');
INSERT INTO `ref_nations` VALUES (27, '028', 'ไซปรัส');
INSERT INTO `ref_nations` VALUES (28, '029', 'อเมริกัน');
INSERT INTO `ref_nations` VALUES (29, '030', 'แคนาดา');
INSERT INTO `ref_nations` VALUES (30, '031', 'เม็กซิโก');
INSERT INTO `ref_nations` VALUES (31, '032', 'คิวบา');
INSERT INTO `ref_nations` VALUES (32, '033', 'อาร์เจนตินา');
INSERT INTO `ref_nations` VALUES (33, '034', 'บราซิล');
INSERT INTO `ref_nations` VALUES (34, '035', 'ชิลี');
INSERT INTO `ref_nations` VALUES (35, '036', 'อาข่า');
INSERT INTO `ref_nations` VALUES (36, '037', 'โคลัมเบีย');
INSERT INTO `ref_nations` VALUES (37, '038', 'ลั๊ว');
INSERT INTO `ref_nations` VALUES (38, '039', 'เปรู');
INSERT INTO `ref_nations` VALUES (39, '040', 'ปานามา');
INSERT INTO `ref_nations` VALUES (40, '041', 'อุรุกวัย');
INSERT INTO `ref_nations` VALUES (41, '042', 'เวเนซุเอลา');
INSERT INTO `ref_nations` VALUES (42, '043', 'เปอร์โตริโก้');
INSERT INTO `ref_nations` VALUES (43, '044', 'จีน');
INSERT INTO `ref_nations` VALUES (44, '045', 'อินเดีย');
INSERT INTO `ref_nations` VALUES (45, '046', 'เวียดนาม');
INSERT INTO `ref_nations` VALUES (46, '047', 'ญี่ปุ่น');
INSERT INTO `ref_nations` VALUES (47, '048', 'พม่า');
INSERT INTO `ref_nations` VALUES (48, '049', 'ฟิลิปปิน');
INSERT INTO `ref_nations` VALUES (49, '050', 'มาเลเซีย');
INSERT INTO `ref_nations` VALUES (50, '051', 'อินโดนีเซีย');
INSERT INTO `ref_nations` VALUES (51, '052', 'ปากีสถาน');
INSERT INTO `ref_nations` VALUES (52, '053', 'เกาหลีใต้');
INSERT INTO `ref_nations` VALUES (53, '054', 'สิงคโปร์');
INSERT INTO `ref_nations` VALUES (54, '055', 'เนปาล');
INSERT INTO `ref_nations` VALUES (55, '056', 'ลาว');
INSERT INTO `ref_nations` VALUES (56, '057', 'กัมพูชา');
INSERT INTO `ref_nations` VALUES (57, '058', 'ศรีลังกา');
INSERT INTO `ref_nations` VALUES (58, '059', 'ซาอุดีอาระเบีย');
INSERT INTO `ref_nations` VALUES (59, '060', 'อิสราเอล');
INSERT INTO `ref_nations` VALUES (60, '061', 'เลบานอน');
INSERT INTO `ref_nations` VALUES (61, '062', 'อิหร่าน');
INSERT INTO `ref_nations` VALUES (62, '063', 'ตุรกี');
INSERT INTO `ref_nations` VALUES (63, '064', 'บังกลาเทศ');
INSERT INTO `ref_nations` VALUES (64, '065', 'ถูกถอนสัญชาติ');
INSERT INTO `ref_nations` VALUES (65, '066', 'ซีเรีย');
INSERT INTO `ref_nations` VALUES (66, '067', 'อิรัก');
INSERT INTO `ref_nations` VALUES (67, '068', 'คูเวต');
INSERT INTO `ref_nations` VALUES (68, '069', 'บรูไน');
INSERT INTO `ref_nations` VALUES (69, '070', 'แอฟริกาใต้');
INSERT INTO `ref_nations` VALUES (70, '071', 'กะเหรี่ยง');
INSERT INTO `ref_nations` VALUES (71, '072', 'ลาหู่');
INSERT INTO `ref_nations` VALUES (72, '073', 'เคนยา');
INSERT INTO `ref_nations` VALUES (73, '074', 'อียิปต์');
INSERT INTO `ref_nations` VALUES (74, '075', 'เอธิโอเปีย');
INSERT INTO `ref_nations` VALUES (75, '076', 'ไนจีเรีย');
INSERT INTO `ref_nations` VALUES (76, '077', 'สหรัฐอาหรับเอมิเรตส์');
INSERT INTO `ref_nations` VALUES (77, '078', 'กินี');
INSERT INTO `ref_nations` VALUES (78, '079', 'ออสเตรเลีย');
INSERT INTO `ref_nations` VALUES (79, '080', 'นิวซีแลนด์');
INSERT INTO `ref_nations` VALUES (80, '081', 'ปาปัวนิวกินี');
INSERT INTO `ref_nations` VALUES (81, '082', 'ม้ง');
INSERT INTO `ref_nations` VALUES (82, '083', 'เมี่ยน');
INSERT INTO `ref_nations` VALUES (83, '084', 'ชาวเขาที่ไม่ได้รับสัญขาติไทย');
INSERT INTO `ref_nations` VALUES (84, '085', '-');
INSERT INTO `ref_nations` VALUES (85, '086', 'จีนฮ่อ');
INSERT INTO `ref_nations` VALUES (86, '087', 'จีน (อดีตทหารจีนคณะชาติ ,อดีตทหารจีนชาติ)');
INSERT INTO `ref_nations` VALUES (87, '088', 'ผู้พลัดถิ่นสัญชาติพม่า');
INSERT INTO `ref_nations` VALUES (88, '089', 'ผู้อพยพเชื้อสายจากกัมพูชา');
INSERT INTO `ref_nations` VALUES (89, '090', 'ลาว (ลาวอพยพ)');
INSERT INTO `ref_nations` VALUES (90, '091', 'เขมรอพยพ');
INSERT INTO `ref_nations` VALUES (91, '092', 'ผู้อพยพอินโดจีนสัญชาติเวียดนาม');
INSERT INTO `ref_nations` VALUES (92, '093', 'รอให้สัญชาติไทย');
INSERT INTO `ref_nations` VALUES (93, '094', 'ไทย-อิสลาม,อิสลาม-ไทย');
INSERT INTO `ref_nations` VALUES (94, '095', 'ไทย-จีน,จีน-ไทย');
INSERT INTO `ref_nations` VALUES (95, '096', 'ไร้สัญชาติ');
INSERT INTO `ref_nations` VALUES (96, '097', 'อื่นๆ');
INSERT INTO `ref_nations` VALUES (97, '098', 'ไม่ได้สัญชาติไทย');
INSERT INTO `ref_nations` VALUES (98, '099', 'ไทย');
INSERT INTO `ref_nations` VALUES (99, '100', 'อัฟกัน');
INSERT INTO `ref_nations` VALUES (100, '101', 'บาห์เรน');
INSERT INTO `ref_nations` VALUES (101, '102', 'ภูฏาน');
INSERT INTO `ref_nations` VALUES (102, '103', 'จอร์แดน');
INSERT INTO `ref_nations` VALUES (103, '104', 'เกาหลีเหนือ');
INSERT INTO `ref_nations` VALUES (104, '105', 'มัลดีฟ');
INSERT INTO `ref_nations` VALUES (105, '106', 'มองโกเลีย');
INSERT INTO `ref_nations` VALUES (106, '107', 'โอมาน');
INSERT INTO `ref_nations` VALUES (107, '108', 'กาตาร์');
INSERT INTO `ref_nations` VALUES (108, '109', 'เยเมน');
INSERT INTO `ref_nations` VALUES (109, '110', 'เยเมน(ใต้)**');
INSERT INTO `ref_nations` VALUES (110, '111', 'หมู่เกาะฟิจิ');
INSERT INTO `ref_nations` VALUES (111, '112', 'คิริบาส');
INSERT INTO `ref_nations` VALUES (112, '113', 'นาอูรู');
INSERT INTO `ref_nations` VALUES (113, '114', 'หมู่เกาะโซโลมอน');
INSERT INTO `ref_nations` VALUES (114, '115', 'ตองก้า');
INSERT INTO `ref_nations` VALUES (115, '116', 'ตูวาลู');
INSERT INTO `ref_nations` VALUES (116, '117', 'วานูอาตู');
INSERT INTO `ref_nations` VALUES (117, '118', 'ซามัว');
INSERT INTO `ref_nations` VALUES (118, '119', 'แอลเบเนีย');
INSERT INTO `ref_nations` VALUES (119, '120', 'อันดอร์รา');
INSERT INTO `ref_nations` VALUES (120, '121', 'เยอรมนีตะวันออก**');
INSERT INTO `ref_nations` VALUES (121, '122', 'ไอซ์แลนด์');
INSERT INTO `ref_nations` VALUES (122, '123', 'ลิกเตนสไตน์');
INSERT INTO `ref_nations` VALUES (123, '124', 'โมนาโก');
INSERT INTO `ref_nations` VALUES (124, '125', 'ซานมารีโน');
INSERT INTO `ref_nations` VALUES (125, '126', 'บริติช  (อังกฤษ, สก็อตแลนด์)');
INSERT INTO `ref_nations` VALUES (126, '127', 'แอลจีเรีย');
INSERT INTO `ref_nations` VALUES (127, '128', 'แองโกลา');
INSERT INTO `ref_nations` VALUES (128, '129', 'เบนิน');
INSERT INTO `ref_nations` VALUES (129, '130', 'บอตสวานา');
INSERT INTO `ref_nations` VALUES (130, '131', 'บูร์กินาฟาโซ');
INSERT INTO `ref_nations` VALUES (131, '132', 'บุรุนดี');
INSERT INTO `ref_nations` VALUES (132, '133', 'แคเมอรูน');
INSERT INTO `ref_nations` VALUES (133, '134', 'เคปเวิร์ด');
INSERT INTO `ref_nations` VALUES (134, '135', 'แอฟริกากลาง');
INSERT INTO `ref_nations` VALUES (135, '136', 'ชาด');
INSERT INTO `ref_nations` VALUES (136, '137', 'คอสตาริกา');
INSERT INTO `ref_nations` VALUES (137, '138', 'คองโก');
INSERT INTO `ref_nations` VALUES (138, '139', 'ไอโวเรี่ยน');
INSERT INTO `ref_nations` VALUES (139, '140', 'จิบูตี');
INSERT INTO `ref_nations` VALUES (140, '141', 'อิเควทอเรียลกินี');
INSERT INTO `ref_nations` VALUES (141, '142', 'กาบอง');
INSERT INTO `ref_nations` VALUES (142, '143', 'แกมเบีย');
INSERT INTO `ref_nations` VALUES (143, '144', 'กานา');
INSERT INTO `ref_nations` VALUES (144, '145', 'กินีบีสเซา');
INSERT INTO `ref_nations` VALUES (145, '146', 'เลโซโท');
INSERT INTO `ref_nations` VALUES (146, '147', 'ไลบีเรีย');
INSERT INTO `ref_nations` VALUES (147, '148', 'ลิเบีย');
INSERT INTO `ref_nations` VALUES (148, '149', 'มาลากาซี');
INSERT INTO `ref_nations` VALUES (149, '150', 'มาลาวี');
INSERT INTO `ref_nations` VALUES (150, '151', 'มาลี');
INSERT INTO `ref_nations` VALUES (151, '152', 'มอริเตเนีย');
INSERT INTO `ref_nations` VALUES (152, '153', 'มอริเชียส');
INSERT INTO `ref_nations` VALUES (153, '154', 'โมร็อกโก');
INSERT INTO `ref_nations` VALUES (154, '155', 'โมซัมบิก');
INSERT INTO `ref_nations` VALUES (155, '156', 'ไนเจอร์');
INSERT INTO `ref_nations` VALUES (156, '157', 'รวันดา');
INSERT INTO `ref_nations` VALUES (157, '158', 'เซาโตเมและปรินซิเป');
INSERT INTO `ref_nations` VALUES (158, '159', 'เซเนกัล');
INSERT INTO `ref_nations` VALUES (159, '160', 'เซเชลส์');
INSERT INTO `ref_nations` VALUES (160, '161', 'เซียร์ราลีโอน');
INSERT INTO `ref_nations` VALUES (161, '162', 'โซมาลี');
INSERT INTO `ref_nations` VALUES (162, '163', 'ซูดาน');
INSERT INTO `ref_nations` VALUES (163, '164', 'สวาซี');
INSERT INTO `ref_nations` VALUES (164, '165', 'แทนซาเนีย');
INSERT INTO `ref_nations` VALUES (165, '166', 'โตโก');
INSERT INTO `ref_nations` VALUES (166, '167', 'ตูนิเซีย');
INSERT INTO `ref_nations` VALUES (167, '168', 'ยูกันดา');
INSERT INTO `ref_nations` VALUES (168, '169', 'ซาอีร์');
INSERT INTO `ref_nations` VALUES (169, '170', 'แซมเบีย');
INSERT INTO `ref_nations` VALUES (170, '171', 'ซิมบับเว');
INSERT INTO `ref_nations` VALUES (171, '172', 'แอนติกาและบาร์บูดา');
INSERT INTO `ref_nations` VALUES (172, '173', 'บาฮามาส');
INSERT INTO `ref_nations` VALUES (173, '174', 'บาร์เบโดส');
INSERT INTO `ref_nations` VALUES (174, '175', 'เบลิซ');
INSERT INTO `ref_nations` VALUES (175, '176', 'คอสตาริกา');
INSERT INTO `ref_nations` VALUES (176, '177', 'โดมินิกา');
INSERT INTO `ref_nations` VALUES (177, '178', 'โดมินิกัน');
INSERT INTO `ref_nations` VALUES (178, '179', 'เอลซัลวาดอร์');
INSERT INTO `ref_nations` VALUES (179, '180', 'เกรเนดา');
INSERT INTO `ref_nations` VALUES (180, '181', 'กัวเตมาลา');
INSERT INTO `ref_nations` VALUES (181, '182', 'เฮติ');
INSERT INTO `ref_nations` VALUES (182, '183', 'ฮอนดูรัส');
INSERT INTO `ref_nations` VALUES (183, '184', 'จาเมกา');
INSERT INTO `ref_nations` VALUES (184, '185', 'นิการากัว');
INSERT INTO `ref_nations` VALUES (185, '186', 'เซนต์คิตส์และเนวิส');
INSERT INTO `ref_nations` VALUES (186, '187', 'เซนต์ลูเซีย');
INSERT INTO `ref_nations` VALUES (187, '188', 'เซนต์วินเซนต์และเกรนาดีนส์');
INSERT INTO `ref_nations` VALUES (188, '189', 'ตรินิแดดและโตเบโก');
INSERT INTO `ref_nations` VALUES (189, '190', 'โบลีเวีย');
INSERT INTO `ref_nations` VALUES (190, '191', 'เอกวาดอร์');
INSERT INTO `ref_nations` VALUES (191, '192', 'กายอานา');
INSERT INTO `ref_nations` VALUES (192, '193', 'ปารากวัย');
INSERT INTO `ref_nations` VALUES (193, '194', 'ซูรินาเม');
INSERT INTO `ref_nations` VALUES (194, '195', 'อาหรับ');
INSERT INTO `ref_nations` VALUES (195, '196', 'คะฉิ่น');
INSERT INTO `ref_nations` VALUES (196, '197', 'ว้า');
INSERT INTO `ref_nations` VALUES (197, '198', 'ไทยใหญ่');
INSERT INTO `ref_nations` VALUES (198, '199', 'ไทยลื้อ');
INSERT INTO `ref_nations` VALUES (199, '200', 'ขมุ');
INSERT INTO `ref_nations` VALUES (200, '201', 'ตองสู');
INSERT INTO `ref_nations` VALUES (201, '202', 'เงี้ยว**');
INSERT INTO `ref_nations` VALUES (202, '203', 'ละว้า');
INSERT INTO `ref_nations` VALUES (203, '204', 'แม้ว');
INSERT INTO `ref_nations` VALUES (204, '205', 'ปะหร่อง');
INSERT INTO `ref_nations` VALUES (205, '206', 'ถิ่น');
INSERT INTO `ref_nations` VALUES (206, '207', 'ปะโอ');
INSERT INTO `ref_nations` VALUES (207, '208', 'มอญ');
INSERT INTO `ref_nations` VALUES (208, '209', 'มลาบรี');
INSERT INTO `ref_nations` VALUES (209, '210', 'เฮาะ**');
INSERT INTO `ref_nations` VALUES (210, '211', 'สก็อตแลน์**');
INSERT INTO `ref_nations` VALUES (211, '212', 'จีน (จีนฮ่ออิสระ)');
INSERT INTO `ref_nations` VALUES (212, '213', 'จีนอพยพ**');
INSERT INTO `ref_nations` VALUES (213, '214', 'จีน (จีนฮ่ออพยพ)');
INSERT INTO `ref_nations` VALUES (214, '215', 'ไต้หวัน**');
INSERT INTO `ref_nations` VALUES (215, '216', 'ยูเครน');
INSERT INTO `ref_nations` VALUES (216, '217', 'อาณานิคมอังกฤษ**');
INSERT INTO `ref_nations` VALUES (217, '218', 'ดูไบ**');
INSERT INTO `ref_nations` VALUES (218, '219', 'จีน(ฮ่องกง)');
INSERT INTO `ref_nations` VALUES (219, '220', 'จีน(ไต้หวัน)');
INSERT INTO `ref_nations` VALUES (220, '221', 'โครเอเชีย');
INSERT INTO `ref_nations` VALUES (221, '222', 'บริทิธ**');
INSERT INTO `ref_nations` VALUES (222, '223', 'คาซัค');
INSERT INTO `ref_nations` VALUES (223, '224', 'อาร์เมเนีย');
INSERT INTO `ref_nations` VALUES (224, '225', 'อาเซอร์ไบจาน');
INSERT INTO `ref_nations` VALUES (225, '226', 'จอร์เจีย');
INSERT INTO `ref_nations` VALUES (226, '227', 'คีร์กีซ');
INSERT INTO `ref_nations` VALUES (227, '228', 'ทาจิก');
INSERT INTO `ref_nations` VALUES (228, '229', 'อุซเบก');
INSERT INTO `ref_nations` VALUES (229, '230', 'หมู่เกาะมาร์แชลล์');
INSERT INTO `ref_nations` VALUES (230, '231', 'ไมโครนีเซีย');
INSERT INTO `ref_nations` VALUES (231, '232', 'ปาเลา');
INSERT INTO `ref_nations` VALUES (232, '233', 'เบลารุส');
INSERT INTO `ref_nations` VALUES (233, '234', 'บอสเนียและเฮอร์เซโกวีนา');
INSERT INTO `ref_nations` VALUES (234, '235', 'เติร์กเมน');
INSERT INTO `ref_nations` VALUES (235, '236', 'เอสโตเนีย');
INSERT INTO `ref_nations` VALUES (236, '237', 'ลัตเวีย');
INSERT INTO `ref_nations` VALUES (237, '238', 'ลิทัวเนีย');
INSERT INTO `ref_nations` VALUES (238, '239', 'มาซิโดเนีย');
INSERT INTO `ref_nations` VALUES (239, '240', 'มอลโดวา');
INSERT INTO `ref_nations` VALUES (240, '241', 'สโลวัก');
INSERT INTO `ref_nations` VALUES (241, '242', 'สโลวีน');
INSERT INTO `ref_nations` VALUES (242, '243', 'เอริเทรีย');
INSERT INTO `ref_nations` VALUES (243, '244', 'นามิเบีย');
INSERT INTO `ref_nations` VALUES (244, '245', 'โบลิเวีย');
INSERT INTO `ref_nations` VALUES (245, '246', 'หมู่เกาะคุก');
INSERT INTO `ref_nations` VALUES (246, '247', 'เนปาล (เนปาลอพยพ)');
INSERT INTO `ref_nations` VALUES (247, '248', 'มอญ  (ผู้พลัดถิ่นสัญชาติพม่า)');
INSERT INTO `ref_nations` VALUES (248, '249', 'ไทยใหญ่  (ผู้พลัดถิ่นสัญชาติพม่า)');
INSERT INTO `ref_nations` VALUES (249, '250', 'เวียดนาม  (ญวนอพยพ)');
INSERT INTO `ref_nations` VALUES (250, '251', 'มาเลเชีย  (อดีต จีนคอมมิวนิสต์)');
INSERT INTO `ref_nations` VALUES (251, '252', 'จีน  (อดีต จีนคอมมิวนิสต์)');
INSERT INTO `ref_nations` VALUES (252, '253', 'สิงคโปร์  (อดีต จีนคอมมิวนิสต์)');
INSERT INTO `ref_nations` VALUES (253, '254', 'กะเหรี่ยง  (ผู้หลบหนีเข้าเมือง)');
INSERT INTO `ref_nations` VALUES (254, '255', 'มอญ  (ผู้หลบหนีเข้าเมือง)');
INSERT INTO `ref_nations` VALUES (255, '256', 'ไทยใหญ่  (ผู้หลบหนีเข้าเมือง)');
INSERT INTO `ref_nations` VALUES (256, '257', 'กัมพูชา  (ผู้หลบหนีเข้าเมือง)');
INSERT INTO `ref_nations` VALUES (257, '258', 'มอญ  (ชุมชนบนพื้นที่สูง)');
INSERT INTO `ref_nations` VALUES (258, '259', 'กะเหรี่ยง  (ชุมชนบนพื้นที่สูง)');
INSERT INTO `ref_nations` VALUES (259, '260', 'ปาเลสไตน์');
INSERT INTO `ref_nations` VALUES (260, '261', 'ติมอร์ตะวันออก');
INSERT INTO `ref_nations` VALUES (261, '262', 'สละสัญชาติไทย');
INSERT INTO `ref_nations` VALUES (262, '263', 'เซอร์เบีย แอนด์ มอนเตเนโกร');
INSERT INTO `ref_nations` VALUES (263, '264', 'กัมพูชา(แรงงาน)');
INSERT INTO `ref_nations` VALUES (264, '265', 'พม่า(แรงงาน)');
INSERT INTO `ref_nations` VALUES (265, '266', 'ลาว(แรงงาน)');
INSERT INTO `ref_nations` VALUES (266, '267', 'เซอร์เบียน');
INSERT INTO `ref_nations` VALUES (267, '268', 'มอนเตเนกริน');
INSERT INTO `ref_nations` VALUES (268, '989', 'บุคคลที่ไม่มีสถานะทางทะเบียน');
INSERT INTO `ref_nations` VALUES (269, '999', 'ไม่ระบุ');

SET FOREIGN_KEY_CHECKS = 1;
