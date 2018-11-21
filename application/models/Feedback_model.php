<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_model extends CI_Model {

	public $id;
	public $titulo;
	public $feedback;
	public $dataHora;
	public $idusuario;

	public function __construct(){
		parent::__construct();
	}


	public function adicionar($titulo, $feedback, $dataHora, $idusuario){
		//mesmo nome da coluna
		$dados['feedbtitulo']=$titulo;
		$dados['feedback']=$feedback;
		$dados['feedbdatahora']=$dataHora;
		$dados['feedbidusuario']=$idusuario;
		
		return $this->db->insert('feedb', $dados);
	}
	
}
