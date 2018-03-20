<?php
/**
 * Projet, Base de donn�es
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

use Core\Database\Model;

class Phone extends Model {
	protected $tableName = "phones";

	public function target() {
		return $this->belongsTo(Target::class);
	}
}