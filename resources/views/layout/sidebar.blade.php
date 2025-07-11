@php
$sidebarData = Helper::getSidebar();
$getSetting = Helper::getSetting();
@endphp
 
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
     integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar bg-light d-none d-md-block" id="sidebar">
     <!-- Brand Logo -->
     <a href="{{ url('/') }}">
         <div class="top_brand_section">
            @include('common.imageViewer', [
                'modal' => 'Setting',
                'id' => $getSetting->id,
                'field' => 'left_logo',
                'defaultImage' => 'defaultImages/imageError.png',
                'alt' => 'Setting Image',
                'class' => 'brand_img'
            ])
             <!-- <img src={{ asset('/defaultImages/organization/logo.jpeg') }} alt="Brand Logo" class="brand_img"> -->
             <p class="brand_title">{{ $getSetting->name ?? '' }}</p>
         </div>
     </a>

  @php
// Recursive function to render sidebar menu and submenus
function renderSidebarMenu($items) {
    foreach ($items as $item) {
        if (!empty($item['status'])) {
            $hasSub = !empty($item['subItems']) && is_array($item['subItems']) && count($item['subItems']);
            echo '<li class="nav-item'.($hasSub ? ' has-treeview' : '').'">';
            echo '<a href="'.($hasSub ? '#' : (isset($item['route']) ? url($item['route']) : '#')).'" class="nav-link '. ( (isset($item['route']) && url($item['route']) == url()->current()) ? 'active' : '' ) . '">';
            echo '<i class="nav-icon '.$item['icon'].'"></i>';
            echo '<p>';
            echo $item['title'];
            if ($hasSub) {
                echo '<i class="fa fa-angle-left right"></i>';
            }
            echo '</p>';
            echo '</a>';
            if ($hasSub) {
                echo '<ul class="nav nav-treeview">';
                renderSidebarMenu($item['subItems']);
                echo '</ul>';
            }
            echo '</li>';
        }
    }
}
@endphp
<!-- Reset Menu Button -->
<button id="resetSidebarMenu" class="btn btn-sm btn-secondary w-100 mb-2">
    Reset Menu
</button>
<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!-- Dashboard Link -->
            <li class="nav-item">
                <a href="{{url('/')}}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }} {{ request()->is('student/dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- Permanent Modules Label -->
            <li class="nav-header">Modules</li>

            <!-- Dynamic Sidebar Modules -->
            @foreach($sidebarData as $index => $menu)
                @if(!empty($menu['status']))
                    <li class="nav-item sidebar-module-group" data-module-index="{{ $index }}">
                        <ul class="nav flex-column">
                            @php renderSidebarMenu([$menu]); @endphp
                        </ul>
                    </li>
                @endif
            @endforeach

            <li class="nav-item">
                <a href="{{url('/logout')}}" class="nav-link">
                    <i class="nav-icon fa fa-sign-out text-danger"></i>
                    <p class="text-danger">Logout</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
 </aside>

 <!-- Toggle button -->
<button id="resetSidebarMenu" class="btn btn-sm btn-secondary w-100 mb-2" style="display:none;">
    Reset Menu
</button>

 <!-- Overlay -->
 <div class="sidebar-overlay" id="sidebarOverlay"></div>

 <style>
    .nav-treeview{
        margin-left: 22px;
    }
     .brand_img {
         width: 40px;
         height: 40px;
         border-radius: 50%;
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
        // Restore sidebar state from localStorage on page load
        const savedState = localStorage.getItem('sidebarOpen');
        if (savedState === 'true') {
            sidebar.classList.add('mobile-show');
            overlay.classList.add('show');
        } else {
            sidebar.classList.remove('mobile-show');
            overlay.classList.remove('show');
        }

        // Toggle sidebar on button click
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const isOpen = sidebar.classList.toggle('mobile-show');
            overlay.classList.toggle('show');
            console.log('Toggle clicked, sidebar classes:', sidebar.className);

            // Save state in localStorage
            localStorage.setItem('sidebarOpen', isOpen);
        });

        // Close sidebar when clicking overlay
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('mobile-show');
            overlay.classList.remove('show');
            // Save closed state
            localStorage.setItem('sidebarOpen', false);
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


<script>
function updateResetMenuVisibility() {
    const groups = document.querySelectorAll('.sidebar-module-group');
    const resetBtn = document.getElementById('resetSidebarMenu');
    const anyHidden = Array.from(groups).some(group => group.style.display === 'none');
    if (resetBtn) {
        resetBtn.style.display = anyHidden ? 'block' : 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const groups = document.querySelectorAll('.sidebar-module-group');
    const resetBtn = document.getElementById('resetSidebarMenu');

    // On page load: check localStorage for selected index
    const selectedIndex = localStorage.getItem('selectedSidebarModule');

    if (selectedIndex !== null) {
        // Hide all groups first
        groups.forEach(group => group.style.display = 'none');
        // Show selected group
        const selectedGroup = document.querySelector(`.sidebar-module-group[data-module-index="${selectedIndex}"]`);
        if (selectedGroup) {
            selectedGroup.style.display = 'block';
        } else {
            // fallback: show all if not found
            groups.forEach(group => group.style.display = 'block');
        }
    } else {
        // No selection stored: show all groups
        groups.forEach(group => group.style.display = 'block');
    }

    updateResetMenuVisibility();

    // Attach click listeners to menu links
    document.querySelectorAll('.sidebar-module-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var index = this.getAttribute('data-module-index');
            // Hide all groups
            groups.forEach(group => group.style.display = 'none');
            // Show selected group
            const selectedGroup = document.querySelector(`.sidebar-module-group[data-module-index="${index}"]`);
            if (selectedGroup) selectedGroup.style.display = 'block';
            // Save selection to localStorage
            localStorage.setItem('selectedSidebarModule', index);
            updateResetMenuVisibility();
        });
    });

    // Reset button clears selection and shows all
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            groups.forEach(group => group.style.display = 'block');
            localStorage.removeItem('selectedSidebarModule');
            updateResetMenuVisibility();
        });
    }
});
</script>

