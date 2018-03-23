<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Controllers;

use App\Models\Organization;
use App\Models\Target;

class OrganizationController extends Controller {
	
	public function index() {
		$organizations = Organization::all();

		return view('organization/index', compact('organizations'));
	}

	public function show($id) {
		$organization = Organization::find($id);
		$phones = $organization->phones();
		$deposits = $organization->deposits();

		return view('organization/show', compact('organization', 'phones', 'deposits'));
	}

	public function create() {
		return view('organization/create');
	}

	public function store() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$target = new Target;
			$target->member = 0;
			$id = $target->save();

			$organization = new Organization;
			$organization->id = $id;
			$organization->title = request('title');

			if($organization->save(true)) redirect("organization/show/{$id}");
		} 		
	}

	public function edit($id) {
		$organization = Organization::find($id);
		return view('organization/edit', compact('organization'));
	}

	public function update($id) {
		if(requestMethod() == 'POST' && allSet() === true) {
			$organization = Organization::find($id);
			$organization->title = request('title');
			if($id = $organization->save()) redirect("organization/index");
		} 
	}

	public function destroy($id) {
		$organization = Target::find($id);
		if($organization->delete()) redirect('organization/index');
	}	
}