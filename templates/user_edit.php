<h3>Extra profile information</h3>

<table class="form-table">
    <tr>
        <th>
            <label for="customer_type">
                Customer Type
            </label>
        </th>
        <td>
            <select name="customer_type" id="customer_type">
                <option class="unset">Default (no discount)</option>
                <?php foreach (Woocommerce_Simple_User_Level_Discount_Field::get_discounts() as $user_type => $discount) : ?>
                    <option 
                        value="<?php print $user_type ?>"
                        <?php print get_the_author_meta( 'customer_type', $user->ID ) == $user_type ? 'selected' : null; ?>
                    >
                        <?php print $user_type; ?> (<?php print $discount ?>% discount)
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
</table>