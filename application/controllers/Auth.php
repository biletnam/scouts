<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Auth extends Leiding_Controller
	{
		public function __construct() { parent::__construct(); }

		public function index() {
			Authenticate::is_logged_in() == FALSE || redirect('leiding/home');
			
			$data['content'] = 'auth/login';
			$data['meta_title'] = 'Aanmelden';
			$this->load->view('layout/master', $data);
		}

		public function validate() {

			// add validation rules
			$rules = Authenticate::get_rules();
			$this->form_validation->set_rules($rules);
			
			// form validation
			if ($this->form_validation->run()) {
				// redirect after login
				if(Authenticate::validate($this->input->post('username'), $this->input->post('password'))) {
					redirect('leiding/home');
				}
				else {
					$this->session->set_flashdata('login-errors', 'De gebruikersnaam of het wachtwoord is niet juist.');
					redirect('home');
				}
			}
			else {
				$this->session->set_flashdata('login-errors', 'Fout bij inloggen. Gelieve na te kijken of u beide velden correct hebt ingevuld.');
				redirect('login');
			}
		}

		public function logout() { Authenticate::logout(); }
	}
?>