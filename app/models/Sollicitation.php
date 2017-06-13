<?php
/**
 * Projet, Base de donn�es
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Sollicitation extends Model {
	static $tableName = "sollicitations";

	public function target() {
		return $this->belongsTo('Target');
	}

	public function sheet() {
		return $this->belongsTo('Sheet');
	}

	public function deposits() {
		return $this->hasMany('Deposit');
	}
	
}