<?php


class Woocommerce_Simple_User_Level_Discount_Field {

    /**
     * Gets the field name.
     *
     * @return string
     */
    public static function get_field_name() {
        return 'user_level_discounts';
    }

    /**
     * Gets the discounts.
     *
     * @return array
     */
    public static function get_discounts() {
        return json_decode( get_option( self::get_field_name() ) );
    }

    /**
     * Gets the users discount amount.
     *
     * @param bool $as_decimal Should return as decimal.
     * @return float|int
     */
    public static function get_users_discount_amount( $as_decimal = false ) {
        if ( ! is_user_logged_in() ) {
            return 0;
        }

        $user_discount_type = get_the_author_meta( 'customer_type', get_current_user_id() ) ?? 'unset';

        if ( $user_discount_type === 'unset' ) {
            return 0;
        }

        $discount = self::get_discounts()->$user_discount_type ?? 0;

        return $as_decimal ? $discount / 100 : $discount;
    }
}
