<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct(){
		//chama o construtor da classe pai
		parent::__construct();
		if (!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}
		$this->load->model('categorias_model','modelcategorias');
		//guarda em uma variavel a lista de tipos
		//após carregar o model no construtor eu vou chamar um metodo do model carregado
		$this->categorias = $this->modelcategorias->listar_categorias();
	}

	public function index()
	{	
		$this->load->library('table');
		//cria um array para guardar as categorias carregadas no construtor
		$dados['categorias'] = $this->categorias;
		//dados a serem enviados para o cabeçalho
		//mudar para cada página 
		$dados['titulo']='Painel de Controle';
		$dados['subtitulo'] = 'Categoria';
		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/categoria');
		$this->load->view('backend/template/html-footer');
	}

	public function inserir() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-categoria', 'Nome da Categoria',
			'required|min_length[3]|is_unique[categoria.titulo]');
		//se o meu validador encontrar algum erro, ele vai retornar À pagina que estava e mostrar o erro
		if ($this->form_validation->run()==FALSE){
			$this->index();

		}else{
			//pega o nome da categoria digitada no form e joga para a variavel titulo
			$titulo= $this->input->post('txt-categoria');
			//enivando a variavel titulo para o model categorias, no metodo adicionar
			if($this->modelcategorias->adicionar($titulo)){
				redirect(base_url('admin/categoria'));
			}else{
				echo "houve um erro no sistema!";
			}
		}

	}

	public function excluir($id){
		//enivando a variavel titulo para o model categorias, no metodo adicionar
			if($this->modelcategorias->excluir($id)){
				redirect(base_url('admin/categoria'));
			}else{
				echo "houve um erro no sistema!";
			}

	}
	//função que exibe a view para alterar a categoria
	public function alterar($id){
		$this->load->library('table');
		//cria um array para guardar as categorias carregadas no construtor
		$dados['categorias'] = $this->modelcategorias->listar_categoria($id);
		//dados a serem enviados para o cabeçalho
		//mudar para cada página 
		$dados['titulo']='Painel de Controle';
		$dados['subtitulo'] = 'Categoria';
		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-categoria');
		$this->load->view('backend/template/html-footer');

	}
	
	public function salvar_alteracoes(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-categoria', 'Nome da Categoria',
			'required|min_length[3]|is_unique[categoria.titulo]');
		//se o meu validador encontrar algum erro, ele vai retornar À pagina que estava e mostrar o erro
		if ($this->form_validation->run()==FALSE){
			$this->index();

		}else{
			//pega o nome da categoria digitada no form e joga para a variavel titulo
			$titulo= $this->input->post('txt-categoria');
			$id = $this->input->post('txt-id');
			//enivando a variavel titulo para o model categorias, no metodo adicionar
			if($this->modelcategorias->alterar($titulo, $id)){
				redirect(base_url('admin/categoria'));
			}else{
				echo "houve um erro no sistema!";
			}
		}

	}
}
