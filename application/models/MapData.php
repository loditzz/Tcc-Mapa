<?php

class MapData extends CI_Model {
   function __construct() {
      parent::__construct();
      $this->load->database();
   }

   function getmappoints() {
      //"SELECT * FROM markers WHERE ".$id
      $sql = "SELECT * FROM markers WHERE 1";
      $query = $this->db->query($sql);
      if ($query->num_rows() > 0) {
         return $query;
      }
   }

   public function adicionar($nome, $address, $lat, $lng, $type, $descricao, $ocorrido, $entrada){
      //mesmo nome da coluna
      
      $dados['name']=$nome;
      $dados['address']=$address;
      $dados['lat']=$lat;
      $dados['lng']=$lng;
      $dados['type']=$type;
      $dados['id_usuario']= $auxid=$this->session->userdata('userlogado')->id;
      $dados['descricao']=$descricao;
      $dados['data_ocorrencia']=$ocorrido;
      $dados['data_entrada']=$entrada;
      $dados['status']='Ativo';

      //insert(nome da tabela, array)
      return $this->db->insert('markers', $dados);
   }

   public function listar_ocorrencias(){
      $auxid=$this->session->userdata('userlogado')->id;
      $this->db->where('id_usuario', $auxid);   
      //order por (nomeDaColune, ordem)
      $this->db->order_by('id', 'ASC');
      //colocar um where id=$idDoUsuario;
      return $this->db->get('markers')->result();
   }

   

   public function excluir($id){
      $this->db->where('md5(id)', $id);
      return $this->db->delete('markers');
   }

   public function listar_ocorrencia($id){
      $this->db->from('markers');
      $this->db->where('id',$id);
      return $this->db->get()->result();
   }
    public function listar_ocorrencia_md5($id){
      $this->db->from('markers');
      $this->db->where('md5(id)',$id);
      return $this->db->get()->result();
   }

   public function alterar($nome, $id, $address, $lat, $lng, $descricao){
      //mesmo nome da coluna
      $dados['id']=$id;
      $dados['name']=$nome;
      $dados['address']=$address;
      $dados['lat']=$lat;
      $dados['lng']=$lng;
      $dados['descricao']=$descricao;
      $this->db->where('id', $id);

      //insert(nome da tabela, array)
      return $this->db->update('markers', $dados);
   }
   //função para listar os tipos de preconceito
   public function listar_tipos(){
     $this->db->order_by('id', 'ASC');
     return $this->db->get('tipo_preconceito')->result();
  }
//função para listar um tipo de preconceito especifico
  public function listar_tipo($id){
   $this->db->from('tipo_preconceito');
   $this->db->where('id',$id);
   return $this->db->get()->result();
}

public function listar_titulo($id){
      $this->db->select('id, name');
      $this->db->from('markers');
      $this->db->where('id='.$id);
      return $this->db->get()->result();
   }
}