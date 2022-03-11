<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="{{asset('landing1/images/test3.jpg')}}" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?= Auth::check() ? Auth::user()->name : "Welcome" ?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
        <div class="row">
            <div class="col-md-12">
                <center>{{date('Y-m-d H:i:s')}}</center>
            </div>
        </div>
    </div>
    <div class="divider"></div>
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li class="menu-dashboard"><a href="/dashboard"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
        <li class="menu-transaction"><a href="/payment"><em class="fa fa-exchange">&nbsp;</em> Transaction</a></li>
        <li class="menu-data-phone"><a href="/task"><em class="fa fa-database">&nbsp;</em> Data Phone</a></li>
        <li class="menu-task"><a href="/task-phone-number"><em class="fa fa-tasks">&nbsp;</em> Task</a></li>
        <li class="menu-report"><a href="/report"><em class="fa fa-file">&nbsp;</em> Report</a></li>
        {{-- <li class="menu-contact"><a href="panels.html"><em class="fa fa-phone">&nbsp;</em> Contacu Us</a></li> --}}
        <li class="menu-user"><a href="/user"><em class="fa fa-user">&nbsp;</em> User Management</a></li>
        {{-- <li class="parent active"><a data-toggle="collapse" href="#sub-item-1">
            <em class="fa fa-file">&nbsp;</em> Report <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li class=""><a class="" href="#">
                    <span class="fa fa-arrow-right">&nbsp;</span> <?= Auth::check() ? Auth::user()->name : "Welcome" ?>
                </a></li>
                <li><a class="" href="#">
                    <span class="fa fa-arrow-right">&nbsp;</span> Employee
                </a></li>
                <li><a class="" href="#">
                    <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
                </a></li>
            </ul>
        </li> --}}
    </ul>
</div><!--/.sidebar-->
