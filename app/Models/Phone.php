<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

class Phone extends Model {
	static $tableName = "phones";

	public function target() {
		return $this->belongsTo(Target::class);
	}
}