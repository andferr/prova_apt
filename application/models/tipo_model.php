<?php

class Tipo_model extends CI_Model {

	public function buscaTodos(){
		return $this->db->order_by("name", "asc")->get("tipo")->result();
	}

	function buscaTodosSelect()
	{
		$this->db->from('tipo');
		$this->db->order_by('name');
		$result = $this->db->get();
		$return = array();
		if($result->num_rows() > 0) {
			foreach($result->result() as $row) {
				$return[$row->type_id] = $row->name;
			}
		}
	   return $return;
	}

	public function salva($tipo){
		$this->db->insert("tipo", $tipo);
		return true;
	}

	function deleta($id) {
		// Valida se a chave está presente na tabela de usuario.

		$query = $this->db->query("SELECT 1 FROM usuario WHERE type_id = ".$id);
		$row = $query->row_array();

		if (!isset($row))
		{

		    $this->db->where('type_id', $id);
		    return $this->db->delete('tipo');
		}

		return false;
	}

	function edita($id) {
	    $this->db->where('type_id', $id);
	    return $this->db->get('tipo')->result();
	}

	function altera($tipo) {
	    $this->db->where('type_id', $tipo['type_id']);
	    $this->db->set($tipo);
	    return $this->db->update('tipo');
	}
}


?>