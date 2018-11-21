<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		//chama o construtor da classe pai
		parent::__construct();

		//checa de o usuário está logado
		if (!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}
	}

	public function index()
	{	//dados a serem enviados para o cabeçalho
		$dados['titulo']='Painel de Controle';
		$dados['subtitulo'] = 'Home';
		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/home');
		$this->load->view('backend/template/html-footer');
	}

	public function sendXML() {
		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);
		$this->load->model('MapData');
		$mapdata = new MapData();

		foreach ( $mapdata->getmappoints()->result() as $row ) {
			$node = $dom->createElement("marker");
			$newnode = $parnode->appendChild($node);
			$newnode->setAttribute("name", $row->name);
			$newnode->setAttribute("address", $row->address);
			$newnode->setAttribute("lat", $row->lat);
			$newnode->setAttribute("lng", $row->lng);
			$newnode->setAttribute("type", $row->type);
		}
		header("Content-type: text/xml");
		echo $dom->saveXML();
	}
	
}
