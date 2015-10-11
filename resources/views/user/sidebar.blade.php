@section("sidebar")
    {{-- */$id=Auth::id();/* --}}
    <div class="uac_sidebar">
        <div class="uac_sidebar_header">
            <!--<a href="#reviewModal" data-toggle="modal">My Profile</a> -->
            My Profile
        </div>
        <div class="uac_nav_items">
            <li @if($nav_item==1) class="active" @endif> <a href="{{'/users/profile'}}">My Profile</a></li>
            <li @if($nav_item==2) class="active" @endif> <a href="{{'/users/'}}{{$id}}{{'/edit'}}">Edit Profile</a> </li>
            <li @if($nav_item==3) class="active" @endif> <a href="{{'/users/changepassword'}}">Change Password</a> </li>
        </div>
    </div>
@show