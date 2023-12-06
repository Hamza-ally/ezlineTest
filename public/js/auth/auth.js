"use strict";

var Auth = function () {
    var _login, _register;

    var handleLogin = function () {
        $(_login).on('submit', function (event) {
            event.preventDefault();
            const loginApiRoute = _login.attr('action');
            const requestData = {
                email: $('form#login_form input#email').val(),
                password: $('form#login_form input#password').val(),
            };

            fetch(loginApiRoute, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
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

            fetch(registerApiRoute, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
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
