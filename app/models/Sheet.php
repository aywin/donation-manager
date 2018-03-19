<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Sheet extends Model {
	static $tableName = "sheets";

	public function campaign() {
		return $this->belongsTo('Campaign');
	}

	public function member() {
		return $this->belongsTo('Member');
	}

	public function sollicitations() {
		return $this->hasMany('Sollicitation');
	}

	public function targets() {
		return $this->belongsToMany('Target', 'sollicitations');
	}

	public function deposits() {
		return $this->hasManyThrough([["Deposit", "sollicitation_id"], ["Sollicitation", "sheet_id"]]);
	}

	public function getSum() {
		$primaryKey = static::$primaryKey;
		$query = "SELECT SUM(deposits.amount) as amount FROM sollicitations LEFT JOIN deposits ON sollicitations.id = deposits.sollicitation_id WHERE sollicitations.sheet_id = ?";

		return Database::query($query, [$this->$primaryKey])->amount ?? 0;
	}

}