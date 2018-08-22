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
        // $data['categorias'] = $this->categoria->getCategorias();

        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/categoria');
    }

    public function getCategorias() {

        $data2['categorias'] = $this->categoria->getCategorias();
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

    
        $data = array();

        foreach ($data2['categorias'] as $r) {
                $url = base_url('assets/img/categorias/'.$r->img_categoria);
            $data[] = array(
                $r->id_categoria,
                $r->img = "<img src='$url' class='img-responsive col-md-3'>",
                $r->nome_categoria,
                $r->desc_categoria,
                $r->opcoes = "<button class='btn btn-info' data-toggle='modal' data-target='#editar-categoria' 
                    onclick=\"alterarCategoria('$r->id_categoria');\"><i class='fa fa-edit'></i> Alterar</button>
                    <button class='btn btn-danger'
                    onclick=\"excluirCategoria('$r->id_categoria');\"><i class='fa fa-close'></i> Excluir</button>
",
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

    public function deletar() {
        $id = $this->input->post('id');
        $this->categoria->deletar($id);
    }

    public function buscarCategoria() {
        $id = $this->input->post('id');
        $data['categoria'] = $this->categoria->buscarCategoria($id);
        echo json_encode($data['categoria']);
    }

    public function salvar() {
        $pasta = "assets/img/categorias/";
        $tipoArquivos = array(".jpg", ".jpeg", ".gif", ".png", ".bmp");
        $input = "img-categoria";
        $campo = "img_categoria";
        $id_imagem = "img-categoria";
        $nome_categoria = $this->input->post('nome-categoria');
        $desc_categoria = $this->input->post('desc-categoria');

        $this->inserirImagens($pasta, $tipoArquivos, $input, $campo, $id_imagem, $nome_categoria, $desc_categoria);
    }

    public function inserirImagens($pasta, $tipoArquivos, $input, $campo, $id_imagem, $nome_categoria, $desc_categoria) {
        
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


                    $this->categoria->salvar($data);
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
