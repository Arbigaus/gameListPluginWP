<h1><?php echo $data->game_name; ?></h1>

<br><img src="<?php echo wp_get_attachment_url($data->media_id); ?>" alt="<?php echo $data->game_name; ?>" style="width: 150px">

<div class="wrap">
<h1><?php echo $title; ?></h1>

<link rel="stylesheet" type="text/css" href="<?php  ?>">
	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" accept-charset="utf-8" enctype="multipart/form-data" >
		<hr>
		Nome do Jogo:<br>
		<input type="text" name="game_name" placeholder="Nome do Jogo" value="<?php echo $data->game_name; ?>"><br>
		<hr>
		Ano de lançamento:<br>
		<input type="number" name="game_year" placeholder="Ano" value="<?php echo $data->game_year; ?>"><br>
		<hr>
		Data da Compra:<br>
		<input type="date" name="date_bought" value="<?php echo $data->date_bought; ?>"><br>
		<hr>
		Capa do Jogo:<br>
		<input type="file" name="capa" id="capa" value="" placeholder="" /><br>

		<?php submit_button('Salvar'); ?> <a class="button button-secondary" href="http://wordpress.pc/wp-admin/admin.php?page=Gerenciar+Jogos&del_item_id=<?php echo $data->id; ?>">Deletar</a>
	</form>

</div>

<?php require('mgp-form-edit.php'); ?>