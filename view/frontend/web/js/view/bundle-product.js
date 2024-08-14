define([
    'jquery',
    'Magento_Customer/js/customer-data',
    'mage/url'
], function ($, customerData, urlBuilder) {
    'use strict';

    return function (productId) {
        // URL to add the product to the cart
        var addToCartUrl = urlBuilder.build('checkout/cart/add');

        // Prepare data for the AJAX request
        var data = {
            product: productId,
            selected_configurable_option: '',
            related_product: '',
            'bundle_option[2]': 3,
            form_key: $.cookie('form_key')
        };

        // Disable the button to prevent multiple clicks
        var $button = $('.bundle-add-to-cart');
        $button.prop('disabled', true);

        // Perform the AJAX request to add the product to the cart
        $.ajax({
            url: addToCartUrl,
            type: 'POST',
            data: data,
            success: function (response) {
                // Enable the button after the request is completed
                $button.prop('disabled', false);

                // Check if the product was added to the cart successfully
                if (response.backUrl) {
                    window.location.href = response.backUrl;
                } else {
                    // Update the mini-cart with the new data
                    customerData.reload(['cart'], true);
                }
            },
            error: function () {
                // Enable the button if there was an error
                $button.prop('disabled', false);

                // Handle the error (optional: show a message to the user)
                alert('Something went wrong while adding the product to the cart. Please try again.');
            }
        });
    };
});
