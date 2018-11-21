<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencia extends CI_Controller {

	public function __construct(){
		//chama o construtor da classe pai
		parent::__construct();
		$this->load->model('MapData','modelocorrencias');
		//lista os tipos de preconceito
		$this->tipo = $this->modelocorrencias->listar_tipos();
		$this->load->model('Comentarios_model', 'modelcomentarios');
	}
	//vai receber o id porque vai exibir uma categoria especifica
	//variavel slug porque o nome estaá indo no parametro
	//função para exibir uma ocorrencia
	public function index($id)
	{
		//cria um array para guardar os tipos de preconceito
		$dados['tipos'] = $this->tipo;
		$dados['postagem']=$this->modelocorrencias->listar_ocorrencia($id);
		//pega os dados dos comentarios
		$dados['comentarios']=$this->modelcomentarios->listar_comentarios($id);
		$this->tipopre = $this->modelocorrencias->listar_tipo($id);
		$dados['tipopre'] = $this->tipopre;
		//dados a serem enviados para o cabeçalho
		//é através da matriz $dados que eu envio iformações do controller para a view
		$dados['titulo']='Ocorrencia';
		$dados['subtitulo'] = '';
		$dados['subtitulodb'] = $this->modelocorrencias->listar_titulo($id);
		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/publicacao');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	//função para inserir um novo comentário
	public function inserir() {

		
			//pega os dados do form
		$titulo= $this->input->post('titulo');

		$comentario= $this->input->post('comentario');
		$idocorrencia= $this->input->post('idocorrencia');
		$idusuario= $this->session->userdata('userlogado')->id;
		$now = new DateTime();
		$dataHora = $now->format('Y-m-d H:i:s'); 



			//adicionando um novo comentario
		if($this->modelcomentarios->adicionar($titulo, $comentario, $dataHora, $idusuario, $idocorrencia)){
			redirect(base_url('ocorrencia/'.$idocorrencia));
		}else{
			echo "houve um erro no sistema!";
		}
		

	}
	 
	
}
