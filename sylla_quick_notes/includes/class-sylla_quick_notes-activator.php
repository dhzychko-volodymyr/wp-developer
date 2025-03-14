<?php

/**
 * Fired during plugin activation
 *
 * @link       https://https://www.linkedin.com/in/volodymyr-dhzychko-865348171/
 * @since      1.0.0
 *
 * @package    Sylla_quick_notes
 * @subpackage Sylla_quick_notes/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Sylla_quick_notes
 * @subpackage Sylla_quick_notes/includes
 * @author     Volodymyr Dhzychko <dhzychko@gmail.com>
 */
class Sylla_quick_notes_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// Create table for notes
		// Allow NULL values for note_title and note_content to be safe 
		//  the check will be done in the code
		global $wpdb;
		$table_name = $wpdb->prefix . 'sylla_quick_notes';
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			note_id bigint(20) NOT NULL AUTO_INCREMENT,
			user_id bigint(20) NOT NULL,
			note_title text NULL,
			note_content text NULL,
			PRIMARY KEY  (note_id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}
