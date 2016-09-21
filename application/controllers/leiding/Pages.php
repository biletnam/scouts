<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Pages extends Leiding_Controller {
		public function __construct() { parent::__construct(); }

		public function index() {
			$data['content'] = 'leiding/pages/dashboard';
			$data['meta_title'] = 'Dashboard';
			$this->load->view('leiding/_layout_main', $data);
		}

		public function details($uri) {
			$data['content'] = 'leiding/pages/'.$uri;
			$data['meta_title'] = ucfirst($uri);
			$this->load->view('leiding/_layout_main', $data);
		}
	}
?>