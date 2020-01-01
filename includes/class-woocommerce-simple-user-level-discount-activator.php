<?php


class Woocommerce_Simple_User_Level_Discount_Activator {

    public function install() {
        if ( ! get_option( Woocommerce_Simple_User_Level_Discount_Field::get_field_name() )) {
            update_option( 
                Woocommerce_Simple_User_Level_Discount_Field::get_field_name(),
                json_encode([])
            );
        }
    }
}