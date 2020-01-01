<?php
/**
 * Plugin Name: Woocommerce - Simple user-level discount
 * Description: A simple Woocommerce plugin to group users together and provide percentage based discounts to those groups.
 * Version: 1.0.0
 * Author: Kevin Ruscoe <hello@kevinruscoe.me>
 */

 define('WOOCOMMERCE_SIMPLE_USER_LEVEL_DISCOUNT_VERSION', '1.0.0');

include plugin_dir_path(__FILE__) . "includes/class-woocommerce-simple-user-level-discount-user-settings.php";
include plugin_dir_path(__FILE__) . "includes/class-woocommerce-simple-user-level-discount-field.php";
include plugin_dir_path(__FILE__) . "includes/class-woocommerce-simple-user-level-discount-settings-tab.php";
include plugin_dir_path(__FILE__) . "includes/class-woocommerce-simple-user-level-discount-woocommerce-hooks.php";
include plugin_dir_path(__FILE__) . "includes/class-woocommerce-simple-user-level-discount-activator.php";

new Woocommerce_Simple_User_Level_Discount_User_Settings;
new Woocommerce_Simple_User_Level_Discount_Settings_Tab;
new Woocommerce_Simple_User_Level_Discount_Woocommerce_Hooks;

register_activation_hook( __FILE__, [ 'Woocommerce_Simple_User_Level_Discount_Activator', 'install'] );