<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Models;

use Core\Database\Model;
use Core\Database\Database;

class Campaign extends Model {
	protected $tableName = "campaigns";

	public function sheets() {
		return $this->hasMany(Sheet::class);
	}

	public static function years() {
		return Database::queryAll("SELECT DISTINCT year FROM {(new static)->tableName}");
	}
}