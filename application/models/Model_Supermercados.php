<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Supermercados extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function salvar($data) {
        $this->db->insert('supermecados', $data);
    }

    public function getSupermercadosAtivos(){
        return $this->db->query("SELECT * FROM supermecados where ativo = 's' ORDER BY nome_supermercado")->result();
    }
    

    
    public function getSupermercados() {
        return $this->db->query("SELECT * FROM supermecados")->result();
    }

    public function verificaIfExists($supermercado) {
        return $this->db->query("select * from supermecados where nome_supermercado = '$supermercado'")->num_rows();
    }

    public function buscarSupermercados($id) {

        $this->db->where('id_supermercado', $id);
        return $this->db->get('supermecados')->result();
    }

    public function deletar($id) {
        $this->db->where('id_marca', $id);
        $this->db->delete('marcas');
    }

    public function update($data, $id) {
        $this->db->where('id_supermercado', $id);
        if($this->db->update('supermecados', $data)){
            echo 1;
        }else{
            echo 2;
        }
        
    }

}
