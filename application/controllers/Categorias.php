<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct(){
		//chama o construtor da classe pai
		parent::__construct();
		$this->load->model('MapData','modelocorrencias');
		//lista os tipos de preconceito
		$this->tipo = $this->modelocorrencias->listar_tipos();
	}
	//vai receber o id porque vai exibir uma categoria especifica
	//variavel slug porque o nome estaá indo no parametro
	public function index($id, $slug=null)
	{

		//cria um array para guardar os tipos de preconceito
		$dados['tipos'] = $this->tipo;

		//dados a serem enviados para o cabeçalho
		//é através da matriz $dados que eu envio iformações do controller para a view
		$dados['titulo']='Tipo';
		$dados['subtitulo'] = '';
		$dados['subtitulodb'] = $this->modelocorrencias->listar_tipo($id);
		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/categoria');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function chart($id)
	{
		$this->load->model('Categorias_model','modelcategorias');
		$dados['dadoschart'] = $this->modelcategorias->chartdata($id)->result();
		$dados['id']=$id;
//cria um array para guardar os tipos de preconceito
		$dados['tipos'] = $this->tipo;
$dados['subtitulodb'] = $this->modelocorrencias->listar_tipo($id);
		//dados a serem enviados para o cabeçalho
		//é através da matriz $dados que eu envio iformações do controller para a view
		$dados['titulo']='Tipo';
		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('welcome_message', $dados);
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}
	
}
