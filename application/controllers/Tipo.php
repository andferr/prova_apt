<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*

- type_id;
- name;
- created_at;

*/

class Tipo extends CI_Controller {

	public function index(){

		$this->load->model("tipo_model");
		$this->load->helper(array("url","form"));

		$lista_tipos = $this->tipo_model->buscaTodos();

		$dados = array("tipos" => $lista_tipos);
		$this->load->view("tipo/index.php", $dados);
	}

	public function salva() {

		$tipo = array(
			"name" => $this->input->post("nome"),
			"type_id" => $this->input->post("type_id"),
			"created_at" => Date('Y-m-d H:i:s')
		);

		$this->load->model("tipo_model");
		$this->load->helper(array("url","form"));
		
		if ($this->tipo_model->salva($tipo)) {
            $dados = array("msg"=>"Tipo cadastrado com sucesso!");
        } else {
            $dados = array("msg"=>"Falha no cadastro");
        }

	    $this->load->view("tipo/resultado.php", $dados);

	}

	public function edita($id)  {
	 
	    $this->load->model("tipo_model");
	    $this->load->helper(array("url","form"));

	    $dados_tipo = $this->tipo_model->edita($id);
	    $lista_tipos = $this->tipo_model->buscaTodos();

		$dados = array("tipos" => $lista_tipos, "dados_tipo" => $dados_tipo);
	 
	    $this->load->view("tipo/index.php", $dados);
	}

	public function altera()  {
	 
		$this->load->model("tipo_model");
		$this->load->helper(array("url","form"));

		$this->load->library('form_validation');

	    $this->form_validation->set_error_delimiters('', '');
	    $validations = array(
	        array(
	            'field' => 'nome',
	            'label' => 'Nome',
	            'rules' => 'required|min_length[4]|max_length[255]'
	        )
	    );
	    $this->form_validation->set_rules($validations);
	    if ($this->form_validation->run() == FALSE) {
	        $this->edita($this->input->post('type_id'));
	    } else {
		    $tipo = array(
				"name" => $this->input->post("nome"),
				"type_id" => $this->input->post("type_id"),
				"created_at" => Date('Y-m-d H:i:s')
			);

	        if ($this->tipo_model->altera($tipo)) {
	            $dados = array("msg"=>"Alteração realizada com sucesso!");
	        } else {
	            $dados = array("msg"=>"Falha na alteração!");
	        }

	        $this->load->view("tipo/resultado.php", $dados);
		}
	}

	public function deleta($id) {
	    $this->load->model('tipo_model');
	    $this->load->helper(array("url","form"));

	    
	    if ($this->tipo_model->deleta($id)) {
	    	$dados = array("msg"=>"O tipo foi excluido com sucesso!");
	    } else {
	    	$dados = array("msg"=>"Falha na exclusão, verifique se o tipo está sendo utilizado por um usuário.");
	    }

	     $this->load->view("tipo/resultado.php", $dados);
	}
}

?>