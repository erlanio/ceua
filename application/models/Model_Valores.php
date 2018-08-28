<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Valores extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getValores() {
        return $this->db->query("select * from produtos as p INNER JOIN valores as v on v.id_produto = p.id_produto INNER JOIN marcas as m on m.id_marca = v.id_marca INNER JOIN supermecados as s on s.id_supermercado = v.id_supermercado INNER JOIN tamanhos as t on t.id_tamanho = v.id_tamanho INNER JOIN categorias as c on c.id_categoria = p.id_categoria
")->result();
    }

    public function salvar($data) {
        $this->db->insert('valores', $data);
    }

    public function getSupermercados() {
        return $this->db->query("SELECT * FROM supermecados")->result();
    }

    public function verificaIfExists($id_tamanho, $id_supermercado, $id_produto, $id_marca) {
        return $this->db->query("SELECT * FROM valores where id_tamanho = $id_tamanho and id_supermercado = $id_supermercado and id_produto = $id_produto and id_marca = $id_marca")->num_rows();
    }

    public function buscarValores($id) {

        $this->db->where('id_valor', $id);
        return $this->db->get('valores')->result();
    }

    public function deletar($id) {
        $this->db->where('id_marca', $id);
        $this->db->delete('marcas');
    }

    public function update($data, $id) {
        $this->db->where('id_valor', $id);
        if ($this->db->update('valores', $data)) {
            echo 1;
        } else {
            echo 2;
        }
    }

}
