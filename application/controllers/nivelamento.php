<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nivelamento extends CI_Controller{

	function index() {
		$this->load->view('base');
		$this->load->view('nivelamento_template');
		$this->load->view('base_end');

	}

	function sendRespostas() {
		$niveis = array('ELEMENTARY', 'PRE-INTERMEDIATE', 'INTERMEDIATE', 'UPPER INTERMEDIATE', 'ADVANCED' );

		$totalQuestions = sizeof($_POST['idPergunta']);
		$questionsOk = 0;
		$correctQuestionsId = array();
		$incorrectQuestionsId = array();
		$currentLevel = $_POST['currentLevel'];
		foreach ($_POST['idPergunta'] as $key => $idPergunta) {
			if(isset($_POST['question'][$key]) && $this->ingles->validQuestion($idPergunta, $_POST['question'][$key])) {
				$questionsOk++;
				array_push($correctQuestionsId, $idPergunta);
			} else {
				array_push($incorrectQuestionsId, $idPergunta);
			}
		}
		$porcent = (float) number_format(($questionsOk*100)/$totalQuestions, 2);

		$hasNext = $porcent > 69 ? $this->ingles->hasNextLevel($currentLevel) : false;
		
		if($hasNext) {
			$nivel = $niveis[$currentLevel-1];
		} else {
			if($currentLevel > 1) {
				$nivel = $niveis[$currentLevel-2];
			} else {
				$nivel = 'INICIANTE';
			}
		}

		$result = array('percentageCorrect' => $porcent, 
						'hasNext'=> $hasNext, 
						'nextLevel' => $hasNext ? $currentLevel + 1 : null, 
						'correctQuestionsIds' => $correctQuestionsId, 
						'nivel' => $nivel, 
						'inCorrectQuestionsIds' => $incorrectQuestionsId);


		$this->ingles->setNivel($nivel);
		echo json_encode($result);
	}
}