<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

use App\Dao\Database;

class Group extends Model {
	static $tableName = "groups";

	public function members() {
		return $this->hasMany(Member::class);
	}

	public function countMembers() {
		$tableName = static::$tableName;
		$primaryKey = static::$primaryKey;

		$query = "SELECT COUNT(*) as count FROM members WHERE members.group_id = ?";
		return Database::query($query, [$this->$primaryKey])->count ?? 0;
	}
}