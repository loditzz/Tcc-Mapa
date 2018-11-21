<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$this->load->view('welcome_message');
	}

	public function dados()
{
  $dados['tarefas'] = array(
    'Tarefas' => 'Horas por dia',
    'Trabalho' => 6,
    'Escrever livros e tutoriais' => 4,
    'Redes Sociais' => 2,
    'Assistir TV' => 4,
    'Dormir' => 8
  );
  $dados['opcoes'] = array(
    'title' => 'Atividades Diárias'
  );
 
  echo json_encode($dados);
}
}