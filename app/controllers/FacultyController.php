<?php
/**
 * Projet, Base de donn�es
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class FacultyController extends Controller {

	public function index() {
		$faculties = Faculty::all();
		return view('faculty/index', compact('faculties'));
	}

	public function show($id) {
		$faculty = Faculty::find($id);
		$departments = $faculty->departments();

		return view('faculty/show', compact('faculty', 'departments'));
	}

	public function create() {
		return view('faculty/create');
	}

	public function store() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$faculty = new Faculty;
			$faculty->title = request('title');
			if($id = $faculty->save()) redirect("faculty/index");
		} 	
	}

	public function edit($id) {
		$faculty = Faculty::find($id);
		return view('faculty/edit', compact('faculty'));
	}

	public function update($id) {
		if(requestMethod() == 'POST' && allSet() === true) {
			$faculty = Faculty::find($id);
			$faculty->title = request('title');
			if($id = $faculty->save()) redirect("faculty/index");
		} 
	}

	public function destroy($id) {
		$faculty = Faculty::find($id);
		if($faculty->delete()) redirect("faculty/index");
	}

}