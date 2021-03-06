<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
error_reporting(E_ALL);
ini_set("display_errors", 1);	
/*
	Plugin Name:  My Games
	Plugin URI:   
	Description:  Catálogos da minha prateleira de games
	Version:      0.1
	Author:       Gerson Arbigaus
	Author URI:   
	License:      GPL2
	License URI:  https://www.gnu.org/licenses/gpl-2.0.html		
 */


register_activation_hook( __FILE__, array ('My_List_Games', 'mgp_install' ));

add_action( 'admin_menu', array ('My_List_Games','mgp_register_menu') );

// var_dump($_GET);

if(isset($_GET['del_item_id']) && isset($_GET['edit_item_id'])){
	header("Location: http://wordpress.pc/wp-admin/admin.php?page=Gerenciar+Jogos");
}

if (isset($_GET['del_item_id']) && $_GET['del_item_id'] != '') {
	
	My_List_Games::del_item($_GET['del_item_id']);

}
/*
if (isset($_GET['edit_item_id']) && $_GET['edit_item_id'] != '') {
	header("Location: http://wordpress.pc/wp-admin/admin.php?page=Editar+Jogo&item_id=".$_GET['edit_item_id']);
	die;
}
*/

class My_List_Games {

	/*
		Register the menus to admin List Games
	*/ 

	public static function mgp_register_menu()
	{
	    $main = add_menu_page(
	      'Lista Jogos',    // page title
	      'Lista Jogos',     // menu title
	      'manage_options',	// capability
	      'Gerenciar Jogos', // menu slug
	      array (__CLASS__, 'mgp_render_list' ) // callback function
	    );

	    $sub = add_submenu_page(
	    	'Gerenciar Jogos',
	    	'Add Jogos',
	    	'Adicionar Jogo',
	    	'manage_options',
	    	'Adicionar Jogos',
	    	array (__CLASS__, 'mgp_render_form')
	    );

	    $edit = add_submenu_page(
	    	'Editar Jogo', 
	    	'Editar Jogo',
	    	null,
	    	'manage_options',
	    	'Editar Jogo',
	    	array (__CLASS__, 'mgp_render_item')
	    );
	}

	/*
		Render the Form 
	 */

	public static function mgp_render_form() {
		global $title;

		$file = plugin_dir_path( __FILE__ ) . "mgp-form.php";

		if (file_exists($file)) {
			require $file;
		}	    
	}

	/*
		Render the List
	 */

	public static function mgp_render_list() {
		global $title;
		global $wpdb;

		$file = plugin_dir_path( __FILE__ )."mgp-list.php";

		$table_name = $wpdb->prefix . "mgp_table";

		$data =	$wpdb->get_results("SELECT * FROM ".$table_name);

		if(file_exists($file)) {
			require $file;
		}
	}

	public static function mgp_render_item(){
		global $wpdb;
		global $title;

		$file = plugin_dir_path(__FILE__)."mgp-item.php";

		$table_name = $wpdb->prefix . "mgp_table";

		$data =	$wpdb->get_row("SELECT * FROM ".$table_name. " WHERE id = ".$_GET['edit_item_id'] );

		if(file_exists($file)){
			require $file;
		}

	}

	public static function mgp_file_upload($mgp_file) {
		
		// $overrides = array( 'test_form' => false);
		$uploaded = media_handle_upload($mgp_file, 0);

		if ($uploaded && ! isset($uploaded['error'])) {
			return $uploaded;
		} else {
			return $uploaded;
		}

	}

	public static function del_item($item_id) {
		global $wpdb;

		$table_name = $wpdb->prefix . "mgp_table";
		
		if(!empty($item_id)){
			$data =	$wpdb->get_row("SELECT * FROM ".$table_name. " WHERE id = ".$item_id );			

			$del_media = wp_delete_attachment($data->media_id);

			$del_game = $wpdb->delete($table_name, array('id' => $item_id));			
			
		}

	}

	/*
		Create the table to plugin
	 */
	
	public static function mgp_install(){
		global $wpdb;

		$table_name = $wpdb->prefix . "mgp_table";

		$charset_collate = $wpdb->collate;

		$sql = "CREATE TABLE $table_name (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  game_name varchar(32) NULL,
		  game_year mediumint(4) NULL,
		  date_bought date DEFAULT '0000-00-00' NULL,
		  media_id mediumint(9) NULL,
		  PRIMARY KEY  (id)
		) COLLATE {$charset_collate}";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		
	}

}
?>