<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Supermercados extends CI_Controller {

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
    }

    public function index() {


        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/supermercados');
    }

    public function buscarSupermercados() {
        $id = $this->input->post('id');
        $data['supermercados'] = $this->supermercados->buscarSupermercados($id);
        echo json_encode($data['supermercados']);
    }

    public function salvar() {
        $nome = $this->input->post('nome');
        $endereco = $this->input->post('endereco');
        $telefone = preg_replace("/\D+/", "", $this->input->post('telefone'));
        $mapa = $this->input->post('mapa');

        $data['nome_supermercado'] = $nome;
        $data['endereco_supermercado'] = $endereco;
        $data['telefone_supermercado'] = $telefone;
        $data['maps_supermercado'] = $mapa;
        if ($this->supermercados->verificaIfExists($nome) == 0) {

            $this->supermercados->salvar($data);
        } else {
            echo 1;
        }


//        if ($this->tamanhos->verificaTamanho($tamanho) == 0) {
//            $data['desc_tamanho'] = $tamanho;
//            $this->tamanhos->salvar($data);
//        }else{
//            echo 1;
//        }
    }

    public function buscarTamanhos() {
        $id = $this->input->post('id');
        $data['tamanhos'] = $this->tamanhos->buscarTamanhos($id);
        echo json_encode($data['tamanhos']);
    }

    public function update() {
        $id = $this->input->post('id');
        $nome = $this->input->post('nome');
        $telefone = preg_replace("/\D+/", "", $this->input->post('telefone'));
        $endereco = $this->input->post('endereco');
        $maps = $this->input->post('maps');

        $data['nome_supermercado'] = $nome;
        $data['telefone_supermercado'] = $telefone;
        $data['endereco_supermercado'] = $endereco;
        $data['maps_supermercado'] = $maps;                      
        
        $this->supermercados->update($data, $id);
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

    public function getSupermercados() {
        $data2['supermercados'] = $this->supermercados->getSupermercados();
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $data = array();

        foreach ($data2['supermercados'] as $r) {

            if($r->ativo == "s"){
                $opcoes = "<div class='col-md-12'><button class='btn btn-info col-md-5' data-toggle='modal' data-target='#editar-supermercados' 
                    onclick=\"alterarSupermercados('$r->id_supermercado');\"><i class='fa fa-edit'></i> Alterar</button>
                    <button class='btn btn-success col-md-5'
                    onclick=\"desativarSupermercado('$r->id_supermercado', '$r->ativo');\"><i class='fa fa-close'></i> Desativar</button></div>";
            }else{
                 $opcoes = "<div class='col-md-12'><button class='btn btn-info col-md-5' data-toggle='modal' data-target='#editar-supermercados' 
                    onclick=\"alterarSupermercados('$r->id_supermercado');\"><i class='fa fa-edit'></i> Alterar</button>
                    <button class='btn btn-danger col-md-5'
                    onclick=\"desativarSupermercado('$r->id_supermercado', '$r->ativo');\"><i class='fa fa-close'></i> Ativar</button></div>";
            }
            
            
            $data[] = array(
                $r->id_supermercado,
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
     
        if($ativo == "s"){
               $data['ativo'] = "n";
        }else{
               $data['ativo'] = "s";
        }
        $this->supermercados->update($data, $id);
        
    }

}
