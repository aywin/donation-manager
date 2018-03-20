<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Controllers;

use App\Models\Department;
use App\Models\Faculty;


class DepartmentController extends Controller {

	public function index() {

	}

	public function show($id) {
		$department = Department::find($id);
		$diplomas = $department->diplomas();
		$faculty = $department->faculty();

		return view('department/show', compact('department', 'diplomas', 'faculty'));
	}

	public function create() {
		$faculties = Faculty::all();
		return view('department/create', compact('faculties'));
	}

	public function store() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$department = new Department;
			$department->title = request('title');
			$department->faculty_id = request('faculty_id');
			if($id = $department->save()) redirect('faculty/show/'.$department->faculty_id);
		} 
		
	}

	public function edit($id) {
		$department = Department::find($id);
		$faculties = Faculty::all();
		return view('department/edit', compact('department', 'faculties'));
	}

	public function update($id) {
		if(requestMethod() == 'POST' && allSet() === true) {
			$department = Department::find($id);
			$department->title = request('title');
			$department->faculty_id = request('faculty_id');
			if($id = $department->save()) redirect('faculty/show/'.$department->faculty_id);
		} 
	}

	public function destroy($id) {
		$department = department::find($id);
		if($department->delete()) redirect('faculty/show/'.$department->faculty_id);
	}

}