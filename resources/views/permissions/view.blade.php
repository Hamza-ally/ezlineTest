<x-app-layout>
    <x-slot name="headerStyles">

    </x-slot>
    <x-slot name="headerScripts">

    </x-slot>

    <x-slot name="title">
        Permisisons | Ezline
    </x-slot>

    <x-slot name="header_menu">

    </x-slot>

    <div class="page-header">
        <h3 class="page-title">
            Permisisons
        </h3>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Permisisons</h4>

                    <p class="card-description">
                        You can view default app permissions here.
                    </p>

                    <div class="table-responsive">
                        <table id="permissions-view-table" class="table">
                          <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                </div>
            </div>

        </div>
    </div>


    <x-slot name="footerScripts">
        <script>
            const _user = @json(Auth::user());
        </script>
        <script src="{{ asset('js/admin/permissions/view.js?v=' . time()) }}"></script>
        {{-- <script src="{{ asset('theme/js/data-table.js?v=' . time()) }}"></script> --}}
    </x-slot>
</x-app-layout>