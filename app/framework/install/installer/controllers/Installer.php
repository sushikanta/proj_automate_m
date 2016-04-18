<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Installer extends CI_Controller {

	public function init()
	{

		if(file_exists('../../config.php'))
		{
			header('Location: ../../index.php');
			exit;
		}

		$this->load->helper(array('form', 'file', 'url'));
		$this->load->library(array('form_validation'));

		$cartPath = dirname(FCPATH);

		$testConfig = is_writeable($cartPath.'/application/config/');
		$testUploads = is_writeable($cartPath.'/uploads/');
		$testIntl = class_exists('Locale');

		$errors = (!$testConfig)?'<div class="alert alert-danger" role="alert">The folder "'.$cartPath.'/application/config" must be writable.</div>':'';
		$errors .= (!$testUploads)?'<div class="alert alert-danger" role="alert">The folder "'.$cartPath.'/uploads" must be writable.</div>':'';
		//$errors .= (!$testIntl)?'<div class="alert alert-danger" role="alert">The PHP_INTL Library is required for GoCart and is not installed on your server. <a href="http://php.net/manual/en/book.intl.php">Read More</a></div>':'';

		$this->form_validation->set_rules('hostname', 'Hostname', 'required');
		$this->form_validation->set_rules('database', 'Database Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'trim');
		$this->form_validation->set_rules('prefix', 'Database Prefix', 'trim');

		$this->form_validation->set_rules('business_title', 'Busintee Title', 'required');
		$this->form_validation->set_rules('business_contact', 'Contact No', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');

		if ($this->form_validation->run() == FALSE || $errors != '')
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			$errors .= validation_errors();

			$this->load->view('index', ['errors'=>$errors]);
		}
		else
		{
			$dbCred = $this->input->post();

			//test the database
			mysqli_report(MYSQLI_REPORT_STRICT);

			try
			{
				$con = mysqli_connect($dbCred['hostname'], $dbCred['username'], $dbCred['password']);
			}
			catch (Exception $e )
			{
				$errors = '<div class="alert alert-danger" role="alert">There was an error connecting to the database</div>';
				$this->load->view('index', ['errors'=>$errors]);
				return;
			}

			// Make my_db the current database
			$db_selected = mysqli_select_db($con, $dbCred['database']);
			if ($db_selected && !@$dbCred['preserve_db']){
				$sql = 'DROP DATABASE '.$dbCred['database'];

				if (mysqli_query($con, $sql)) {
					echo "Database my_db DROPPED successfully\n";
					mysqli_select_db($con, $dbCred['database']);
					$db_selected = false;
				}
			}

			if (!$db_selected) {
				// If we couldn't, then it either doesn't exist, or we can't see it.
				$sql = 'CREATE DATABASE '.$dbCred['database'];

				if (mysqli_query($con, $sql)) {
					echo "Database my_db created successfully\n";
					mysqli_select_db($con, $dbCred['database']);
					$newly_created = true;
				} else {
					$errors = '<div class="alert alert-danger" role="alert">Unable to create Database "'.$dbCred['database'].'" </div>';
					$this->load->view('index', ['errors'=>$errors]);
					return;
				}
			}

			//create the database file
			$database_file_content = $this->load->view('core_database', $this->input->post(), true);
			$myfile = fopen('../../config.php', "w");
			fwrite($myfile, $database_file_content);
			fclose($myfile);
			//--------
			$database_file_content_2 = $this->load->view('database', $this->input->post(), true);
			$myfile_2 = fopen($cartPath.'/application/config/database.php', "w");
			fwrite($myfile_2, $database_file_content_2);
			fclose($myfile_2);
			//--------
			if(true || @$newly_created){
				$sql = file_get_contents(FCPATH.'database_automate.sql');
				$con->multi_query($sql); // run the dump
				while ($con->more_results() && $con->next_result()) {;} //run through it

				if(@$newly_created){
					//set some basic information in settings
					$query = "INSERT INTO `settings` (`code`, `setting_key`, `setting`) VALUES
					('default', 'business_title', '".@$dbCred['business_title']."'),
					('default', 'business_contact', '".@$dbCred['business_contact']."'),
					('default', 'email', '".@$dbCred['email']."'),
					('default', 'regd_no', '".@$dbCred['regd_no']."'),
					('default', 'installed_on', '".date('Y-m-d h:i:s')."'),
					('default', 'installation_type', '".$this->config->item('installation_type')."'),
					('default', 'trial_days', '".$this->config->item('trial_days')."'),
					('default', 'app_name', '".$this->config->item('app_name')."'),
					('default', 'address', '".@$dbCred['address']."');";
					$con->query($query);
				}else{
					mysqli_query($con,"DELETE FROM settings WHERE setting_key != 'installed_on'");
					$query = "INSERT INTO `settings` (`code`, `setting_key`, `setting`) VALUES
					('default', 'business_title', '".@$dbCred['business_title']."'),
					('default', 'business_contact', '".@$dbCred['business_contact']."'),
					('default', 'email', '".@$dbCred['email']."'),
					('default', 'regd_no', '".@$dbCred['regd_no']."'),
					('default', 'installation_type', '".$this->config->item('installation_type')."'),
					('default', 'trial_days', '".$this->config->item('trial_days')."'),
					('default', 'app_name', '".$this->config->item('app_name')."'),
					('default', 'address', '".@$dbCred['address']."');";
					$con->query($query);

				}



			}


			$con->close();

			//$url  = dirname((isset($_SERVER['HTTPS'])?'https://':'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']).'/admin';

			header('Location: ../../index.php?reset=true');
			exit;
		}

	}

}
