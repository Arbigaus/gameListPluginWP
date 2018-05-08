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

		$file = plugin_dir_path( __FILE__ )."mgp-list.php";

		if(file_exists($file)) {
			require $file;
		}
	}

	/*
		Create the table to plugin
	 */
	
	public static function mgp_install(){
		global $wpdb;

		$table_name = $wpdb->prefix . "mgp_table";

		echo $table_name;
	}

	public static function mgp_file_upload($file) {

		$uploaded = media_handle_upload($file, 0);

		if (is_wp_error($uploaded)) {
			echo "Erro ao fazer upload ".$uploaded->get_error_message();
		} else {
			echo "Upload concluido!";
		}

	}

}