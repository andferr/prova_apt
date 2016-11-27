<!DOCTYPE html>
<html>
<head>
	<title>Tipos</title>
	<link rel='stylesheet' href='<?php echo base_url("css/bootstrap.css") ?>'>
	<script language='javascript' src='<?php echo base_url("js/jquery-3.1.1.min.js") ?>'></script>
</head>
<body>
	<div class='container'>
		<h1>Tipos</h1>
		<table class='table'>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Criação</th>
			</tr>
			<?php
				foreach($tipos as $tipo){
			?>
			<tr>
				<td><?php echo $tipo->type_id ?> </td>
				<td><?php echo $tipo->name ?> </td>
				<td><?php echo $tipo->created_at ?> </td>
				<td><a href="<?php echo base_url() . 'tipo/edita/' . $tipo->type_id; ?>">[EDIT]</a></td>
				<td><a href="<?php echo base_url() . 'tipo/deleta/' . $tipo->type_id ?>">[DELETE]</a></td>
			</tr>
			<?php
				}
			?>
		</table>
		<h1>Cadastro</h1>
		<?php
			if(isset($dados_tipo)){
				echo form_open("tipo/altera");
			}else{
				echo form_open("tipo/salva");
			}

			echo form_hidden('type_id', isset($dados_tipo) ? $dados_tipo[0]->type_id : "");

			echo form_label("Nome", "nome");
			echo form_input(array(
					"name"=>"nome",
					"id"=>"nome",
					"class"=>"form-control",
					"maxlength"=> "255",
					"value"=> isset($dados_tipo) ? $dados_tipo[0]->name : ""
				));		
			
			echo '<br><br>';


			echo form_button(array(
					"content"=>"Salvar",
					"class"=>"btn btn-primary",
					"type" =>"submit"
				));

			echo "<a href='".base_url()."' class='btn btn-cancel'>Cancelar</a>";

			echo form_close();
		?>
	<container>
</body>
</html>