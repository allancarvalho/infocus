<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {

	function index() {

		$this->load->view('base');
		$arr['questions'] = $this->ingles->getFaq();
		$this->load->view('faq', $arr);
		$this->load->view('base_end');
	}
}
?>