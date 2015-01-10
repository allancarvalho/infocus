<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ingles extends CI_Model {

	public function getPoints($id = null)	{
		if($id == null) {
			$id = $this->ion_auth->user()->row()->id;
		}
		$query = $this->db->get_where('points', array('user_id' => $id));
		$result = 0;
		foreach ($query->result() as $row){
			$result = $row->points;
		}
		return floor($result/60);
	}

	public function gravar_aula($hour_start, $hour_end, $duracao) {
		$data = array(
			'id_aula' => NULL ,
			'id_user' => $id = $this->ion_auth->user()->row()->id,
			'hour_start' => $hour_start,
			'hour_end' => $hour_end,
			'duracao' => $duracao,
			'approved' => 0
			);
		$this->db->insert('aulas', $data);

		$this->db->query("UPDATE points SET  points =  ".($this->getPoints() - $duracao)." WHERE user_id  = '".$id."';");
		echo json_encode(array('success'=> true));
	}

	function saveOrder($idUser, $idPedido, $valor) {
		$data = array(
			'id_pedido' => $idPedido,
			'id_usuario' => $idUser,
			'valor' => $valor
			);
		$this->db->insert('pedidos', $data);
	}

	function setOrderApproved($id_pedido) {
		$this->db->start_cache();

		$data = array('pago' => 1);
		$this->db->where('id_pedido', $id_pedido);
		$this->db->update('pedidos', $data);

		$this->db->stop_cache();
		$this->db->flush_cache();



		$this->db->start_cache();
		$query = $this->db->get_where('pedidos', array('id_pedido' => $id_pedido));
		foreach ($query->result() as $row){
			$id_user = $row->id_usuario;
			$duracao = $row->valor;
		}

		// $query2 = $this->db->query('select * from points where	id_user = '.$id_user)->num_rows();
		$query2 = $this->db->query("SELECT * FROM `points` WHERE `user_id` =". $id_user)->num_rows();

		print_r($query2);
		if($query2 > 0) {
			echo "caiu1";

			$this->db->stop_cache();
			$this->db->flush_cache();


			$data = array(
				'points' => $this->getPoints($id_user) + $duracao
				);

			$this->db->where('user_id', $id_user);
			$this->db->update('points', $data); 
		} else {
			echo "caiu2";
			$data = array(
				'points' => $duracao,
				'user_id' => $id_user
				);
			$this->db->insert('points', $data); 

		}

	}

	function get_aulas($all = false) {

		if($this->ion_auth->is_admin()) {

			$this->db->select('*');
			$this->db->from('aulas');
			if($all == false) {
				$this->db->where('approved', 0); 
			}
			if($all == true) {
				$this->db->where('approved', 1); 
				$this->db->where('hour_start >= NOW()', '', false); 
			}
			$this->db->join('users', 'users.id = aulas.id_user');

			return $this->db->get();
		}
	}

	function editarResposta($id, $resposta) {
		$data = array('resposta' => $resposta);

		$this->db->where('id', $id);
		$this->db->update('respostas', $data); 

	}

	function desconfirmar($id) {
		if($this->ion_auth->is_admin()) {

			$this->db->start_cache();
			$query = $this->db->get_where('aulas', array('id_aula' => $id));
			$duracao = reset($query->result())->duracao;
			$id_user = reset($query->result())->id_user;
			$this->db->stop_cache();
			$this->db->flush_cache();

			$this->db->delete('aulas', array('id_aula' => $id)); 

			$data = array(
				'points' => $this->getPoints($id_user) + $duracao
				);

			$this->db->where('user_id', $id_user);
			$this->db->update('points', $data); 
		}
	}

	function confirmar($id) {
		if($this->ion_auth->is_admin()) {

			$data = array('approved' => 1);

			$this->db->where('id_aula', $id);
			$this->db->update('aulas', $data); 

			return true;
		}
	}

	function insertQuestion($arr) {
		$this->db->insert('perguntas', $arr); 
		return $this->db->insert_id();
	}

	function insertAnswers($arr) {
		$this->db->insert('respostas', $arr); 

		return $this->db->insert_id();
	}

	function deletePergunta($id){
		$this->db->delete('perguntas', array('id' => $id)); 
	}

	function getQuestion($id) {
		if($this->ion_auth->is_admin()) {
			$select = 'id, pergunta, nivel, reposta_certa';
		} else {
			$select = 'id, pergunta, nivel';
		}
		$this->db->start_cache();
		
		$this->db->select($select);

		$query = $this->db->get_where('perguntas', array('id' => $id));

		$this->db->stop_cache();
		$this->db->flush_cache();


		$result = $query->result();


		foreach ($result as $value) {
			$this->db->select('id, resposta');
			$query2 = $this->db->get_where('respostas', array('id_pergunta' => $value->id));
			$result2 = $query2->result();
			if(!$this->ion_auth->is_admin()) {
				shuffle($result2);
			}
			$value->respostas = $this->array_randsort($result2);
		}

		return $result[0];
	}

	function getQuestions($nivel) {

		if($this->ion_auth->is_admin()) {
			$select = 'id, pergunta, nivel, reposta_certa';
		} else {
			$select = 'id, pergunta, nivel';
		}
		$this->db->start_cache();
		
		$this->db->select($select);

		$query = $this->db->get_where('perguntas', array('nivel' => $nivel));

		$this->db->stop_cache();
		$this->db->flush_cache();


		$result = $query->result();


		foreach ($result as $value) {
			$this->db->select('id, resposta');
			$query2 = $this->db->get_where('respostas', array('id_pergunta' => $value->id));
			$result2 = $query2->result();
			if(!$this->ion_auth->is_admin()) {
				shuffle($result2);
			}
			$value->respostas = $this->array_randsort($result2);
		}

		return $result;
	}
	function array_randsort($array,$preserve_keys=false){
		if(!is_array($array)):
			exit('Supplied argument is not a valid array.');
		else:
			$i = NULL;
		$array_length = count($array); 
		$randomize_array_keys = array_rand($array,$array_length);
		if($preserve_keys===true) {		
			foreach($randomize_array_keys as $k=>$v){
				$randsort[$randomize_array_keys[$k]] = $array[$randomize_array_keys[$k]];
			}
		} else {
			for($i=0; $i < $array_length; $i++){
				$randsort[$i] = $array[$randomize_array_keys[$i]];
			}
		}
		return $randsort;
		endif;
	}

	function hasNextLevel($currentLevel = 1) {
		$query = $this->db->get_where('perguntas', array('nivel' => $currentLevel + 1));
		return $query->num_rows > 0;
	}
	function validQuestion($id_pergunta, $id_resposta) {
		$query = $this->db->get_where('perguntas', array('id' => $id_pergunta, 'reposta_certa' => $id_resposta));
		return $query->num_rows > 0;
	}

	function setNivel($nivel) {
		$this->db->start_cache();
		if($this->ion_auth->logged_in()) {
			$id = $this->ion_auth->user()->row()->id;
		} else {
			$id = $this->session->userdata('idSigned');
		}
		$query = $this->db->get_where('nivel', array('id_user' => $id) );
		$this->db->stop_cache();
		$this->db->flush_cache();

		if($query->num_rows > 0) {
			$data = array(
				'nivel' => $nivel
				);
			$this->db->where('id_user', $id);
			$this->db->update('nivel', $data); 
		} else {
			$data = array(
				'id_user' => $id,
				'nivel' => $nivel
				);
			$this->db->insert('nivel', $data);
		}

	}
	function getFaq() {
		return $this->db->get('faq')->result();
	}

	function insertFaq($pergunta, $resposta) {
		$data = array(
			'pergunta' => $pergunta,
			'resposta' => $resposta
			);
		$this->db->insert('faq', $data);

		return true;
	}

	function deleteFaq($id) {
		$this->db->delete('faq', array('id' => $id)); 

		return true;
	}

	function getNivel($id) {
		$query = $this->db->get_where('nivel', array('id_user' => $id) );
		$result = "";
		foreach ($query->result() as $row){
			$result = $row->nivel;
		}
		return $result;
	}

	function hasNivel($id = null) {
		if($id == null) {
			$id = $this->ion_auth->user()->row()->id;
		}
		$query = $this->db->get_where('nivel', array('id_user' => $id) );
		return $query->num_rows > 0;
	}
}

?>