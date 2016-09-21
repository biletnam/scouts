<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	public function index()
	{
		$this->data['content'] = 'pages/contact';
		$this->data['meta_title'] = 'Contact';

		$this->load->view('layout/master', $this->data);
	}

	public function send()
	{
		if ($this->input->post('message') != NULL) {
			$data = array (
				'email' => $this->input->post('email'),
				'message' => $this->input->post('message'),
			);

			$this->load->library('email');

			$this->email->from($this->input->post('email'), '18BP');
			$this->email->to('webmaster18bp.be');

			$this->email->subject('Bericht aan de webmaster');
			$this->email->message($this->load->view('email/default', $data));

			$this->email->send();
			$this->session->set_flashdata('success', 'Uw bericht is verzonden!.');
		} else {
			$this->session->set_flashdata('errors', 'U dient een bericht in te geven om te verzenden.');
		}
		return redirect('contact');
	}
}
