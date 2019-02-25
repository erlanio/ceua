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
        $this->load->model('Model_Projeto', 'projeto');
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

    public function buscarCPF() {
        $cpf = $this->input->post('cpf');
        $data['pessoa'] = $this->pessoa->buscarCPF($cpf);
        echo json_encode($data['pessoa']);
    }

    public function salvarMembro() {
        //MONTA ARRAY PESSOA
        $data['nome_pessoa'] = strtoupper($this->input->post('nome'));
        $data['telefone'] = removerMascara($this->input->post('telefone'));
        $data['cpf_pessoa'] = removerMascara($this->input->post('cpf'));
        $data['email_pessoa'] = $this->input->post('email');
        $data['lattes'] = $this->input->post('lattes');
        $data['departamento'] = strtoupper($this->input->post('dpto'));
        $data['instituicao'] = strtoupper($this->input->post('instituicao'));


        //MONTA ARRAY EQUIPE
        $data2['xp_previa'] = strtoupper($this->input->post('experiencia_previa'));
        $data2['qt_tmpo_previa'] = strtoupper($this->input->post('xptmpo'));
        $data2['treinamento'] = strtoupper($this->input->post('treinamento'));
        $data2['qt_tmpo_treinamento'] = strtoupper($this->input->post('treiqtotmpo'));
        $data2['outros'] = strtoupper($this->input->post('outros_vinculo'));
        $data2['id_vinculo'] = strtoupper($this->input->post('vinculo'));
        $data2['id_projeto'] = $this->input->post('id_projeto');
        $id_pessoa = $this->input->post('id_pessoa');
        if ($id_pessoa == "") {
            $id_pessoa = $this->pessoa->salvarMembro($data);
            $data2['id_pessoa'] = $id_pessoa;
            $this->projeto->salvarMembro($data2);
            echo '1';
        } else {
            
            if ($this->projeto->verificaMembro($id_pessoa) == 0) {
                $data2['id_pessoa'] = $id_pessoa;
                $this->projeto->salvarMembro($data2);
                 echo '1';
            } else {
                echo '2';
            }
        }
    }

    public function lastInsert() {
        echo $this->pessoa->lastInsert();
    }

    public function dados() {
        $data['estados'] = $this->pessoa->retornaEstados();
        $data['cidade'] = $this->pessoa->retornaCidade();

        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/meus_dados', $data);
    }

    public function getMembros() {
        $id_projeto = 68; //$this->input->get('id_projeto');

        $data2['membros'] = $this->pessoa->getMembros($id_projeto);
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data = array();
        foreach ($data2['membros'] as $r) {
            $data[] = array(
                $r->id_pessoa,
                $r->nome_pessoa,
                $r->desc_vinculo,
                $r->opcoes = "<div class='col-md-12'>
                    <button class='btn btn-danger col-md-5'
                    onclick=\"deletarMembro('$r->id_equipe');\"><i class='fa fa-close'></i> Excluir</button></div>",
            );
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => "",
            "recordsFiltered" => "",
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function excluirMembro() {
        $id = $this->input->post('id');
        return $this->pessoa->excluirMembro($id);
    }

}
