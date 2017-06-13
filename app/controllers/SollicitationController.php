<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class SollicitationController extends Controller {

	public function index() {
		$sollicitations = Sollicitation::all();
		return view('sollicitation/index', compact('sollicitations'));
	}

	public function show($id) {
		$sollicitation = Sollicitation::find($id);
		$sheets = $sollicitation->sheets();

		return view('sollicitation/show', compact('sollicitation', 'sheets'));
	}

	public function create($id) {
		$members = Member::all();
		$organizations = Organization::all();
		$sheet = Sheet::find($id);		
		return view('sollicitation/create', compact('members', 'organizations', 'sheet'));
	}

	public function store() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$sheet = Sheet::find(request('sheet_id'));

			$sollicitation = new Sollicitation;
			$sollicitation->target_id = request('target_id');
			$sollicitation->sheet_id = request('sheet_id');
			$sollicitation->date = request('date');

			if($sollicitation->date > $sheet->end_date || $sollicitation->date < $sheet->start_date) {
				return error("La date n'appartient pas à l'intervalle de la fiche de sollicitation !");
			}

			if($sollicitation->save()) redirect('sheet/show/'.$sollicitation->sheet_id);
		} 		
	}

	public function edit($id) {
		$members = Member::all();
		$organizations = Organization::all();
		$sollicitation = Sollicitation::find($id);
		return view('sollicitation/edit', compact('sollicitation', 'members', 'organizations'));
	}

	public function update($id) {
		if(requestMethod() == 'POST' && allSet() === true) {

			$sollicitation = Sollicitation::find($id);
			$sheet = Sheet::find($sollicitation->sheet_id);
			$sollicitation->target_id = request('target_id');
			$sollicitation->date = request('date');

			if($sollicitation->date > $sheet->end_date || $sollicitation->date < $sheet->start_date) {
				return error("La date n'appartient pas à l'intervalle de la fiche de sollicitation !");
			}


			if($sollicitation->save()) redirect('sheet/show/'.$sollicitation->sheet_id);
		} 
	}

	public function destroy($id) {
		$sollicitation = Sollicitation::find($id);
		if($sollicitation->delete()) redirect('sheet/show/'.$sollicitation->sheet_id);
	}	
}