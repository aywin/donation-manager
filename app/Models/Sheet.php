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

class Sheet extends Model {
	protected $tableName = "sheets";

	public function campaign() {
		return $this->belongsTo(Campaign::class);
	}

	public function member() {
		return $this->belongsTo(Member::class);
	}

	public function sollicitations() {
		return $this->hasMany(Sollicitation::class);
	}

	public function targets() {
		return $this->belongsToMany(Target::class, 'sollicitations');
	}

	public function deposits() {
		return $this->hasManyThrough([[Deposit::class, "sollicitation_id"], [Sollicitation::class, "sheet_id"]]);
	}

	public function getSum() {
		$query = "SELECT SUM(deposits.amount) as amount FROM sollicitations LEFT JOIN deposits ON sollicitations.id = deposits.sollicitation_id WHERE sollicitations.sheet_id = ?";

		return Database::query($query, [$this->getId()])->amount ?? 0;
	}

}