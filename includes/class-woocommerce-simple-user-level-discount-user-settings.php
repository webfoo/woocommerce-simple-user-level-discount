<?php



class Woocommerce_Simple_User_Level_Discount_User_Settings {

    /**
     * Setup
     */
    public function __construct() {
        add_action( 'show_user_profile', [ $this, 'extra_user_profile_fields' ] );
        add_action( 'edit_user_profile', [ $this, 'extra_user_profile_fields' ] );

        add_action( 'personal_options_update', [ $this, 'save_extra_user_profile_fields' ] );
        add_action( 'edit_user_profile_update', [ $this, 'save_extra_user_profile_fields' ] );
        add_action( 'plugin_action_links_woocommerce-simple-user-level-discount/woocommerce-simple-user-level-discount.php', [ $this, 'add_plugin_links' ] );
    }

    /**
     * Adds plugin admin links.-white
     *
     * @param array $links The links.
     * @return array
     */
    public function add_plugin_links( array $links ) {
        $links = array_merge(
            [
				'<a href="' . esc_url( admin_url( 'admin.php?page=wc-settings&tab=user_level_discount' ) ) . '">Setup Discounts</a>',
            ],
        $links );

        return $links;
    }

    /**
     * Saves the user meta data.
     *
     * @param int $user_id The user id.
     * @return void|bool
     */
    public function save_extra_user_profile_fields( $user_id ) {
        if ( ! current_user_can( 'edit_user', $user_id ) ) {
            return false;
        }

        if ( isset( $_POST['customer_type'] ) ) {
            update_user_meta( $user_id, 'customer_type', $_POST['customer_type'] );
        }
    }

    /**
     * Renders the additional fields tempalte.
     *
     * @param int $user The user.
     * @return void
     */
    public function extra_user_profile_fields( $user ) {
        include plugin_dir_path( __FILE__ ) . '../templates/user_edit.php';
    }
}
