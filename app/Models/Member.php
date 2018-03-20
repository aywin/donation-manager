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
use App\Services\Auth;

class Member extends Model {
	protected $tableName = "members";

	public function group() {
		return $this->belongsTo(Group::class);
	}

	public function diplomas() {
		return $this->belongsToMany(Diploma::class);
	}

	public function sheets() {
		return $this->hasMany(Sheet::class);
	}

	public function deposits() {		
		return $this->hasManyThrough([[Deposit::class, "sollicitation_id"], [Sollicitation::class, "target_id"]]);
	}

	public function phones() {
		return $this->hasMany(Phone::class, 'target_id');
	}

	public function search($search) {
		$query = "SELECT * FROM {$this->tableName} WHERE concat(first_name, ' ', last_name) LIKE ? OR concat(last_name, ' ', first_name) LIKE ?";
		$search = '%'.trim($search).'%';
		
		return $this->dao->fetchAll($query, [$search, $search], 'App\Models\Member');
	}


	public function subscriptionByYear($year) {
		$query = "SELECT SUM(deposits.amount) as amount FROM deposits LEFT JOIN sollicitations ON deposits.sollicitation_id = sollicitations.id LEFT JOIN targets ON targets.id = sollicitations.target_id WHERE targets.id = ? AND YEAR(deposits.date) = ? AND deposits.subscription = 1";

		return Database::query($query, [$this->getId(), $year])->amount ?? 0;
	}

	public function amountRequired() {
		$diplomaTable = (new Diploma)->getTableName();

		$query = "SELECT MAX(diplomas.amount) as amount FROM member_diploma LEFT JOIN {$diplomaTable} ON member_diploma.diploma_id = {$diplomaTable}.id WHERE member_diploma.member_id = ?";

		return Database::query($query, [$this->getId()])->amount;
	}

	public static function getTotal($year) {
		$query = "SELECT SUM(deposits.amount) as amount FROM deposits LEFT JOIN sollicitations ON deposits.sollicitation_id = sollicitations.id RIGHT JOIN members ON members.id = sollicitations.target_id WHERE YEAR(deposits.date) = ?";

		return Database::query($query, [$year])->amount ?? 0;
	}

}