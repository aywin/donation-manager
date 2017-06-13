<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Faculty extends Model {
	static $tableName = "faculties";

	public function departments() {
		return $this->hasMany('Department');
	}

}