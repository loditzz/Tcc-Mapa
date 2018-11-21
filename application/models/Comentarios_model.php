<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comentarios_model extends CI_Model {

	public $id;
	public $titulo;
	public $comentario;
	public $dataHora;
	public $idusuario;
	public $idocorrencia;

	public function __construct(){
		parent::__construct();
	}


	public function listar_comentarios($id){
		$this->db->select('id, titulo, comentario, dataHora');
		$this->db->from('comentario');
		$this->db->where('idocorrencia='.$id);
		return $this->db->get()->result();
	}

	public function adicionar($titulo, $comentario, $dataHora, $idusuario, $idocorrencia){
		//mesmo nome da coluna
		$dados['titulo']=$titulo;
		$dados['comentario']=$comentario;
		$dados['dataHora']=$dataHora;
		$dados['idusuario']=$idusuario;
		$dados['idocorrencia']=$idocorrencia;
		
		return $this->db->insert('comentario', $dados);
	}
	
}
