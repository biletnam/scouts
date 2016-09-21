<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schakeltje extends Leiding_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('schakeltjes');
	}
	public function index()
	{
		$this->data['meta_title'] = 'Schakeltjes';
		$this->data['schakels'] = Schakeltjes::get_all();
		$this->data['content'] = 'pages/schakeltje';
		$this->load->view('layout/master', $this->data);
	}

	public function add()
	{
		$this->load->helper('form');

		// config
		$config['upload_path'] = './schakeltjes/';
		$config['allowed_types'] = 'pdf';
		$config['overwrite'] = TRUE;
		
		// upload
		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		$data['upload_data'] = '';
    
		if (!$this->upload->do_upload('schakeltje')) {
			$this->session->set_flashdata('errors', $this->upload->display_errors());
		}
		else {
     	 	$data['upload_data'] = $this->upload->data();
     	 	Schakeltjes::add($data['upload_data']['raw_name']);
		}
		
		redirect('schakeltje');
	}

	public function delete($id)
	{
		//artikel met $id verwijderen
		$this->schakel_model->delete($id);
		redirect('leiding/schakeltje');
	}
}