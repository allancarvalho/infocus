<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marcar extends CI_Controller{

	public function __construct() {
		parent::__construct();

		$this->load->library('pagseguro');
	}


	public function index()	{
		$this->load->view('base');
		$this->load->view('marcar');
		$this->load->view('base_end');
	}
    function g() {

        $date = $_POST['date'];
        $hora = $_POST['hora_inicio'];
        $duracao = $_POST['duracao'];
        if($duracao > $this->ingles->getPoints()) {
            $result = array('success' => false, 'message' => "Não tem créditos suficientes");
            echo json_encode($result);
            return false;
        }
        // echo $date;
        $date = explode('/', $date);
        $date = $date[2] . '-' . $date[1] . '-' . $date[0];
        $date = $date . ' ' . $hora;
        $time = new DateTime($date);
        $time->add(new DateInterval('PT' . $duracao . 'M'));
        

        $date_end = $time->format('Y-m-d H:i');

        $this->ingles->gravar_aula($date, $date_end, $duracao);
    }
    /**
     * Exemplo de como gerar botão de pagamento.
     */
}