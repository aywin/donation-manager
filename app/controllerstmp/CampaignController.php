<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Controllers;


use App\Models\Campaign;

class CampaignController extends Controller {

	public function index() {
		$campaigns = Campaign::all();
		return view('campaign/index', compact('campaigns'));
	}

	public function show($id) {
		$campaign = Campaign::find($id);
		$sheets = $campaign->sheets();

		return view('campaign/show', compact('campaign', 'sheets'));
	}

	public function create() {
		return view('campaign/create');
	}

	public function store() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$campaign = new Campaign;
			$campaign->year = request('year');
			if($id = $campaign->save()) redirect('campaign/index');
		} 		
	}

	public function edit($id) {
		$campaign = campaign::find($id);
		return view('campaign/edit', compact('campaign'));
	}

	public function update($id) {
		if(requestMethod() == 'POST' && allSet() === true) {
			$campaign = Campaign::find($id);
			$campaign->year = request('year');
			if($id = $campaign->save()) redirect('campaign/index');
		} 
	}

	public function destroy($id) {
		$campaign = Campaign::find($id);
		if($campaign->delete()) redirect('campaign/index');
	}	
}