<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()	{
		$data['result'] = $this->ingles->get_aulas()->result();
		$data['all'] = $this->ingles->get_aulas(true)->result();
		
		$this->load->view('base');
		$this->load->view('agenda', $data);
		$this->load->view('base_end');


	}
	
	function desconfirmar($id) {
		$this->ingles->desconfirmar($id);
	}
	function confirmar($id) {
		$this->ingles->confirmar($id);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */