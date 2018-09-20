<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Pessoa extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function retornaPessoa($email, $senha) {
       $this->db->where('email_usuario', $email);
       $this->db->where('senha_usuario', $senha);
       $this->db->where('ativo_usuario', 's');
       return $this->db->get('usuarios')->result();
       
    }
}
