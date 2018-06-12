<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <img src="images/default.png" class="img-rounded img-responsive"/>
            </div>
            <ul class="list-group">
                <li class="list-group-item {{Request::is('admin/dashboard') ? 'active' : ""}}"><a href="{{route('dashboard')}}">View All Memorandum</a> </li>
                <li class="list-group-item {{Request::is('admin/memorandum/add') ? 'active' : ""}}"><a href="{{route('memo.add')}}">Add Memorandum</a> </li>
                <li class="list-group-item {{Request::is('admin/users') ? 'active' : ""}}"><a href="{{route('admin.user.all')}}">View All User</a> </li>
                <li class="list-group-item {{Request::is('admin/users/add') ? 'active' : ""}}"><a href="{{route('admin.user.action',['type' => 'add'])}}">Add User</a> </li>
            </ul>
            <div class="panel-footer">
                <a href="{{route('logout')}}" class="btn btn-danger text-center">Logout</a>
            </div>
        </div>
    </div>
</div>