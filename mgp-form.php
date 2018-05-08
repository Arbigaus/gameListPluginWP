<div class="wrap">
<h1><?php echo $title; ?></h1>

<link rel="stylesheet" type="text/css" href="<?php  ?>">
	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" accept-charset="utf-8" enctype="multipart/form-data" >
		Nome do Jogo:<br>
		<input type="text" name="name" placeholder="Nome do Jogo"><br>
		Ano de lançamento:<br>
		<input type="number" name="year" placeholder="Ano"><br>
		Data da Compra:<br>
		<input type="date" name="date_bought"><br>
		Capa do Jogo:<br>
		<input type="file" name="capa" id="capa" value="" placeholder="" />

		<?php submit_button('Salvar'); ?>
	</form>

</div>

<?php require('mgp-form-submit.php'); ?>