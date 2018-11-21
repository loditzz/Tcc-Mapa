<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postagens extends CI_Controller {

	public function __construct(){
		//chama o construtor da classe pai
		parent::__construct();
		//carrega o model categorias_model e cria um alias para o mesmo
		$this->load->model('categorias_model','modelcategorias');
		//guarda em uma variavel a lista de tipos
		//após carregar o model no construtor eu vou chamar um metodo do model carregado
		$this->categorias = $this->modelcategorias->listar_categorias();

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
		//cria um array para guardar as categorias
		$dados['categorias'] = $this->categorias;
		//carrega o model mapa_model
		$this->load->model('publicacoes_model','modelpublicacoes');
		//joga para a variavel markers (que estará disponível na view) o return da função destaques_home();
		$dados['postagem']=$this->modelpublicacoes->publicacao($id);

		//dados a serem enviados para o cabeçalho
		//é através da matriz $dados que eu envio iformações do controller para a view
		$dados['titulo']='Publicação';
		$dados['subtitulo'] = '';
		$dados['subtitulodb'] = $this->modelpublicacoes->listar_titulo($id);
		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/publicacao');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	 
	
}
