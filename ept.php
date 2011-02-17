<?php
/*
Plugin Name: EPT - Empty Plugin Template
Plugin URI: http://1manfactory.com/ept
Description: An empty plugin template to start with, including the most basic necessary stuff
Version: 0.1
Author: Juergen Schulze, 1manfactory@gmail.com
Author URI: http://1manfactory.com
License: GPL2
*/

/*  Copyright 2011  Juergen Schulze  (email : 1manfactory@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?><?php

// Version/Build of the plugin
define( 'EPT_PUGIN_NAME', 'EPT Empty Plugin Template');
define( 'EPT_PLUGIN_DIRECTORY', 'empty-plugin-template');
define( 'EPT_CURRENT_VERSION', '0.1' );
define( 'EPT_CURRENT_BUILD', '1' );


// i18n plugin domain for language files
define( 'EMU2_I18N_DOMAIN', 'ept' );
// load language files
function ept_set_lang_file() {
	# set the language file
	$currentLocale = get_locale();
	if(!empty($currentLocale)) {
		$moFile = dirname(__FILE__) . "/lang/" . $currentLocale . ".mo";
		if (@file_exists($moFile) && is_readable($moFile)) {
			load_textdomain(EMU2_I18N_DOMAIN, $moFile);
		}

	}
}
ept_set_lang_file();

// create custom plugin settings menu
add_action('admin_menu', 'ept_create_menu');

//call register settings function
add_action( 'admin_init', 'ept_register_settings' );

register_activation_hook(__FILE__, 'ept_activate');
register_deactivation_hook(__FILE__, 'ept_deactivate');
register_uninstall_hook(__FILE__, 'ept_uninstall');

// activating the default values
function ept_activate() {
	add_option('ept_option_3', 'any_value');
}

// deactivating
function ept_deactivate() {
	// needed for proper deletion of every option
	delete_option('ept_option_3');
}

// uninstalling
function ept_uninstall() {
	# delete all data stored
	delete_option('ept_option_3');
}

function ept_create_menu() {

	// create new top-level menu
	#add_menu_page( __('HTML Title', EMU2_I18N_DOMAIN), EPT_PUGIN_NAME, 9, basename(__FILE__), 'ept_settings_page', plugins_url('/images/icon.png', __FILE__));
	#add_submenu_page( basename(__FILE__), __("HTML Title", EMU2_I18N_DOMAIN), __("Menu title", EMU2_I18N_DOMAIN), 9, basename(__FILE__), EPT_PLUGIN_DIRECTORY.'/ept_settings_page.php' );
	#add_submenu_page( basename(__FILE__), __("HTML Title2", EMU2_I18N_DOMAIN), __("Menu title 2", EMU2_I18N_DOMAIN), 9, basename(__FILE__), EPT_PLUGIN_DIRECTORY.'/ept_settings_page2.php' );
	
	// or create options menu page
	add_options_page(__('HTML Title', EMU2_I18N_DOMAIN), __("Menu title", EMU2_I18N_DOMAIN), 9,  EPT_PLUGIN_DIRECTORY.'/ept_settings_page.php');

	// or create sub menu page
	$parent_slug="index.php";	# For Dashboard
	$parent_slug="edit.php";	# For Posts
	// more examples at http://codex.wordpress.org/Administration_Menus
	#add_submenu_page( $parent_slug, __("HTML Title", EMU2_I18N_DOMAIN), __("Menu title", EMU2_I18N_DOMAIN), 9, EPT_PLUGIN_DIRECTORY.'/ept_settings_page.php');
}


function ept_register_settings() {
	//register settings
	register_setting( 'ept-settings-group', 'new_option_name' );
	register_setting( 'ept-settings-group', 'some_other_option' );
	register_setting( 'ept-settings-group', 'option_etc' );
}


?>
