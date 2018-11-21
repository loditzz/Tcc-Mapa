<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

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
		$this->load->view('frontend/feedback');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	//função para inserir um novo comentário
	public function inserir() {
		$this->load->model('feedback_model', 'modelfeedback');
		
			//pega os dados do form
		$titulo= $this->input->post('titulo');

		$feedback= $this->input->post('feedback');
		$idocorrencia= $this->input->post('idocorrencia');
		$idusuario= $this->session->userdata('userlogado')->id;
		$now = new DateTime();
		$dataHora = $now->format('Y-m-d H:i:s'); 



			//adicionando um novo comentario
		if($this->modelfeedback->adicionar($titulo, $feedback, $dataHora, $idusuario)){
			redirect(base_url('feedback/obrigado'));
		}else{
			echo "houve um erro no sistema!";
		}
		

	}

	public function obrigado()
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
		$this->load->view('frontend/obrigado');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');

	}
	
}
