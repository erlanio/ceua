<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Valores extends CI_Controller {

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
        $this->load->model('Model_Supermercados', 'supermercados');
        $this->load->model('Model_Tamanhos', 'tamanhos');
        $this->load->model('Model_Marcas', 'marcas');
        $this->load->model('Model_Valores', 'valores');
        $this->load->model('Model_Produtos', 'produtos');
        $this->load->model('Model_Categoria', 'categorias');
        if($this->session->userdata('usuario')==null) redirect('Login');
    }

    public function index() {
        $data['supermercados'] = $this->supermercados->getSupermercadosAtivos();
        $data['tamanhos'] = $this->tamanhos->getTamanhos();
        $data['produtos'] = $this->produtos->getProdutos();
        $data['marcas'] = $this->marcas->getMarcas();
        $data['categorias'] = $this->categorias->getCategorias();
        
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/valores', $data);
    }

    public function buscarSupermercados() {
        $id = $this->input->post('id');
        $data['supermercados'] = $this->supermercados->buscarSupermercados($id);
        echo json_encode($data['supermercados']);
    }

    public function salvar() {
        $supermercado = $this->input->post('supermercado');
        $tamanho = $this->input->post('tamanho');
        $marca = $this->input->post('marca');
        $produto = $this->input->post('produto');
        $valor = $this->input->post('valor');
        $categoria = $this->input->post('categoria');
        //$valor =  preg_replace("/\D+/", "", $this->input->post('valor'));
        $data['id_tamanho'] = $tamanho;
        $data['id_supermercado'] = $supermercado;
        $data['id_produto'] = $produto;
        $data['id_marca'] = $marca;
        $data['valor'] = $valor;
        $data['id_categoria'] = $categoria;
        if ($this->valores->verificaIfExists($tamanho, $supermercado, $produto, $marca) == 0) {
            $this->valores->salvar($data);
        } else {
            echo 1;
        }
    }

    public function buscarValores() {
        $id = $this->input->post('id');
        $data['valores'] = $this->valores->buscarValores($id);
        echo json_encode($data['valores']);
    }

    public function update() {
        $supermercado = $this->input->post('supermercado');
        $tamanho = $this->input->post('tamanho');
        $marca = $this->input->post('marca');
        $produto = $this->input->post('produto');
        $valor = $this->input->post('valor');
        $id = $this->input->post('id');
        //$valor =  preg_replace("/\D+/", "", $this->input->post('valor'));
        $data['id_tamanho'] = $tamanho;
        $data['id_supermercado'] = $supermercado;
        $data['id_produto'] = $produto;
        $data['id_marca'] = $marca;
        $data['valor'] = $valor;


        $this->valores->update($data, $id);
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

    public function getValores() {
        $data2['valores'] = $this->valores->getValores();
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $data = array();

        foreach ($data2['valores'] as $r) {

            if ($r->valor_ativo == "s") {
                $opcoes = "<div class='col-md-12'><button class='btn btn-info col-md-5' data-toggle='modal' data-target='#editar-protudos-modal' 
                    onclick=\"alterarValor('$r->id_valor');\"><i class='fa fa-edit'></i> Alterar</button>
                    <button class='btn btn-success col-md-5'
                    onclick=\"desativarValor('$r->id_valor', '$r->valor_ativo');\"><i class='fa fa-close'></i> Desativar</button></div>";
            } else {
                $opcoes = "<div class='col-md-12'><button class='btn btn-info col-md-5' data-toggle='modal' data-target='#editar-protudos-modal' 
                    onclick=\"alterarValor('$r->id_valor');\"><i class='fa fa-edit'></i> Alterar</button>
                    <button class='btn btn-danger col-md-5'
                    onclick=\"desativarValor('$r->id_valor', '$r->valor_ativo');\"><i class='fa fa-close'></i> Ativar</button></div>";
            }


            $data[] = array(
                $r->id_valor,
                $r->nome_categoria,
                $r->nome_produto,
                $r->nome_marca,
                $r->desc_tamanho,
                $r->valor,
                $r->nome_supermercado,
                $r->opcoes = $opcoes,
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

    public function desativar() {
        $id = $this->input->post('id');
        $ativo = $this->input->post('ativo');

        if ($ativo == "s") {
            $data['ativo'] = "n";
        } else {
            $data['ativo'] = "s";
        }
        $this->supermercados->update($data, $id);
    }

}
