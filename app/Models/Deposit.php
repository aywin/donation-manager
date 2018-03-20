<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

use Core\Database\Model;

class Deposit extends Model {
	protected $tableName = "deposits";

	public function target() {
		return $this->sollicitation()->target();
	}

	public function sollicitation() {
		return $this->belongsTo(Sollicitation::class);
	}

}