<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Organization extends Model {
	static $tableName = "organizations";

	public function phones() {
		return $this->hasMany('Phone', 'target_id');
	}

	public function deposits() {
		return $this->hasManyThrough([["Deposit", "sollicitation_id"], ["Sollicitation", "target_id"]]);
	}

	public static function getTotal($year) {
		$query = "SELECT SUM(deposits.amount) as amount FROM deposits LEFT JOIN sollicitations ON deposits.sollicitation_id = sollicitations.id RIGHT JOIN organizations ON organizations.id = sollicitations.target_id WHERE YEAR(deposits.date) = ?";

		return static::query($query, [$year])->amount ?? 0;
	} 

}