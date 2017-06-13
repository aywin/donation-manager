<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Deposit extends Model {
	static $tableName = "deposits";

	public function target() {
		return $this->sollicitation()->target();
	}

	public function sollicitation() {
		return $this->belongsTo('Sollicitation');
	}

}