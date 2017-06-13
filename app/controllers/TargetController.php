<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class TargetController extends Controller {


	public function show($id) {
		$target = Target::find($id);
		if($target->isMember()) redirect('member/show/'.$target->id);
		else redirect('organization/show/'.$target->id);
	}

}