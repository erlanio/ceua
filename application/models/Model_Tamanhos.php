<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Tamanhos extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function salvar($data) {
        $this->db->insert('tamanhos', $data);
    }
    
    function verificaTamanho($nome){
        return $this->db->query("SELECT * FROM tamanhos where desc_tamanho = '$nome'")->num_rows();
    }

    public function getTamanhos() {
        return $this->db->query("SELECT * FROM tamanhos order by desc_tamanho")->result();
    }

    public function buscarTamanhos($id) {

        $this->db->where('id_tamanho', $id);
        return $this->db->get('tamanhos')->result();
    }

    public function deletar($id) {
        $this->db->where('id_marca', $id);
        $this->db->delete('marcas');
    }

    public function update($data, $id) {
        $this->db->where('id_tamanho', $id);
        $this->db->update('tamanhos', $data);
    }

}
