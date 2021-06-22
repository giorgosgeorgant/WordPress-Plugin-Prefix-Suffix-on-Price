<?php

/**
 * Fired during plugin activation
 *
 * @link       www.giorgosgeorgantas.com
 * @since      1.0.0
 *
 * @package    Prefixsuffix
 * @subpackage Prefixsuffix/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Prefixsuffix
 * @subpackage Prefixsuffix/includes
 * @author     Giorgos Georgantas <g.giorgantas@gmail.com>
 */
class Prefixsuffix_Activator {
	function create_plugin_database_table()
	{
		global $table_prefix, $wpdb;
	
		$tblname = 'pin';
		$wp_track_table = $table_prefix . "$tblname ";
	
		#Check to see if the table exists already, if not, then create it
	
		if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
		{
	
			$sql = "CREATE TABLE `". $wp_track_table . "` ( ";
			$sql .= "  `id`  int(11)   NOT NULL auto_increment, ";
			$sql .= "  `pincode`  int(128)   NOT NULL, ";
			$sql .= "  PRIMARY KEY `order_id` (`id`) "; 
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
			require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
			dbDelta($sql);
		}
	}
	
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
	/** Step 2 (from text above). */


}
}