<?php

class Usuario_model extends CI_Model {

	public function buscaTodos(){
		return $this->db->query("SELECT a.email,a.id,a.name,a.created_at, a.type_id,b.name as `tipo` FROM usuario a JOIN tipo b ON a.type_id = b.type_id ORDER BY a.name")->result();
	}

	public function salva($usuario){
		$this->db->insert("usuario", $usuario);
		return true;
	}

	function deleta($id) {
	    $this->db->where('id', $id);
	    return $this->db->delete('usuario');
	}

	function edita($id) {
	    $this->db->where('id', $id);
	    return $this->db->get('usuario')->result();
	}

	function altera($usuario) {
	    $this->db->where('id', $usuario['id']);
	    $this->db->set($usuario);
	    return $this->db->update('usuario');
	}
}


?>