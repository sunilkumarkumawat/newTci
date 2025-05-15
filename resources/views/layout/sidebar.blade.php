<!-- Main Sidebar Container -->
<aside class="main-sidebar bg-light d-none d-md-block" id="sidebar">
    <!-- Brand Logo -->
    <a href="/">
        <div class="top_brand_section">
            <img src={{ asset(env('IMAGE_SHOW_PATH') . 'Sidebar\brand-logo.png') }} alt="Brand Logo" class="brand_img">
            <p class="brand_title">Rukmani Software School</p>
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link">
                        <i class="fa fa-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- USER MENU -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fa fa-user"></i>
                        <p> User <i class="fa fa-angle-left right "></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('userAdd') }}" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('userEdit') }}" class="nav-link">
                                <i class="fa fa-pencil-square nav-icon"></i>
                                <p>Edit User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('userView') }}" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View User</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- STUDENT MENU -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fa fa-graduation-cap" style="font-size: 14px"></i>
                        <p>
                            Student
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('studentAdd') }}" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>Add Student</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('studentEdit') }}" class="nav-link">
                                <i class="fa fa-pencil-square nav-icon"></i>
                                <p>Edit Student</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('studentView') }}" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Students</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- message --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-envelope"></i>
                        <p>
                            Message
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('messageTypeAdd') }}" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>Add Message</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('messageTemplate') }}" class="nav-link">
                                <i class="fa fa-square-envelope nav-icon"></i>
                                <p>Message Template</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Branch -->
                <li class="nav-item has-treeview">
                    <a href="{{ url('branch') }}" class="nav-link">
                        <i class="fa-solid fa-code-branch"></i>
                        <p>
                            Branch
                        </p>
                    </a>
                </li>

                <!-- Role -->
                <li class="nav-item has-treeview">
                    <a href="{{ url('role') }}" class="nav-link">
                        <i class="fa-solid fa-user-circle"></i>
                        <p>
                            Role
                        </p>
                    </a>
                </li>

                <!-- Expense MENU -->
                <li class="nav-item has-treeview">
                    <a href="{{ url('expense') }}" class="nav-link">
                        <i class="fa fa-credit-card"></i>
                        <p>
                            Expense
                        </p>
                    </a>
                </li>

                <!-- library Management -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fa fa-eraser"></i>
                        <p>
                            Library Management
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('cabin') }}" class="nav-link">
                                <i class="fa-solid fa-house-user nav-icon" style="font-size: 15px"></i>
                                <p>Cabin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('locker') }}" class="nav-link">
                                <i class="fa fa-lock nav-icon" style="font-size: 15px"></i>
                                <p>Locker</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('subscription') }}" class="nav-link">
                                <i class="fa fa-layer-group nav-icon" style="font-size: 15px"></i>
                                <p>Subscription</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('billing') }}" class="nav-link">
                                <i class="fa fa-receipt nav-icon" style="font-size: 15px"></i>
                                <p>Bill</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('due') }}" class="nav-link">
                                <i class="fa fa-rectangle-list  nav-icon" style="font-size: 15px"></i>
                                <p>Due List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('wallet') }}" class="nav-link">
                                <i class="fa fa-wallet nav-icon" style="font-size: 15px"></i>
                                <p>Wallet</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Book management --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fa fa-book"></i>
                        <p>
                            Book Management
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('bookAdd') }}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Book Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('bookAssign') }}" class="nav-link">
                                <i class="fa fa-book nav-icon"></i>
                                <p>Book Assign</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Log Out -->
                <li class="nav-item">
                    <a href="{{ url('login') }}" class="nav-link text-danger">
                        <i class="fa fa-sign-out"></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Toggle button -->
<button class="mobile-sidebar-toggle d-md-none" id="sidebarToggleBtn">
    <i class="fa fa-bars"></i>
</button>

<!-- Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<style>
    .brand_img {
        width: 45px;
        height: 40px;
    }

    .brand_title {
        margin: 0 0 0 10px;
        font-size: 12px;
        font-weight: 600;
        color: white;
        overflow: hidden;
    }

    .top_brand_section {
        display: flex;
        align-items: center;
        height: 50px;
        background-color: #343a40;
        padding: 10px;
        border-bottom: 2px solid white;
    }

    .quick-menu {
        position: fixed !important;
        top: -38px !important;
        left: 12.8rem !important;
        z-index: 1000;
        display: none;
        min-width: 12rem;
        padding: .5rem 0;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: .25rem;
        box-shadow: 10px 3px 12px rgba(0, 0, 0, 0.26);
    }

    .nav-icon {
        margin-right: 10px;
    }

    /* Normal nav link */
    .nav-sidebar .nav-link {
        color: #f9fbfc;
    }

    /* Active link styling for main menu */
    .nav-sidebar .nav-link.active {
        background-color: #397ec7 !important;
        color: white !important;
    }

    /* Active submenu link */
    .nav-treeview .nav-link.active {
        background-color: #0069d9 !important;
        color: #fff !important;
        font-weight: 500;
    }

    /* Optional: change submenu icon color on active */
    .nav-treeview .nav-icon {
        color: #fff;
    }

    .nav-icon:hover {
        color: #000000;
    }

    /* Improve hover */
    .nav-sidebar .nav-link:hover {
        background-color: #ffffffde;
        color: #000 !important;
    }

    /* Set sidebar font size */
    .nav-link p,
    .brand-text {
        font-size: 0.8rem !important;
    }

    /* Smooth transition */
    #sidebar {
        transition: all 0.3s ease;
    }

    /* Collapsed sidebar */
    #sidebar.sidebar-collapsed {
        width: 60px !important;
        overflow: hidden;
    }

    /* Hide sidebar text when collapsed */
    #sidebar.sidebar-collapsed .nav-link p,
    #sidebar.sidebar-collapsed .brand_title {
        display: none !important;
    }

    /* Expand on hover */
    @media (min-width: 768px) {
        #sidebar.sidebar-collapsed:hover {
            width: 220px !important;
        }

        #sidebar.sidebar-collapsed:hover .nav-link p,
        #sidebar.sidebar-collapsed:hover .brand_title {
            display: inline-block !important;
        }
    }

    /* Mobile sidebar toggle button */
    .mobile-sidebar-toggle {
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1050;
        background-color: #003366;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 8px 12px;
        font-size: 1.25rem;
        cursor: pointer;
    }

    /* Mobile view enhancements */
    @media (max-width: 767.98px) {
        /* Fix for the d-none d-md-block classes */
        #sidebar {
            display: block !important;
            width: 0 !important;
            min-width: 0;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 1040;
            background-color: #003366;
            transition: width 0.3s ease;
        }

        /* Active state for mobile - sidebar shown */
        #sidebar.mobile-show {
            width: 250px !important;
        }

        /* Add overlay when sidebar is open */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;
            display: none;
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* Ensure text is visible on mobile */
        #sidebar .nav-link p,
        #sidebar .brand_title {
            display: inline-block !important;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get DOM elements
    const toggleBtn = document.getElementById('sidebarToggleBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (toggleBtn && sidebar && overlay) {
        // Toggle sidebar on button click
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('mobile-show');
            overlay.classList.toggle('show');
            console.log('Toggle clicked, sidebar classes:', sidebar.className);
        });
        
        // Close sidebar when clicking overlay
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('mobile-show');
            overlay.classList.remove('show');
        });
    } else {
        console.error('Sidebar elements not found:', { 
            toggleBtn: !!toggleBtn, 
            sidebar: !!sidebar, 
            overlay: !!overlay 
        });
    }
});
</script>