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
             <p class="brand_title">Tci Edu Hub</p>
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
            @foreach($sidebarData as $index => $menu)
                @if(!empty($menu['status']))
                    <li class="nav-item sidebar-module-group" data-module-index="{{ $index }}" style="display:none;">
                        <ul class="nav flex-column">
                            @php renderSidebarMenu([$menu]); @endphp
                        </ul>
                    </li>
                @endif
            @endforeach
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


<script>
    // Optional: Toggle collapse without Bootstrap JS
    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.classList.toggle('show');
            }
        });
    });
</script>


<script>
function updateResetMenuVisibility() {
    const groups = document.querySelectorAll('.sidebar-module-group');
    const resetBtn = document.getElementById('resetSidebarMenu');
    // Show button only if at least one group is hidden
    const anyHidden = Array.from(groups).some(group => group.style.display === 'none');
    if (resetBtn) {
        resetBtn.style.display = anyHidden ? 'block' : 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Show all modules by default
    document.querySelectorAll('.sidebar-module-group').forEach(function(group) {
        group.style.display = 'block';
    });
    updateResetMenuVisibility();

    // Dropdown click: show only selected module
    document.querySelectorAll('.sidebar-module-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var index = this.getAttribute('data-module-index');
            document.querySelectorAll('.sidebar-module-group').forEach(function(group) {
                group.style.display = 'none';
            });
            var selected = document.querySelector('.sidebar-module-group[data-module-index="' + index + '"]');
            if(selected) selected.style.display = 'block';
            updateResetMenuVisibility();
        });
    });

    // Reset Menu functionality
    document.getElementById('resetSidebarMenu').addEventListener('click', function() {
        document.querySelectorAll('.sidebar-module-group').forEach(function(group) {
            group.style.display = 'block';
        });
        updateResetMenuVisibility();
    });
});

</script>