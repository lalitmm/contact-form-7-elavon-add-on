<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// add elavon menu under contact form 7 menu
add_action( 'admin_menu', 'cf7elavon_admin_menu', 20 );
function cf7elavon_admin_menu() {
	add_submenu_page('wpcf7',__( 'Elavon Settings', 'contact-form-7' ),__( 'Elavon Settings', 'contact-form-7' ),'wpcf7_edit_contact_forms', 'cf7elavon_admin_table','cf7elavon_admin_table');
}


// plugin page links
add_filter('plugin_action_links', 'cf7elavon_plugin_settings_link', 10, 2 );
function cf7elavon_plugin_settings_link($links,$file) {
	
	if ($file == 'contact-form-7-elavon-add-on/elavon.php') {
		
		$settings_link = 	'<a href="admin.php?page=cf7elavon_admin_table">' . __('Settings', 'PTP_LOC') . '</a>';
		$premium_link = 	'<a target="_blank" href="https://wpplugin.org/downloads/contact-form-7-elavon-add-on/">' . __('Pro Version', 'PTP_LOC') . '</a>';
		
		array_unshift($links, $settings_link);
		array_push($links, $premium_link);
	}
	
	return $links; 
}
