"use strict";

var Auth = function () {
    var _login, _register;

    const baseURL = window.location.origin;

    var handleLogin = function () {
        $(_login).on('submit', function (event) {
            event.preventDefault();
            const loginApiRoute = _login.attr('action');
            const requestData = {
                email: $('form#login_form input#email').val(),
                password: $('form#login_form input#password').val(),
                // _token: $('form#login_form input[name="_token"]').val(),
            };
            // console.log(requestData);
            const _token = $('form#login_form input[name="_token"]').val();
            fetch(loginApiRoute, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': _token,
                    // 'Authorization': 'Bearer ' + yourAccessToken ?? ''
                },
                body: JSON.stringify(requestData)
            })
                .then(response => {
                    // if (!response.ok) {
                    //     throw new Error('Network response was not ok');
                    // }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    var token = data.data.api_token;
                    const redirectURL = `${baseURL}/home?token=${token}`;
                    window.location.assign(redirectURL);
                    console.log(data);
                })
                .catch(error => {
                    console.log(error);
                    // console.error('There was a problem with the fetch operation:', error);
                });
        });
    }

    var handleRegister = function () {
        $(_register).on('submit', function (event) {
            event.preventDefault();
            const registerApiRoute = _register.attr('action');
            const requestData = {
                name: $('form#register_form input#name').val(),
                email: $('form#register_form input#email').val(),
                password: $('form#register_form input#password').val(),
                confirm_password: $('form#register_form input#confirm_password').val(),
            };
            const _token = $('form#register_form input[name="_token"]').val();
            fetch(registerApiRoute, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': _token,
                    // 'Authorization': 'Bearer ' + yourAccessToken ?? ''
                },
                body: JSON.stringify(requestData)
            })
                .then(response => {
                    // console.log(response);
                    // if (!response.ok) {
                    //     throw new Error('Network response was not ok');
                    // }
                    return response.json();
                })
                .then(data => {
                    var token = data.data.api_token;
                    const redirectURL = `${baseURL}/home?token=${token}`;
                    window.location.assign(redirectURL);
                    console.log(data);
                })
                .catch(error => {
                    console.log(error);
                    // console.error('There was a problem with the fetch operation:', error);
                });
        });
    }

    return {
        init: function () {
            if ($('form#login_form').length) {
                _login = $('form#login_form');
                handleLogin();
            }
            if ($('form#register_form').length) {
                _register = $('form#register_form');
                handleRegister();
            }
        }
    };
}();

jQuery(document).ready(function () {
    Auth.init();
});
