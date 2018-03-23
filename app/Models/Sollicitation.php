<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

use Core\Database\Model;

class Sollicitation extends Model {
	protected $tableName = "sollicitations";

	public function target() {
		return $this->belongsTo(Target::class);
	}

	public function sheet() {
		return $this->belongsTo(Sheet::class);
	}

	public function deposits() {
		return $this->hasMany(Deposit::class);
	}
	
}