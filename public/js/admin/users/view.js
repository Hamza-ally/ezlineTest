"use strict";

var UsersView = function () {

    const user = _user;
    const baseURL = window.location.origin;
    const meta_token = document.querySelector('meta[name="csrf-token"]').content;

    function drawDatatable(token, apiEndpointView){
        fetch(apiEndpointView, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            $('#users-view-table').DataTable({
                data: data.data,
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'role' },
                    { 
                        data: null,
                        render: function (data, type, row) {
                            return '<button id="edit-user" data-id="' + row.id + '" class="btn btn-rounded btn-icon btn-outline-info"><i style="margin-left: -2.5px;" class="fa fa-edit"></i></button>' +
                                   '<button id="delete-user" data-id="' + row.id + '" class="btn btn-rounded btn-icon btn-outline-danger ml-2"><i style="margin-left: -2.5px;" class="fa fa-trash"></i></button>';
                        }
                    },
                ],
                "serverSide": false,
                "ordering": true,
                "aLengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "iDisplayLength": 10,
                "language": {
                    search: ""
                }
            });

            $('#users-view-table').each(function () {
                var datatable = $(this);

                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');

                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }

    var init = function () {

        var token = user.api_token;
        const apiEndpointView = `${baseURL}/api/admin/users/view`;

        
        drawDatatable(token, apiEndpointView);

        $(document).on('click', 'button#delete-user', function(event){
            const apiEndpointDelete= `${baseURL}/api/admin/users/delete/${$(this).data('id')}`;
            fetch(apiEndpointDelete, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': meta_token,
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                $('#users-view-table').DataTable().destroy();
                drawDatatable(token, apiEndpointView);
                sweetAlert.Unitoast('Success', data.success, 'success');
            })
            .catch(error => {
                sweetAlert.Unitoast('Error', error, 'error');
                // console.error('Error fetching data:', error);
            });
        });

        $(document).on('click', 'button#edit-user', function(event){
            const editRoute = `${baseURL}/admin/users/edit/${$(this).data('id')}`;
            window.location.assign(editRoute);
        });
    };

    // var init = function () {
    //     var token = user.api_token;
    //     const apiEndpointView = `${baseURL}/api/admin/users/view`;
    //     var dataTable;
    
    //     fetch(apiEndpointView, {
    //         method: 'GET',
    //         headers: {
    //             'Accept': 'application/json',
    //             'Authorization': 'Bearer ' + token,
    //             'Content-Type': 'application/json',
    //         },
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         // Initialize DataTable outside the fetch callback
    //         dataTable = $('#users-view-table').DataTable({
    //             data: data.data,
    //             columns: [
    //                 { data: 'name' },
    //                 { data: 'email' },
    //                 { 
    //                     data: null,
    //                     render: function (data, type, row) {
    //                         return '<button id="delete-user" data-id="' + row.id + '" class="btn btn-rounded btn-icon btn-outline-danger"><i style="margin-left: -2.5px;" class="fa fa-trash"></i></button>';
    //                     }
    //                 },
    //             ],
    //             "serverSide": false,
    //             "ordering": true,
    //             "aLengthMenu": [
    //                 [5, 10, 15, -1],
    //                 [5, 10, 15, "All"]
    //             ],
    //             "iDisplayLength": 10,
    //             "language": {
    //                 search: ""
    //             }
    //         });
    
    //         $('#users-view-table').each(function () {
    //             var datatable = $(this);
    
    //             var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
    //             search_input.attr('placeholder', 'Search');
    //             search_input.removeClass('form-control-sm');
    
    //             var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
    //             length_sel.removeClass('form-control-sm');
    //         });
    //     })
    //     .catch(error => {
    //         console.error('Error fetching data:', error);
    //     });
    
    //     $(document).on('click', 'button#delete-user', function(event){
    //         const apiEndpointDelete= `${baseURL}/api/admin/users/delete/${$(this).data('id')}`;
    //         fetch(apiEndpointDelete, {
    //             method: 'POST',
    //             headers: {
    //                 'Accept': 'application/json',
    //                 'Authorization': 'Bearer ' + token,
    //                 'Content-Type': 'application/json',
    //             },
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.error) {
    //                 throw new Error(data.error);
    //             }
    //             // Use the initialized DataTable to redraw
    //             dataTable.draw();
    //             sweetAlert.Unitoast('Success', data.success, 'success');
    //         })
    //         .catch(error => {
    //             sweetAlert.Unitoast('Error', error, 'error');
    //         });
    //     });
    // };

    return {
        init: function () {
            init();
        }
    };
}();

jQuery(document).ready(function () {
    UsersView.init();
});


