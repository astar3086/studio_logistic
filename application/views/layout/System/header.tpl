<header class="header">
	<a class="logo" href="../../index.html">
		<!-- Add the class icon to your logo image or logo icon to add the margining -->
		<span>Logistic</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav role="navigation" class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a role="button" data-toggle="offcanvas" class="navbar-btn sidebar-toggle" href="#">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<!-- Messages: style can be found in dropdown.less-->

				<!-- Tasks: style can be found in dropdown.less -->
				<li class="dropdown tasks-menu">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<i class="fa fa-taskrs"></i>
						<span class="label label-danger"></span>
					</a>
					<ul class="dropdown-menu"></ul>

				</li>
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<i class="glyphicon glyphicon-user"></i>
						<span>{Registry::getCurrentUser()->first_name} {Registry::getCurrentUser()->last_name}<i class="caret"></i></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header bg-light-blue">
							
							<p>
								{Registry::getCurrentUser()->first_name} {Registry::getCurrentUser()->last_name} - {*Registry::getCurrentUser()->*}
								
							</p>
						</li>
						<!-- Menu Body -->
						<!--li class="user-body">
							<div class="col-xs-4 text-center">
								<a href="#">Followers</a>
							</div>
							<div class="col-xs-4 text-center">
								<a href="#">Sales</a>
							</div>
							<div class="col-xs-4 text-center">
								<a href="#">Friends</a>
							</div>
						</li-->
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a class="btn btn-default btn-flat" href="{URL::get('SystemRoute','Profile','Index')}/Index">Изменить данные</a>
							</div>
							<div class="pull-right">
								<a class="btn btn-default btn-flat" href="{URL::get('SystemRoute','Main','logout')}">Выход</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
