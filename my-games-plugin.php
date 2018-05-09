<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
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

class My_List_Games {

	/*
		Register the menus to admin List Games
	*/

	function mgp_register_menu()
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
	}

	/*
		Render the Form 
	 */

	function mgp_render_form() {
		global $title;

		$file = plugin_dir_path( __FILE__ ) . "mgp-form.php";

		if (file_exists($file)) {
			require $file;
		}	    
	}

	/*
		Render the List
	 */

	function mgp_render_list() {
		global $title;
		global $wpdb;

		$file = plugin_dir_path( __FILE__ )."mgp-list.php";

		$table_name = $wpdb->prefix . "mgp_table";

		$data =	$wpdb->get_results("SELECT * FROM ".$table_name);



		if(file_exists($file)) {
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
		echo $item_id;
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