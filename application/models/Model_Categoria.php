<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Categoria extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function salvar($data) {
        $this->db->insert('categorias', $data);
    }

    public function getCategorias() {
       
        return $this->db->query("select * from categorias order by nome_categoria asc")->result();
    }

    public function buscarCategoria($id) {

        $this->db->where('id_categoria', $id);
        return $this->db->get('categorias')->result();
    }

    public function deletar($id) {
        $this->db->where('id_categoria', $id);
        $this->db->delete('categorias');
    }

    public function update($data, $id) {
        $this->db->where('id_categoria', $id);
        $this->db->update('categorias', $data);
    }

}
