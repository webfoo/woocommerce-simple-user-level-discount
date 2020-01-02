<?php

class Woocommerce_Simple_User_Level_Discount_Settings_Tab {

    /**
     * Fire actions and filters.
     */
    public function __construct() {
        add_filter( 'woocommerce_settings_tabs_array', [ $this, 'add_settings_tab' ], 50 );

        add_action(
            'woocommerce_settings_tabs_user_level_discount',
            function () {
                include plugin_dir_path( __FILE__ ) . '../templates/user_level_discount_tab.php';
            }
        );

        add_action(
            'woocommerce_update_options_user_level_discount',
            function () {
                woocommerce_update_options( $this->build_settings() );
            }
        );

        add_action( 'admin_enqueue_scripts', [ $this, 'load_assets' ] );
    }

    /**
     * Loads JS and CSS.
     */
    public function load_assets() {
        if ( ! isset( $_GET['tab'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            return;
        }

        if ( $_GET['tab'] === 'user_level_discount' ) {  // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            wp_enqueue_script( 'user_level_discount_js', plugin_dir_url( __FILE__ ) . '../js/app.js', [], WOOCOMMERCE_SIMPLE_USER_LEVEL_DISCOUNT_VERSION, true );
            wp_enqueue_style( 'user_level_discount_css', plugin_dir_url( __FILE__ ) . '../css/app.css', [], WOOCOMMERCE_SIMPLE_USER_LEVEL_DISCOUNT_VERSION );
        }
    }

    /**
     * Adds additional tab.
     *
     * @param array $settings_tabs The tabs.
     * @return array
     */
    public function add_settings_tab( array $settings_tabs ) {
        $settings_tabs['user_level_discount'] = 'User Level Discount';

        return $settings_tabs;
    }

    /**
     * The settings.
     *
     * @return array
     */
    public function build_settings() {
        return [
            'section_title' => [
                'name' => 'User Level Discount',
                'type' => 'title',
            ],
            'title'         => [
                'name' => 'Title',
                'type' => 'text',
                'id'   => Woocommerce_Simple_User_Level_Discount_Field::get_field_name(),
            ],
            'section_end'   => [
                'type' => 'sectionend',
            ],
        ];
    }

}
