<?php
$dados_form = filter_input_array(INPUT_POST,FILTER_SANITIZE_MAGIC_QUOTES);

if(isset($_FILES['capa'])){
	return My_List_Games::mgp_file_upload($_FILES['capa']);
}


echo "<pre>";
print_r($dados_form);
echo "</pre>";