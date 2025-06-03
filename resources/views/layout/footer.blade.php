<script src="{{URL::asset('public/assets/school/js/jquery.min.js')}}"></script>
@php
$getUser=Helper::getUser();
@endphp
<!-- /.content-wrapper -->

<footer class="main-footer Display_none_mobile">
    
    <strong>{{ __('common.Copyright') }} &copy; 2014-{{ date('Y') }} <a target="blank" href="http://rukmanisoftware.com/">{{ __('common.Rukmani Software') }}</a>.</strong> {{ __('common.All rights reserved.') }}
    <div class="float-right d-none d-sm-inline-block"><b>{{ __('common.Version') }}</b> 6.1.0</div>
    
</footer>

<div class="Display_none_PC">
<footer class="main_mobile_footer">
    <div class="flex_footer_items">
        <ul>
            <a href="{{url('minidashboard')}}">
                <div class="centerd_text_icon">
                <li class="{{ url('minidashboard')  == URL::current() ? 'flex_footer_item_li_active' : "" }}">
                    <i class="fa fa-home"></i>
                </li>
                 </div>
                <p>Home</p>
               
            </a>
            <a href="">
                <div class="centerd_text_icon">
                <li>
                    <i class="fa fa-refresh"></i>
                </li>
                </div>
                    <p>Refresh</p>
            </a>
            <a href="{{url('clear-cache')}}">
                <div class="centerd_text_icon">
                <li>
                    <i class="fa fa-recycle"></i>
                </li>
                </div>
                    <p>Clear</p>
            </a>
            <a href="{{url('logout')}}">
                <div class="centerd_text_icon">
                <li class="bg-danger">
                    <i class="fa fa-sign-out"></i>
                </li>
                </div>
                    <p>Log Out</p>
            </a>
            @php
            $url = "profile/edit/".Session::get('id');
            @endphp
            <a href="{{ url($url) }}">
                <div class="centerd_text_icon">
                <li class="{{ url($url)  == URL::current() ? 'flex_footer_item_li_active' : "" }}">
                    <i class="fa fa-user"></i>
                </li>
                </div>
               <p>Profile</p>
            </a>
        </ul>
    </div>
</footer>
    </div>

<!-- Control Sidebar -->

<aside class="control-sidebar control-sidebar-dark"></aside>

