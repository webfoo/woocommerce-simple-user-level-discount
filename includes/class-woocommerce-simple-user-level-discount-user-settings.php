<?php


class Woocommerce_Simple_User_Level_Discount_User_Settings {

    public function __construct()
    {
        add_action( 'show_user_profile', [$this, 'extra_user_profile_fields'] );
        add_action( 'edit_user_profile', [$this, 'extra_user_profile_fields'] );

        add_action( 'personal_options_update', [$this, 'save_extra_user_profile_fields'] );
        add_action( 'edit_user_profile_update', [$this, 'save_extra_user_profile_fields'] );
        add_action( 'plugin_action_links_woocommerce-simple-user-level-discount/woocommerce-simple-user-level-discount.php', [$this, 'add_plugin_links']);
    }

    public function add_plugin_links($links)
    {
        $links = array_merge( array(
            '<a href="' . esc_url( admin_url( 'admin.php?page=wc-settings&tab=user_level_discount' ) ) . '">Setup Discounts</a>'
        ), $links );
        return $links;
    }

    /**
     * Saves the user meta data.
     * 
     * @return void
     */
    function save_extra_user_profile_fields( $user_id )
    {
        if ( ! current_user_can( 'edit_user', $user_id ) ) { 
            return false; 
        }
        update_user_meta( $user_id, 'customer_type', $_POST['customer_type'] );
    }

    /**
     * Renders the additional fields tempalte.
     * 
     * @return void
     */
    function extra_user_profile_fields( $user )
    { 
        include plugin_dir_path(__FILE__) . '../templates/user_edit.php';
    }
}