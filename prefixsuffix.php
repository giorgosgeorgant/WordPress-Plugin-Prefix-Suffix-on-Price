<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.giorgosgeorgantas.com
 * @since             1.0.0
 * @package           Prefixsuffix
 *
 * @wordpress-plugin
 * Plugin Name:       Add Suffix/Prefix Product at Product price
 * Plugin URI:        prefixsuffix
 * Description:       Adds Custom Prefix Suffix on WooCommerce Products.
 * Version:           1.0.0
 * Author:            Giorgos Georgantas
 * Author URI:        www.giorgosgeorgantas.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       prefixsuffix
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PREFIXSUFFIX_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-prefixsuffix-activator.php
 */
function activate_prefixsuffix() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-prefixsuffix-activator.php';
	Prefixsuffix_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-prefixsuffix-deactivator.php
 */
function deactivate_prefixsuffix() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-prefixsuffix-deactivator.php';
	Prefixsuffix_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_prefixsuffix' );
register_deactivation_hook( __FILE__, 'deactivate_prefixsuffix' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-prefixsuffix.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_prefixsuffix() {

	$plugin = new Prefixsuffix();
	$plugin->run();




}
run_prefixsuffix();
/*WordPress Menus API.*/
function add_new_menu_items()
{
	//add a new menu item. This is a top level menu item i.e., this menu item can have sub menus
	add_menu_page(
		"Price Suffix/Prefix", //Required. Text in browser title bar when the page associated with this menu item is displayed.
		"Price Suffix/Prefix", //Required. Text to be displayed in the menu.
		"manage_options", //Required. The required capability of users to access this menu item.
		"prefix-prefix", //Required. A unique identifier to identify this menu item.
		"theme_options_page", //Optional. This callback outputs the content of the page associated with this menu item.
		"", //Optional. The URL to the menu item icon.
		100 //Optional. Position of the menu item in the menu.
	);

}
/**
* Check if WooCommerce Plugin is active in the admin area
*/

	//WooCommerce plugin is activated
		// some code
		$all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
		if (!stripos(implode($all_plugins), 'woocommerce.php')) {
			// Put your plugin code here
			function sample_admin_notice__success() {
				?>
				<div class="notice notice-success is-dismissible">
					<p><?php _e( 'Prefix/Suffix Plugin requires WooCommerce to work correctly', 'sample-text-domain' ); ?></p>
				</div>
				<?php
			}
			
			
			add_action( 'admin_notices', 'sample_admin_notice__success' );
			
		}
	
	

	




function theme_options_page()
{
	?>
		<div class="wrap">
		<div id="icon-options-general" class="icon32"></div>
		<h1>Price Suffix Prefix</h1>
		<form method="post" action="options.php">
			<?php
		   
				//add_settings_section callback is displayed here. For every new section we need to call settings_fields.
				settings_fields("header_section");
			   
				// all the add_settings_field callbacks is displayed here
				do_settings_sections("prefix-prefix");
		   
				// Add the submit button to serialize the options
				submit_button();
			   
			?>         
		</form>
	</div>
	<?php
}

//this action callback is triggered when wordpress is ready to add new items to menu.
add_action("admin_menu", "add_new_menu_items");


/*WordPress Settings API Demo*/

function display_options()
{
	//section name, display name, callback to print description of section, page to which section is attached.
	add_settings_section("header_section", "Set Custom Price Prefix Suffix in the form bellow", "display_header_options_content", "prefix-prefix");

	//setting name, display name, callback to print form element, page in which field is displayed, section to which it belongs.
	//last field section is optional.
	add_settings_field("price_suffix", "Suffix", "display_logo_form_element", "prefix-prefix", "header_section");
	add_settings_field("price_prefix", "Prefix", "display_ads_form_element", "prefix-prefix", "header_section");

	//section name, form element name, callback for sanitization
	register_setting("header_section", "price_suffix");
	register_setting("header_section", "price_prefix");
}

function display_header_options_content(){echo "";}
function display_logo_form_element()
{
	//id and name of form element should be same as the setting name.
	?>
		<input type="text" name="price_suffix" id="price_suffix" value="<?php echo get_option('price_suffix'); ?>" />
	<?php
}
function display_ads_form_element()
{
	//id and name of form element should be same as the setting name.
	?>
		<input type="text" name="price_prefix" id="price_prefix" value="<?php echo get_option('price_prefix'); ?>" />
	<?php
}

//this action is executed after loads its core, after registering all actions, finds out what page to execute and before producing the actual output(before calling any action callback)
add_action("admin_init", "display_options");
add_filter( 'woocommerce_get_price_suffix', 'bbloomer_add_price_suffix', 99, 4 );
  /** Step 4.Admin Suffix  */
  
function bbloomer_add_price_suffix( $html, $product, $price, $qty ){
	$suffix = get_option("price_suffix");
    $html .= $suffix;
    return $html;
}
add_filter( 'woocommerce_get_price_html', 'bbloomer_add_price_prefix', 99, 2 );
  
function bbloomer_add_price_prefix( $price, $product ){
	$prefix = get_option("price_prefix");
    $price = $prefix. $price;
    return $price;
}
