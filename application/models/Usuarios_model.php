<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public $id;
	public $nome;
	public $email;
	public $sexo;
	public $senha;

	public function __construct(){
		parent::__construct();
	}


	public function listar_autor($id){
		$this->db->select('id, nome, sexo');
		$this->db->from('usuario');
		$this->db->where('id='.$id);
		return $this->db->get()->result();
	}
	public function listar_autores(){
		$this->db->select('id, nome, sexo');
		$this->db->from('usuario');
		$this->db->order_by('nome', 'ASC');
		return $this->db->get()->result();
	}
	public function adicionar($nome, $email, $sexo, $senha){
		//mesmo nome da coluna
		$dados['nome']=$nome;
		$dados['email']=$email;
		$dados['sexo']=$sexo;
		$dados['senha']=md5($senha);
		return $this->db->insert('usuario', $dados);
	}
	public function excluir($id){
		$this->db->where('md5(id)', $id);
		return $this->db->delete('usuario');
	}
	public function listar_usuario($id){
		$this->db->select('id, nome, email, sexo');
		$this->db->from('usuario');
		$this->db->where('md5(id)', $id);
		return $this->db->get()->result();
	}
	public function alterar($nome, $email, $sexo, $senha, $id){
		//mesmo nome da coluna
		$dados['nome']=$nome;
		$dados['email']=$email;
		$dados['sexo']=$sexo;
		$dados['senha']=md5($senha);
		$dados['id']=$id;
		$this->db->where('id', $id);
		return $this->db->update('usuario', $dados);

	}
}
