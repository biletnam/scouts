<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class News extends Leiding_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('article');
		}

		public function index() {
			$data['articles'] = Article::get();
			$data['content'] = 'pages/news';
			$data['meta_title'] = 'Nieuws';

			if ($this->session->userdata('loggedin')) {
				$this->load->view('leiding/_layout_main', $data);
			} else {
				$this->load->view('layout/master', $data);
			}
		}

		public function edit($id = FALSE) {
			if ($id) { $data['article'] = Article::get($id); }

			$data['content'] = 'leiding/news/edit';
			$data['meta_title'] = 'Nieuws';
			$this->load->view('leiding/_layout_main', $data);
		}
		
		public function save($id = FALSE) {

			$rules = Article::get_rules();
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				$fields = array('body', 'title');
				$data = Article::array_from_post($fields);

				if ($id) { Article::save($data, $id); }
				else { Article::save($data); }
			}

			return redirect('leiding/nieuws');
		}

		public function delete($id) { Article::delete($id); }
	}
?>