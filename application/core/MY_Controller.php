<?php
	class MY_Controller extends CI_Controller {
		
		public function __construct(){
			parent::__construct();

			$this->load->library('pagination');
			$this->data['errors'] = array();
			$this->data['sitename'] = config_item('site_name');
		}
	}

	class Leiding_Controller extends MY_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->model('leader');
			$this->load->model('authenticate');

			$exception_uris = array('login', 'login/logout', 'auth/validate', 'schakeltje', 'nieuws');

			if(!in_array(uri_string(), $exception_uris))
			{	
				if(!Authenticate::is_logged_in()) {
					redirect('login');
				}
			}
		}
	}
?>