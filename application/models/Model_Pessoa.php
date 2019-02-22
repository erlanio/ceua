<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Pessoa extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function retornaEstados() {
        $this->db->order_by('nome', 'asc');
        return $this->db->get('estados')->result();
    }

    public function retornaCidadesPorEstado($id_estado) {
        $this->db->where('estados_id', $id_estado);
        return $this->db->get('cidades')->result();
    }

    public function selectedCidades($id_estado) {
        $cidades = $this->retornaCidadesPorEstado($id_estado);

        $option = "<option>Selecione a cidade...</option>";

        foreach ($cidades as $cidade) {
            $option .= "<option value='$cidade->id'>{$cidade->nome}</option>" . PHP_EOL;
        }
        return $option;
    }

    public function salvar($data) {
        return $this->db->insert('pessoa', $data);
    }

    public function salvarMembro($data) {
        $this->db->insert('pessoa', $data);
        return $this->db->insert_id();
    }

    public function verificaCPF($cpf) {
        $this->db->where('cpf_pessoa', $cpf);
        return $this->db->get('pessoa')->num_rows();
    }

    public function verificaLogin($email, $senha) {
        $this->db->where('email_pessoa', $email);
        $this->db->where('senha_pessoa', $senha);
        return $this->db->get('pessoa')->num_rows();
    }

    public function retornaPessoa($email, $senha) {
        $this->db->where('email_pessoa', $email);
        $this->db->where('senha_pessoa', $senha);
        return $this->db->get('pessoa')->result();
    }

    public function retornaCidade() {
        $this->db->where('id', $this->session->userdata('usuario')->id_cidade);
        return $this->db->get('cidades')->result();
    }

    public function buscar($id_pessoa) {
        $this->db->where('id_pessoa', $id_pessoa);
        return $this->db->get('pessoa')->result();
    }

    public function buscarCPF($cpf) {
        $this->db->where('cpf_pessoa', $cpf);
        return $this->db->get('pessoa')->result();
    }

    public function getMembros($id_projeto) {
        return $this->db->query("select 
 	vi.desc_vinculo,
    p.id_pessoa,
    p.nome_pessoa,
    e.id_equipe
    from equipe as e join pessoa as p on e.id_pessoa = p.id_pessoa join projeto as pr on pr.id_projeto = e.id_projeto join vinculos_instituicao as vi on vi.id_vinculo = e.id_vinculo where e.id_projeto = $id_projeto")->result();
    }

}
