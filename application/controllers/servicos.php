<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicos extends CI_Controller {

	// function index() {
	// 	$this->load->view("base");
	// 	$this->load->view("servicos");

	// 	$this->load->view("base_end");
	// }
	function index() {
		$this->load->view("base");
		$this->load->view("servicos_english");

		$this->load->view("base_end");
	}

	function portuguese() {
		$this->load->view("base");
		$this->load->view("servicos_portuguese");

		$this->load->view("base_end");
	}

}