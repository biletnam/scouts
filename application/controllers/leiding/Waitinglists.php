<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Waitinglists extends Leiding_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('waitinglist');
		}

		public function index() {
			$data['waitinglist'] = Waitinglist::get_all();
			$data['content'] = 'leiding/waitinglist/index';
			$data['meta_title'] = 'Wachtlijst';
			$this->load->view('leiding/_layout_main', $data);
		}

		public function details($id) {
			$data['kid'] = Waitinglist::get($id);
			$data['content'] = 'leiding/waitinglist/details';
			$data['meta_title'] = 'Wachtlijst';
			$this->load->view('leiding/_layout_main', $data);
		}

		public function edit($id = FALSE) {
			if ($this->input->get('tak') !== NULL) {
				$data['tak'] = $this->input->get('tak');
			}
			$rules = Waitinglist::get_rules();
			$this->form_validation->set_rules($rules);

			if ($id) {
				$data['kid'] = Waitinglist::get($id);
			}
			$data['tak'] = $this->input->get('tak');
			$data['content'] = 'leiding/waitinglist/edit';
			$data['meta_title'] = 'Wachtlijst';
			$this->load->view('leiding/_layout_main', $data);
		}

		public function save($id = FALSE) {
			// form validation
			$rules = Waitinglist::get_rules();
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() !== FALSE) {
				$fields = array('firstname', 'name', 'birthdate', 'address', 'zip', 'city', 'tel', 'gsm', 'email', 'tak');
				$data = Waitinglist::array_from_post($fields);

				if ($id) {
					if ($data['tel'] != '') {
						$data['tel'] = Waitinglist::format_phone($data['tel']);
					} else { 
						$data['tel'] = NULL;
					}

					if ($data['gsm'] != '') {
						$data['gsm'] = Waitinglist::format_phone($data['gsm'], TRUE);
					} else { 
						$data['gsm'] = NULL;
					}

					Waitinglist::save($data, $id);
				}
				else {
					$data['slug'] = str_replace('-', '', str_replace(' ', '', $data['firstname'])).'-'.str_replace('-', '', str_replace(' ', '', $data['name']));
					$data['tel'] = Waitinglist::format_phone($data['tel']);
					$data['gsm'] = Waitinglist::format_phone($data['gsm'], TRUE);

					Waitinglist::save($data);
				}
				redirect('leiding/ledenlijst');
			}
			else {

				$data['tak'] = $this->input->get('tak');

				$data['content'] = 'leiding/waitinglist/edit';
				$data['meta_title'] = 'Ledenlijst';
				$this->load->view('leiding/_layout_main', $data);
			}
		}

		public function delete($id) { Waitinglist::delete($id); }
	}
?>