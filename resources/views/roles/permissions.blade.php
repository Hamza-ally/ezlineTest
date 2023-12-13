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

                    <h4 class="card-title">Role: <ins>{{$role['name']}}</ins></h4>

                    <p class="card-description">
                        You can create default app role permissions here.
                    </p>

                    <form id="role-create-form" method="POST"
                        action="{{ route('api.admin.roles.create.permissions', ['id' => $role['id']]) }}">
                        @csrf
                        <div class="form-group">
                            <label>Select Permissions for '{{$role['name']}}'</label>
                            <select class="js-example-basic-multiple w-100" multiple="multiple" id="permissions" name="permisisons">
                                @foreach ($permissions as $permission)
                                    <option value="{{$permission['id']}}"@if(in_array($permission['id'], $role_permissions_ids)) selected @endif>{{$permission['name']}}</option>
                                @endforeach
                            </select>
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
        <script src="{{asset('theme/js/select2.js')}}"></script>
        <script>
            const _user = @json(Auth::user());
            const role_id = @json($role['id']);
        </script>
        {{-- <script src="{{asset('js/swal.js')}}"></script> --}}
        <script src="{{ asset('js/admin/roles/permissions.js') }}"></script>
    </x-slot>

</x-app-layout>
