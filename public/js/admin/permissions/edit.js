"use strict";

var EditPermissions = function () {

    const user = _user;
    const baseURL = window.location.origin;

    var init = function () {

        $('form#permission-edit-form').on('submit', function (event) {
            event.preventDefault();
            var token = user.api_token;
            const apiEndpoint = `${baseURL}/api/admin/permissions/edit/${permission_id}`;

            var formData = new FormData();
            formData.append('name', $('form#permission-edit-form input#name').val());

            const _token = $('form#permission-edit-form input[name="_token"]').val();
            fetch(apiEndpoint, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                    'X-CSRF-TOKEN': _token,
                    // 'Content-Type': 'application/json',
                },
                body: formData,
            })
                .then(response => response.json())
                // .then(response => {if(response.status == 404 || response.status == 500){throw new Error(`${response.json()}`);} else return response.json()})
                // .then(response => {
                //     if (!response.ok) {
                //         console.log(response.json());
                //         // Throw an error to trigger the .catch block
                //         // throw new Error(response);
                //     }
                //     return response.json();
                // })
                .then(data => {
                    if (data.error) {
                        // console.log(response.json());
                        // Throw an error to trigger the .catch block
                        throw new Error(data.error);
                    }
                    sweetAlert.Unitoast('Success', data.success, 'success');
                    // console.log(data);
                })
                .catch(error => {
                    sweetAlert.Unitoast('Error', error, 'error');
                    // console.log(error);
                    // console.error('Error fetching data:', error);
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
    EditPermissions.init();
});


