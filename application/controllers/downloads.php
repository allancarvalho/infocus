<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads extends CI_Controller {

	function index() {
		$this->load->View('base');
		$this->load->View('downloads');
		$this->load->View('base_end');
	}
}

	?>