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

					<li class="sidebar-header">
						Tools & Components
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-buttons.html">
                           <i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-forms.html">
                           <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-cards.html">
                          <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-typography.html">
                              <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
                        </a>
					</li>

					<li class="sidebar-header">
						Plugins & Addons
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="charts-chartjs.html">
                             <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="maps-google.html">
                             <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                        </a>
					</li>
				</ul>
			</div>
</nav>