<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class SheetController extends Controller {

	public function index() {
		$sheets = Sheet::all();
		return view('sheet/index', compact('sheets'));
	}

	public function show($id) {
		$sheet = Sheet::find($id);
		$member = $sheet->member();
		$targets = $sheet->targets();
		$deposits = $sheet->deposits();
		$campaign = $sheet->campaign();
		$sollicitations = $sheet->sollicitations();

		return view('sheet/show', compact('sheet', 'member', 'targets', 'deposits', 'campaign', 'sollicitations'));
	}

	public function create() {
		$campaigns = Campaign::all();
		$members = Member::all();		
		return view('sheet/create', compact('campaigns', 'members'));
	}

	public function store() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$sheet = new Sheet;
			$sheet->member_id = request('member_id');
			$sheet->campaign_id = request('campaign_id');
			$sheet->start_date = request('start_date');
			$sheet->end_date = request('end_date');

			$campaign = Campaign::find($sheet->campaign_id);

			if($sheet->start_date > $sheet->end_date) {
				return error("Intervalle des dates non valide !");
			}

			if(getYear($sheet->start_date) != $campaign->year OR getYear($sheet->end_date) != $campaign->year) {
				return error("Les dates n'appartiennent pas à l'année de la compagne.");
			}

			if($id = $sheet->save()) redirect("sheet/show/{$id}");
		} 		
	}

	public function edit($id) {
		$sheet = Sheet::find($id);
		$campaigns = Campaign::all();
		$members = Member::all();
		return view('sheet/edit', compact('sheet', 'campaigns', 'members'));
	}

	public function update($id) {
		if(requestMethod() == 'POST' && allSet() === true) {
			$sheet = Sheet::find($id);
			$sheet->member_id = request('member_id');
			$sheet->campaign_id = request('campaign_id');
			$sheet->start_date = request('start_date');
			$sheet->end_date = request('end_date');

			$campaign = Campaign::find($sheet->campaign_id);
			
			if($sheet->start_date > $sheet->end_date) {
				return error("Intervalle des dates non valide !");
			}

			if(strftime("%Y", strtotime($sheet->start_date)) != $campaign->year OR strftime("%Y", strtotime($sheet->end_date)) != $campaign->year) {
				return error("Les dates n'appartiennent pas à l'année de la compagne.");
			}			
						
			if($id = $sheet->save()) redirect("sheet/show/{$id}");
		} 
	}

	public function destroy($id) {
		$sheet = Sheet::find($id);
		if($sheet->getSum() > 0) {
			return error("Il existe des contributions liées à cette fiche !");
		}
		if($sheet->delete()) redirect('sheet/index');
	}	
}