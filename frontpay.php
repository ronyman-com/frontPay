<?php

/**
 * Plugin Name :      FrontPay
 *
 * @package           PluginPackage
 * @author            ronyman.com
 * @copyright         2021 ronyman.com
 * @license           GNU General Public License v3.0
 *
 * @wordpress-plugin
 * Plugin Name:       FrontPay
 * Plugin URI:        https://front-pay.com
 * Description:       Your secured and easy payment gate way on stripe to the integrate stores.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.0.0
 * Author:            ronyman.com
 * Author URI:        https://ronyman.com
 * Text Domain:       plugin-slug
 * License:           GNU General Public License v3.0
 * Github:            https://github.com/ronyman-com/frontPay/
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


 /*
FrontPay is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{FrontPay} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {FrontPay}. If not, see {URI to Plugin License}.
*/



/**
 * Register the "FrontPay" custom post type
 */
function fp_setup_post_type() {
    register_post_type( 'FrontPay', ['public' => true ] ); 
} 
add_action( 'init', 'fp_setup_post_type' );
 
 
/**
 * Activate the plugin.
 */
function fp_activate() { 
    // Trigger our function that registers the custom post type plugin.
    fp_setup_post_type(); 
    // Clear the permalinks after the post type has been registered.
    flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'fp_activate' );



//Create a function called "fp_init" if it doesn't already exist
//Create a function called "fp_menu" if it doesn't already exist


if ( !class_exists( 'fp_Plugin' ) ) {
    class fp_Plugin
    {
        public static function init() {
            register_setting( 'fp_settings', 'fp_option_menu' );
        }
 
        public static function get_menu() {
            return get_option( 'fp_option_menu' );
        }
    }
 
    fp_Plugin::init();
    fp_Plugin::get_menu();
}

 

function FrontPay_options_page_html() {
    ?>
    <div class="wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <form action="options.php" method="post">
        <?php
        // output security fields for the registered setting "fp_options"
        settings_fields( 'fp_options' );
        // output setting sections and their fields
        // (sections are registered for "fp", each field is registered to a fpecific section)
        do_settings_sections( 'fp' );
        // output save settings button
        submit_button( __( 'Save Settings', 'textdomain' ) );
        ?>
      </form>
    </div>
    <?php
}

// admin Area
if ( is_admin() ) {
    // we are in admin mode
    require_once __DIR__ . '/admin/frontpay-admin.php';
}





