<h1>Meus Jogos:</h1>
<?php $url = 'http://wordpress.pc/wp-admin/admin.php?page=Gerenciar+Jogos'; ?>

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
			<td><img src="<?php echo wp_get_attachment_url($game->media_id); ?>" alt="<?php echo $game->game_name; ?>" style="width: 150px" /></td>
			<td><h2><?php echo $game->game_name; ?></h2></td>
			<td><?php echo $game->game_year; ?></td>
			<td>Comprado em: <?php echo $game->date_bought; ?></td>
			<td><a class="button button-primary" href="<?php echo $url; ?>&edit_item_id=<?php echo $game->id; ?>">Editar</a></td>
			<td><a class="button button-secondary" href="<?php echo $url; ?>&del_item_id=<?php echo $game->id; ?>">Deletar</a></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>