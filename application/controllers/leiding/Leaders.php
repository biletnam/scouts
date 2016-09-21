<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Leaders extends Leiding_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('leader');
		}

		public function index() {
			$data['leaders'] = Leader::get_users();
			$data['content'] = 'leiding/leaders/index';
			$data['meta_title'] = 'Gebruikers';
			$this->load->view('leiding/_layout_main', $data);
		}

		public function edit($id = FALSE) {
			$rules = Leader::get_rules();
			$this->form_validation->set_rules($rules);

			if ($id) {
				$data['leader'] = Leader::get_one($id);
			}
			$data['type'] = $this->input->get('type');
			$data['content'] = 'leiding/leaders/edit';
			$data['meta_title'] = 'Gebruikers';
			$this->load->view('leiding/_layout_main', $data);
		}

		public function save($id = FALSE) {

			// form validation
			$rules = Leader::get_rules();
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() !== FALSE) {
				$fields = array('username', 'nickname', 'show_nick', 'type');
				$data = Leader::array_from_post($fields);
				
				if ($id) { Leader::save($data, $id); }
				else { Leader::save($data); }
				
				return redirect('leiding/gebruikers');
			} else {
				$this->session->set_flashdata('edit-errors', 'Het formulier is niet correct ingevuld. Gelieve dit nog eens na te kijken.');
				
				$data['leader'] = Leader::get_one($id);
				$data['content'] = 'leiding/leaders/edit';
				$data['meta_title'] = 'Gebruikers';
				$this->load->view('leiding/_layout_main', $data);
			}
		}

		public function delete($id) { Leader::delete($id); }
	}
?>