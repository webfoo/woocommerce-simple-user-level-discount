<?php


class Woocommerce_Simple_User_Level_Discount_Activator {

    /**
     * Install the plugin.
     *
     * @return void
     */
    public function install() {
        if ( ! get_option( Woocommerce_Simple_User_Level_Discount_Field::get_field_name() ) ) {
            update_option(
                Woocommerce_Simple_User_Level_Discount_Field::get_field_name(),
                wp_json_encode( [] )
            );
        }
    }
}
