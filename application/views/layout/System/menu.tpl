<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
       
        <div class="pull-left info">
            {if $isAdmin}
                <p>Hello, {Registry::getCurrentUser()->first_name}</p>
            {/if}
        </div>
    </div>

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li>
            <a href="{Url::get('SystemRoute','Main', 'Index')}">
                <i class="fa fa-th"></i> <span>Users</span>
            </a>
        </li>
        {if $isAdmin}
        <li>
            <a href="{Url::get('SystemRoute','Payments', 'Index')}">
                <i class="fa fa-bar-chart-o"></i>
                <span>Payments</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
        </li>

        <li>
            <a href="{Url::get('SystemRoute','Pages', 'Index')}">
                <i class="fa fa-bar-chart-o"></i>
                <span>Pages</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
        </li>
        {/if}
    </ul>
</section>
<!-- /.sidebar -->