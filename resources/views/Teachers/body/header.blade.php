<header class="main-header">
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top pl-30">
		<!-- Sidebar toggle button-->
		<div>
			<ul class="nav">
				<li class="btn-group nav-item">
					<a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu"
						role="button">
						<i class="nav-link-icon mdi mdi-menu"></i>
					</a>
				</li>
				<li class="btn-group nav-item">
					<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded svg-bt-icon"
						title="Full Screen">
						<i class="nav-link-icon mdi mdi-crop-free"></i>
					</a>
				</li>
			</ul>
		</div>

		<div class="navbar-custom-menu r-side">
			<ul class="nav navbar-nav">
				<!-- Term | Academic Session -->
				<li class="search-bar">
					<div>
						<h4>{{Active_Term()->term_name}} | {{Active_Session()->name}}</h4>
					</div>
				</li>

				<!-- Notifications -->
				<li class="dropdown notifications-menu">
					<a href="#" class="waves-effect waves-light rounded dropdown-toggle" data-toggle="dropdown"
						title="Notifications">
						<i class="ti-bell"></i>
					</a>
					<ul class="dropdown-menu animated bounceIn">

						<li class="header">
							<div class="p-20">
								<div class="flexbox">
									<div>
										<h4 class="mb-0 mt-0">Notifications</h4>
									</div>
									<div>
										<a href="#" class="text-danger">Clear All</a>
									</div>
								</div>
							</div>
						</li>

						<li>

						</li>
						<li class="footer">
							<a href="#">View all</a>
						</li>
					</ul>
				</li>

				<!-- User Account -->
				<li class="dropdown user user-menu">
					<a href="javascript:void(0)" class="waves-effect waves-light rounded dropdown-toggle p-0"
						data-toggle="dropdown" title="User">
						<img src="{{ (!empty($staff_info['staff_passport'])) ? url('storage/' . $staff_info['staff_passport']) : url('storage/profile-photos/default.png') }}"
							alt="Staff Passport">
					</a>
					<ul class="dropdown-menu animated flipInX">
						<li class="user-body">
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#Profile"><i
									class="ti-user text-muted mr-2"></i> Profile</a>
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#ChangePassword"><i
									class="ti-key text-muted mr-2"></i> Password</a>

							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{ route('admin.logout') }}"><i
									class="ti-lock text-muted mr-2"></i> Logout</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>