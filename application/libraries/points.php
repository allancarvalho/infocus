<?php

class Points {
	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->model('ingles'); 
	}

	function getPoints($id) {
		return $this->CI->ingles->getPoints($id);
	}	

	function hasNivel($id) {
		return $this->CI->ingles->hasNivel($id);
	}
	function getNivel($id) {
		return $this->CI->ingles->getNivel($id);
	}
}