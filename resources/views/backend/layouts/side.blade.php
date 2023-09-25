<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<div class="sidebar-brand">
                    <span class="align-middle">Wallet Pay</span>
                </div>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>
					<li class="sidebar-item @yield('home')">
						<a class="sidebar-link" href="{{ route('admin.home')}}">
                          <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                         </a>
					</li>

					<li class="sidebar-item @yield('admin_user')">
						<a class="sidebar-link" href="{{ route('admin-user.index') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Admin User</span>
                        </a>
					</li>

					<li class="sidebar-item @yield('user')">
						<a class="sidebar-link" href="{{ route('user.index') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">User</span>
                        </a>
					</li>

					<li class="sidebar-item @yield('wallet')">
						<a class="sidebar-link" href="{{ route('wallet.index') }}">
                            <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Wallet</span>
                        </a>
					</li>
				</ul>
			</div>
</nav>