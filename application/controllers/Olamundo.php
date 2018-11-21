<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Olamundo extends CI_Controller {

	public function index()
	{
		$dados['mensagem']='Ola mundo!';
		$this->load->view('olamundo', $dados);
	}

	public function teste()
	{

		$dados['mensagem']='testenado!';
		$this->load->view('olamundo', $dados);
	}

	public function testedb()
	{

		$dados['mensagem']=$this->db->get('markers')->result();
		echo "<pre>";
		print_r($dados);
	}
}
