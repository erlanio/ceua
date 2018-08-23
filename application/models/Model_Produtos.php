<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Produtos extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function salvar($data) {
        $this->db->insert('produtos', $data);
    }

    public function getProdutos() {
       
        return $this->db->query("select * from produtos as p INNER join categorias as c on c.id_categoria = p.id_categoria")->result();
    }

    public function buscarProdutos($id) {

        $this->db->where('id_produto', $id);
        return $this->db->get('produtos')->result();
    }

    public function deletar($id) {
        $this->db->where('id_produto', $id);
        $this->db->delete('produtos');
    }

    public function update($data, $id) {
        $this->db->where('id_produto', $id);
        $this->db->update('produtos', $data);
    }

}
