<?php require('mgp-form-edit.php'); ?>
<h1><?php echo $data->game_name; ?></h1>

<br><img src="<?php echo wp_get_attachment_url((isset($dados_form['media_id']))? $dados_form['media_id'] :$data->media_id); ?>" alt="<?php echo $data->game_name; ?>" style="width: 150px">

<div class="wrap">
<h1><?php echo $title; ?></h1>

<link rel="stylesheet" type="text/css" href="<?php  ?>">
	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" accept-charset="utf-8" enctype="multipart/form-data" >
		<hr>
		Nome do Jogo:<br>
		<input type="text" name="game_name" placeholder="Nome do Jogo" value="<?php echo (isset($dados_form['game_name'])) ? $dados_form['game_name'] : $data->game_name; ?>"><br>
		<hr>
		Ano de lançamento:<br>
		<input type="number" name="game_year" placeholder="Ano" value="<?php echo (isset($dados_form['game_year']))? $dados_form['game_year'] : $data->game_year; ?>"><br>
		<hr>
		Data da Compra:<br>
		<input type="date" name="date_bought" value="<?php echo (isset($dados_form['date_bought']))? $dados_form['date_bougth'] : $data->date_bought; ?>"><br>
		<hr>
		Capa do Jogo:<br>
		<input type="file" name="capa" id="capa" value="" placeholder="" /><br>

		<?php submit_button('Salvar'); ?>
		
		<a class="button button-secondary" href="http://wordpress.pc/wp-admin/admin.php?page=Gerenciar+Jogos&del_item_id=<?php echo $data->id; ?>">Deletar</a>
	</form>

	</div>

<?php echo (isset($ok) && $ok)? '<br><a class="button button-primary" href="http://wordpress.pc/wp-admin/admin.php?page=Gerenciar+Jogos">Voltar</a>' :'';