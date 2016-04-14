<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notify extends CI_Controller {

	public function init(){


		if(!file_exists(APPPATH.'/config/database.php'))
		{
			redirect('install');
			exit;
		}


		//----
		$db = $this->load->database('default', TRUE);
		$query = $db->get('settings');
		$records =  $query->result_array();

		$params = [];
		if($records){
			$settings = [];
			foreach ($records as $item){
				$settings[$item['setting_key']] = $item;
			}
			$prod_type  = @$settings['installation_type']['setting']?$settings['installation_type']['setting']:'trial';
			if($prod_type =='enterprise'){
				header('Location: ../index.php');
				exit;
			}
			$trial_days = $settings['trial_days']['setting'];
			//$trial_days = 1;
			$installed_date = $settings['trial_days']['ts'];
			$params = $this->getTrialParams($trial_days, $installed_date);

		}

		return $this->load->view('notify/index', $params);

	}

	public function getTrialParams($trial_days, $installed_date)
	{
		$results = [];
		if($trial_days && $installed_date){
			$now = time(); // or your date as well
			$your_date = strtotime($installed_date);
			$elaspe_seconds = $now - $your_date;

			$trial_seconds =  (($trial_days * 24) * 60) * 60;
			$diff_seconds = $trial_seconds - $elaspe_seconds;
			$remained_days = floor($diff_seconds/(60*60*24));

			$results = [
				'seconds_left' =>@$diff_seconds?$diff_seconds:0,
				'days_left' => @$remained_days?$remained_days:0
			];
		}
		return $results;

	}
}