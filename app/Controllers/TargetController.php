<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Controllers;

use App\Models\Target;

class TargetController extends Controller {


	public function show($id) {
		$target = Target::find($id);
		if($target->isMember()) redirect('member/show/'.$target->id);
		else redirect('organization/show/'.$target->id);
	}

}