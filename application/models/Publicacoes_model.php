<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacoes_model extends CI_Model {

	public $id;
	public $categoria;
	public $titulo;
	public $subtitulo;
	public $conteudo;
	public $data;
	public $img;
	public $user;

	public function __construct(){
		parent::__construct();
	}

	public function destaques_home(){
		/*SELECT `usuario`.`id` as `idautor`, `usuario`.`nome`, `postagens`.`id`, `postagens`.`titulo`, `postagens`.`subtitulo`, `postagens`.`user`, `postagens`.`data`, `postagens`.`img` FROM `postagens` JOIN `usuario` ON `usuario`.`id`=`postagens`.`user` ORDER BY `data` DESC LIMIT 4*/

		$this->db->select('usuario.id as idautor,
			usuario.nome, postagens.id, postagens.titulo, 
			postagens.subtitulo, postagens.user, postagens.data, postagens.img');
		$this->db->from('postagens');
		$this->db->join('usuario', 'usuario.id=postagens.user');
		$this->db->limit(4);
		//ordenar por (nomeDaColune, ordem)
		$this->db->order_by('data', 'DESC');
		//db->get faz um selec*from 'tabela'
		//essa linha abaixo poderia ser feita também da seguinte forma: $query=$this->db->get('tipo_preconceito'); 
		//return $query; 
		return $this->db->get()->result();
	}

	public function categoria_pub($id){
		$this->db->select('usuario.id as idautor,
			usuario.nome, postagens.id, postagens.titulo, 
			postagens.subtitulo, postagens.user, postagens.data, postagens.img, postagens.categoria');
		$this->db->from('postagens');
		$this->db->join('usuario', 'usuario.id=postagens.user');
		$this->db->where('postagens.categoria='.$id);
		//ordenar por (nomeDaColune, ordem)
		$this->db->order_by('data', 'DESC');
		//db->get faz um selec*from 'tabela'
		//essa linha abaixo poderia ser feita também da seguinte forma: $query=$this->db->get('tipo_preconceito'); 
		//return $query; 
		return $this->db->get()->result();

	}

		public function publicacao($id){
		$this->db->select('usuario.id as idautor,
			usuario.nome, postagens.id, postagens.titulo, 
			postagens.subtitulo, postagens.user, postagens.data, postagens.img, 
			postagens.categoria, postagens.conteudo');
		$this->db->from('postagens');
		$this->db->join('usuario', 'usuario.id=postagens.user');
		//onde id da postagem seja o igual id da postagem passado por parametro
		$this->db->where('postagens.id='.$id);
		//db->get faz um selec*from 'tabela'
		//essa linha abaixo poderia ser feita também da seguinte forma: $query=$this->db->get('tipo_preconceito'); 
		//return $query; 
		return $this->db->get()->result();

	}
	public function listar_titulo($id){
		$this->db->select('id, titulo');
		$this->db->from('postagens');
		$this->db->where('id='.$id);
		return $this->db->get()->result();
	}
	
}
