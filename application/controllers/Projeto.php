<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projeto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Projeto', 'projeto');
        if ($this->session->userdata('usuario') == null)
            redirect('Login');
    }

    public function index() {
        // $data['categorias'] = $this->categoria->getCategorias();

        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/projeto');
    }

    public function novo() {
        $data['areas'] = $this->projeto->areas();
        $data['vinculos'] = $this->projeto->vinculos();
        $data['finalidades'] = $this->projeto->finAcademica();

        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/novo-projeto', $data);
        $this->load->view('admin/modal-add-membros');
    }

    public function selectedSubArea() {
        $id = $this->input->post('id');
        echo $this->projeto->selectedSubArea($id);
    }

    public function selectedSubFinalidade() {
        $id = $this->input->post('id');

        echo $this->projeto->selectedSubFinalidade($id);
    }

    public function salvar() {
        $data['titulo'] = $this->input->post('titulo');
        $data['resumo'] = $this->input->post('resumo');
        $data['objetivos'] = $this->input->post('objetivos');
        $data['justificativa'] = $this->input->post('justificativa');
        $data['relevancia'] = $this->input->post('relevancia');
        $data['id_sub_area'] = $this->input->post('subarea');
        $data['id_sub_fin'] = $this->input->post('subfinalidade');
        $data['outras_finalidades'] = $this->input->post('outras_finalidades');
        $data['dt_ini'] = $this->input->post('dt_ini');
        $data['dt_cadastro'] = date('Y-m-d');
        $data['id_pessoa'] = $this->session->userdata('usuario')->id_pessoa;
        $data['dt_fim'] = $this->input->post('dt_fim');             
        
        $this->projeto->salvar($data);
    }

    public function salvarImagem() {
        $pasta = "assets/img/categorias/";
        $tipoArquivos = array(".jpg", ".jpeg", ".gif", ".png", ".bmp");
        $input = "img-categoria";
        $campo = "img_categoria";
        $id_imagem = "img-categoria";
        $nome_categoria = $this->input->post('nome-categoria');
        $desc_categoria = $this->input->post('desc-categoria');

        $this->inserirImagens($pasta, $tipoArquivos, $input, $campo, $id_imagem, $nome_categoria, $desc_categoria);
    }

    public function inserirImagens($pasta, $tipoArquivos, $input, $campo, $id_imagem, $nome_categoria, $desc_categoria, $id_categoria = null) {

        $pasta = $pasta;
        /* formatos de imagem permitidos */
        $permitidos = $tipoArquivos;
        //$id_imagem = $this->input->post('id_imagem');
        if (isset($_POST)) {
            if (isset($_FILES["$input"])) {
                $nome_imagem = $_FILES["$input"]['name'];
                $tamanho_imagem = $_FILES["$input"]['size'];
            }
            /* pega a extensão do arquivo */
            $ext = strtolower(strrchr($nome_imagem, "."));

            /*  verifica se a extensão está entre as extensões permitidas */
            if (in_array($ext, $permitidos)) {

                /* converte o tamanho para KB */
                $tamanho = round($tamanho_imagem / 1024);


                $nome_atual = md5(uniqid(time())) . $ext; //nome que dará a imagem
                if (isset($_FILES["$input"])) {
                    $tmp = $_FILES["$input"]['tmp_name']; //caminho temporário da imagem                    
                }

                /* se enviar a foto, insere o nome da foto no banco de dados */
                if (move_uploaded_file($tmp, $pasta . $nome_atual)) {
                    $url = base_url();
                    //echo "<div class='alert alert-success'>Dados salvos com sucesso!</div>";
                    $data["$campo"] = $nome_atual;
                    $data["nome_categoria"] = $nome_categoria;
                    $data["desc_categoria"] = $desc_categoria;
                    if ($id_categoria == null) {
                        $this->categoria->salvar($data);
                    } else {
                        echo 'update';
                        $this->categoria->update($data, $id_categoria);
                    }
                } else {
                    echo "Falha ao enviar";
                }
            } else {
                echo "Somente são aceitos arquivos do tipo Imagem";
            }
        } else {
            echo "Selecione uma imagem";
            exit;
        }
    }

}
