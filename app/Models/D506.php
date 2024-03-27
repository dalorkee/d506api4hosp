<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Carbon\Carbon;

class D506 extends Model {
	protected $table = 'd506_data';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $connection = 'mysql';
	protected $fillable = [
		'id',
		'data',
		'cid',
		'passport_no',
		'prefix',
		'first_name',
		'last_name',
		'gender',
		'epidem_report_guid',
		'hn',
		'reg_no',
		'visit_date',
		'diag_date',
		'last_diag_date',
		'last_update',
		'message_code',
		'message',
		'request_time',
		'endpoint_port',
		'status',
		'attempt',
	];

	protected function visitDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->getMySqlDateToHis(date: $value),
			set: fn ($value) => $this->setHisDateToMySql(date: $value),
		);
	}

	public function getMySqlDateToHis($date=null): ?string {
		return (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) ? Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y') : "";
	}

	public function setHisDateToMySql($date=null): ?string {
		if (preg_match("/^([2][5][0-9][0-9][0-9][0-9][0-9][0-9])$/", $date)) {
			$year = ((int)Str::substr($date, 0, 4)-543);
			$month = Str::substr($date, 4, 2);
			$day = Str::substr($date, 6, 2);
			$result = $year.'-'.$month.'-'.$day;
			return $result;
		} else {
			return null;
		}
	}

}
