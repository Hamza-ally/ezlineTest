"use strict";

var CreateProducts = function () {

    const user = _user;
    const baseURL = window.location.origin;

    var init = function () {

        $('form#product-create-form').on('submit', function (event) {
            event.preventDefault();
            var token = user.api_token;
            const apiEndpoint = `${baseURL}/api/admin/products/create`;
            var formData = new FormData();
            formData.append('name', $('form#product-create-form input#name').val());
            formData.append('quantity', $('form#product-create-form input#quantity').val());

            const _token = $('form#product-create-form input[name="_token"]').val();
            fetch(apiEndpoint, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                    'X-CSRF-TOKEN': _token,
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
    CreateProducts.init();
});


