<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		//chama o construtor da classe pai
		parent::__construct();
		$this->load->model('MapData','modelocorrencias');
		//lista os tipos de preconceito
		$this->tipo = $this->modelocorrencias->listar_tipos();
	}

	public function index()
	{
		//cria um array para guardar os tipos de preconceito
		$dados['tipos'] = $this->tipo;
		//carrega o model publicações
		//esse model está sendo carregado aqui porque ele não é requerido em todas as páginas
		//somente na página de index
		$this->load->model('publicacoes_model','modelpublicacoes');
		//joga para a variavel markers (que estará disponível na view) o return da função destaques_home();
		$dados['postagem']=$this->modelpublicacoes->destaques_home();

		//dados a serem enviados para o cabeçalho
		$dados['titulo']='Mapa do Preconceito';
		$dados['subtitulo'] = 'Bem Vindx!';
		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/home');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
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
			$newnode->setAttribute("id", $row->id);
			$newnode->setAttribute("name", $row->name);
			$newnode->setAttribute("address", $row->address);
			$newnode->setAttribute("lat", $row->lat);
			$newnode->setAttribute("lng", $row->lng);
			$newnode->setAttribute("type", $row->type);
			$newnode->setAttribute("descricao", $row->descricao);
			$newnode->setAttribute("data_ocorrencia", $row->data_ocorrencia);
			$idtipo=$row->type;
			$aux2= $this->modelocorrencias->listar_tipo($idtipo);
			//nome do tipo do preconceito
			$newnode->setAttribute("typename", $aux2[0]->nome);
		}
		header("Content-type: text/xml");
		echo $dom->saveXML();
	}
	
}
