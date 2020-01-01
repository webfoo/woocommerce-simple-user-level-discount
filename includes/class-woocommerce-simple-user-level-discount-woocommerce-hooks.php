<?php


class Woocommerce_Simple_User_Level_Discount_Woocommerce_Hooks {

    /**
     * Setup.
     */
    public function __construct() {
        add_filter( 'woocommerce_get_price_html', [ $this, 'update_price_html' ], 50, 2 );
        add_action( 'woocommerce_cart_calculate_fees', [ $this, 'add_discount_to_cart' ], 10 );
        add_filter( 'woocommerce_cart_item_price', [ $this, 'update_cart_item_price' ], 10, 2 );
        add_filter( 'woocommerce_cart_item_subtotal', [ $this, 'update_cart_item_subtotal' ], 10, 2 );
    }

    /**
     * Update how the prices are visually shown (don't update actual price).
     *
     * @param string $html The html.
     * @param object $product The Product.
     *
     * @return string
     */
    public function update_price_html( $html, $product ) {
        $price = $product->price;

        if ( ! $price ) {
            return $html;
        }

        if ( ! Woocommerce_Simple_User_Level_Discount_Field::get_users_discount_amount() ) {
            return $html;
        }

        $discount = Woocommerce_Simple_User_Level_Discount_Field::get_users_discount_amount( true );

        $discount = (float) $price * $discount;
        $price    = $price - $discount;

        return wc_price( $price );
    }

    /**
     * Add an discount to the cart based on users type.
     *
     * @param object $cart The cart.
     *
     * @return void
     */
    public function add_discount_to_cart( $cart ) {
        if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
            return;
        }

        if ( ! Woocommerce_Simple_User_Level_Discount_Field::get_users_discount_amount() ) {
            return;
        }

        $discount_as_percent = Woocommerce_Simple_User_Level_Discount_Field::get_users_discount_amount();
        $discount_as_decimal = $discount_as_percent / 100;

        $discount = WC()->cart->get_subtotal() * $discount_as_decimal;

        if ( $discount > 0 ) {
            $cart->add_fee(
                sprintf( 'Discount %s%%', $discount_as_percent ),
                -$discount
            );
        }
    }

    /**
     * Update the cart item price, with the discount.
     *
     * @param int|float $price The price.
     * @param object    $cart_item The cart item.
     *
     * @return string
     */
    public function update_cart_item_price( $price, $cart_item ) {
        $price    = $cart_item['data']->get_price();
        $discount = $price * Woocommerce_Simple_User_Level_Discount_Field::get_users_discount_amount( true );
        $price    = $price - $discount;

        return wc_price( $price );
    }

    /**
     * Update the cart item sub-total, with the discount.
     *
     * @param int|float $price The price.
     * @param object    $cart_item The cart item.
     *
     * @return string
     */
    public function update_cart_item_subtotal( $price, $cart_item ) {
        $price    = $cart_item['data']->get_price();
        $discount = $price * Woocommerce_Simple_User_Level_Discount_Field::get_users_discount_amount( true );
        $price    = $price - $discount;
        $price    = $price * $cart_item['quantity'];

        return wc_price( $price );
    }
}
