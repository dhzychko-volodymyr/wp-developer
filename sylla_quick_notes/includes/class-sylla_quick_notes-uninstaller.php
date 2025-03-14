<?php

/**
 * Fired during plugin deletion
 *
 * @link       https://https://www.linkedin.com/in/volodymyr-dhzychko-865348171/
 * @since      1.0.0
 *
 * @package    Sylla_quick_notes
 * @subpackage Sylla_quick_notes/includes
 */

/**
 * Fired during plugin deletion.
 *
 * This class defines all code necessary to run during the plugin's deletion.
 *
 * @since      1.0.0
 * @package    Sylla_quick_notes
 * @subpackage Sylla_quick_notes/includes
 * @author     Volodymyr Dhzychko <dhzychko@gmail.com>
 */
class Sylla_quick_notes_Uninstaller {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function uninstall() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'sylla_quick_notes';
        $sql = "DROP TABLE IF EXISTS $table_name;";
        $wpdb->query($sql);
	}

}