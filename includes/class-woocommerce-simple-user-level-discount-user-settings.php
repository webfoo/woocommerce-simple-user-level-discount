<?php


class Woocommerce_Simple_User_Level_Discount_User_Settings {

    public function __construct() {

        $this->create_default_discounts();

        add_action( 'show_user_profile', [$this, 'extra_user_profile_fields'] );
        add_action( 'edit_user_profile', [$this, 'extra_user_profile_fields'] );

        add_action( 'personal_options_update', [$this, 'save_extra_user_profile_fields'] );
        add_action( 'edit_user_profile_update', [$this, 'save_extra_user_profile_fields'] );

    }

    /**
     * Create the default discounts.
     * 
     * @return void
     */
    public function create_default_discounts()
    {
        if ( ! get_option( Woocommerce_Simple_User_Level_Discount_Field::get_field_name() )) {
            update_option( 
                Woocommerce_Simple_User_Level_Discount_Field::get_field_name(),
                json_encode([])
            );
        }
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