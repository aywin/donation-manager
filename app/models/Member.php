<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Member extends Model {
	static $tableName = "members";

	public function group() {
		return $this->belongsTo('Group');
	}

	public function diplomas() {
		return $this->belongsToMany('Diploma');
	}

	public function sheets() {
		return $this->hasMany('Sheet');
	}

	public function deposits() {		
		return $this->hasManyThrough([["Deposit", "sollicitation_id"], ["Sollicitation", "target_id"]]);
	}

	public function phones() {
		return $this->hasMany('Phone', 'target_id');
	}

	public function search($search) {
		$primaryKey = static::$primaryKey;
		$tableName = static::$tableName;
		$query = "SELECT * FROM {$tableName} WHERE concat(first_name, ' ', last_name) LIKE ? OR concat(last_name, ' ', first_name) LIKE ?";
		$search = '%'.trim($search).'%';
		
		return $this->dao->fetchAll($query, [$search, $search], 'Member');
	}


	public function subscriptionByYear($year) {
		$primaryKey = static::$primaryKey;
		$query = "SELECT SUM(deposits.amount) as amount FROM deposits LEFT JOIN sollicitations ON deposits.sollicitation_id = sollicitations.id LEFT JOIN targets ON targets.id = sollicitations.target_id WHERE targets.id = ? AND YEAR(deposits.date) = ? AND deposits.subscription = 1";

		return Database::query($query, [$this->$primaryKey, $year])->amount ?? 0;
	}

	public function amountRequired() {
		$primaryKey = static::$primaryKey;
		$diplomaTable = Diploma::$tableName;

		$query = "SELECT MAX(diplomas.amount) as amount FROM member_diploma LEFT JOIN {$diplomaTable} ON member_diploma.diploma_id = {$diplomaTable}.id WHERE member_diploma.member_id = ?";

		return Database::query($query, [$this->$primaryKey])->amount;
	}

	public static function getTotal($year) {
		$query = "SELECT SUM(deposits.amount) as amount FROM deposits LEFT JOIN sollicitations ON deposits.sollicitation_id = sollicitations.id RIGHT JOIN members ON members.id = sollicitations.target_id WHERE YEAR(deposits.date) = ?";

		return Database::query($query, [$year])->amount ?? 0;
	}

	public static function lookFor($username, $password) {
		return DaoImpl::getInstance()->lookFor($username, $password);
	}

}