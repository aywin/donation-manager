<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Controllers;

use App\Models\Member;
use App\Models\Organization;

class HomeController extends Controller {

	public function index() {
		$nbrYears = 4;
		$lastYears[] = date("Y");
		for($i = 1; $i < $nbrYears; $i++) {
			$lastYears[] = $lastYears[0] - $i;
		}

		$lastYears = array_reverse($lastYears);

		$membersStats = [];
		$organizationsStats = [];
		foreach ($lastYears as $year) {
			$membersStats[] = Member::getTotal($year);
			$organizationsStats[] = Organization::getTotal($year);
		}

		return view('home', compact('lastYears', 'membersStats', 'organizationsStats'));
	}


}