<!DOCTYPE html>
<html>
<head>
	<title>Bem Vindo</title>
	<link rel='stylesheet' href='<?php echo base_url("css/bootstrap.css") ?>'>
</head>
<body>
<div class='container'>
	<h1>Bem Vindo</h1>
	<?php echo "<br><br>"; ?>
	<table class='table'>
		<tr>
			<td><a href="<?php echo base_url('usuario'); ?>" class='btn btn-primary'>CRUD Usuário</a></td>
			<td><a href="<?php echo base_url('tipo') ?>" class='btn btn-primary'>CRUD Tipo</a></td>
		</tr>
	</table>
	
</div>
</body>
</html>