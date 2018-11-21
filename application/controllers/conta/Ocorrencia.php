<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencia extends CI_Controller {

	public function __construct(){
		//chama o construtor da classe pai
		parent::__construct();
		if (!$this->session->userdata('logado')){
			redirect(base_url('conta/login'));
		}
		$this->load->model('MapData','modelocorrencias');
		//guarda em uma variavel a lista de ocorrencias
		$this->ocorrencia = $this->modelocorrencias->listar_ocorrencias();
		//lista os tipos de preconceito
		$this->tipo = $this->modelocorrencias->listar_tipos();
	}

	//lista todas as ocorrencias
	public function index()
	{	
		$this->load->library('table');
		//dados a serem enviados para o cabeçalho
		//mudar para cada página 
		$dados['titulo']='Mapa do Preconceito';
		$dados['subtitulo'] = 'Ocorrencias';
		$dados['ocorrencias'] = $this->ocorrencia;
		
		$this->load->view('conta/template/html-header', $dados);
		$this->load->view('conta/template/template');
		$this->load->view('conta/ocorrencias');
		$this->load->view('conta/template/html-footer');
	}
	//função que exibe a view de adicionar nova ocorrencia
	public function adicionar()
	{	
		$this->load->library('table');
		//dados a serem enviados para o cabeçalho
		//mudar para cada página 
		$dados['titulo']='Mapa do Preconceito';
		$dados['subtitulo'] = 'Ocorrencia';
		$dados['tipos'] = $this->tipo;
		$this->load->view('conta/template/html-header', $dados);
		$this->load->view('conta/template/template');
		$this->load->view('conta/ocorrencia');
		$this->load->view('conta/template/html-footer');
	}

	//função para inserir uma nova ocorrencia
	public function inserir() {
		
			//pega os dados do form
		$nome= $this->input->post('nome');

		$address= $this->input->post('address');
		$lat= $this->input->post('lat');
		$lng= $this->input->post('lng');
		$type= $this->input->post('type');
		$descricao = $this->input->post('txt-descricao');
		$ocorrido= $this->input->post('txt-ocorrido');

		$now = new DateTime();
		$entrada = $now->format('Y-m-d'); 



			//enivando a variavel titulo para o model categorias, no metodo adicionar
		if($this->modelocorrencias->adicionar($nome, $address, $lat, $lng, $type, $descricao, $ocorrido, $entrada)){
			redirect(base_url('conta/ocorrencia'));
		}else{
			echo "houve um erro no sistema!";
		}
		

	}

	public function excluir($id){
		//enivando a variavel titulo para o model categorias, no metodo adicionar
		if($this->modelocorrencias->excluir($id)){
			redirect(base_url('conta/ocorrencia'));
		}else{
			echo "houve um erro no sistema!";
		}

	}

	public function alterar($id){
		$this->load->library('table');
		//dados a serem enviados para o cabeçalho
		//mudar para cada página 
		//$id=md5($id);
		$auxocorrencia=$this->modelocorrencias->listar_ocorrencia_md5($id);
		$dados['titulo']='Mapa do Preconceito';
		$dados['subtitulo'] = 'Ocorrencias';
		$dados['ocorrencias'] = $auxocorrencia;
		$dados['tipos'] = $this->tipo;
		$this->load->view('conta/template/html-header', $dados);
		$this->load->view('conta/template/template');
		$this->load->view('conta/alterar-ocorrencia');
		$this->load->view('conta/template/html-footer');

	}
	//monta um xml com somente 1 elemento
	public function sendXML($id) {
		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);
		$this->load->model('MapData');
		$mapdata = new MapData();

		foreach ( $mapdata->listar_ocorrencia($id)->result() as $row ) {
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
	public function salvar_alteracoes(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome',
			'required|min_length[3]');
		//se o meu validador encontrar algum erro, ele vai retornar À pagina que estava e mostrar o erro
		if ($this->form_validation->run()==FALSE){
			$this->index();

		}else{
			//pega os dados do form
			$nome= $this->input->post('nome');
			$id= $this->input->post('id');
			$address= $this->input->post('address');
			$lat= $this->input->post('lat');
			$lng= $this->input->post('lng');
			$descricao = $this->input->post('txt-descricao');


			//enivando a variavel titulo para o model categorias, no metodo adicionar
			if($this->modelocorrencias->alterar($nome, $id, $address, $lat, $lng, $descricao)){
				redirect(base_url('conta/ocorrencia'));
			}else{
				echo "houve um erro no sistema!";
			}
		}

	}
	
}
