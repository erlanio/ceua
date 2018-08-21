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
}
