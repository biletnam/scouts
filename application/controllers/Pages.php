<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function inschrijven()
	{
		$this->data['content'] = 'pages/inschrijven';
		$this->data['meta_title'] = 'Inschrijven';

		$this->load->view('layout/master', $this->data);
	}
}
