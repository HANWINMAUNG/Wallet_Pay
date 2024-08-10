<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown" style="padding-right:30px;">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                 <img src="https://ui-avatars.com/api/?name={{ auth()->guard('admin_user')->user()->name }}" class="avatar img-fluid rounded me-1" alt="https://ui-avatars.com/api/?name={{ auth()->guard('admin_user')->user()->name }}" /> <span class="text-dark">{{ auth()->guard('admin_user')->user()->name }}</span>
                            </a>
							<div class="dropdown-menu dropdown-menu-end">
								<p class="dropdown-item"  onclick="document.getElementById('logout-form').submit();">Log out</p>
								<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
                                </form>
							</div>
						</li>
					</ul>
				</div>
			</nav>