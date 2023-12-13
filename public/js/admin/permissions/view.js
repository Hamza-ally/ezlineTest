"use strict";

var Permisisons = function () {

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
            $('#permissions-view-table').DataTable({
                data: data.data,
                columns: [
                    { data: 'name' },
                    { 
                        data: null,
                        render: function (data, type, row) {
                            return '<button id="edit-permission" data-id="' + row.id + '" class="btn btn-rounded btn-icon btn-outline-info" title="Edit Permission"><i style="margin-left: -2.5px;" class="fa fa-edit"></i></button>' +
                                   '<button id="delete-permission" data-id="' + row.id + '" class="btn btn-rounded btn-icon btn-outline-danger ml-2" title="Delete Permission"><i style="margin-left: -2.5px;" class="fa fa-trash"></i></button>';
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

            $('#permissions-view-table').each(function () {
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
        const apiEndpointView = `${baseURL}/api/admin/permissions/view`;

        
        drawDatatable(token, apiEndpointView);

        $(document).on('click', 'button#delete-permission', function(event){
            const apiEndpointDelete= `${baseURL}/api/admin/permissions/delete/${$(this).data('id')}`;
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
                $('#permissions-view-table').DataTable().destroy();
                drawDatatable(token, apiEndpointView);
                sweetAlert.Unitoast('Success', data.success, 'success');
            })
            .catch(error => {
                sweetAlert.Unitoast('Error', error, 'error');
                // console.error('Error fetching data:', error);
            });
        });

        $(document).on('click', 'button#edit-permission', function(event){
            const editRoute = `${baseURL}/admin/permissions/edit/${$(this).data('id')}`;
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
    Permisisons.init();
});


