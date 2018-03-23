<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

use Core\Database\Model;

class Target extends Model {
	protected $tableName = "targets";

	public function member() {
		return $this->hasOne(Member::class, 'id');
	}

	public function organization() {
		return $this->hasOne(Organization::class, 'id');
	}

	public function deposits() {
		return $this->hasMany(Deposit::class);
	}

	public function isMember() {
		return $this->member;
	}

	public function name() {
		if($this->isMember()) {
			$member = $this->member();
			return $member->first_name . ' ' . $member->last_name;
		} else {
			return $this->organization()->title;
		}
		
	}

	public function sheets() {
		// TODO
	}

}