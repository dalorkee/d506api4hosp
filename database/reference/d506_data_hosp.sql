/*
 Navicat Premium Data Transfer

 Source Server         : labsur_201
 Source Server Type    : MySQL
 Source Server Version : 80025 (8.0.25)
 Source Host           : 192.168.200.201:3306
 Source Schema         : hos-base-demo

 Target Server Type    : MySQL
 Target Server Version : 80025 (8.0.25)
 File Encoding         : 65001

 Date: 01/04/2024 15:59:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for d506_data_hosp
-- ----------------------------
DROP TABLE IF EXISTS `d506_data_hosp`;
CREATE TABLE `d506_data_hosp`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `hospital_code` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'รหัสหน่วยบริการ (รหัสมาตรฐาน 5 หลัก) ที่ส่งข้อมูล',
  `hospital_name` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ชื่อหน่วยบริการที่ส่งข้อมูล',
  `his_identifier` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ชื่อหน่วยบริการหรือ ข้อมูลอื่นๆที่อ้างอิง รพ.',
  `cid` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'เลขบัตรประจำตัวประชาชน',
  `passport_no` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'เลขที่หนังสือเดินทาง',
  `prefix` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'คำนำหน้าชื่อ',
  `first_name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อผู้ป่วย',
  `last_name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'นามสกุลผู้ป่วย',
  `nationality` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'รหัสสัญชาติ ใช้รหัสมาตรฐาน 43 แฟ้ม',
  `gender` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'เพศ (1= ชาย, 2 = หญิง)',
  `birth_date` date NOT NULL COMMENT 'วันเกิด ปี ค,ศ. YYYY-MM-DD',
  `age_y` int NOT NULL COMMENT 'อายุ (ปี)',
  `age_m` int NOT NULL COMMENT 'อายุ (เดือน)',
  `age_d` int NOT NULL COMMENT 'อายุ (วัน)',
  `marital_status_id` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'สถานะภาพสมรส (1=โสด, 2=คู่, 3=หย่าร้าง, 4=หม้าย, 5=ไม่ทราบ, 6=สมณะ)',
  `address` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ที่อยู่ปัจจุบัน',
  `moo` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'หมู่ที่',
  `road` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ถนน',
  `chw_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสจังหวัดที่อยู่ปัจจุบัน',
  `amp_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสอำเภออยู่ปัจจุบัน',
  `tmb_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสตำบลอยู่ปัจจุบัน',
  `mobile_phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `occupation` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'รหัสอาชีพ (อ้างอิง 43 แฟ้ม)',
  `epidem_report_guid` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '\"{73F287FF-5924-FFFF-B80A-8993A1349DAE}\" unique และมีความยาว 38 ตัวอักษรตาม uuid-v4 UID ของข้อมูลที่รายงานครั้งนี้ ใช้อ้างอิงการส่งข้อมูลรายงานครั้งนี้ กรณีส่งมาแก้ไขให้ใช้รหัสเดิม',
  `epidem_report_group_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสโรคทางระบาดวิทยา ',
  `treated_hospital_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสโรงพยาบาลที่กำลังรักษาตัว',
  `report_datetime` datetime NOT NULL COMMENT '\"2021-12-12T09:00:00.000\" ** UTC + 7 วันที่/เวลา ที่รายงานโรค',
  `onset_date` date NULL DEFAULT NULL COMMENT 'วันที่เริ่มมีอาการ (ค.ศ.) YYYY-MM-DD',
  `treated_date` date NULL DEFAULT NULL COMMENT 'วันที่เริ่มรักษา (ค.ศ.)  YYYY-MM-DD',
  `diagnosis_date` date NULL DEFAULT NULL COMMENT 'วันที่วินิจฉัยโรค  (ค.ศ.)YYYY-MM-DD',
  `death_date` date NULL DEFAULT NULL COMMENT 'วันที่เสียชีวิต (ค.ศ.)YYYY-MM-DD',
  `cdeath` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'Died with หรือ Died from COVID-19 สาเหตุการเสียชีวิต Free text',
  `informer_name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ชื่อผู้รายงาน',
  `diagnosis_icd10` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัส ICD10 หลัก',
  `diagnosis_icd10_list` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '“J149,J189\" รหัส ICD10 รอง ผลการวินิจฉัยอื่นๆ กรณีมีเพียง principle_diagnosis ให้ส่งเป็นตัวเดียวกันเข้ามา ',
  `organism` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ชนิดของเชื้อ เลข 2 หลัก',
  `complication` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ภาวะแทรกซ้อน เลข 1 หลัก',
  `epidem_person_status_id` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'สถานะผู้ป่วย  (1 = หายจากโรคแล้ว, 2 = เสียชีวิต , 3 = ยังรักษาอยู่, 4 = ไม่ทราบ)',
  `epidem_symptom_type_id` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'อาการที่แสดง (1 = ไม่มีอาการ , 2 = มีอาการที่ ไม่รุนแรง , 3 = มีอาการที่รุนแรง เช่น ปอดบวม)',
  `respirator_status` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ใส่เครื่องช่วยหายใจ (Y = ใส่, N=ไม่ใส่) ถ้าไม่ทราบให้ default เป็น N',
  `vaccinated_status` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'มีประวัติการได้รับวัคซีน Y / N',
  `municipal` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'เขตเทศบาล(1 = ในเขตเทศบาล  2 = อบต.  3 = ไม่ทราบ)',
  `epidem_address` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ที่อยู่ บ้านเลขที่ขณะสำรวจว่าเป็นโรค',
  `epidem_moo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ที่อยู่ หมู่ ขณะสำรวจว่าเป็นโรค',
  `epidem_road` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ที่อยู่ ถนน ขณะสำรวจว่าเป็นโรค',
  `epidem_chw_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ที่อยู่ รหัสจังหวัด ขณะสำรวจว่าเป็นโรค',
  `epidem_amp_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ที่อยู่ รหัสอำเภอ ขณะสำรวจว่าเป็นโรค',
  `epidem_tmb_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ที่อยู่ รหัสตำบล ขณะสำรวจว่าเป็นโรค',
  `location_gis_latitude` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'พิกัด Latitude GIS float value WGS84',
  `location_gis_longitude` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'พิกัด Longitude GIS float value WGS84',
  `isolate_chw_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสจังหวัดที่ isolate / รับรักษาผู้ป่วย',
  `patient_type` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ประเภทผู้ป่วย (OPD / IPD / ACF)',
  `active_case_finding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'ใช้สำหรับบันทึกค้นหาในชุมชนเพิ่ม หรือบันทึกจาก web portal active case finding ค้นหาผู้ป่วยเชิงรุก Free text',
  `epidem_cluster_type_id` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'รหัสของกลุ่ม cluster (ตัวเลือกจากตาราง epidem_cluster)',
  `cluster_latitude` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'พิกัด Latitude GIS float value WGS84 ของ cluster',
  `cluster_longitude` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'พิกัด Longitude GIS float value WGS84  ของ cluster',
  `comment` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'คำอธิบายเพิ่มเติม อื่นๆ',
  `epidem_lab_confirm_type_id` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ผลการตรวจที่ยืนยันการติดเชื้อ อ้างอิงจากตาราง epidem_lab_confirm_type',
  `lab_report_date` date NULL DEFAULT NULL COMMENT 'วันที่รายงานผล LAB(ค.ศ.) YYYY-MM-DD',
  `lab_report_result` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ผล lab',
  `specimen_date` date NULL DEFAULT NULL COMMENT 'วันที่เก็บตัวอย่าง specimen (ค.ศ.) YYYY-MM-DD',
  `specimen_place_id` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'รหัสสถานที่เก็บตัวอย่าง อ้างอิงจากตาราง epidem_specimen_place',
  `lab_his_ref_code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'รหัส LAB อ้างอิงฝั่ง HIS',
  `lab_his_ref_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ชื่อรายการ Lab ฝั่ง HIS',
  `tmlt_code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'รหัส TMLT',
  `vaccine_hospital_code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'รหัสหน่วยบริการ ที่รับวัคซีน',
  `vaccine_date` date NULL DEFAULT NULL COMMENT 'วันที่รับวัคซีน (ค.ศ.) YYYY-MM-DD',
  `dose` int NULL DEFAULT NULL COMMENT 'เข็ม ที่',
  `vaccine_manufacturer` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ชื่อผู้ผลิตวัคซีน',
  `message_code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'code response',
  `message` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'message response',
  `request_time` datetime NOT NULL COMMENT 'เวลาrequest',
  `endpoint_port` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'endpoint port',
  `status` enum('new','sent','fail') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempt` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of d506_data_hosp
-- ----------------------------
INSERT INTO `d506_data_hosp` VALUES (1, '41173', 'กองระบาดวิทยา', 'HOMEC', '1234567891111', '', 'น.ส.', 'ทดสอบ', 'นามสกุล', '48', '2', '2000-01-01', 24, 1, 1, '1', '164', '9', '', '12', '01', '03', '', '', '{B7D7C372-829D-4877-A17B-F18D63F25114}', '', '41173', '2023-07-12 16:44:01', '2024-04-01', '2024-04-01', '2024-04-01', '2024-04-01', '', '', 'A001', '', '2', '10', '3', '0', 'N', 'N', '3', '', '', '', '12', '', '', '', '', '12', 'OPD', '', '0', '', '', '', '1', '2024-04-01', '', '2024-04-01', '2', '', '', '', '', '2024-04-01', 0, '', '', '', '2024-04-01 15:58:46', NULL, 'new', 0, '2023-07-27 13:03:14', '2023-07-27 13:03:14');

SET FOREIGN_KEY_CHECKS = 1;
