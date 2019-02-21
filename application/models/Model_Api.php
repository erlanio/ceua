<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Api extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function categorias() {
        $this->db->order_by("categorias.nome_categoria");
        return $this->db->get('categorias')->result();
    }
    
    public function produtos($id_categoria) {
        return $this->db->query("select * from produtos as p INNER JOIN categorias as c on c.id_categoria = p.id_categoria where c.id_categoria = $id_categoria")->result();
    }
    
     public function num_marcas($id_marca) {
        return $this->db->query("select m.*, p.* from marcas as m INNER join produtos as p on m.id_produto = p.id_produto WHERE p.id_produto = $id_marca" )->num_rows();
    }
    
    public function marcas($id_marca) {
        return $this->db->query("select m.*, p.* from marcas as m INNER join produtos as p on m.id_produto = p.id_produto WHERE p.id_produto = $id_marca" )->result();
    }
    
//    public function tamanhos($id_marca) {
//        return $this->db->query("select t.*, ct.*, m.* from marcas as m INNER JOIN config_tamanhos as ct on ct.id_marca = m.id_marca INNER JOIN tamanhos as t on t.id_tamanho = ct.id_tamanho where m.id_marca = $id_marca ORDER BY t.desc_tamanho")->result();        
//    }
    
    public function tamanhos($id_marca, $id_produto) {
        return $this->db->query("select DISTINCT t.* from tamanhos as t INNER JOIN valores as v on v.id_tamanho = t.id_tamanho where v.id_marca = $id_marca and v.id_produto = $id_produto")->result();
    }
    
    public function valores($id_tamanho, $id_marca) {
        return $this->db->query("select * from valores as v INNER JOIN produtos as p on p.id_produto = v.id_produto INNER JOIN tamanhos as t on t.id_tamanho = v.id_tamanho INNER JOIN marcas as m on m.id_marca = v.id_marca INNER JOIN supermecados as s on s.id_supermercado = v.id_supermercado where v.id_tamanho = $id_tamanho and v.id_marca = $id_marca")->result();
    }

//    public function valores($id_tamanho) {
//        return $this->db->query("select m.*, v.*, ct.*, s.*, t.*, p.* from marcas as m INNER JOIN config_tamanhos as ct on ct.id_marca = m.id_marca INNER join tamanhos as t on t.id_tamanho = ct.id_tamanho INNER JOIN valores as v on v.id_tamanho = ct.id_tamanho INNER JOIN supermecados as s on s.id_supermercado = v.id_supermercado INNER JOIN produtos as p on p.id_produto = m.id_produto WHERE t.id_tamanho = $id_tamanho ORDER BY v.valor ASC")->result();
//    }
    
    public function supermercado($id_supermercado) {
        return $this->db->query("SELECT * from supermecados WHERE id_supermercado = $id_supermercado")->result();
        
    }
    
    
}
