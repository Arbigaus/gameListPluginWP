<?php
$dados_form = filter_input_array(INPUT_POST,FILTER_SANITIZE_MAGIC_QUOTES);

if(isset($dados_form['game_name']) && !empty($dados_form['game_name'])) {
	global $wpdb;
	
	$table_name = $wpdb->prefix . "mgp_table";
	
	if(isset($_FILES['capa']) && !empty($_FILES['capa']['name'])){
		$uploaded = My_List_Games::mgp_file_upload('capa');
		
		if ($uploaded && ! isset($uploaded['error'])) {
			$dados_form['media_id'] = $uploaded;
		} else {
			echo "Erro ao subir imagem - ".$uploaded['error'];
		}
	}
	
	unset($dados_form['submit']);
	
	$update_item = $wpdb->update($table_name, $dados_form, array ('id' => $_GET['edit_item_id']));
	
	if($update_item === false){
		echo "Erro ao atualizar";
	} else {
		$ok = true;
	}


}
?>