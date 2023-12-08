"use strict";

var RolesView = function () {

    const user = _user;
    const baseURL = window.location.origin;

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
            $('#roles-view-table').DataTable({
                data: data.data,
                columns: [
                    { data: 'name' },
                    { 
                        data: null,
                        render: function (data, type, row) {
                            return '<button id="assign-permissions" data-id="' + row.id + '" class="btn btn-rounded btn-icon btn-outline-primary" title="Assign Permissions"><i style="margin-left: -5.5px;" class="fa fa-cogs"></i></button>' +
                                    '<button id="edit-role" data-id="' + row.id + '" class="btn btn-rounded btn-icon btn-outline-info ml-2" title="Edit Role"><i style="margin-left: -2.5px;" class="fa fa-edit"></i></button>' +
                                   '<button id="delete-role" data-id="' + row.id + '" class="btn btn-rounded btn-icon btn-outline-danger ml-2" title="Delete Role"><i style="margin-left: -2.5px;" class="fa fa-trash"></i></button>';
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

            $('#roles-view-table').each(function () {
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
        const apiEndpointView = `${baseURL}/api/admin/roles/view`;

        
        drawDatatable(token, apiEndpointView);

        $(document).on('click', 'button#delete-role', function(event){
            const apiEndpointDelete= `${baseURL}/api/admin/roles/delete/${$(this).data('id')}`;
            fetch(apiEndpointDelete, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                $('#roles-view-table').DataTable().destroy();
                drawDatatable(token, apiEndpointView);
                sweetAlert.Unitoast('Success', data.success, 'success');
            })
            .catch(error => {
                sweetAlert.Unitoast('Error', error, 'error');
                // console.error('Error fetching data:', error);
            });
        });

        $(document).on('click', 'button#edit-role', function(event){
            const editRoute = `${baseURL}/admin/roles/edit/${$(this).data('id')}`;
            window.location.assign(editRoute);
        });
        $(document).on('click', 'button#assign-permissions', function(event){
            const editRoute = `${baseURL}/admin/roles/create/permissions/${$(this).data('id')}/arcp`;
            window.location.assign(editRoute);
        });
    };

    return {
        init: function () {
            init();
        }
    };
}();

jQuery(document).ready(function () {
    RolesView.init();
});


