<h1>Meus Jogos:</h1>
<?php $url = plugin_dir_url( $file ); ?>

<table style="width:80%">
	<caption><h2>Lista de Jogos</h2></caption>
	<thead>
		<tr>
			<th>Imagem</th>
			<th>Titulo</th>
			<th>Ano de Lançamento</th>
			<th>Data de Compra</th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $game): ?>
		<tr>
			<td><img src="<?php echo wp_get_attachment_image_src($game->media_id)[0]; ?>" alt="<?php echo $game->game_name; ?>"></td>
			<td><h2><?php echo $game->game_name; ?></h2></td>
			<td><?php echo $game->game_year; ?></td>
			<td>Comprado em: <?php echo $game->date_bought; ?></td>
			<td><a class="button button-primary" href="<?php echo $url; ?>mgp-del-item.php?del_item_id=<?php echo $game->id; ?>">Editar</a></td>
			<td><a class="button button-secondary" href="#">Deletar</a></td>
		</tr>
		<?php endforeach; ?>		
	</tbody>
</table>

