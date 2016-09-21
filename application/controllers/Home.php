<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$this->load->model('article');
		$this->data['articles'] = Article::get_frontpage(2);
		$this->data['content'] = 'pages/home';
		$this->data['meta_title'] = 'Hoofdpagina';

		$this->load->view('layout/master', $this->data);
	}
}