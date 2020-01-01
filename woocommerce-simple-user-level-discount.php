<?php
/**
 * Plugin Name: Woocommerce - Simple user-level discount
 * Version: 1.0.0
 */

include plugin_dir_path(__FILE__) . "includes/class-woocommerce-simple-user-level-discount-user-settings.php";
include plugin_dir_path(__FILE__) . "includes/class-woocommerce-simple-user-level-discount-field.php";
include plugin_dir_path(__FILE__) . "includes/class-woocommerce-simple-user-level-discount-settings-tab.php";
include plugin_dir_path(__FILE__) . "includes/class-woocommerce-simple-user-level-discount-woocommerce-hooks.php";

new Woocommerce_Simple_User_Level_Discount_User_Settings;
new Woocommerce_Simple_User_Level_Discount_Settings_Tab;
new Woocommerce_Simple_User_Level_Discount_Woocommerce_Hooks;