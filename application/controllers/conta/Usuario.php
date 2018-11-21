<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct(){
		//chama o construtor da classe pai
		parent::__construct();
	}

	public function index()
	{	//VERIFICAÇÃO DE USUÁRIO LOGADO
		if (!$this->session->userdata('logado')){
			redirect(base_url('conta/login'));
		}

		//dados a serem enviados para o cabeçalho
		$dados['titulo']='Painel de Controle';
		$dados['subtitulo'] = 'Home';
		$this->load->view('conta/template/html-header', $dados);
		$this->load->view('conta/template/template');
		$this->load->view('conta/home');
		$this->load->view('conta/template/html-footer');
	}

	public function inserir() {
		$this->load->model('usuarios_model', 'modelusuarios');
		$this->load->library('form_validation');
		//VALIDAÇÃO DO FORM, CAMPO NOME DO USUÁRIO
		$this->form_validation->set_rules('txt-nome', 'Nome do usuario',
			'required|min_length[3]');
		//VALIDAÇÃO DO FORM, CAMPO EMAIL
		$this->form_validation->set_rules('txt-email', 'Email',
			'required|min_length[3]|valid_email');
		//VALIDAÇÃO DO FORM, CAMPO SENHA
		$this->form_validation->set_rules('txt-senha', 'Senha',
			'required|min_length[3]');
		//VALIDAÇÃO DO FORM, CAMPO CONFIRMAR SENHA
		$this->form_validation->set_rules('txt-confir-senha', 'Confirmar Senha',
			'required|matches[txt-senha]');

		//se o meu validador encontrar algum erro, ele vai retornar À pagina que estava e mostrar o erro
		if ($this->form_validation->run()==FALSE){
			$this->index();

		}else{
			//SALVA EM VARIAVEIS OS DADOS DO FORM
			$nome= $this->input->post('txt-nome');
			$email= $this->input->post('txt-email');
			$sexo= $this->input->post('sexo');
			$senha= $this->input->post('txt-senha');

			//enivando a variavel titulo para o model categorias, no metodo adicionar
			if($this->modelusuarios->adicionar($nome, $email, $sexo, $senha)){
				redirect(base_url('conta/usuario'));
			}else{
				echo "houve um erro no sistema!";
			}
		}

	}

	public function pag_login(){
		//dados a serem enviados para o cabeçalho
		$dados['titulo']='Painel de Controle';
		$dados['subtitulo'] = 'Entrar no sistema';
		$this->load->view('conta/template/html-header', $dados);
		$this->load->view('conta/template/header-login');
		$this->load->view('conta/login');
		$this->load->view('conta/template/html-footer');
	}
	
	public function login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-user', 'Usuário',
			'required|min_length[3]');
		$this->form_validation->set_rules('txt-senha', 'Senha',
			'required|min_length[3]');
		//se o meu validador encontrar algum erro, ele vai retornar À pagina que estava e mostrar o erro
		if ($this->form_validation->run()==FALSE){
			$this->pag_login();

		}else{
			//pega os dados do formulário
			$usuario=$this->input->post('txt-user');
			$senha=$this->input->post('txt-senha');

			//where ('nome da coluna', variavel para comparação)
			$this->db->where('email', $usuario);
			$this->db->where('senha', md5($senha));

			//get(nome da tabela)
			$userlogado = $this->db->get('usuario')->result();

			//testando se existe o usuário e a senha
			if (count($userlogado)==1){
				$dadosSessao['userlogado'] = $userlogado[0];
				$dadosSessao['logado'] = TRUE;
				$this->session->set_userdata($dadosSessao);
				redirect(base_url('conta'));

			}else{
				$dadosSessao['userlogado'] = NULL;
				$dadosSessao['logado'] = FALSE;
				$this->session->set_userdata($dadosSessao);
				redirect(base_url('conta/login'));
				
			}

		}
	}

	//controller para exibir página de cadastro de usuário
	public function pag_cad(){
		$this->load->model('MapData','modelocorrencias');
		//lista os tipos de preconceito
		$this->tipo = $this->modelocorrencias->listar_tipos();
		//dados a serem enviados para o cabeçalho
		$this->load->library('form_validation');
		$dados['titulo']='Painel de Controle';
		$dados['subtitulo'] = 'Usuario';
		//cria um array para guardar os tipos de preconceito
		$dados['tipos'] = $this->tipo;
		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('conta/cadastro');
		
		$this->load->view('frontend/template/html-footer');
	
	}
	//EXIBE A VIEW (FORM) DE ALTERAR INFORMAÇÕES DO USUÁRIO
	public function alterar($id){
		$this->load->model('usuarios_model', 'modelusuarios');
		//VERIFICAÇÃO DE USUÁRIO LOGADO
		if (!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}
		
		//cria um array para guardar as categorias carregadas no construtor
		$dados['usuarios'] = $this->modelusuarios->listar_usuario($id);
		//dados a serem enviados para o cabeçalho
		//mudar para cada página 
		$dados['titulo']='Painel de Controle';
		$dados['subtitulo'] = 'Categoria';
		$this->load->view('conta/template/html-header', $dados);
		$this->load->view('conta/template/template');
		$this->load->view('conta/alterar-usuario');
		$this->load->view('conta/template/html-footer');

	}
	//SALVA AS ALTERAÇÕES DOS DADOS DO USUÁRIO
	public function salvar_alteracoes(){
		//VERIFICAÇÃO DE USUÁRIO LOGADO
		if (!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}
		$this->load->model('usuarios_model', 'modelusuarios');
		$this->load->library('form_validation');

		//VALIDAÇÃO DO FORM, CAMPO NOME DO USUÁRIO
		$this->form_validation->set_rules('txt-nome', 'Nome do usuario',
			'required|min_length[3]');
		//VALIDAÇÃO DO FORM, CAMPO EMAIL
		$this->form_validation->set_rules('txt-email', 'Email',
			'required|min_length[3]|valid_email');
		//VALIDAÇÃO DO FORM, CAMPO SENHA
		$this->form_validation->set_rules('txt-senha', 'Senha',
			'required|min_length[3]');
		//VALIDAÇÃO DO FORM, CAMPO CONFIRMAR SENHA
		$this->form_validation->set_rules('txt-confir-senha', 'Confirmar Senha',
			'required|matches[txt-senha]');
		//se o meu validador encontrar algum erro, ele vai retornar À pagina que estava e mostrar o erro
		if ($this->form_validation->run()==FALSE){
			$id=$this->input->post('txt-id');
			$this->alterar($id);

		}else{
			//SALVA EM VARIAVEIS OS DADOS DO FORM
			$nome= $this->input->post('txt-nome');
			$email= $this->input->post('txt-email');
			$sexo= $this->input->post('sexo');
			$senha= $this->input->post('txt-senha');
			$id=$this->input->post('txt-id');
			//enivando a variavel titulo para o model categorias, no metodo adicionar
			if($this->modelusuarios->alterar($nome, $email, $sexo, $senha, $id)){
				redirect(base_url('conta/usuario'));
			}else{
				echo "houve um erro no sistema!";
			}
		}



}
	public function logout(){
		$dadosSessao['userlogado'] = NULL;
		$dadosSessao['logado'] = FALSE;
		$this->session->set_userdata($dadosSessao);
		redirect(base_url());
	}
	
}
