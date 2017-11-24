<?php
	/*
	Plugin Name: THFO Role
	Plugin URI: https://www.thivinfo.com
	Description: Create Role From admin removing theme & extension + some stuff
	Author: Sébastien SERRE
	Author URI: https://www.paypal.me/sebastienserre
	Version: 1.0.0
	*/

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	} // Exit if accessed directly

	/**
	 * https://www.easywebdesigntutorials.com/creating-a-custom-user-role/
	 * @author sebastienserre
	 * @version 1.0.0
	 */

	function thfo_create_role() {
		global $wp_roles;
		if ( ! isset( $wp_roles ) ) {
			$wp_roles = new WP_Roles();
		}

		/**
		 * From which role would you like to copy to start creating your own role?
		 * Replace administrator by an existing WP role
		 */
		define('ROLE_FROM', 'administrator');

		/**
		 * Give an unique name to your role
		 */

		define('ROLE_NAME', 'role');

		/**
		 * Give a name which be used in admin to assign this role
		 */
		define('DISPLAY_NAME', 'My Great New Role');

		/**
		 * You make an error? You can delete the role by adding the ROLE_NAME
		 */
		define('ROLE2REMOVE', '');

		/**
		 * Make a copy of admin
		 */

		$adm = $wp_roles->get_role( ROLE_FROM );

		$wp_roles->add_role( ROLE_NAME, DISPLAY_NAME, $adm->capabilities );

		/**
		 * Remove some not needed capabilities
		 */

		$role = get_role(ROLE_NAME);

		$caps = array(
			'export',
			'import',
			'update_core',
			'upload_file',
			'delete_themes',
			'edit_theme_options',
			'edit_themes',
			'install_themes',
			'switch_themes',
			'update_themes',
			'activate_plugins',
			'delete_plugins',
			'edit_plugins',
			'install_plugins',
			'update_plugins',

			);
		foreach ( $caps as $cap) {
			$role->remove_cap( $cap );
		}


		if (defined('ROLE2REMOVE') && !empty(ROLE2REMOVE)) {
			$wp_roles->remove_role( ROLE2REMOVE );
		}

	}
	add_action('init', 'thfo_create_role');