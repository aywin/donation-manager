<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class DepositController extends Controller {

	public function index() {
		$deposits = Deposit::all();
		// return view('deposit/index', compact('deposits'));
	}

	public function show($id) {
		$deposit = Deposit::find($id);
		$sollicitation = $deposit->sollicitation();
		$target = $sollicitation->target();	
		$campaign = $sollicitation->sheet()->campaign();
		// return view('deposit/show', compact('deposit', 'sollicitation', 'target', 'campaign'));
	}

	public function create($f_id,$s_id = 0) {
		$sheet = sheet::find($f_id);
		$sollicitation = Sollicitation::find($s_id);
		if($sollicitation) $target = $sollicitation->target();

		return view('deposit/create', compact('sollicitation', 'target', 'sheet'));
	}

	public function store() {
		if (requestMethod() == 'POST' && allSet() === true) {
			$sollicitation = Sollicitation::find(request('sollicitation_id'));					
			$target = $sollicitation->target();

			$deposit = new Deposit;
			$deposit->amount = request('amount');
			$deposit->subscription = false;
			$deposit->sollicitation_id = request('sollicitation_id');
			$deposit->date = request('date');

			if($deposit->date < $sollicitation->date) {
				return  error("Date de la cotribution avant la sollicitation, hein ?!");
			}

			if(getYear($deposit->date) != getYear($sollicitation->date)) {
				return error("La contribution doit être enregistrée pendant la même année de la compagne.");
			}

			if ($target->isMember()) {

				$member = $target->member();
				$campaign = $sollicitation->sheet()->campaign();

				if(($sum = $member->subscriptionByYear($campaign->year)) < ($required = $member->amountRequired())) {
					$deposit->subscription = true;
					if($sum + $deposit->amount > $required) {					
						$secondDeposit = clone $deposit;
						$secondDeposit->subscription = false;
						$secondDeposit->amount = $deposit->amount + $sum - $required;					

						$deposit->amount = $required - $sum;
					}
				}
			}

			if(isset($secondDeposit)) {
				if ($deposit->save() && $secondDeposit->save()) redirect('sheet/show/'.$sollicitation->sheet()->id);
			} else {
				if ($deposit->save()) redirect('sheet/show/'.$sollicitation->sheet()->id);
			}
		} 		
	}

	public function edit($id) {
		$deposit = Deposit::find($id);
		$sollicitation = $deposit->sollicitation();
		$target = $sollicitation->target();
		return view('deposit/edit', compact('deposit', 'sollicitation', 'target'));
	}

	public function update($id) {
		if(requestMethod() == 'POST' && allSet() === true) {
			$sollicitation = Sollicitation::find(request('sollicitation_id'));

			$deposit = Deposit::find($id);
			$deposit->amount = request('amount');
			$deposit->subscription = false;
			$deposit->sollicitation_id = request('sollicitation_id');
			$deposit->date = request('date');

			if($deposit->date < $sollicitation->date) {
				return  error("Date de la cotribution avant la sollicitation, hein ?!");
			}

			if(getYear($deposit->date) != getYear($sollicitation->date)) {
				return error("La contribution doit être enregistrée pendant la même année de la compagne.");
			}

			if ($target->isMember()) {

				$member = $target->member();
				$campaign = $sollicitation->sheet()->campaign();

				if(($sum = $member->subscriptionByYear($campaign->year)) < ($required = $member->amountRequired())) {
					$deposit->subscription = true;
					if($sum + $deposit->amount > $required) {					
						$secondDeposit = clone $deposit;
						$secondDeposit->subscription = false;
						$secondDeposit->amount = $deposit->amount + $sum - $required;					

						$deposit->amount = $required - $sum;
					}
				}
			}

			if(isset($secondDeposit)) {
				if ($deposit->save() && $secondDeposit->save()) redirect('sheet/show/'.$sollicitation->sheet()->id);
			} else {
				if ($deposit->save()) redirect('sheet/show/'.$sollicitation->sheet()->id);
			}
		} 
	}

	public function destroy($id) {
		$deposit = Deposit::find($id);
		$sollicitation = $deposit->sollicitation();
		if($deposit->delete()) redirect('sheet/show/'.$sollicitation->sheet()->id);
	}	
}