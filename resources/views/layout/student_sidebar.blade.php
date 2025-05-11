  @php
  $getSetting = Helper::getSetting();
  @endphp
<aside class="main-sidebar bg-light  elevation-4">
  
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{ env('IMAGE_SHOW_PATH').'/setting/left_logo/'.$getSetting['left_logo'] ?? '' }}" alt="" class="brand-image img-circle elevation-3" onerror="this.src='{{ env('IMAGE_SHOW_PATH').'/default/rukmani_logo.png' }}'">
      <span class="brand-text font-weight-light text-white">Rukmani software</span>
    </a>
        
    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


@php
$sidebarData = DB::table('students_sidebar')->whereNull('deleted_at')->get();
@endphp

@if(!empty($sidebarData))

@foreach($sidebarData as $item)
 <li class="nav-item menu-open ">
                    <a href="{{url($item->url)}}{{$item->url == 'student_fees_details' ? '/'.Session::get('id') : ''}}" class="nav-link {{ url($item->url)  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas {{$item->ican ?? '' }}"></i>
                    <p>{{$item->name ?? ''}}</p>
                    </a>
                </li>

@endforeach
@endif
                <!--<li class="nav-item menu-open ">
                    <a href="{{url('dashboard')}}" class="nav-link {{ url('dashboard')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-home"></i>
                    <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item menu-open ">
                    <a href="{{url('student_fees_details')}}/{{ Session::get('id') }}" class="nav-link {{ url('student_fees_details')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-calendar-check-o"></i>
                    <p>Fees Details</p>
                    </a>
                </li>
                
                <li class="nav-item menu-open ">
                    <a href="{{url('studentsAttendanceView')}}" class="nav-link {{ url('students/attendance/view')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-calendar-check-o"></i>
                    <p>Attendance</p>
                    </a>
                </li>
                <li class="nav-item menu-open ">
                    <a href="{{url('school_desk_view')}}" class="nav-link {{ url('school_desk_view')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fa fa-table"></i>
                    <p>School Desk</p>
                    </a>
                </li>
                <li class="nav-item menu-open ">
                    <a href="{{url('teachers/index')}}" class="nav-link {{ url('teachers/index')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-user-secret"></i>
                    <p>My Teacher</p>
                    </a>
                </li>
                <li class="nav-item menu-open ">
                    <a href="{{url('timetable')}}" class="nav-link {{ url('timetable')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-calendar-plus-o"></i>
                    <p>Time Table</p>
                    </a>
                </li>      
                <li class="nav-item menu-open ">
                    <a href="{{url('gallery_view')}}" class="nav-link {{ url('gallery_view')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fa fa-image"></i>
                    <p>Gallery</p>
                    </a>
                </li>
                 <li class="nav-item menu-open ">
                    <a href="{{url('prayer')}}" class="nav-link {{ url('prayer')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-calendar-plus-o"></i>
                    <p>Prayer</p>
                    </a>
                </li>      
                <li class="nav-item menu-open ">
                    <a href="{{url('student_subject_view')}}" class="nav-link {{ url('student_subject_view')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fa fa-book"></i>
                    <p>Subjects</p>
                    </a>
                </li>    
                <li class="nav-item menu-open">
                    <a href="{{url('rule_view')}}" class="nav-link {{ url('rule_view')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fa fa-check-square"></i>
                    <p>Rules</p>
                    </a>
                </li>    
                <li class="nav-item menu-open ">
                    <a href="{{url('student_gate_pass_view')}}" class="nav-link {{ url('student_gate_pass_view')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fa fa-times-circle-o"></i>
                    <p>Gate Pass</p>
                    </a>
                </li>      
                <li class="nav-item menu-open ">
                    <a href="{{url('student_uniform_view')}}" class="nav-link {{ url('student_uniform_view')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fa fa-shirtsinbulk"></i>
                    <p>Uniform</p>
                    </a>
                </li>
                <li class="nav-item menu-open ">
                    <a href="{{url('books_uniform_view')}}" class="nav-link {{ url('books_uniform_view')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-book"></i>
                    <p>Books/Uniform Shops</p>
                    </a>
                </li>
                <li class="nav-item menu-open ">
                    <a href="{{url('homework/index')}}" class="nav-link {{ url('homework/index')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-flask"></i>
                    <p>Homework</p>
                    </a>
                </li>
                <li class="nav-item menu-open ">
                    <a href="{{url('examTerminal')}}" class="nav-link {{ url('examTerminal')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-map-o"></i>
                    <p>Examinations</p>
                    </a>
                </li>   
                <li class="nav-item menu-open ">
                    <a href="{{url('student_bus_assign_view')}}" class="nav-link {{ url('student_bus_assign_view')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fa fa-truck"></i>
                    <p>Transport</p>
                    </a>
                </li>   
                <li class="nav-item menu-open ">
                    <a href="{{url('books_library')}}" class="nav-link {{ url('books_library')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-book"></i>
                    <p>Library Books</p>
                    </a>
                </li>  
                <li class="nav-item menu-open ">
                    <a href="{{url('download_center')}}" class="nav-link {{ url('download_center')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-download"></i>
                    <p>Download Center</p>
                    </a>
                </li>
                <li class="nav-item menu-open ">
                    <a href="{{url('notice_board/view/0')}}" class="nav-link {{ url('notice_board/view')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-envelope"></i>
                    <p>Notice Board</p>
                    </a>
                </li>
                <li class="nav-item menu-open ">
                    <a href="{{url('complaint_view')}}" class="nav-link {{ url('complaint_view')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa fa-list-alt"></i>
                    <p>Complain Box</p>
                    </a>
                </li>
                <li class="nav-item menu-open ">
                    <a href="{{url('leave_management')}}" class="nav-link {{ url('leave_management')  == URL::current() ? 'active' : "" }}">
                    <i class="nav-icon fas fa fa-check-square"></i>
                    <p>Apply Leave</p>
                    </a>
                </li>    
                            -->
                <!--<li class="nav-item menu-open ">-->
                <!--    <a href="{{url('chat/compose')}}" class="nav-link {{ url('chat/compose')  == URL::current() ? 'active' : "" }}">-->
                <!--    <i class="nav-icon fas fa fa-snapchat"></i>-->
                <!--    <p>Chat Panel</p>-->
                <!--    </a>-->
                <!--</li>                -->
                <li class="nav-item menu-open ">
                    <a href="{{url('logout')}}" class="nav-link ">
                    <i class="nav-icon fa fa-sign-out"></i>
                    <p>Log Out</p>
                    </a>
                </li>
            
            </ul>
        </nav>
    </div>
</aside>