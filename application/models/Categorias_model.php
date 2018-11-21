<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

	public $id;
	public $titulo;


	public function __construct(){
		parent::__construct();
	}

	public function listar_categorias(){
		//order por (nomeDaColune, ordem)
		$this->db->order_by('titulo', 'ASC');
		//db->get faz um selec*from
		//essa linha abaixo poderia ser feita também da seguinte forma: $query=$this->db->get('tipo_preconceito'); 
		//return $query; 
		return $this->db->get('categoria')->result();
	}

	public function listar_titulo($id){
		$this->db->from('categoria');
		$this->db->where('id='.$id);
		return $this->db->get()->result();
	}

	public function adicionar($titulo){
		//mesmo nome da coluna
		$dados['titulo']=$titulo;
		return $this->db->insert('categoria', $dados);
	}
	
	public function excluir($id){
		$this->db->where('md5(id)', $id);
		return $this->db->delete('categoria');
	}

	public function listar_categoria($id){
		$this->db->from('categoria');
		$this->db->where('md5(id)',$id);
		return $this->db->get()->result();
	}

	public function alterar($titulo, $id){
		//de acordo com a tabela
		//$dados['id']=$id;
		$dados['titulo'] = $titulo;	
		$this->db->where('id', $id);
		return $this->db->update('categoria', $dados);

	}
	public function chartdata($id)
	{/*
		$this->db->select('sexo');
		$this->db->from('usuario');
		$this->db->where_in('select id_usuario from markers where type=1');
		return $this->db->get()->result();*/
	//"SELECT * FROM markers WHERE ".$id
      $sql = "select * from usuario where id in (select id_usuario from markers where type=".$id.")";

      $query = $this->db->query($sql);
      if ($query->num_rows() > 0) {
         return $query;
      }
	}
}
