<x-app-layout>

    <x-slot name="headerStyles">

    </x-slot>
    <x-slot name="headerScripts">

    </x-slot>

    <x-slot name="title">
        Roles | Ezline
    </x-slot>

    <x-slot name="header_menu">

    </x-slot>

    <div class="page-header">
        <h3 class="page-title">
            Roles
        </h3>
    </div>

    <div class="row">
        <div class="col-md-8 grid-margin stretch-card offset-sm-2">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Roles</h4>

                    <p class="card-description">
                        You can edie default app roles here.
                    </p>

                    <form id="role-edit-form" method="POST" action="{{route('api.admin.roles.edit', ['id' => $role['name']])}}">
                        
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$role['name']}}">
                        </div>
                    
                        <br>
                    
                        <button type="submit" class="btn btn-sm btn-block btn-primary btn-icon-text float-center">
                            <i class="far fa-check-square btn-icon-prepend"></i>
                            Submit
                        </button>
                    
                    </form>
                </div>
            </div>

        </div>
    </div>

    <x-slot name="footerScripts">
        <script>
            const _user = @json(Auth::user());
            const role_id = @json($role['id']);
        </script>
        {{-- <script src="{{asset('js/swal.js')}}"></script> --}}
        <script src="{{asset('js/admin/roles/edit.js')}}"></script>
    </x-slot>

</x-app-layout>
