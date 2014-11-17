<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends CI_Controller {

	public function index()	{
		$this->load->view('base');
		$this->load->view('contato');
		$this->load->view('base_end');
	}

	function send() {
		$this->load->library('email');
		// $_POST = $_GET;
		// print_r($_POST);


		$this->load->library('email');

		$this->email->from('infocusvir@gmail.com', $_POST['email']);
		$this->email->to('infocusvir@gmail.com'); 

		$this->email->subject($_POST['assunto']);
		$this->email->message($_POST['mensagem']);	

		
		$data= array();
		if($this->email->send()) {
			$data['success'] = true;
		} else {
			$data['success'] = false;
		}

		// print_r($data);

		// echo $this->email->print_debugger();

		$this->load->view('base');
		$this->load->view('contato', $data);
		$this->load->view('base_end');


	}
}
?>