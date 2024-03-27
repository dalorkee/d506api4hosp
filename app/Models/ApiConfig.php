<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiConfig extends Model {
	protected $table = 'api_config';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $connection = 'mysql';
	protected $fillable = [
		'moph_token_enpoint',
		'moph_send_506_enpoint',
		'moph_username',
		'moph_password',
		'moph_password_hash',
		'moph_token',
		'moph_token_expire',
		'hosp_name',
		'hosp_code',
	];
}
