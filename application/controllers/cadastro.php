<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadastro extends CI_Controller {

	function index() {

		$this->load->view('base');
		$this->load->view('cadastro');
		$this->load->view('base_end');
	}
	function send() {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];

		$additional_data = array(
			'skype' => $_POST['skype'],
			'nascimento' => $_POST['nascimento'],
			'telefone' => $_POST['telefone'],
			'cep' => $_POST['cep'],
			'endereco' => $_POST['endereco'],
			'numero' => $_POST['numero'],
			'complemento' => $_POST['complemento'],
			'bairro' => $_POST['bairro'],
			'cidade' => $_POST['cidade'],
			'uf' => $_POST['uf'],
			'pais' => $_POST['pais'],
			'questions' => json_encode($_POST['question']),
			);


		$group = array(); // Sets user to admin. No need for array('1', '2') as user is always set to member by default
		$arr = array();
		$cadastro = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
		if($cadastro) {
			$arr['success'] = true;
			$arr['messages'] = $this->ion_auth->messages();
			$arr['id'] = $cadastro;
			$this->session->set_userdata('idSigned', $arr['id']);
		} else {
			$arr['success'] = false;
			$arr['messages'] = $this->ion_auth->errors_array();
		}
		echo json_encode($arr);
	}
	function testSession() {
		
	}
	function get_nivelamento($nivel = 1) {
		$questions = array();
		if($nivel == 1) {
			$questions[0]['id'] = 0;
			$questions[0]['question'] = "Where _________ from?";

			$questions[0]['respostas'][0]['question'] = "she is?";
			$questions[0]['respostas'][0]['resposta'] = false;


			$questions[0]['respostas'][1]['question'] = "are she?";
			$questions[0]['respostas'][1]['resposta'] = true;


// a) she is b) are she c) is she d) I don’t know

// Resposta certa: c
		}
		echo json_encode($questions);
	}
}