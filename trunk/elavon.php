<?php

/*
Plugin Name: Contact Form 7 - Elavon Add-on
Plugin URI: 
Description: Integrates Elavon with Contact Form 7
Author: 
Author URI: 
License: GPL2
Version: 0.0.1
*/

/*  Copyright 2018 Roventix Inc

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

*/



// plugin variable: cf7elavon

// empty function used by pro version to check if free version is installed
function cf7elavon_free() {
}

// check if pro version is attempting to be activated - if so, then deactive this plugin
if (function_exists('cf7elavon_pro')) {

	deactivate_plugins('contact-form-7-elavon-add-on-pro/elavon.php');

} else {

	//  plugin functions
	register_activation_hook( 	__FILE__, "cf7elavon_activate" );
	register_deactivation_hook( __FILE__, "cf7elavon_deactivate" );
	register_uninstall_hook( 	__FILE__, "cf7elavon_uninstall" );

	function cf7elavon_activate() {
		
		// default options
		$cf7elavon_options = array(
			'currency'    		=> '25',
			'language'    		=> '3',
			'liveaccount'    	=> '',
			'sandboxaccount'    => '',
			'mode' 				=> '2',
			'cancel'    		=> '',
			'return'    		=> '',
			'redirect'			=> '2',
			'pub_key_live'		=> '',
			'sec_key_live'		=> '',
			'pub_key_test'		=> '',
			'sec_key_test'		=> '',
		);
		
		add_option("cf7elavon_options", $cf7elavon_options);
		
	}

	function cf7elavon_deactivate() {
		
		delete_option("cf7elavon_my_plugin_notice_shown");
		
	}

	function cf7elavon_uninstall() {
	}

	// check to make sure contact form 7 is installed and active
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {		
		
		// public includes
		include_once('includes/functions.php');
		include_once('includes/redirect_methods.php');
		include_once('includes/redirect.php');
		include_once('includes/enqueue.php');
		
		
		// admin includes
		if (is_admin()) {
			include_once('includes/admin/tabs_page.php');
			include_once('includes/admin/settings_page.php');
			include_once('includes/admin/menu_links.php');
			include_once('includes/admin/extensions.php');
		}
		
		
		// start session if not already started
		function cf7elavon_session() {
			if(!session_id()) {
				session_start();
			}
		}
		add_action('init', 'cf7elavon_session', 1);
		
		
	} else {
		
		// give warning if contact form 7 is not active
		function cf7elavon_my_admin_notice() {
			?>
			<div class="error">
				<p><?php _e( '<b>Contact Form 7 - Elavon Add-on:</b> Contact Form 7 is not installed and / or active! Please install <a target="_blank" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a>.', 'cf7elavon' ); ?></p>
			</div>
			<?php
		}
		add_action( 'admin_notices', 'cf7elavon_my_admin_notice' );
		
	}
}


?
