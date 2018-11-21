<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapa_model extends CI_Model {
	//marcadores
	public $id;
	public $name;
	public $address;
	public $lat;
	public $lng;
	public $type;

	public function __construct(){
		parent::__construct();
	}

	public function destaques_home(){
		//pegar 4 linhas
		$this->db->limit(4);
		//order por id em ordem decrescente
		$this->db->order_by('id','DESC');
		//retornar os resultados do get markers - select * from marcas
		return $this->db->get('markers')->result();
	}

	
}
