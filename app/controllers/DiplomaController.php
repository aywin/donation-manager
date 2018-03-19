<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Controllers;

use App\Models\Diploma;

class DiplomaController extends Controller {

	public function index() {
		$diplomas = Diploma::all();
		return view('diploma/index', compact('diplomas'));
	}

	public function show($id) {
		$diploma = Diploma::find($id);
		$department = $diploma->department();
		$faculty = $department->faculty();

		return view('diploma/show', compact('diploma', 'department', 'faculty'));
	}

	public function create() {
		$faculties = Faculty::all();
		return view('diploma/create', compact('faculties'));
	}

	public function store() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$diploma = new Diploma;
			$diploma->title = request('title');
			$diploma->department_id = request('department_id');
			$diploma->amount = request('amount');
			if($id = $diploma->save()) redirect('department/show/'.$diploma->department_id);
		} 
		
	}

	public function edit($id) {
		$diploma = Diploma::find($id);
		$faculties = Faculty::all();
		return view('diploma/edit', compact('diploma', 'faculties'));
	}

	public function update($id) {
		if(requestMethod() == 'POST' && allSet() === true) {
			$diploma = Diploma::find($id);
			$diploma->title = request('title');
			$diploma->department_id = request('department_id');
			$diploma->amount = request('amount');
			if($id = $diploma->save()) redirect('department/show/'.$diploma->department_id);
		} 
	}

	public function destroy($id) {
		$diploma = Diploma::find($id);
		if($diploma->delete()) redirect('department/show/'.$diploma->department_id);
	}

}