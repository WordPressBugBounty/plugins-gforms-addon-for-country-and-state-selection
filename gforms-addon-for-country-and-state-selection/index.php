<?php
/**
 * Plugin Name:	  Country and State Selection Addon for Gravity Forms
 * Plugin URI:	  https://plugins.hirewebxperts.com/
 * Description:	  Country and State Selection Addon for Gravity Forms is used to add country and state dropdown fields depending on your needs. By default, all the countries of the world appear on the country select dropdown on the form and once you select any specific country, its respective states appear in the state select dropdown. All the countries and states are already available in the addon by default. 
 * Version: 	  1.1
 * Author: 		  Coder426
 * Author URI:	  https://hirewebxperts.com/
 * Donate link:   https://hirewebxperts.com/donate/
 * Text Domain:   gforms-addon-for-country-and-state-selection
 * Domain Path:	  /languages
 * License:          GPLv3
 * License URI:      https://www.gnu.org/licenses/gpl-2.0.txt
 * License:          GPL2
 */

if (!defined('ABSPATH')) {exit;}

/* Plugin details */
$version             =  '1.1';
$name                =  'gforms-addon-for-country-and-state-selection';
$dir_name            =  'gforms-addon-for-country-and-state-selection';
$location            =  'plugins';
$plugin_dir          =  dirname(__FILE__);
$plugin_url          =  plugin_dir_url(__FILE__);

//Define plugin url path
define($plugin_url, plugin_dir_url(__FILE__));
define($plugin_dir, dirname(__FILE__));
define('GF_CWS_JS', $plugin_url . 'assets/js/');
define('GF_CWS_CSS', $plugin_url . 'assets/css/');
define('GF_CWS_IMG', $plugin_url . 'assets/images/');
define('GF_CWS_INC', $plugin_dir . '/includes/');
define('GF_CWS_VER', $version);
define('GF_CWS_NAME', $name);


add_action( 'gform_loaded', array( 'GF_CWS_Field_AddOn', 'load' ), 5 );
class GF_CWS_Field_AddOn {
    public static function load() {
        if ( ! method_exists( 'GFForms', 'include_addon_framework' ) ) {
            return;
        }
        require_once( 'class-gf-cws-fields.php' );
    }
}