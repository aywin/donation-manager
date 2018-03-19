<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

class Sollicitation extends Model {
	static $tableName = "sollicitations";

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