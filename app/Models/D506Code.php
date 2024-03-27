<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class D506Code extends Model {
	protected $table = 'ref_d506_code';
	protected $primaryKey = 'id';
	protected $connection = 'mysql';
	protected $fillable = [];
	public $timestamps = false;
}
