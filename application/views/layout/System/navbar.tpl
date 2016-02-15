
<!-- begin container-fluid -->
<div class="container-fluid">
    <!-- begin mobile sidebar expand / collapse button -->
    <!--div class="navbar-header">
        <a href="index.html"  class="navbar-brand"><span class="navbar-logo"></span> Color Admin</a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div-->
    <!-- end mobile sidebar expand / collapse button -->

<!-- fa-bell-o -->
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a href="/{Url::get('SystemRoute','Overview')}" class=" f-s-16" alt="Обзор">
                <i class="fa fa-tachometer"></i>
            </a>
        </li>
        <li>
            <a href="javascript:;" alt="Империя">
                <i class="fa fa-university"></i>
            </a>
        </li>
        <li>
            <a href="javascript:;" alt="Статистика">
                <i class="fa fa-signal"></i>
            </a>
        </li>
        <li>
            <a href="javascript:;" >
                <i class="fa icon-overview "></i>
            </a>
        </li>
        <li>
            <a href="javascript:;" >
                <i class="fa icon-overview "></i>
            </a>
        </li>
        <li>
            <a href="javascript:;" >
                <i class="fa icon-chat "></i>
            </a>
        </li>
        <button class="navbar-toggle" data-click="sidebar-toggled" type="button">
    </ul>


    <!-- begin header navigation right -->
    <ul class="nav navbar-nav navbar-right">
        <li>

        </li>
        <li class="dropdown">
            <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                <i class="fa fa-bell-o"></i>
                <span class="label">5</span>
            </a>
            <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                <li class="dropdown-header">Notifications (5)</li>
                <li class="media">
                    <a href="javascript:;">
                        <div class="pull-left media-object bg-red"><i class="fa fa-bug"></i></div>
                        <div class="media-body">
                            <h6 class="media-heading">Server Error Reports</h6>
                            <div class="text-muted">3 minutes ago</div>
                        </div>
                    </a>
                </li>
                <li class="media">
                    <a href="javascript:;">
                        <div class="pull-left"><img  class="media-object" alt="" /></div>
                        <div class="media-body">
                            <h6 class="media-heading">John Smith</h6>
                            <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                            <div class="text-muted">25 minutes ago</div>
                        </div>
                    </a>
                </li>
                <li class="media">
                    <a href="javascript:;">
                        <div class="pull-left"><img  class="media-object" alt="" /></div>
                        <div class="media-body">
                            <h6 class="media-heading">Olivia</h6>
                            <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                            <div class="text-muted">35 minutes ago</div>
                        </div>
                    </a>
                </li>
                <li class="media">
                    <a href="javascript:;">
                        <div class="pull-left media-object bg-green"><i class="fa fa-plus"></i></div>
                        <div class="media-body">
                            <h6 class="media-heading"> New User Registered</h6>
                            <div class="text-muted">1 hour ago</div>
                        </div>
                    </a>
                </li>
                <li class="media">
                    <a href="javascript:;">
                        <div class="pull-left media-object bg-blue"><i class="fa fa-envelope"></i></div>
                        <div class="media-body">
                            <h6 class="media-heading"> New Email From John</h6>
                            <div class="text-muted">2 hour ago</div>
                        </div>
                    </a>
                </li>
                <li class="dropdown-footer text-center">
                    <a href="javascript:;">View more</a>
                </li>
            </ul>
        </li>
        <li class="dropdown navbar-user">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <img alt="" />
                <span class="hidden-xs">Adam Schwartz</span> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInLeft">
                <li class="arrow"></li>
                <li><a href="javascript:;">Edit Profile</a></li>
                <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                <li><a href="javascript:;">Calendar</a></li>
                <li><a href="javascript:;">Setting</a></li>
                <li class="divider"></li>
                <li><a href="javascript:;">Log Out</a></li>
            </ul>
        </li>
    </ul>
    <!-- end header navigation right -->
</div>
<!-- end container-fluid -->



<div class="container-fluid">
    <ul class="nav navbar-nav ">
        <li>
            <div class="icon_metal"></div>
            <div id="current-metal-bar" class="progress active">
                <div class="progress-bar progress-bar-primary" style="width: 33%">33%</div>
                <!--div class="progress-bar progress-bar-info" style="width: 33%">33%</div>
                <div class="progress-bar progress-bar-success" style="width: 34%">33%</div-->
            </div>
        </li>
        <li>
            <div id="current-crystal-bar" class="progress active">
                <div class="progress-bar progress-bar-primary" style="width: 33%">33%</div>
                <!--div class="progress-bar progress-bar-info" style="width: 33%">33%</div>
                <div class="progress-bar progress-bar-success" style="width: 34%">33%</div-->
            </div>
        </li>
        <li>
            <div id="current-deuterium-bar" class="progress active">
                <div class="progress-bar progress-bar-primary" style="width: 33%">33%</div>
                <!--div class="progress-bar progress-bar-info" style="width: 33%">33%</div>
                <div class="progress-bar progress-bar-success" style="width: 34%">33%</div-->
            </div>
        </li>

        <li>
            <div id="current-energy-bar" class="progress active">
                <div class="{*progress-bar progress-bar-success*}" style="width: 50%;float:left;">&nbsp;</div>
                <div class="progress-bar progress-bar-info" style="width: 33%">Energy:25%</div>
            </div>
        </li>
    </ul>
</div>