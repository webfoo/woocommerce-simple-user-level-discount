<h2>User Level Discount</h2>

<div id="app">
    <user-level-table 
        name="<?php print Woocommerce_Simple_User_Level_Discount_Field::get_field_name() ?>"
        :value='<?php print wp_json_encode( Woocommerce_Simple_User_Level_Discount_Field::get_discounts() ) ?>'
    />
</div>