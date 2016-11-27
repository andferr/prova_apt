<!DOCTYPE html>
<html>
<head>
	<title>Usuários</title>
	<link rel='stylesheet' href='<?php echo base_url("css/bootstrap.css") ?>'>
	<script language='javascript' src='<?php echo base_url("js/jquery-3.1.1.min.js") ?>'></script>
</head>
<body>
	<div class='container'>
		<h1>Usuários</h1>
		<table class='table'>
			<tr>
				<th>ID</th>
				<th>Tipo</th>
				<th>Nome</th>
				<th>Email</th>
				<th>Criação</th>
			</tr>
			<?php
				foreach($usuarios as $usuario){
			?>
			<tr>
				<td><?php echo $usuario->id ?></td>
				<td><?php echo $usuario->tipo ?> </td>
				<td><?php echo $usuario->name ?> </td>
				<td><?php echo $usuario->email ?> </td>
				<td><?php echo $usuario->created_at ?> </td>
				<td><a href="<?php echo base_url() . 'usuario/edita/' . $usuario->id; ?>">[EDIT]</a></td>
				<td><a href="<?php echo base_url() . 'usuario/deleta/' . $usuario->id ?>">[DELETE]</a></td>
			</tr>
			<?php
				}
			?>
		</table>
		<h1>Cadastro</h1>
		<?php
			
			if(isset($dados_usuario)){
				echo form_open("usuario/altera",array('id'=>'formUsuario'));
			}else{
				echo form_open("usuario/salva",array('id'=>'formUsuario'));
			}

			echo form_hidden('id', isset($dados_usuario) ? $dados_usuario[0]->id : "");

			echo form_label("Nome", "nome");
			echo form_input(array(
					"name"=>"nome",
					"id"=>"nome",
					"class"=>"form-control",
					"maxlength"=> "255",
					"value"=> isset($dados_usuario) ? $dados_usuario[0]->name : ""
			));

			echo form_label("Email", "email");
			echo form_input(array(
					"name"=>"email",
					"id"=>"email",
					"class"=>"form-control",
					"maxlength"=> "255",
					"value"=> isset($dados_usuario) ? $dados_usuario[0]->email : ""
				));

			echo form_label("Tipo", "tipo");
			echo '<br>';
			echo form_dropdown('tipo_id', $tipos, (isset($dados_usuario) ? $dados_usuario[0]->type_id : ""),array("id"=>"tipo"));
			echo '<br><br>';
			
			echo form_button(array(
					"content"=>"Salvar",
					"class"=>"btn btn-primary",
					"type" =>"submit",
					"id" => "btn"
				));

			echo "<a href='".base_url()."' class='btn btn-cancel'>Cancelar</a>";


			echo form_close();
		?>
	<container>
</body>
</html>

<script>
	$(document).ready(function(){
		$('#formUsuario').on("submit", function(){
			var err = 0;
			if($('#nome').val().length > 255 || $('#nome').val().length < 4){
				err = 1;
			}

			if($('#email').val().search('@') < 0){
				err = 1;
			}

			if(err > 0){
				alert('Existem erros de preenchimento no formulário!');
				return false;
			}else{
				return true;
			}
		});
	});
</script>