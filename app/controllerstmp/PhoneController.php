<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Controllers;

use App\Models\Phone;

class PhoneController extends Controller {

	public function index() {
		
	}

	public function show($id) {
	}

	public function create() {
		
	}

	public function store() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$phone = new Phone;
			$phone->number = request('number');
			$phone->target_id = request('target_id');
			if($phone->save()) redirect('target/show/'.$phone->target_id);
		} 		
	}

	public function edit($id) {
		$phone = Phone::find($id);
		$target = $phone->target();
		return view('phone/edit', compact('phone', 'target'));
	}

	public function update($id) {
		if(requestMethod() == 'POST' && allSet() === true) {
			$phone = Phone::find($id);
			$phone->number = request('number');
			if($phone->save()) redirect('target/show/'.$phone->target_id);
		} 
	}

	public function destroy($id) {
		$phone = Phone::find($id);
		if($phone->delete()) redirect('target/show/'.$phone->target_id);
	}	
}