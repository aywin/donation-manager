<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

use Core\Database\Model;
use Core\Database\Database;

class Group extends Model {
	protected $tableName = "groups";

	public function members() {
		return $this->hasMany(Member::class);
	}

	public function countMembers() {
		$query = "SELECT COUNT(*) as count FROM members WHERE members.group_id = ?";
		return Database::query($query, [$this->getId()])->count ?? 0;
	}
}