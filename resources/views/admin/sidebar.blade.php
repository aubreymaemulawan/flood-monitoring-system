<!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <!-- Dasboard -->
            <li class="nav-item"> 
                <a id="main-admin-dashboard" class="nav-link collapsed" href="./admin"> 
                    <i class="bi bi-grid"></i> 
                    <span>Dashboard</span> 
                </a>
            </li> 
            <!-- Go to Website -->
            <li class="nav-item"> 
                <a id="main-admin-website" class="nav-link collapsed" href="./"> 
                    <i class="bi bi-globe"></i> 
                    <span>Go to Website</span> 
                </a>
            </li>
            <!-- Management Divider -->
            <li class="nav-heading">Management</li>
            <!-- Manage Devices -->
            <li class="nav-item"> 
                <a id="main-admin-manageDevices" class="nav-link collapsed" href="./manage-devices"> 
                    <i class="bi bi-shield-check"></i> 
                    <span>Manage Devices</span> 
                </a>
            </li>
            <!-- Flood Monitoring -->
            <li class="nav-item"> 
                <a id="main-admin-waterLevel" class="nav-link collapsed" href="./water-level"> 
                    <i class="bi bi-clipboard-data"></i> 
                    <span>Water Level</span> 
                </a>
            </li>
            <!-- Registered Numbers -->
            <li class="nav-item"> 
                <a id="main-admin-registeredNumbers" class="nav-link collapsed" href="./registered-numbers"> 
                    <i class="bi bi-phone"></i> 
                    <span>Registered Numbers</span> 
                </a>
            </li>
            <!-- Export Data -->
            <li class="nav-item"> 
                <a id="main-admin-exportData" class="nav-link collapsed" href="./export-data"> 
                    <i class="bi bi-download"></i> 
                    <span>Export Data</span> 
                </a>
            </li>
            <!-- Generate Report -->
            <li class="nav-item">
                <a id="main-admin-generateReport" class="nav-link collapsed" data-bs-target="#mid-genrep" data-bs-toggle="collapse" href="#"> 
                    <i class="bi bi-journal-text"></i>
                    <span>Generate Report</span>
                    <i class="bi bi-chevron-down ms-auto"></i> 
                </a>
                <ul id="mid-genrep" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li> 
                        <a id="menu-generateReport-waterLevel" href="./report-waterLevel"> 
                            <i class="bi bi-circle"></i>
                            <span>Water Level</span> 
                        </a>
                    </li>
                    <li > 
                        <a id="menu-generateReport-registeredNumbers" href="./report-registeredNumbers"> 
                            <i class="bi bi-circle"></i>
                            <span>Registered Numbers</span> 
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Account Divider -->
            <li class="nav-heading">Account</li>
            <!-- Profile -->
            <li class="nav-item"> 
                <a id="main-admin-profile" class="nav-link collapsed" href="./profile"> 
                    <i class="bi bi-person"></i> 
                    <span>Profile</span> 
                </a>
            </li>
        </ul>
    </aside>
<!-- / End of Sidebar -->