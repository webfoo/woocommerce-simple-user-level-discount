<?php


class Woocommerce_Simple_User_Level_Discount_Woocommerce_Hooks {

    public function __construct() {
        /**
         * Add an discount to the cart based on users type.
         */
        add_action( 
            'woocommerce_cart_calculate_fees', 
            function( $cart ){
                if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
                    return;
                }

                if (! Woocommerce_Simple_User_Level_Discount_Field::get_users_discount_amount()) {
                    return;
                }

                $discount = Woocommerce_Simple_User_Level_Discount_Field::get_users_discount_amount();
                $discount_as_percent = $discount / 100;

                $discount = WC()->cart->get_subtotal() * $discount_as_percent;
            
                if ( $discount > 0 ) {
                    $cart->add_fee( 
                        sprintf("Discount %s%%", $discount),
                        -$discount 
                    );
                }
            },
            10
        );

        /**
         * Update the cart item price, with the discount.
         */
        add_filter(
            'woocommerce_cart_item_price',
            function($price, $cart_item) {
                $price = $cart_item['data']->get_price();
                $discount = $price * Woocommerce_Simple_User_Level_Discount_Field::get_users_discount_amount(true);
                $price =  $price - $discount;
                return wc_price($price);
            }, 
            100, 
            2
        );

        /**
         * Update the cart item sub-total, with the discount.
         */
        add_filter(
            'woocommerce_cart_item_subtotal', 
            function($price, $cart_item) {
                $price = $cart_item['data']->get_price();
                $discount = $price * Woocommerce_Simple_User_Level_Discount_Field::get_users_discount_amount(true);
                $price = $price - $discount;
                $price = $price * $cart_item['quantity'];
                return wc_price($price);
            },
            100,
            2
        );
    }
}