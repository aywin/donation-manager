<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class MemberController extends Controller {

	public function index() {
		$members = Member::all();
		return view('member/index', compact('members'));
	}

	public function show($id) {
		$member = Member::find($id);
		$group = $member->group();
		$deposits = $member->deposits();
		$diplomas = $member->diplomas();
		$campaigns = Campaign::years();
		$faculties = Faculty::all();

		return view('member/show', compact('member', 'group', 'deposits', 'diplomas', 'campaigns', 'faculties'));

	}

	public function search() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$search = request('search');
			$members = Member::search($search);
			return view('member/index', compact('members', 'search'));
		}
	}

	public function addDiploma() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$member_diploma[] = request('member_id');
			$member_diploma[] = request('diploma_id');
			if(Model::addAssoc('member_diploma', $member_diploma)) return redirect('member/show/'.$member_diploma[0]);
			else return error("Ce membre a déjà obtenu ce dipôme!");
		}
	}

	public function removeDiploma($member_id, $diploma_id) {
		$member_diploma['member_id'] = $member_id;
		$member_diploma['diploma_id'] = $diploma_id;
		if(Model::deleteAssoc('member', 'diploma', $member_diploma)) return redirect('member/show/'.$member_diploma['member_id']);
	}

	public function create() {
		$groups = Group::all();
		return view('member/create', compact('groups'));
	}

	public function store() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$target = new Target;
			$target->member = 1;
			$id = $target->save();
			echo "hello".$id;

			echo $id;
			$member = new Member;
			$member->id = $id;
			$member->first_name = request('first_name');
			$member->last_name = request('last_name');
			$member->birthday = request('birthday');
			$member->address = request('address');
			$member->group_id = request('group_id');

			if($id = $member->save(true)) redirect("member/show/{$id}");
		} 		
	}

	public function edit($id) {
		$member = Member::find($id);
		$groups = Group::all();
		return view('member/edit', compact('member', 'groups'));
	}

	public function update($id) {
		if(requestMethod() == 'POST' && allSet() === true) {
			$member = Member::find($id);
			$member->first_name = request('first_name');
			$member->last_name = request('last_name');
			$member->birthday = request('birthday');
			$member->address = request('address');
			$member->group_id = request('group_id');
			if($id = $member->save()) redirect("member/index");
		} 
	}

	public function destroy($id) {
		$member = Member::find($id);
		if($member->delete()) redirect('member/index');
	}
	 
}