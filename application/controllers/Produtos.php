<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {

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
        $this->load->model('Model_Produtos', 'produtos');
        $this->load->model('Model_Categoria', 'categorias');
    }

    public function index() {

        $data['categorias'] = $this->categorias->getCategorias();
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/produtos', $data);
    }

    public function getProdutos() {
        $data2['categorias'] = $this->produtos->getProdutos();
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $data = array();

        foreach ($data2['categorias'] as $r) {
            $url = base_url('assets/img/produtos/' . $r->img_produto);
            $data[] = array(
                $r->id_produto,
                $r->nome_produto,
                $r->nome_categoria,
                $r->desc_produto,
                $r->opcoes = "<div class='col-md-12'><button class='btn btn-info col-md-5' data-toggle='modal' data-target='#editar-produto' 
                    onclick=\"alterarProduto('$r->id_produto');\"><i class='fa fa-edit'></i> Alterar</button>
                    <button class='btn btn-danger col-md-5'
                    onclick=\"excluirProduto('$r->id_produto', '$r->img_produto');\"><i class='fa fa-close'></i> Excluir</button></div>
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
        $img = $this->input->post('img');
        echo $img;

        define('EXT', '.' . pathinfo(__FILE__, PATHINFO_EXTENSION));
        //   define('FCPATH', __FILE__);
        // define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
        define('PUBPATH', str_replace(SELF, '', FCPATH)); // added

        $filestring = PUBPATH . 'assets/img/produtos/' . $img;
        unlink($filestring);
        $this->produtos->deletar($id);
    }

    public function buscarProdutos() {
        $id = $this->input->post('id');
        $data['produtos'] = $this->produtos->buscarProdutos($id);
        echo json_encode($data['produtos']);
    }

    public function update() {
        $nome_produto = $this->input->post('nome-produto-edit');
        $desc_produto = $this->input->post('desc-produto-edit');
        $id_categoria = $this->input->post('categoria-produto-edit');
        $id_produto = $this->input->post('id-produto-edit');

        $data['nome_produto'] = $nome_produto;
        $data['desc_produto'] = $desc_produto;
        $data['id_categoria'] = $id_categoria;

        if (isset($_FILES["img-produto-edit"])) {

            $pasta = "assets/img/produtos/";
            $tipoArquivos = array(".jpg", ".jpeg", ".gif", ".png", ".bmp");
            $input = "img-produto-edit";
            $campo = "img_produto";
            $id_imagem = "img-categoria-edit";


            $this->inserirImagens($pasta, $tipoArquivos, $input, $campo, $id_imagem, $nome_produto, $desc_produto, $id_categoria, $id_produto);
        } else {
            echo "<div class='alert alert-success'>Dados alterados com sucesso!</div>";

            $this->produtos->update($data, $id_produto);
        }
    }

    public function salvar() {
 
        
        $pasta = "assets/img/produtos/";
        $tipoArquivos = array(".jpg", ".jpeg", ".gif", ".png", ".bmp");
        $input = "img-produto";
        $campo = "img_produto";
        $id_imagem = "img-produto";
        $nome_produto = $this->input->post('nome-produto');
        $desc_produto = $this->input->post('desc-produto');
        $id_categoria = $this->input->post('categoria-produto');
        $id_produto = $this->input->post('id_produto');
        $this->inserirImagens($pasta, $tipoArquivos, $input, $campo, $id_imagem, $nome_produto, $desc_produto, $id_categoria, $id_produto);
    }

    public function inserirImagens($pasta, $tipoArquivos, $input, $campo, $id_imagem, $nome_produto, $desc_produto, $id_categoria, $id_produto = null) {

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
                    $data["nome_produto"] = $nome_produto;
                    $data["desc_produto"] = $desc_produto;
                    $data["id_categoria"] = $id_categoria;
                    if ($id_produto == null) {
                        $this->produtos->salvar($data);
                    } else {
                        $this->produtos->update($data, $id_produto);
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
