<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {

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
          if($this->session->userdata('usuario')==null) redirect('Login');
    }

    public function index() {
        $data['produtos'] = $this->produtos->getProdutos();

        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/marcas', $data);
    }
    
    
 


    public function buscarMarcas() {
        $id = $this->input->post('id');
        $data['marcas'] = $this->marcas->buscarMarcas($id);
        echo json_encode($data['marcas']);
    }

    public function salvar() {
        $pasta = "assets/img/marcas/";
        $tipoArquivos = array(".jpg", ".jpeg", ".gif", ".png", ".bmp");
        $input = "img-marcas";
        $campo = "img_marca";
        $id_imagem = "img-marcas";
        $nome_marca = $this->input->post('nome-marcas');
        $desc_marca = $this->input->post('desc-marcas');
        $id_produto = $this->input->post('id-produto-marcas');
        $id_marca = null;
        $this->inserirImagens($pasta, $tipoArquivos, $input, $campo, $id_imagem, $nome_marca, $desc_marca, $id_produto, $id_marca = null);
    }

    public function update() {
        $nome_marca = $this->input->post('nome-marcas-edit');
        $desc_marca = $this->input->post('desc-marcas-edit');
        $id_produto = $this->input->post('produto-marcas-edit');
        $id_marca = $this->input->post('id-marcas-edit');

        $data['nome_marca'] = $nome_marca;
        $data['desc_marca'] = $desc_marca;
        $data['id_marca'] = $id_marca;
        $data['id_produto'] = $id_produto;

        if (isset($_FILES["img-marcas-edit"])) {

            $pasta = "assets/img/marcas/";
            $tipoArquivos = array(".jpg", ".jpeg", ".gif", ".png", ".bmp");
            $input = "img-marcas-edit";
            $campo = "img_marca";
            $id_imagem = "img-maras-edit";


            $this->inserirImagens($pasta, $tipoArquivos, $input, $campo, $id_imagem, $nome_marca, $desc_marca, $id_produto, $id_marca);
        } else {
            echo "<div class='alert alert-success'>Dados alterados com sucesso!</div>";

            $this->marcas->update($data, $id_marca);
        }
    }

    public function inserirImagens($pasta, $tipoArquivos, $input, $campo, $id_imagem, $nome_marca, $desc_marca, $id_produto, $id_marca = null) {
        
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
                    $data["nome_marca"] = $nome_marca;
                    $data["desc_marca"] = $desc_marca;
                    $data["id_produto"] = $id_produto;
                    if ($id_marca == null) {
                        $this->marcas->salvar($data);
                    } else {                        
                        $this->marcas->update($data, $id_marca);
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

    public function getMarcas() {
        $data2['marcas'] = $this->marcas->getMarcas();
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $data = array();

        foreach ($data2['marcas'] as $r) {
            $url = base_url('assets/img/marcas/' . $r->img_marca);
            $data[] = array(
                $r->id_marca,
                $r->nome_marca,
                $r->desc_marca,
                $r->nome_produto,
                $r->opcoes = "<div class='col-md-12'><button class='btn btn-info col-md-5' data-toggle='modal' data-target='#editar-marcas' 
                    onclick=\"alterarMarcas('$r->id_marca');\"><i class='fa fa-edit'></i> Alterar</button>
                    <button class='btn btn-danger col-md-5'
                    onclick=\"excluirMarcas('$r->id_marca', '$r->img_marca');\"><i class='fa fa-close'></i> Excluir</button></div>
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

        $filestring = PUBPATH . 'assets/img/marcas/' . $img;
        unlink($filestring);
        $this->marcas->deletar($id);
    }
}
