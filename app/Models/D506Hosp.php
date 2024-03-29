<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class D506Hosp extends Model {
	protected $table = 'd506_data_hosp';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $connection = 'mysql2';
	protected $fillable = [
		'hospital_code',
		'hospital_name',
		'his_identifier',
		'cid',
		'passport_no',
		'prefix',
		'first_name',
		'last_name',
		'nationality',
		'gender',
		'birth_date',
		'age_y',
		'age_m',
		'age_d',
		'marital_status_id',
		'address',
		'moo',
		'road',
		'chw_code',
		'amp_code',
		'tmb_code',
		'mobile_phone',
		'occupation',
		'epidem_report_guid',
		'epidem_report_group_code',
		'treated_hospital_code',
		'report_datetime',
		'onset_date',
		'treated_date',
		'diagnosis_date',
		'death_date',
		'cdeath',
		'informer_name',
		'diagnosis_icd10',
		'diagnosis_icd10_list',
		'organism',
		'complication',
		'epidem_person_status_id',
		'epidem_symptom_type_id',
		'respirator_status',
		'vaccinated_status',
		'municipal',
		'epidem_address',
		'epidem_moo',
		'epidem_road',
		'epidem_chw_code',
		'epidem_amp_code',
		'epidem_tmb_code',
		'location_gis_latitude',
		'location_gis_longitude',
		'isolate_chw_code',
		'patient_type',
		'active_case_finding',
		'epidem_cluster_type_id',
		'cluster_latitude',
		'cluster_longitude',
		'comment',
		'epidem_lab_confirm_type_id',
		'lab_report_date',
		'lab_report_result',
		'specimen_date',
		'specimen_place_id',
		'lab_his_ref_code',
		'lab_his_ref_name',
		'tmlt_code',
		'vaccine_hospital_code',
		'vaccine_date',
		'dose',
		'vaccine_manufacturer',
		'message_code',
		'message',
		'request_time',
		'endpoint_port',
		'status',
		'attempt'
	];

	protected $attributes = [
		'status' =>'new',
		'attempt' => 0
	];
}
