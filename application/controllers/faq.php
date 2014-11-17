<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {

	function index() {

		$this->load->view('base');
		$this->load->view('faq');
		$this->load->view('base_end');
	}
}
?>