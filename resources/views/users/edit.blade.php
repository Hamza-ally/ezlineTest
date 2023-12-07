<x-app-layout>

    <x-slot name="headerStyles">

    </x-slot>
    <x-slot name="headerScripts">

    </x-slot>

    <x-slot name="title">
        Users | Ezline
    </x-slot>

    <x-slot name="header_menu">

    </x-slot>

    <div class="page-header">
        <h3 class="page-title">
            Users
        </h3>
    </div>

    <div class="row">
        <div class="col-md-8 grid-margin stretch-card offset-sm-2">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Users</h4>

                    <p class="card-description">
                        You can edit default app users here.
                    </p>

                    <form id="user-edit-form" method="POST" action="{{route('api.admin.users.edit', ['id' => $user['id']])}}">
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$user['name']}}">
                        </div>
                    
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{$user['email']}}">
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="Administrator" @if($user['role'] == "Administrator") selected @endif>Administrator</option>
                                <option value="User" @if($user['role'] == "User") selected @endif>User</option>
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="text" class="form-control" name="password" id="password" placeholder="New Password">
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
            const user_id = @json($user['id']);
        </script>
        {{-- <script src="{{asset('js/swal.js')}}"></script> --}}
        <script src="{{asset('js/admin/users/edit.js')}}"></script>
    </x-slot>

</x-app-layout>
