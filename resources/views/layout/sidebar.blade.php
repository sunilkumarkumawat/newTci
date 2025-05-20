 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
     integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                         <i class="fa fa-dashboard nav-icon"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>

                 <!-- Branch -->
                 <li class="nav-item has-treeview">
                     <a href="{{ url('branch') }}" class="nav-link">
                         <i class="fa fa-code-branch nav-icon"></i>
                         <p>Branch</p>
                     </a>
                 </li>

                  <!-- Role -->
                 <li class="nav-item has-treeview">
                     <a href="{{ url('role') }}" class="nav-link">
                         <i class="fa fa-user-circle nav-icon"></i>
                         <p> Role</p>
                     </a>
                 </li>

                 <!-- USER MENU -->
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="fa fa-user nav-icon"></i>
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
                             <a href="{{ url('userView') }}" class="nav-link">
                                 <i class="fa fa-eye nav-icon"></i>
                                 <p>View List</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 <!-- STUDENT MENU -->
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="fa fa-graduation-cap nav-icon"></i>
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
                             <a href="{{ url('studentView') }}" class="nav-link">
                                 <i class="fa fa-eye nav-icon"></i>
                                 <p>View List</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 {{-- message --}}
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="fa fa-envelope nav-icon"></i>
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
                                 <i class="fa fa-envelope-square nav-icon"></i>
                                 <p>Message Template</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 <!-- Expense MENU -->
                 <li class="nav-item has-treeview">
                     <a href="{{ url('expense') }}" class="nav-link">
                         <i class="fa fa-credit-card nav-icon"></i>
                         <p>Expense</p>
                     </a>
                 </li>

                 <!-- library Management -->
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="fa fa-eraser nav-icon"></i>
                         <p>
                             Library Management
                             <i class="fa fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ url('cabin') }}" class="nav-link">
                                 <i class="fa fa-home nav-icon"></i>
                                 <p>Cabin</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('locker') }}" class="nav-link">
                                 <i class="fa fa-lock nav-icon"></i>
                                 <p>Locker</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('subscription') }}" class="nav-link">
                                 <i class="fa fa-bookmark nav-icon"></i>
                                 <p>Subscription</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('billing') }}" class="nav-link">
                                 <i class="fa fa-file-text nav-icon"></i>
                                 <p>Bill</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('due') }}" class="nav-link">
                                 <i class="fa fa-list nav-icon"></i>
                                 <p>Due List</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('wallet') }}" class="nav-link">
                                 <i class="fa fa-money nav-icon"></i>
                                 <p>Wallet</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 {{-- Book management --}}
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="fa fa-book nav-icon"></i>
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
                         <i class="fa fa-sign-out nav-icon"></i>
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
