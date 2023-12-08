"use strict";

var EditProducts = function () {

    const user = _user;
    const baseURL = window.location.origin;

    var init = function () {

        $('form#product-edit-form').on('submit', function (event) {
            event.preventDefault();
            var token = user.api_token;
            const apiEndpoint = `${baseURL}/api/admin/products/edit/${product_id}`;

            var formData = new FormData();
            formData.append('name', $('form#product-edit-form input#name').val());
            formData.append('quantity', $('form#product-edit-form input#quantity').val());

            fetch(apiEndpoint, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                },
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        throw new Error(data.error);
                    }
                    sweetAlert.Unitoast('Success', data.success, 'success');
                })
                .catch(error => {
                    sweetAlert.Unitoast('Error', error, 'error');
                });
        })
    };

    return {
        init: function () {
            init();
        }
    };
}();

jQuery(document).ready(function () {
    EditProducts.init();
});


