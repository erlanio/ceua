<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa extends CI_Controller {

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
        $this->load->model('Model_Pessoa', 'pessoa');
        $this->load->helper('uteis');
    }


    public function buscar() {
        $id = $this->input->post('id_pessoa');
        $data['pessoa'] = $this->pessoa->buscar($id);
        echo json_encode($data['pessoa']);
    }


    public function getCidades() {
        $id_estado = $this->input->post('id_estado');
        echo $this->pessoa->selectedCidades($id_estado);
    }

    public function salvar() {

        $data['nome_pessoa'] = strtoupper($this->input->post('nome'));
        $data['id_estado'] = $this->input->post('estado');
        $data['id_cidade'] = $this->input->post('cidade');
        $data['rua'] = $this->input->post('endereco');
        $data['telefone'] = removerMascara($this->input->post('telefone'));
        $data['cpf_pessoa'] = removerMascara($this->input->post('cpf'));
        $data['rg_pessoa'] = removerMascara($this->input->post('rg'));
        $data['email_pessoa'] = $this->input->post('email');
        $data['senha_pessoa'] = md5($this->input->post('senha'));
        $data['lattes'] = $this->input->post('lattes');
        $data['departamento'] = strtoupper($this->input->post('dpto'));
        $data['instituicao'] = strtoupper($this->input->post('instituicao'));


        if ($this->pessoa->verificaCPF(removerMascara($this->input->post('cpf'))) == 0) {
            if ($this->pessoa->salvar($data)) {
                echo 'Cadastrado com sucesso!<br>Faça Login para continuar!';
            }
        } else {
            echo 'Usuário já cadastrado!';
        }
    }

    public function dados() {
        $data['estados'] = $this->pessoa->retornaEstados();
        $data['cidade'] = $this->pessoa->retornaCidade();

        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/meus_dados', $data);
    }

}
