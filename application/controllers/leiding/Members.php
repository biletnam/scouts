<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Members extends Leiding_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('member');
		}

		public function index() {
			$data['members'] = Member::get_all();
			$data['admin'] = Leader::has_permission('administratie');
			$data['content'] = 'leiding/members/index';
			$data['meta_title'] = 'Ledenlijst';
			$this->load->view('leiding/_layout_main', $data);
		}

		public function details($id) {
			$data['member'] = Member::get($id);
			$data['content'] = 'leiding/members/details';
			$data['meta_title'] = 'Ledenlijst';
			$this->load->view('leiding/_layout_main', $data);
		}

		public function edit($id = FALSE) {
			if (Leader::has_permission('administratie')) {
				$rules = Member::get_rules();
				$this->form_validation->set_rules($rules);

				if ($id) {
					$data['member'] = Member::get($id);
				}
				$data['tak'] = $this->input->get('tak');
				$data['content'] = 'leiding/members/edit';
				$data['meta_title'] = 'Ledenlijst';
				$this->load->view('leiding/_layout_main', $data);
			} else {
				return redirect('leiding/dashboard');
			}
		}

		public function save($id = FALSE) {
			// form validation
			$rules = Member::get_rules();
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() !== FALSE) {
				$fields = array('firstname', 'name', 'birthdate', 'address', 'zip', 'city', 'tel', 'gsm', 'email', 'tak', 'paid', );
				$data = Member::array_from_post($fields);

				if ($id) {
					if ($data['tel'] != '') {
						$data['tel'] = Member::format_phone($data['tel']);
					} else { 
						$data['tel'] = NULL;
					}

					if ($data['gsm'] != '') {
						$data['gsm'] = Member::format_phone($data['gsm'], TRUE);
					} else { 
						$data['gsm'] = NULL;
					}

					Member::save($data, $id);
				}
				else {
					$data['slug'] = str_replace('-', '', str_replace(' ', '', $data['firstname'])).'-'.str_replace('-', '', str_replace(' ', '', $data['name']));
					$data['tel'] = Member::format_phone($data['tel']);
					$data['gsm'] = Member::format_phone($data['gsm'], TRUE);

					Member::save($data);
				}
				redirect('leiding/ledenlijst');
			}
			else {

				$data['tak'] = $this->input->get('tak');

				$data['content'] = 'leiding/members/edit';
				$data['meta_title'] = 'Ledenlijst';
				$this->load->view('leiding/_layout_main', $data);
			}
		}

		public function delete($id) {
			if (Leader::has_permission('administratie')) {
				Member::delete($id);
			} else {
				return redirect('leiding/dashboard');
			}
		}

		public function toggle_paid($id) {
			if (Leader::has_permission('administratie')) {
				return Member::toggle_paid($id);
			} else {
				return redirect('leiding/dashboard');
			}
		}
	}
?>