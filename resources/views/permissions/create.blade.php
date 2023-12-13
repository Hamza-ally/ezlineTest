<x-app-layout>

    <x-slot name="headerStyles">

    </x-slot>
    <x-slot name="headerScripts">

    </x-slot>

    <x-slot name="title">
        Permissions | Ezline
    </x-slot>

    <x-slot name="header_menu">

    </x-slot>

    <div class="page-header">
        <h3 class="page-title">
            Permissions
        </h3>
    </div>

    <div class="row">
        <div class="col-md-8 grid-margin stretch-card offset-sm-2">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Permissions</h4>

                    <p class="card-description">
                        You can create default app permissions here.
                    </p>

                    <form id="permission-create-form" method="POST" action="{{route('api.admin.permissions.create')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Permission Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Permission Name">
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
        </script>
        {{-- <script src="{{asset('js/swal.js')}}"></script> --}}
        <script src="{{asset('js/admin/permissions/create.js')}}"></script>
    </x-slot>

</x-app-layout>
