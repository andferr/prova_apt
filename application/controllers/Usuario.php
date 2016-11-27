<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*

- id;
- type_id;
- name;
- email;
- created_at;

*/

class Usuario extends CI_Controller {

	public function index(){


		$this->load->model("usuario_model");
		$this->load->model("tipo_model");
		$this->load->helper(array("url","form"));

		$lista_usuarios = $this->usuario_model->buscaTodos();
		$lista_tipos = $this->tipo_model->buscaTodosSelect();

		$dados = array("usuarios" => $lista_usuarios, "tipos" => $lista_tipos);
		$this->load->view("usuario/index.php", $dados);
	}

	public function salva() {

		$usuario = array(
			"email" => $this->input->post("email"),
			"name" => $this->input->post("nome"),
			"type_id" => $this->input->post("tipo_id"),
			"created_at" => Date('Y-m-d H:i:s')
		);

		$this->load->model("usuario_model");
		$this->load->helper(array("url","form"));

		if ($this->usuario_model->salva($usuario)) {
            $dados = array("msg"=>"Usuário cadastrádo com sucesso!");
        } else {
            $dados = array("msg"=>"Falha no cadastro!");
        }

	    $this->load->view("usuario/resultado.php", $dados);

	}

	public function edita($id)  {
	 
	    $this->load->model("usuario_model");
		$this->load->model("tipo_model");
		$this->load->helper(array("url","form"));

		$lista_usuarios = $this->usuario_model->buscaTodos();
		$lista_tipos = $this->tipo_model->buscaTodosSelect();

	    $dados_usuario = $this->usuario_model->edita($id);
	 	
	 	$dados = array("usuarios" => $lista_usuarios, "tipos" => $lista_tipos, "dados_usuario" => $dados_usuario);

	    $this->load->view("usuario/index.php", $dados);
	}

	public function altera()  {
	 	$this->output->enable_profiler(TRUE);
	    $this->load->model("usuario_model");
		$this->load->model("tipo_model");
		$this->load->helper(array("url","form"));

		$this->load->library('form_validation');

	    $this->form_validation->set_error_delimiters('', '');
	    $validations = array(
	        array(
	            'field' => 'nome',
	            'label' => 'Nome',
	            'rules' => 'required|min_length[4]|max_length[255]'
	        ),
	        array(
	            'field' => 'email',
	            'label' => 'Email',
	            'rules' => 'trim|required|valid_email|max_length[255]'
	        )
	    );
	    $this->form_validation->set_rules($validations);
	    if ($this->form_validation->run() == FALSE) {
	       $dados = array("msg"=>"Falha na edição! Verifique o valor dos campos!");
	       $this->load->view("usuario/resultado.php", $dados);
	    } else {
	       $usuario = array(
	       		"id" => $this->input->post("id"),
				"email" => $this->input->post("email"),
				"name" => $this->input->post("nome"),
				"type_id" => $this->input->post("tipo_id"),
				"created_at" => Date('Y-m-d H:i:s')
			);

	        if ($this->usuario_model->altera($usuario)) {
	            $dados = array("msg"=>"Edição realizada com sucesso!");
	        } else {
	            $dados = array("msg"=>"Falha na edição!  Verifique o valor dos campos");
	        }

	        $this->load->view("usuario/resultado.php", $dados);
		}
	}

	public function deleta($id) {
	    $this->load->model('usuario_model');
	    $this->load->helper(array("url","form"));

	    
	    if ($this->usuario_model->deleta($id)) {
	    	$dados = array("msg"=>"Usuário removido com sucesso!");
	    } else {
	    	$dados = array("msg"=>"Falha na remoção do usuário!");
	    }

	     $this->load->view("usuario/resultado.php", $dados);
	}
}

?>