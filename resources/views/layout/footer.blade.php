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

<style>
#scrollToTopBtn,
#scrollToBottomBtn {
    display: none;
    position: fixed;
    z-index: 1000;
}

#scrollToTopBtn {
    bottom: 70px;
    right: 20px;
}

#scrollToBottomBtn {
    bottom: 20px;
    right: 20px;
}
</style>

<script>
$(document).ready(function () {
    // Append buttons
    $('body').append('<button id="scrollToTopBtn" class="btn btn-primary"><i class="fa fa-arrow-up"></i></button>');
    $('body').append('<button id="scrollToBottomBtn" class="btn btn-primary"><i class="fa fa-arrow-down"></i> </button>');

    // Scroll to top
    $('#scrollToTopBtn').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });

    // Scroll to bottom
    $('#scrollToBottomBtn').click(function () {
        $('html, body').animate({ scrollTop: $(document).height() }, 'slow');
    });

    let lastHeight = $(document).height();

    function updateScrollButtonsVisibility() {
        const hasScroll = $(document).height() > $(window).height();
        const scrollTop = $(window).scrollTop();
        const scrollBottom = scrollTop + $(window).height();
        const nearTop = scrollTop < 100;
        const nearBottom = scrollBottom >= $(document).height() - 100;

        // Show/hide top button
        if (hasScroll && !nearTop) {
            $('#scrollToTopBtn').fadeIn();
        } else {
            $('#scrollToTopBtn').fadeOut();
        }

        // Show/hide bottom button
        if (hasScroll && !nearBottom) {
            $('#scrollToBottomBtn').fadeIn();
        } else {
            $('#scrollToBottomBtn').fadeOut();
        }
    }

    // Bind scroll and resize events
    $(window).on('scroll resize', updateScrollButtonsVisibility);

    // Periodically check height changes
    setInterval(() => {
        const currentHeight = $(document).height();
        if (currentHeight !== lastHeight) {
            lastHeight = currentHeight;
            updateScrollButtonsVisibility();
        }
    }, 300);

    // Initial call
    updateScrollButtonsVisibility();
});
</script>
