<!-- Navbar -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between"> 
            <a href="#" class="logo1 d-flex align-items-center"> 
                <img src="assets/img/logo1.png" alt=""> 
                <span class="d-none d-lg-block">FLSys</span> 
            </a> 
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <!-- Settings Dropdown -->
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"> 
                        <img src="assets/img/admin_icon.png" alt="Profile" class="rounded-circle"> 
                        <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span> 
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Admin</h6>
                            <span>Web Manager</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li> 
                            <a class="dropdown-item d-flex align-items-center" href="./profile"> 
                                <i class="bi bi-person"></i> 
                                <span>My Profile</span> 
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li> 
                            <button class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#logoutModal"> 
                                <i class="bi bi-box-arrow-right"></i> 
                                <span>Sign Out</span> 
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
<!-- / End of Navbar -->

<!-- Logout Modal -->
    <div class="modal fade" role="dialog" aria-labelledby="logoutModalLabel" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalTitle">Ready to Leave?</h5>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>
        </div>
    </div>
<!-- / Logout Modal -->