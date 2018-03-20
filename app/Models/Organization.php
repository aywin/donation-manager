<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

use Core\Database\Model;
use Core\Database\Database;

class Organization extends Model {
	protected $tableName = "organizations";

	public function phones() {
		return $this->hasMany(Phone::class, 'target_id');
	}

	public function deposits() {
		return $this->hasManyThrough([[Deposit::class, "sollicitation_id"], [Sollicitation::class, "target_id"]]);
	}

	public static function getTotal($year) {
		$query = "SELECT SUM(deposits.amount) as amount FROM deposits LEFT JOIN sollicitations ON deposits.sollicitation_id = sollicitations.id RIGHT JOIN organizations ON organizations.id = sollicitations.target_id WHERE YEAR(deposits.date) = ?";

		return Database::query($query, [$year])->amount ?? 0;
	} 

}