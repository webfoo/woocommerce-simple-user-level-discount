jQuery(function($) {

    var discountField = $("#user_level_discounts");

    var discounts = JSON.parse(discountField.val());

    $(".form-table").hide();

    $(".form-table").after(
        '<table class="form-table user_level_table wc_emails widefat">' +
            '<thead>' +
                '<tr>' +
                    '<th>Level Name</th>' +
                    '<th>Discount Percent</th>' +
                    '<th width="20" style="width:20px"><a href="#" class="add">&plus;</a></th>' +
                '</tr>' +
            '</thead>' +
            '<tbody>' +
            '</tbody>' +
        '</table>'
    );

    for (const [user_level, discount] of Object.entries(discounts)) {
        $(".form-table tbody").append(
            '<tr>' +
                '<td><input type="text" value="' + user_level + '"></td>' +
                '<td><input type="number" value="' + discount + '"></td>' +
                '<td><a href="#" class="remove">&times;</a></td>' +
            '</tr>'
        );
    }

    $(".form-table.wc_emails.widefat .remove").on("click", function() {
        $(this).closest("tr").remove();
        recalc_discounts();
    });

    $(".form-table.wc_emails.widefat .add").on("click", function() {
        $(".form-table tbody").append(
            '<tr>' +
                '<td><input type="text"></td>' +
                '<td><input type="number"></td>' +
                '<td><a href="#" class="remove">&times;</a></td>' +
            '</tr>'
        );
        recalc_discounts();
    });

    $(".form-table.wc_emails.widefat input").on("change", function() {
        recalc_discounts();
    });

    function recalc_discounts() {
        var key, val;
        var loopIndex = 1;

        discounts = {};

        $(".form-table.wc_emails.widefat input").each(function() {

            if (loopIndex % 2) {
                key = $(this).val()
            } else {
                val = $(this).val()
                discounts[key] = val;
            }

            loopIndex++;
        });

        discountField.val(JSON.stringify(discounts));
    }

});