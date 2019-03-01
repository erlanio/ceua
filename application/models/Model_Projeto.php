<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Projeto extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function areas() {
        $this->db->order_by('desc_area', 'asc');
        return $this->db->get('areas_conhecimento')->result();
    }

    public function retornaSubArea($id_area) {
        echo $id_area;
        $this->db->where('id_area', $id_area);
        return $this->db->get('sub_areas')->result();
    }

    public function selectedSubArea($id_area) {
        $subAreas = $this->retornaSubArea($id_area);

        $option;

        foreach ($subAreas as $sub) {
            $option .= "<option value='$sub->id_subarea'>{$sub->desc_subarea}</option>" . PHP_EOL;
        }
        return $option;
    }

    public function vinculos() {
        $this->db->order_by('desc_vinculo', 'asc');
        return $this->db->get('vinculos_instituicao')->result();
    }

    public function finAcademica() {
        $this->db->order_by('desc_fin_academica', 'asc');
        return $this->db->get('fin_academica')->result();
    }

    public function subFinalidade($id) {
        $this->db->where('id_fin_academica', $id);
        return $this->db->get('sub_fin')->result();
    }

    public function selectedSubFinalidade($id) {
        $finalidade = $this->subFinalidade($id);

        $option = "";

        foreach ($finalidade as $fin) {
            $option .= "<option value='$fin->id_sub_fin'>{$fin->desc_sub_fin}</option>" . PHP_EOL;
        }
        return $option;
    }

    public function salvar($data) {
        $this->db->insert('projeto', $data);
        return $this->db->insert_id();
    }

    public function salvarMembro($data) {
        return $this->db->insert('equipe', $data);
    }

    public function getProjetos() {
        $id = $this->session->userdata('usuario')->id_pessoa;
        return $this->db->query("select * from projeto where id_pessoa = $id")->result();
    }

    public function excluir($id) {
        $this->db->where('id_projeto', $id);
        $this->db->delete('projeto');
    }

    public function numMembros($id) {
        $this->db->where("id_projeto", $id);
        return $this->db->get('equipe')->num_rows();
    }

    public function verificaMembro($id) {
        $this->db->where('id_pessoa', $id);
        return $this->db->get('equipe')->num_rows();
    }

    public function getEspecies() {
        return $this->db->get('especies')->result();
    }

    public function getProcedencias() {
        $this->db->order_by('desc_procedencia', 'asc');
        return $this->db->get('procedencia')->result();
    }

    public function salvarAnimalExperimental($data) {

        return $this->db->insert('modelo_animal', $data);
    }

    public function salvarEdicaoAnimalExperimental($data, $id_modelo_animal) {
        $this->db->where('id_modelo_animal', $id_modelo_animal);
        return $this->db->update('modelo_animal', $data);
    }

    public function getModeloAnimal($id_projeto) {
        return $this->db->query("select * from modelo_animal as ma join especies as es on es.id_especie = ma.id_especie join projeto as p on p.id_projeto = ma.id_projeto join pessoa as pes on pes.id_pessoa = ma.id_pessoa where ma.id_projeto = $id_projeto")->result();
    }

    public function excluirAnimal($id) {
        $this->db->where('id_modelo_animal', $id);
        return $this->db->delete('modelo_animal');
    }

    public function getEspecieID($id) {
        return $this->db->query("select * from modelo_animal as ma join especies as es on es.id_especie = ma.id_especie join projeto as p on p.id_projeto = ma.id_projeto join pessoa as pes on pes.id_pessoa = ma.id_pessoa where ma.id_modelo_animal = $id")->result();
    }

}
