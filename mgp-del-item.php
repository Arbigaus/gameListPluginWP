<?php
require("my-games-plugin.php");

if (!isset($_GET['del_item_id']) || empty($_GET['del_item_id'])){
	header("Location: http://wordpress.pc/wp-admin/admin.php?page=Gerenciar+Jogos");
	die();
} else {
	$item = $_GET['del_item_id'];
	$del_item = My_List_Games::del_item($item);

	var_dump($del_item);
}
