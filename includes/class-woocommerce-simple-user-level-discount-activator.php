<?php


class Woocommerce_Simple_User_Level_Discount_Activator {

    public function install() {
        Woocommerce_Simple_User_Level_Discount_User_Settings::create_default_discounts();
    }
}