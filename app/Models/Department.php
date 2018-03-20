<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

use Core\Database\Model;

class Department extends Model {
	protected $tableName = "departments";

	public function diplomas() {
		return $this->hasMany(Diploma::class);
	}

	public function faculty() {
		return $this->belongsTo(Faculty::class);
	}
}