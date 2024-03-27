<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model};
use Illuminate\Database\Eloquent\Casts\Attribute;

class Hosp2Bms extends Model
{
	protected $table = 'API_DDC';
	protected $primaryKey = 'cid';
	public $timestamps = false;
	protected $connection = 'sqlsrv';
	protected $fillable = [];
}
