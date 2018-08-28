<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Marcas extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function salvar($data) {
        $this->db->insert('marcas', $data);
    }

    public function getMarcas() {
        return $this->db->query("select * from produtos as p INNER JOIN marcas as m on m.id_produto = p.id_produto INNER join categorias as c on c.id_categoria = p.id_categoria order by m.nome_marca asc
")->result();
    }
    


    public function buscarMarcas($id) {

        $this->db->where('id_marca', $id);
        return $this->db->get('marcas')->result();
    }

    public function deletar($id) {
        $this->db->where('id_marca', $id);
        $this->db->delete('marcas');
    }

    public function update($data, $id) {
        $this->db->where('id_marca', $id);
        $this->db->update('marcas', $data);
    }

}
