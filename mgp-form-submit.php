<?php
$dados_form = filter_input_array(INPUT_POST,FILTER_SANITIZE_MAGIC_QUOTES);

if(isset($_FILES['capa']) && !empty($_FILES['capa']['name'])){
	global $wpdb;

	$uploaded = My_List_Games::mgp_file_upload('capa');

	if ($uploaded && ! isset($uploaded['error'])) {			
			$dados_form['media_id'] = $uploaded;
			unset($dados_form['submit']);

			$table_name = $wpdb->prefix . "mgp_table";

			$wpdb->insert($table_name, $dados_form );

			echo "Dados enviado com sucesso!";

	} else {
			echo $uploaded['error'];
	}
}