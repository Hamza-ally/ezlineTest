"use strict";

var CreateRolesPermissions = function () {

    const user = _user;
    const baseURL = window.location.origin;

    var init = function () {

        $('form#role-create-form').on('submit', function (event) {
            event.preventDefault();
            var token = user.api_token;
            const apiEndpoint = `${baseURL}/api/admin/roles/create/permissions/${role_id}`;

            var selectedOptions = $('#permissions option:selected');
            var selectedValues = selectedOptions.map(function () {
                return $(this).val();
            }).get();
            // console.log(selectedValues);
            // return;

            var formData = new FormData();
            formData.append('permissions', JSON.stringify(selectedValues));

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
    CreateRolesPermissions.init();
});


