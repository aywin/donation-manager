<?php
/**
 * Projet, Base de donn�es
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Department extends Model {
	static $tableName = "departments";

	public function diplomas() {
		return $this->hasMany('Diploma');
	}

	public function faculty() {
		return $this->belongsTo('Faculty');
	}
}