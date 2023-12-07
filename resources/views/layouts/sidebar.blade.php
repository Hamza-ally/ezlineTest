<ul class="nav">

    <x-layouts.sidebar-userinfo></x-layouts.sidebar-userinfo>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard">
            <i class="fa fa-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#permission" aria-expanded="false" aria-controls="permission">
            <i class="fab fa-trello menu-icon"></i>
            <span class="menu-title">Permission</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="permission">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> 
                    <a class="nav-link" id="permission" href="#">Create</a>
                    <a class="nav-link" id="permission" href="#">View</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
            <i class="fa fa-users menu-icon"></i>
            <span class="menu-title">Users</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="users">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> 
                    <a class="nav-link" id="users" href="{{route('admin.users.create.auc')}}">Create</a>
                    <a class="nav-link" id="users" href="{{route('admin.users.view.auv')}}">View</a>
                </li>
            </ul>
        </div>
    </li>

</ul>
