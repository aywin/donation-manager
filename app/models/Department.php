<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

class Department extends Model {
	static $tableName = "departments";

	public function diplomas() {
		return $this->hasMany(Diploma::class);
	}

	public function faculty() {
		return $this->belongsTo(Faculty::class);
	}
}