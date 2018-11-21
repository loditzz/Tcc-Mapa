<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobrenos extends CI_Controller {

	public function __construct(){
		//chama o construtor da classe pai
		parent::__construct();
		//carrega o model categorias_model e cria um alias para o mesmo
		$this->load->model('categorias_model','modelcategorias');
		//guarda em uma variavel a lista de tipos
		//após carregar o model no construtor eu vou chamar um metodo do model carregado
		$this->categorias = $this->modelcategorias->listar_categorias();
		$this->load->model('usuarios_model', 'modelusuarios');

	}
	//vai receber o id porque vai exibir uma categoria especifica
	//variavel slug porque o nome estaá indo no parametro
	public function index()
	{
		//cria um array para guardar as categorias
		$dados['categorias'] = $this->categorias;

		//joga para a variavel markers (que estará disponível na view) o return da função destaques_home();
		$dados['autores']=$this->modelusuarios->listar_autores();
		//dados a serem enviados para o cabeçalho
		//é através da matriz $dados que eu envio iformações do controller para a view
		$dados['titulo']='Sobre Nos';
		$dados['subtitulo'] = 'Sobre';
		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/sobrenos');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function autores($id, $slug=null){

	 	//cria um array para guardar as categorias
		$dados['categorias'] = $this->categorias;
		$dados['autores'] = $this->modelusuarios->listar_autor($id);

		//dados a serem enviados para o cabeçalho
		//é através da matriz $dados que eu envio iformações do controller para a view
		$dados['titulo']='Sobre Nós';
		$dados['subtitulo'] = 'Autor';
		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/autor');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}
	
}
