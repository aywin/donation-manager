<?php
/**
 * Projet, Base de donn�es
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

class Faculty extends Model {
	static $tableName = "faculties";

	public function departments() {
		return $this->hasMany(Department::class);
	}

}