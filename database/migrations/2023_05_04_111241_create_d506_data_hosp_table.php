<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('d506_data_hosp', function (Blueprint $table) {
			$table->id()->comment('id');

			$table->string('hospital_code', 15)->nullable()->comment('รหัสหน่วยบริการ (รหัสมาตรฐาน 5 หลัก) ที่ส่งข้อมูล');
			$table->string('hospital_name', 90)->nullable()->comment('ชื่อหน่วยบริการที่ส่งข้อมูล');
			$table->string('his_identifier', 90)->nullable()->comment('ชื่อหน่วยบริการหรือ ข้อมูลอื่นๆที่อ้างอิง รพ.');

			$table->string('cid', 30)->nullable(false)->comment('เลขบัตรประจำตัวประชาชน');
			$table->string('passport_no', 30)->nullable()->comment('เลขที่หนังสือเดินทาง');
			$table->string('prefix', 30)->nullable(false)->comment('คำนำหน้าชื่อ');
			$table->string('first_name', 120)->nullable(false)->comment('ชื่อผู้ป่วย');
			$table->string('last_name', 120)->nullable(false)->comment('นามสกุลผู้ป่วย');
			$table->string('nationality', 30)->nullable()->comment('รหัสสัญชาติ ใช้รหัสมาตรฐาน 43 แฟ้ม');
			$table->string('gender',  9)->nullable(false)->comment('เพศ (1= ชาย, 2 = หญิง)');
			$table->date('birth_date')->nullable(false)->comment('วันเกิด ปี ค,ศ. YYYY-MM-DD');
			$table->integer('age_y')->nullable(false)->comment('อายุ (ปี)');
			$table->integer('age_m')->nullable(false)->comment('อายุ (เดือน)');
			$table->integer('age_d')->nullable(false)->comment('อายุ (วัน)');
			$table->string('marital_status_id', 9)->nullable()->comment('สถานะภาพสมรส (1=โสด, 2=คู่, 3=หย่าร้าง, 4=หม้าย, 5=ไม่ทราบ, 6=สมณะ)');
			$table->string('address', 30)->nullable(false)->comment('ที่อยู่ปัจจุบัน');
			$table->string('moo', 9)->nullable()->comment('หมู่ที่');
			$table->string('road', 90)->nullable()->comment('ถนน');
			$table->string('chw_code', 6)->nullable(false)->comment('รหัสจังหวัดที่อยู่ปัจจุบัน');
			$table->string('amp_code', 6)->nullable(false)->comment('รหัสอำเภออยู่ปัจจุบัน');
			$table->string('tmb_code', 6)->nullable(false)->comment('รหัสตำบลอยู่ปัจจุบัน');
			$table->string('mobile_phone', 30)->nullable()->comment('เบอร์โทรศัพท์');
			$table->string('occupation', 30)->nullable()->comment('รหัสอาชีพ (อ้างอิง 43 แฟ้ม)');

			$table->string('epidem_report_guid', 120)->nullable(false)->comment('"{73F287FF-5924-FFFF-B80A-8993A1349DAE}" unique และมีความยาว 38 ตัวอักษรตาม uuid-v4 UID ของข้อมูลที่รายงานครั้งนี้ ใช้อ้างอิงการส่งข้อมูลรายงานครั้งนี้ กรณีส่งมาแก้ไขให้ใช้รหัสเดิม');
			$table->string('epidem_report_group_code', 10)->nullable(false)->comment('รหัสโรคทางระบาดวิทยา ');
			$table->string('treated_hospital_code', 10)->nullable(false)->comment('รหัสโรงพยาบาลที่กำลังรักษาตัว');
			$table->dateTime('report_datetime')->nullable(false)->comment('"2021-12-12T09:00:00.000" ** UTC + 7 วันที่/เวลา ที่รายงานโรค');
			$table->date('onset_date')->nullable()->comment('วันที่เริ่มมีอาการ (ค.ศ.) YYYY-MM-DD');
			$table->date('treated_date')->nullable()->comment('วันที่เริ่มรักษา (ค.ศ.)  YYYY-MM-DD');
			$table->date('diagnosis_date')->nullable()->comment('วันที่วินิจฉัยโรค  (ค.ศ.)YYYY-MM-DD');
			$table->date('death_date')->nullable()->comment('วันที่เสียชีวิต (ค.ศ.)YYYY-MM-DD');
			$table->text('cdeath')->nullable()->comment('Died with หรือ Died from COVID-19 สาเหตุการเสียชีวิต Free text');
			$table->string('informer_name', 120)->nullable()->comment('ชื่อผู้รายงาน');
			$table->string('diagnosis_icd10', 90)->nullable(false)->comment('รหัส ICD10 หลัก');
			$table->string('diagnosis_icd10_list', 90)->nullable(false)->comment('“J149,J189" รหัส ICD10 รอง ผลการวินิจฉัยอื่นๆ กรณีมีเพียง principle_diagnosis ให้ส่งเป็นตัวเดียวกันเข้ามา ');
			$table->string('organism', 6)->nullable()->comment('ชนิดของเชื้อ เลข 2 หลัก');
			$table->string('complication', 3)->nullable()->comment('ภาวะแทรกซ้อน เลข 1 หลัก');
			$table->string('epidem_person_status_id', 3)->nullable(false)->comment('สถานะผู้ป่วย  (1 = หายจากโรคแล้ว, 2 = เสียชีวิต , 3 = ยังรักษาอยู่, 4 = ไม่ทราบ)');
			$table->string('epidem_symptom_type_id', 3)->nullable()->comment('อาการที่แสดง (1 = ไม่มีอาการ , 2 = มีอาการที่ ไม่รุนแรง , 3 = มีอาการที่รุนแรง เช่น ปอดบวม)');
			$table->string('respirator_status', 3)->nullable(false)->comment('ใส่เครื่องช่วยหายใจ (Y = ใส่, N=ไม่ใส่) ถ้าไม่ทราบให้ default เป็น N');
			$table->string('vaccinated_status', 3)->nullable()->comment('มีประวัติการได้รับวัคซีน Y / N');
			$table->string('municipal', 3)->nullable(false)->comment('เขตเทศบาล(1 = ในเขตเทศบาล  2 = อบต.  3 = ไม่ทราบ)');
			$table->string('epidem_address', 30)->nullable()->comment('ที่อยู่ บ้านเลขที่ขณะสำรวจว่าเป็นโรค');
			$table->string('epidem_moo', 30)->nullable()->comment('ที่อยู่ หมู่ ขณะสำรวจว่าเป็นโรค');
			$table->string('epidem_road', 30)->nullable()->comment('ที่อยู่ ถนน ขณะสำรวจว่าเป็นโรค');
			$table->string('epidem_chw_code', 6)->nullable(false)->comment('ที่อยู่ รหัสจังหวัด ขณะสำรวจว่าเป็นโรค');
			$table->string('epidem_amp_code', 6)->nullable()->comment('ที่อยู่ รหัสอำเภอ ขณะสำรวจว่าเป็นโรค');
			$table->string('epidem_tmb_code', 6)->nullable()->comment('ที่อยู่ รหัสตำบล ขณะสำรวจว่าเป็นโรค');
			$table->string('location_gis_latitude', 30)->nullable()->comment('พิกัด Latitude GIS float value WGS84');
			$table->string('location_gis_longitude', 30)->nullable()->comment('พิกัด Longitude GIS float value WGS84');
			$table->string('isolate_chw_code', 6)->nullable(false)->comment('รหัสจังหวัดที่ isolate / รับรักษาผู้ป่วย');
			$table->string('patient_type', 9)->nullable(false)->comment('ประเภทผู้ป่วย (OPD / IPD / ACF)');
			$table->text('active_case_finding')->nullable()->comment('ใช้สำหรับบันทึกค้นหาในชุมชนเพิ่ม หรือบันทึกจาก web portal active case finding ค้นหาผู้ป่วยเชิงรุก Free text');
			$table->string('epidem_cluster_type_id', 30)->nullable()->comment('รหัสของกลุ่ม cluster (ตัวเลือกจากตาราง epidem_cluster)');
			$table->string('cluster_latitude', 30)->nullable()->comment('พิกัด Latitude GIS float value WGS84 ของ cluster');
			$table->string('cluster_longitude', 30)->nullable()->comment('พิกัด Longitude GIS float value WGS84  ของ cluster');
			$table->string('comment', 191)->nullable()->comment('คำอธิบายเพิ่มเติม อื่นๆ');

			$table->string('epidem_lab_confirm_type_id', 15)->nullable()->comment('ผลการตรวจที่ยืนยันการติดเชื้อ อ้างอิงจากตาราง epidem_lab_confirm_type');
			$table->date('lab_report_date')->nullable()->comment('วันที่รายงานผล LAB(ค.ศ.) YYYY-MM-DD');
			$table->string('lab_report_result', 120)->nullable()->comment('ผล lab');
			$table->date('specimen_date')->nullable()->comment('วันที่เก็บตัวอย่าง specimen (ค.ศ.) YYYY-MM-DD');
			$table->string('specimen_place_id', 30)->nullable()->comment('รหัสสถานที่เก็บตัวอย่าง อ้างอิงจากตาราง epidem_specimen_place');
			$table->string('lab_his_ref_code', 30)->nullable()->comment('รหัส LAB อ้างอิงฝั่ง HIS');
			$table->string('lab_his_ref_name', 30)->nullable()->comment('ชื่อรายการ Lab ฝั่ง HIS');
			$table->string('tmlt_code', 30)->nullable()->comment('รหัส TMLT');

			$table->string('vaccine_hospital_code', 30)->nullable()->comment('รหัสหน่วยบริการ ที่รับวัคซีน');
			$table->date('vaccine_date')->nullable()->comment('วันที่รับวัคซีน (ค.ศ.) YYYY-MM-DD');
			$table->integer('dose')->nullable()->comment('เข็ม ที่');
			$table->string('vaccine_manufacturer', 120)->nullable()->comment('ชื่อผู้ผลิตวัคซีน');

			$table->string('message_code', 30)->nullable(false)->comment('code response');
			$table->string('message', 191)->nullable(false)->comment('message response');
			$table->dateTime('request_time')->nullable(false)->comment('เวลาrequest');
			$table->string('endpoint_port', 30)->nullable()->comment('endpoint port');
			$table->enum('status', ['new', 'sent', 'fail']);
			$table->integer('attempt')->default(0);
			$table->timestamps();

			$table->charset = 'utf8mb4';
			$table->collation = 'utf8mb4_unicode_ci';
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('d506');
	}
};
