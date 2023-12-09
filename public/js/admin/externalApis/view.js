"use strict";

var ExternalApisView = function () {

    var init = function () {
        
        function fetchData(apiUrl, pageNumber, callback) {
            $.ajax({
                url: apiUrl,
                type: 'GET',
                data: {
                    page: pageNumber,
                },
                success: function (data) {
                    callback(data);
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                },
            });
        }
        
        $('#movies-view-table').DataTable({
            serverSide: true,
            ajax: function (data, callback, settings) {
                console.log(data.start);
                console.log(data);
                var pageNumber = Math.ceil(data.start / data.length) + 1;
                fetchData('https://yts.mx/api/v2/list_movies.json', pageNumber, function (apiResponse) {
                    callback({
                        recordsTotal: apiResponse.data.movie_count,
                        recordsFiltered: apiResponse.data.movie_count,
                        data: apiResponse.data.movies,
                    });
                });
            },
            columns: [
                { data: 'id' },
                { data: 'title' },
                { data: 'year' },
                { data: 'language' },
                { data: 'date_uploaded' },
            ],
            ordering: true,
            // aLengthMenu: [
            //     [5, 20, 15, -1],
            //     [5, 20, 15, "All"]
            // ],
            iDisplayLength: 20,
            language: {
                search: ""
            },
            drawCallback: function (settings) {
                var apiResponse = settings.json;
                if (apiResponse && apiResponse.data && apiResponse.data.movies) {
                    var pageInfo = Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1;
                    var pageSize = settings._iDisplayLength;
                    var totalRecords = apiResponse.data.movie_count;
                    $('#movies-view-table_info').html('Showing ' + pageInfo + ' of ' + Math.ceil(totalRecords / pageSize) + ' pages');
                }
            }
        });
    };

    return {
        init: function () {
            init();
        }
    };
}();

jQuery(document).ready(function () {
    ExternalApisView.init();
});


