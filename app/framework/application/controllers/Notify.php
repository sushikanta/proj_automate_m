<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notify extends CI_Controller {

	public function init(){
		$this->data['var_app_version'] =  "automate-m-v-1";
		$this->data['var_app_type_arr'] =  [
			'15' => 'gGxEd7rxMP',
			'30' => 'Un9wDQE6i2',
			'90' => 'O6zSVzJJpr',
			'365' => '8C31LazG05',
			'730' => '3KY8AG8Sb6',
			'1' => 'YN29tx8p2F',
		];

		if(!file_exists(APPPATH.'/config/database.php'))
		{
			redirect('install');
			exit;
		}


		//----
		$this->db = $this->load->database('default', TRUE);
		$query = $this->db->get_where('settings',  array('code' => 'app_key'));
		$records =  $query->result_array();

		$params = [];
		if($records){
			$settings = [];
			foreach ($records as $item){
				$settings[$item['setting_key']] = $item;
			}
			$result = $this->evaluateKeys($settings);
			$trial_days = @$result['activated_days']?$result['activated_days']:0;
			$installed_date = @$result['activated_date']?$result['activated_date']:'2000-01-01 01:00:00';
			$params = $this->getTrialParams($trial_days, $installed_date);

		}
		if(@$this->uri->segments[2] == 'activate'){
			$results = [];
			$data = $this->input->post();
			if(@$data['key']){
				$ret_data = $this->verifyKey($data);
				if(@$ret_data['success']){
					$this->db->delete('settings', array('code' => 'app_key'));
					$data = array(
						array('code' => 'app_key' ,'setting_key' => 'key_1' ,'setting' => $ret_data['key_1']),
						array('code' => 'app_key' ,'setting_key' => 'key_2' ,'setting' => $ret_data['key_2']),
						array('code' => 'app_key' ,'setting_key' => 'key_3' ,'setting' => $ret_data['key_3']),
					);
					$this->db->insert_batch('settings', $data);
					$results['success'] = true;
					$results['message']= 'The key has been successfully registered & the product has been re-activated for '.@$ret_data['activated_days'].' days';
				}elseif(@$ret_data['key_exists']){
					$results['already_exists'] = true;
					$results['message']= 'Please enter a new key to activate.';
				}
			}
			header('Content-Type: application/json');
			echo json_encode( $results );
		}else{
			$params['system_key'] = $this->getSystemKey();
			return $this->load->view('notify/index', $params);
		}


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



	public function verifyKey($options = []) {
		// options = [generate][ktype]
		$var_app_version = $this->data['var_app_version'];
		//--------
		ob_start();
		system('ipconfig /all');
		$mycom=ob_get_contents();
		ob_clean();
		$findme = "Physical";
		$pmac = strpos($mycom, $findme);
		$secret_key =substr($mycom,($pmac+36),17);
		//--------
		$var_app_type_arr = $this->data['var_app_type_arr'];
		$var_app_type = isset($options['ktype'])?$options['ktype']:'gGxEd7rxMP';

		if(isset($options['generate'])){
			$data = $var_app_version.$var_app_type;
			return hash_hmac('sha256',$data,$secret_key);
		}
		$result = [];
		if(isset($options['key'])){
			$key_matched = false;
			$activated_days = 0;
			//--precheck key for pre-existance
			$query = $this->db->get_where('settings',  array('code' => 'app_key', 'setting_key' => 'key_2','setting' =>$options['key']));
			$records =  $query->result_array();
			if(count($records)){
				return ['key_exists' => true];
			}

			foreach ($var_app_type_arr AS $key => $item){
				if($key_matched){
					continue;
				}
				$data = $var_app_version.$item;
				$possible_key = hash_hmac('sha256',$data,$secret_key);
				if($possible_key == $options['key']){
					$key_matched = true;
					$activated_days = $key;
				}
			}
			if($key_matched){
				$result = [
					'success' => true,
					'activated_days' => $activated_days,
					'key_1' => base64_encode($secret_key),
					'key_2' => $options['key'],
					'key_3' =>  base64_encode(date('Y-m-d H:i:s')),

				];
			}

		}
		return $result;
	}


	public function evaluateKeys($settings = []){
		if(count($settings) == 3 && @$settings['key_1']['setting'] && @$settings['key_2']['setting'] && @$settings['key_3']['setting']){
			$key_1 = base64_decode($settings['key_1']['setting']);
			$key_2 = $settings['key_2']['setting'];
			$key_3 = base64_decode($settings['key_3']['setting']);

			//--checking whether key 1 is valid or not
			ob_start();
			system('ipconfig /all');
			$mycom=ob_get_contents();
			ob_clean();
			$findme = "Physical";
			$pmac = strpos($mycom, $findme);
			$secret_key =substr($mycom,($pmac+36),17);
			//--------
			if($key_1 != $secret_key){
				return false;
			}

			//--checking whether key 3 is valid or not
			$d = DateTime::createFromFormat('Y-m-d H:i:s', $key_3);
			if(!($d && $d->format('Y-m-d H:i:s') === $key_3)){
				return false;
			}

			$key_matched = false;
			$var_app_version = $this->data['var_app_version'];
			$var_app_type_arr = $this->data['var_app_type_arr'];
			foreach ($var_app_type_arr AS $key => $item){
				if($key_matched){
					continue;
				}
				$data = $var_app_version.$item;
				$possible_key = hash_hmac('sha256',$data,$secret_key);
				if($possible_key == $key_2){
					$key_matched = true;
					$activated_days = $key;
					$result = array(
						'activated_days' =>$key,
						'activated_date' =>$key_3,
					);
					return $result;
				}
			}
		}
		return false;

	}


	public function getSystemKey(){
		ob_start();
		system('ipconfig /all');
		$mycom=ob_get_contents();
		ob_clean();
		$findme = "Physical";
		$pmac = strpos($mycom, $findme);
		$secret_key =substr($mycom,($pmac+36),17);
		return implode('-', str_split((str_replace('-','', $secret_key)), 4));
	}

}