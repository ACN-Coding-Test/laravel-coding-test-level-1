<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar collapse in" aria-expanded="true" style="">
    <div class="profile-sidebar">
        <div class="profile-userpic">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php 
                $userSession = Auth::user();
                echo  $userSession->first_name.' '.$userSession->last_name; ?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
        <li class="active"><a href="index.html"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
        <li><a href="widgets.html"><em class="fa fa-calendar">&nbsp;</em> Widgets</a></li>
        <li><a class="dropdown-item" href="javascript:;" onclick="$('#logout-form').submit();" data-toggle="modal" data-target="#logoutModal">
                <em class="fa fa-power-off">&nbsp;</em>
                Logout
            </a>                
            <form id="logout-form"  action="{{ url('/logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
