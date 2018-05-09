<?php


if (!isset($_GET['del_item_id']) || empty($_GET['del_item_id'])){
	header("Location: http://wordpress.pc/wp-admin/admin.php?page=Gerenciar+Jogos");
	die();
} else {
	require_once(plugin_dir_path( __FILE__ )."my-games-plugin.php");
	My_List_Games::del_item($_GET['del_item_id']);
}
