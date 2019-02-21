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
        return $this->db->insert('projeto', $data);
    }
    
    public function salvarMembro($data) {
        return $this->db->insert('equipe', $data);
    }
}
