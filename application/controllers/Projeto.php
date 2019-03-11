<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projeto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Projeto', 'projeto');
        $this->load->helper('uteis_helper');
        if ($this->session->userdata('usuario') == null)
            redirect('Login');
    }

    public function index() {
        // $data['categorias'] = $this->categoria->getCategorias();
        $data['areas'] = $this->projeto->areas();
        $data['vinculos'] = $this->projeto->vinculos();
        $data['finalidades'] = $this->projeto->finAcademica();
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/projeto', $data);
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
        echo $this->projeto->salvar($data);
    }

    public function getProjetos() {
        $data2['projetos'] = $this->projeto->getProjetos();

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $url = base_url('projeto/administrar');
        $data = array();
        foreach ($data2['projetos'] as $r) {
            $data[] = array(
                $r->id_projeto,
                $r->titulo,
                $r->opcoes = "<div class='col-md-12'>
                    <button class='btn btn-success col-md-3'
                    onclick=\"adminProjeto('$r->id_projeto');\"><i class='fa fa-close'></i> Administrar</button>


                    <button class='btn btn-info col-md-3'
                    onclick=\"editarProjeto('$r->id_projeto');\"><i class='fa fa-close'></i> Editar</button>
                    
                    <button class='btn btn-danger col-md-3'
                    onclick=\"excluirProjeto('$r->id_projeto');\"><i class='fa fa-close'></i> Excluir</button></div>
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

    public function excluir() {
        $id = $this->input->post('id');
        $this->projeto->excluir($id);
    }

    public function administrar() {
        $id = $this->uri->segment(3);
        $data['areas'] = $this->projeto->areas();
        $data['vinculos'] = $this->projeto->vinculos();
        $data['finalidades'] = $this->projeto->finAcademica();
        $data['numMembros'] = $this->projeto->numMembros($id);
        $data['especies'] = $this->projeto->getEspecies();
        $data['procedencias'] = $this->projeto->getProcedencias();

        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/admin-projeto', $data);
        $this->load->view('admin/modal-add-membros', $data);

        $this->load->view('admin/tabela-especies');
        $this->load->view('admin/modal-add-animal-experimental', $data);
        $this->load->view('admin/modal-procedimentos', $data);
        $this->load->view('admin/modal-add-medicamentos');
    }

    public function salvarAnimalExperimental() {

        $data['id_especie'] = $this->input->post('especie');
        $data['id_projeto'] = $this->input->post('id_projeto');
        $data['linhagem'] = $this->input->post('linhagem');
        $data['idade'] = $this->input->post('idade');
        $data['peso'] = $this->input->post('peso');
        $data['num_animais_grupo'] = $this->input->post('numAnimaisGrupo');
        $data['num_grupos'] = $this->input->post('numGrupos');
        $data['qtd_mas'] = $this->input->post('qtdM');
        $data['qtd_fem'] = $this->input->post('qtdF');
        $data['criterio'] = $this->input->post('criterio');
        $data['num_sisbio'] = $this->input->post('sisbio');
        $data['metodo_captura'] = $this->input->post('captura');
        $data['procedencia_outras'] = $this->input->post('qualprocedimento');
        $data['num_ctnbio'] = $this->input->post('numctnbio');
        $data['aprv_aniamais'] = $this->input->post('aproveitamento');
        $data['aprv_animais_como'] = $this->input->post('qualaproveitamento');
        $data['manejo_animais'] = $this->input->post('manejo');
        $data['tipo_agua'] = $this->input->post('agua');
        $data['racao_comercia'] = $this->input->post('racaoComercial');
        $data['qual_racao'] = $this->input->post('qualRacao');
        $data['racao_especial'] = $this->input->post('racaoEspecial');
        $data['procedencia'] = $this->input->post('procedencia');
        $data['id_pessoa'] = $this->session->userdata('usuario')->id_pessoa;

        $data['dt_update'] = date('Y-m-d');

        $id_modelo_animal = $this->input->post('id_modelo_animal');

        if ($id_modelo_animal != "n") {
            echo $this->projeto->salvarEdicaoAnimalExperimental($data, $id_modelo_animal);
        } else {
            $data['dt_cadastro'] = date('Y-m-d');
            echo $this->projeto->salvarAnimalExperimental($data);
        }
    }

    public function getModeloAnimal() {
        $id_projeto = $this->input->get('id_projeto');
        $data2['modeloAnimal'] = $this->projeto->getModeloAnimal($id_projeto);

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data = array();
        foreach ($data2['modeloAnimal'] as $r) {
            $data[] = array(
                $r->id_modelo_animal,
                $r->nome_especie,
                $r->nome_pessoa,
                data_br($r->dt_cadastro),
                $r->opcoes = "<div class='col-md-12'>
                    <button class='btn btn-info col-md-5'
                    onclick=\"editarModeloAnimal('$r->id_modelo_animal');\" data-toggle='modal' data-target='#modal-add-animal-experimental'><i class='fa fa-close'></i> Editar</button>
                    
                    <button class='btn btn-danger col-md-5'
                    onclick=\"excluirModeloAnimal('$r->id_modelo_animal');\" ><i class='fa fa-close'></i> Excluir</button></div>
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

    public function excluirExpecie() {
        $id = $this->input->post('id');
        echo $this->projeto->excluirAnimal($id);
    }

    public function getEspecieID() {
        $id = $this->input->post('id');
        $data['especie'] = $this->projeto->getEspecieID($id);
        echo json_encode($data['especie']);
    }

    public function salvarMedicamento() {
        $data['id_projeto'] = $this->input->post('id_projeto');
        $data['farmaco'] = $this->input->post('farmaco');
        $data['dose'] = $this->input->post('dose');
        $data['frequencia'] = $this->input->post('frequencia');
        $data['duracao'] = $this->input->post('duracao');
        $data['via'] = $this->input->post('via');
        
        $id_medicamento = $this->input->post('id_medicamento');
        
        echo $this->projeto->salvarMedicamento($data, $id_medicamento);
    }

    public function getMedicamentos() {
        $id = $this->input->get('id_projeto');
        $data2['medicamento'] = $this->projeto->getMedicamentos($id);
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data = array();
        foreach ($data2['medicamento'] as $r) {
            $data[] = array(
                $r->id_medicamento,
                $r->farmaco,
                $r->dose,            
                $r->opcoes = "<div class='col-md-12'>
                    <button class='btn btn-info col-md-5'
                    onclick=\"editarMedicamento('$r->id_medicamento');\"><i class='fa fa-close'></i> Editar</button>
                    
                    <button class='btn btn-danger col-md-5'
                    onclick=\"excluirMedicamento('$r->id_medicamento');\" ><i class='fa fa-close'></i> Excluir</button></div>
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
    
    public function excluirMedicamento() {
        $id = $this->input->post('id');       
        echo $this->projeto->excluirMedicamento($id);
    }
    
    public function getMedicamentoID() {
        $id = $this->input->post('id');
        $data['medicamento'] = $this->projeto->getMedicamentoID($id);
        echo json_encode($data['medicamento']);
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
