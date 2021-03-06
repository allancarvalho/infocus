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
		$resposta_certa = $_POST['resposta'][$_POST['resposta_certa']];
		$arrPerguntas = array('pergunta' => $_POST['pergunta'], 'nivel' => $_POST['nivel'], 'reposta_certa' => '');

		// print_r($arrPerguntas);
		$id_pergunta = $this->ingles->insertQuestion($arrPerguntas);
		
		foreach ($_POST['resposta'] as $value) {
			$arrResposta = array('resposta' => $value, 'id_pergunta' =>  $id_pergunta);
			$idQuestion = $this->ingles->insertAnswers($arrResposta);
			if($value == $resposta_certa) {
				$idResposta = $idQuestion;
			}
		}

		$data = array('reposta_certa' => $idResposta);
		$this->db->where('id', $id_pergunta);
		$this->db->update('perguntas', $data); 

	}
	function getPerguntas($nivel = 1) {
		echo json_encode($this->ingles->getQuestions($nivel));
	}

	function getPergunta($id) {
		echo json_encode($this->ingles->getQuestion($id));
	}

	function editPergunta() {
		foreach ($_POST as $id=>$resposta) {
			$id = explode('-', $id);
			$id = $id[1];
			// echo $id;
			// echo $resposta;
			$this->ingles->editarResposta($id, $resposta);
		}

		echo "Ok";
	}

	function faq() {
		$this->load->view('base');
		$this->load->view('admin/faq');
		$this->load->view('base_end');
	}
	
	function getFaq() {
		echo json_encode($this->ingles->getFaq());
	}

	function deleteFaq($id) {
		$this->ingles->deleteFaq($id);
		return true;
	}

	function insertFaq() {
		$this->ingles->insertFaq($_POST['pergunta'], $_POST['resposta']);
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