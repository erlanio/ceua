<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Categoria', 'categoria');
    }

    public function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/categoria');
    }

    public function salvar() {
        //$data['nome_categoria'] = $this->input->post('nome');
        //$data['desc_categoria'] = $this->input->post('desc');
        //$data['img_categoria'] = "";
        //$this->categoria->salvar($data);
        
        echo $this->input->post('nome');;
    }
    
    public function salvarImagem() {
        var_dump($_FILES['img-categoria']);
    }

}
