<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Den18 extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->model('Tak');
		$this->load->model('Leader');

		$this->data['content'] = 'den18/groep';
		$this->data['takken'] = Tak::get_all();
		$this->data['leaders'] = Leader::get_all();
		$this->data['meta_title'] = 'Den 18';

		$this->load->view('layout/master', $this->data);
	}
	public function geschiedenis()
	{
		$this->data['content'] = 'den18/geschiedenis';
		$this->data['meta_title'] = 'Geschiedenis';

		$this->load->view('layout/master', $this->data);
	}
	public function unform()
	{
		$this->data['content'] = 'den18/uniform';
		$this->data['meta_title'] = 'Uniform';

		$this->load->view('layout/master', $this->data);
	}
}
