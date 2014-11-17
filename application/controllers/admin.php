<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function teste_nivelamento() {
		$this->load->view('base');
		$this->load->view('admin/teste_nivelamento');
		$this->load->view('base_end');
	}

	function cadastrar_teste_nivelamento() {
		// print_r($_POST);
		// return false;
		
		$arrPerguntas = array('pergunta' => $_POST['pergunta'], 'nivel' => $_POST['nivel'], 'reposta_certa' => $_POST['resposta'][$_POST['resposta_certa']]);

		// print_r($arrPerguntas);
		$id_pergunta = $this->ingles->insertQuestion($arrPerguntas);
		
		foreach ($_POST['resposta'] as $value) {
			$arrResposta = array('resposta' => $value, 'id_pergunta' =>  $id_pergunta);
			$this->ingles->insertAnswers($arrResposta);
		}

	}
	function getPerguntas($nivel = 1) {
		echo json_encode($this->ingles->getQuestions($nivel));
	}

	function deletePergunta($id) {
		$this->ingles->deletePergunta($id);
	}
	function perguntas_cadastradas() {
		$this->load->view('base');
		$this->load->view('admin/perguntas_cadastradas');
		$this->load->view('base_end');
	}
 
}