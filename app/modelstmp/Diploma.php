<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

class Diploma extends Model {
	static $tableName = "diplomas";

	public function department() {
		return $this->belongsTo(Department::class);
	}

}