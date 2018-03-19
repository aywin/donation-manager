<?php
/**
 * Projet, Base de donn�es
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

class Deposit extends Model {
	static $tableName = "deposits";

	public function target() {
		return $this->sollicitation()->target();
	}

	public function sollicitation() {
		return $this->belongsTo(Sollicitation::class);
	}

}