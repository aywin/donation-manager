<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Controllers;

use App\Models\Group;

class GroupController extends Controller {
	
	public function index() {
		$groups = Group::all();
		return view('group/index', compact('groups'));
	}

	public function show($id) {
		$group = Group::find($id);
		$members = $group->members();

		return view('group/show', compact('group', 'members'));
	}

	public function create() {
		return view('group/create');
	}

	public function store() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$group = new Group;
			$group->title = request('title');
			if($id = $group->save()) redirect("group/index");
		} 		
	}

	public function edit($id) {
		$group = Group::find($id);
		return view('group/edit', compact('group'));
	}

	public function update($id) {
		if(requestMethod() == 'POST' && allSet() === true) {
			$group = Group::find($id);
			$group->title = request('title');
			if($id = $group->save()) redirect("group/index");
		} 
	}

	public function destroy($id) {
		$group = group::find($id);
		if($group->countMembers() > 0) {
			return error("Il existe des membres dans cette comité !");
		}
		if($group->delete()) redirect('group/index');
	}		
}