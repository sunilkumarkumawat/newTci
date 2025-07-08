@php
    $setting = DB::table('settings')->get()->first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->name ?? '' }}</title>
    <link rel="icon" type="image/x-icon"
        href="{{ env('IMAGE_SHOW_PATH') . 'setting/left_logo/' . $setting->left_logo }}"
        onerror="this.src='{{ env('IMAGE_SHOW_PATH') . 'default/mini_logo.png' }}'">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('public/assets/school/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/mobilescreen.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/dataTables.bootstrap4.css') }}">
    <!--<link rel="stylesheet" href="{{ asset('public/assets/school/css/responsive.bootstrap4.css') }}">-->
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/richtexteditor.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/school/css/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="{{ URL::asset('public/assets/school/js/jquery.min.js') }}"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->


    <link rel="stylesheet" href="{{ asset('public/assets/school/student/css/style.css') }}">
    <!-- Include SheetJS -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>





    <!-- Buttons extension -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <!-- JSZip and pdfmake for Excel/PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>



</head>
<style>
    .centered_flex {
        display: flex;
        margin-bottom: 10px;
    }

    .centered_flex i {
        font-size: 34px;
    }

    .centered_flex p {
        margin-bottom: 0px;
        font-size: 20px;
        margin-left: 10px;
        font-weight: 600;
    }

    .error_message_whatsapp {
        font-weight: 400;
        text-transform: capitalize;
        line-height: 20px;
        margin-bottom: 20px;
    }

    .modal_btn {
        border: none;
        padding: 5px 20px;
        color: black;
        font-weight: 600;
    }

    .whatsapp_note {
        margin-bottom: 0px;
        font-size: 10px;
        text-transform: uppercase;
    }


    .wizard-step h5 {
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
        margin-bottom: 20px;
    }


    .placeholder-wave {
        position: relative;
        overflow: hidden;
    }

    .placeholder-wave::before {
        content: "";
        position: absolute;
        top: 0;
        left: -150%;
        width: 200%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.5),
                transparent);
        animation: placeholder-wave 1.5s infinite;
    }

    @keyframes placeholder-wave {
        0% {
            left: -150%;
        }

        100% {
            left: 150%;
        }
    }
</style>


@php
    $cur_route = Route::getFacadeRoot()->current()->uri();
@endphp

<body class="sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">


        @include('layout.header')
        @if (Session()->get('role_id') == 3)
            @include('layout.student_sidebar')
        @else
            @include('layout.sidebar')
        @endif
        @include('layout.message')
        @yield('content')
        @include('layout.footer')
        <script>
            /*$.ajaxSetup({
                                                                                                                                                                                                                                                                                                                                                                                            headers: {
                                                                                                                                                                                                                                                                                                                                                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                        });*/
            //var URL  = "{{ url('/') }}";
        </script>

        <script src="{{ URL::asset('public/assets/school/js/jquery-ui.min.js') }}"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script src="{{ URL::asset('public/assets/school/js/jquery.dataTables.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/dataTables.bootstrap4.js') }}"></script>
        <!--<script src="{{ URL::asset('public/assets/school/js/dataTables.responsive.js') }}"></script>-->
        <script src="{{ URL::asset('public/assets/school/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/Chart.min.js') }}"></script>
        <!--<script src="{{ URL::asset('public/assets/school/js/sparkline.js') }}"></script>-->
        <script src="{{ URL::asset('public/assets/school/js/jquery.vmap.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/jquery.vmap.usa.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/jquery.knob.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/moment.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/daterangepicker.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/summernote-bs4.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/pdfmake.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/demo.js') }}"></script>
        <!--<script src="{{ URL::asset('public/assets/school/js/dashboard.js') }}"></script>-->
        <script src="{{ URL::asset('public/assets/school/js/bootstrap5.js') }}"></script>

        <!--<script src="{{ URL::asset('public/assets/school/js/ckediter.js') }}"></script>-->
        <!--            <script src="{{ URL::asset('public/assets/school/js/responsive.bootstrap4.js') }}"></script>
-->
        <script src="{{ URL::asset('public/assets/school/js/dataTables.buttons.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/buttons.bootstrap4.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/buttons.html5.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/buttons.print.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/buttons.colVis.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/jquery.validate.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/additional-methods.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/adminlte.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/toastr.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/select2.full.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/richtexteditor.js') }}"></script>
        <script src="{{ URL::asset('public/assets/school/js/richtexteditor_all_plugins.js') }}"></script>
        <!--<script src="{{ URL::asset('public/assets/school/js/adminlte.min.js?v=3.2.0') }}"></script>-->

        <!--<script nonce="13793727-1378-4506-ac7e-88e6851a25a2">
            (function(w, d) {
                ! function(a, e, t, r) {
                    a.zarazData = a.zarazData || {}, a.zarazData.executed = [], a.zaraz = {
                        deferred: []
                    }, a.zaraz.q = [], a.zaraz._f = function(e) {
                        return function() {
                            var t = Array.prototype.slice.call(arguments);
                            a.zaraz.q.push({
                                m: e,
                                a: t
                            })
                        }
                    };
                    for (const e of ["track", "set", "ecommerce", "debug"]) a.zaraz[e] = a.zaraz._f(e);
                    a.zaraz.init = () => {
                        var t = e.getElementsByTagName(r)[0],
                            z = e.createElement(r),
                            n = e.getElementsByTagName("title")[0];
                        for (n && (a.zarazData.t = e.getElementsByTagName("title")[0].text), a.zarazData.x = Math
                            .random(), a.zarazData.w = a.screen.width, a.zarazData.h = a.screen.height, a.zarazData.j =
                            a.innerHeight, a.zarazData.e = a.innerWidth, a.zarazData.l = a.location.href, a.zarazData
                            .r = e.referrer, a.zarazData.k = a.screen.colorDepth, a.zarazData.n = e.characterSet, a
                            .zarazData.o = (new Date).getTimezoneOffset(), a.zarazData.q = []; a.zaraz.q.length;) {
                            const e = a.zaraz.q.shift();
                            a.zarazData.q.push(e)
                        }
                        z.defer = !0;
                        for (const e of [localStorage, sessionStorage]) Object.keys(e || {}).filter((a => a.startsWith(
                            "_zaraz_"))).forEach((t => {
                            try {
                                a.zarazData["z_" + t.slice(7)] = JSON.parse(e.getItem(t))
                            } catch {
                                a.zarazData["z_" + t.slice(7)] = e.getItem(t)
                            }
                        }));
                        z.referrerPolicy = "origin", z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON
                            .stringify(a.zarazData))), t.parentNode.insertBefore(z, t)
                    }, ["complete", "interactive"].includes(e.readyState) ? zaraz.init() : a.addEventListener(
                        "DOMContentLoaded", zaraz.init)
                }(w, d, 0, "script");
            })(window, document);
        </script>-->

        <script type="text/javascript">
            $(function() {
                $("#example1").DataTable({
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    //   "responsive": true,
                });
            });

            $(document).ready(function() {
                if ($(window).width() < 400) {
                    $('#example1').addClass('table-responsive nowrap');
                    $("#example1 tr td").css('padding', '10px');
                }
            });

            function isNumber(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }

            $(function() {
                $('.select2').select2()

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

            })

            $(function() {
                $('#compose-textarea').summernote()
            })
        </script>


        <script>
            var timer2 = "5:01";
            var interval = setInterval(function() {


                var timer = timer2.split(':');
                //by parsing integer, I avoid all extra string processing
                var minutes = parseInt(timer[0], 10);
                var seconds = parseInt(timer[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                if (minutes < 0) {
                    clearInterval(interval);
                    location.reload();
                }


                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                //minutes = (minutes < 10) ?  minutes : minutes;


                $('.countdown').html(minutes + ':' + seconds);
                timer2 = minutes + ':' + seconds;
                //console.log(minutes + ':' + seconds);
            }, 1000);

            $(document).on("mousemove keypress", function() {
                timer2 = "5:01";


            });
        </script>

        <script>
            $(document).ready(function() {
                var whatsapp_error = "{{ Session::get('whatsapp_error') }}";



                if (whatsapp_error != "") {
                    $('#whatsapp_error_modal').modal('show');
                }

                $('.change_status').click(function() {
                    var action = $(this).data('action');
                    var whatsapp_error_respose_id = $('#whatsapp_error_respose_id').val();

                    if (whatsapp_error_respose_id != "") {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'post',
                            url: '/whatsapp_api_response',
                            data: {
                                action: action,
                                whatsapp_error_respose_id: whatsapp_error_respose_id
                            },
                            success: function(data) {
                                //   alert(JSON.stringify(data));
                            }
                        });
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                var baseUrl = "{{ url('/') }}";
                $('.editable').dblclick(function() {
                    var currentTd = $(this);
                    var currentValue = $(this).text().trim();
                    var field = $(this).attr('data-field');
                    var modal = $(this).attr('data-modal');
                    var id = $(this).attr('data-id');

                    var inputField = $(
                        `<input type="text" name="${field}" data-id="${id}" data-modal="${modal}">`).val(
                        currentValue);
                    $(this).empty().append(inputField);

                    inputField.focus();

                    inputField.blur(function() {
                        var newValue = $(this).val().trim();
                        $(this).parent().text(currentValue);
                    });

                    inputField.focusout(function(event) {
                        //  if (event.keyCode === 13) {
                        var input = $(this);
                        var inputData = $(this).val();
                        if (inputData != '') {

                            var inputField = $(this).attr('name');
                            var inputModal = $(this).attr('data-modal');
                            var inputId = $(this).attr('data-id');
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                url: baseUrl + '/updateSingleField',
                                type: 'POST',
                                contentType: 'application/json',
                                data: JSON.stringify({
                                    name: inputField,
                                    value: inputData,
                                    id: inputId,
                                    modal: inputModal
                                }),
                                success: function(response) {
                                    if (response.status) {
                                        currentTd.text(inputData);
                                        toastr.success(response.message)
                                    } else {
                                        input.blur();
                                        toastr.error(response.message)
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error saving data:', error);
                                }
                            });
                        } else {
                            input.blur();
                            currentTd.text(currentValue);
                            toastr.error('Nullable field not be allowed');
                        }
                        //  }
                    });
                });


            });
        </script>

        {{-- add data --}}
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // $('#headerBranchSelect').on('change', function() {
                //     const selectedBranchId = $(this).val();
                //     $('#branch_id').val(selectedBranchId); // sync to form
                // });

                // Apply to multiple forms
                $(document).on('submit', '#createCommon, .createCommon', function(e) {
                    e.preventDefault();

                    $('.dataContainer').each(function() {
                        const $row = $(`
                                    <tr class="placeholder-row" style="display:none">
                                    <td class="placeholder-wave" style="padding:16px">
                                        <div class="placeholder rounded" style="width:99%; height:20px; background:#0000001f; padding:10px"></div>
                                    </td>
                                    <td class="placeholder-wave" style="padding:16px">
                                        <div class="placeholder rounded" style="width:99%; height:20px; background:#00000038"></div>
                                    </td>
                                    <td class="placeholder-wave" style="padding:16px" colspan="100%">
                                        <div class="placeholder rounded" style="width:99%; height:20px; background:#00000045"></div>
                                    </td>
                                    </tr>
                                `);

                        // Prepend and fade in
                        $(this).prepend($row);
                        $row.fadeIn(300);

                        // Fade out after a short delay, then remove
                        setTimeout(() => {
                            $row.fadeOut(500, function() {
                                $(this).remove();
                            });
                        }, 500); // Adjust delay as needed (1500ms = 1.5s)
                    });

                    // // Get branch_id just before submission
                    // const selectedBranchId = $('#headerBranchSelect').val();
                    // $('#branch_id').val(selectedBranchId); // set it again


                    function validateForm($form) {
                        let isValid = true;

                        // Remove previous validation messages
                        $form.find('.text-danger.validation-error').remove();

                        $form.find('[data-required="true"]').each(function() {
                            const $input = $(this);
                            const value = $input.val().trim();
                            const name = $input.attr(
                                'name'
                            ); // Get the name attribute (e.g., email, mobile, branch_code)
                            const customMessage = $input.data('error') ||
                                'This field is required';
                            let message = '';


                            switch (name) {
                                case 'email':
                                    if (!/^\S+@\S+\.\S+$/.test(value)) {
                                        message = 'Please enter a valid email address.';
                                    }
                                    break;

                                case 'mobile':

                                    if (!/^\d{10}$/.test(value)) {
                                        message =
                                            'Please enter a valid 10-digit mobile number.';
                                    }
                                    break;

                                case 'father_mobile':

                                    if (!/^\d{10}$/.test(value)) {
                                        message =
                                            'Please enter a valid 10-digit mobile number.';
                                    }
                                    break;

                                case 'guardian_mobile':

                                    if (!/^\d{10}$/.test(value)) {
                                        message =
                                            'Please enter a valid 10-digit mobile number.';
                                    }
                                    break;

                                case 'aadhaar':

                                    if (!/^\d{12}$/.test(value)) {
                                        message =
                                            'Please enter a valid 12-digit aadhaar number.';
                                    }
                                    break;

                                case 'branch_code':
                                    if (value === '') {
                                        message = 'Branch code is required.';
                                    }
                                    break;
                                case 'name':
                                    if (value === '') {
                                        message = 'Name is required.';
                                    }
                                    break;
                                case 'contact_person':
                                    if (value === '') {
                                        message = 'Contact Person is required.';
                                    }
                                    break;
                                case 'name':
                                    if (value === '') {
                                        message = 'Role name is required.';
                                    }

                                case 'role_id':
                                    if (value === '') {
                                        message = 'Role is required.';
                                    }
                                    break;
                                case 'first_name':
                                    if (value === '') {
                                        message = 'First Name is required.';
                                    }
                                    break;

                                case 'last_name':
                                    if (value === '') {
                                        message = 'Last Name is required.';
                                    }
                                    break;

                                case 'userName':
                                    if (value === '') {
                                        message = 'Username is required.';
                                    }
                                    break;

                                case 'student_name':
                                    if (value === '') {
                                        message = 'Student Name is required.';
                                    }
                                    break;

                                case 'password':
                                    if (value === '') {
                                        message = 'Password is required.';
                                    }
                                    break;

                                case 'country_id':
                                    if (value === '') {
                                        message = 'Country is required';
                                    }
                                    break;

                                case 'state_id':
                                    if (value === '') {
                                        message = 'State is required.';
                                    }
                                    break;

                                case 'city_id':
                                    if (value === '') {
                                        message = 'city is required.';
                                    }
                                    break;

                                case 'dob':
                                    if (value === '') {
                                        message = 'Date of birth is required.';
                                    }
                                    break;

                                case 'father_name':
                                    if (value === '') {
                                        message = 'father name is required.';
                                    }
                                    break;

                                case 'mother_name':
                                    if (value === '') {
                                        message = 'mother name is required.';
                                    }
                                    break;

                                case 'guardian_name':
                                    if (value === '') {
                                        message = 'guardian name is required.';
                                    }
                                    break;

                                case 'address':
                                    if (value === '') {
                                        message = 'address is required.';
                                    }
                                    break;

                                case 'guardian_address':
                                    if (value === '') {
                                        message = 'address is required.';
                                    }
                                    break;

                                case 'student_address':
                                    if (value === '') {
                                        message = 'student address is required.';
                                    }
                                    break;

                                case 'gender_id':
                                    if (value === '') {
                                        message = 'Gender is required';
                                    }
                                    break;
                                case 'class_type_id':
                                    if (value === '') {
                                        message = 'Class is required';
                                    }
                                    break;
                                case 'exam_pattern_id':
                                    if (value === '') {
                                        message = 'Exam pattern is required';
                                    }
                                    break;
                                case 'exam_type_id':
                                    if (value === '') {
                                        message = 'Exam type is required';
                                    }
                                    break;
                                case 'topic_id':
                                    if (value === '') {
                                        message = 'Topic is required';
                                    }
                                    break;
                                case 'level_id':
                                    if (value === '') {
                                        message = 'Level is required';
                                    }
                                    break;
                                case 'suka_id':
                                    if (value === '') {
                                        message = 'Suka is required';
                                    }
                                    break;
                                case 'question_type_id':
                                    if (value === '') {
                                        message = 'Question type is required';
                                    }
                                    break;
                                case 'subject_id':
                                    if (value === '') {
                                        message = 'Subject is required';
                                    }
                                    break;
                                case 'chapter_id':
                                    if (value === '') {
                                        message = 'Chapter is required';
                                    }
                                    break;
                                case 'category_id':
                                    if (value === '') {
                                        message = 'Category is required';
                                    }
                                    break;
                                case 'religion':
                                    if (value === '') {
                                        message = 'Religion is required';
                                    }
                                    break;

                                case 'category':
                                    if (value === '') {
                                        message = 'Category is required';
                                    }
                                    break;

                                case 'tags':
                                    if (value === '') {
                                        message = 'Tags are required';
                                    }
                                    break;

                                case 'source_id':
                                    if (value === '') {
                                        message = 'Source is required';
                                    }
                                    break;

                                case 'expense_name':
                                    if (value === '') {
                                        message = 'Expense Name is required';
                                    }
                                    break;

                                case 'expense_date':
                                    if (value === '') {
                                        message = 'Expense date is required';
                                    }
                                    break;

                                case 'expense_date':
                                    if (value === '') {
                                        message = 'Expense date is required';
                                    }
                                    break;

                                case 'quantity':
                                    if (value === '') {
                                        message = 'Expense quantity is required';
                                    }
                                    break;

                                case 'rate':
                                    if (value === '') {
                                        message = 'Rate is required';
                                    }
                                    break;

                                case 'total_amt':
                                    if (value === '') {
                                        message = 'Total amount is required';
                                    }
                                    break;

                                case 'payment_mode_id':
                                    if (value === '') {
                                        message = 'Payment mode is required';
                                    }
                                    break;

                                case 'cabin_name':
                                    if (value === '') {
                                        message = 'Cabin is required';
                                    }
                                    break;

                                case 'locker_no':
                                    if (value === '') {
                                        message = 'Locker is required';
                                    }
                                    break;

                                case 'amount':
                                    if (value === '') {
                                        message = 'Amount is required';
                                    }
                                    break;

                                case 'plan_name':
                                    if (value === '') {
                                        message = 'Plan Name is required';
                                    }
                                    break;
                            }


                            // Show error message if validation fails
                            if (message) {
                                isValid = false;
                                if (!$input.next('.validation-error').length) {
                                    $input.after(
                                        `<small class="text-danger validation-error">${message}</small>`
                                    );
                                }
                            }
                        });

                        return isValid;
                    }


                    let currentStep = $(this).attr('data-step') ||
                        1; // Get current step from data attribute or default to 1
                    let totalSteps = $(this).attr('data-total_steps') ||
                        1; // Get current step from data attribute or default to 1

                    // let student - > unique_id = $this - > generateUniqueStudentCode()

                    // Optional helper to format field names like "mobile_no" to "Mobile No"
                    function formatFieldName(name) {
                        return name
                            .replace(/_/g, ' ')
                            .replace(/\b\w/g, l => l.toUpperCase());
                    }

                    const $form = $(this);
                    if (!validateForm($form)) return;
                    const endpoint = "{{ url('/') }}/createCommon";




                    if (currentStep !== totalSteps) {
                        return
                    }

                   

                    const formData = new FormData(this); // Handles files + inputs
                    const submitBtn = $form.find('button[type="submit"]');
                    const originalBtnText = submitBtn.text();



                    submitBtn.prop("disabled", true).html(
                        `Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>`
                    );
                    $.ajax({
                        url: endpoint,
                        type: 'POST',
                        data: formData,
                        processData: false, // Required for FormData
                        contentType: false, // Required for FormData
                        success: function(response) {

                            if (response.modal === 'Exam') {
                                const id = response?.data?.id;

                                if (id) {
                                    window.location.href =
                                        `{{ url('/') }}/createExam?query=${id}`;
                                } else {
                                    toastr.error(
                                        'Exam ID is missing. Cannot proceed with redirection.');
                                }
                            }

                            if (response.method == 'update') {
                                // window.location.href = "{{ url('/') }}/" + (response.modal)
                                //     .toLowerCase();

                                dataGet();
                                toastr.success('Data Updated Successfully');
                                return
                            }



                            console.log(response);
                            $form[0].reset();
                            toastr.success('Form Submitted Successfully');
                            dataGet();
                        },
                        error: function(xhr) {
                            alert('Failed to submit form.');
                            console.error(xhr.responseText);
                            toastr.error(xhr.responseText);
                        },
                        complete: function() {
                            submitBtn.prop("disabled", false).text(originalBtnText);
                        }
                    });


                });



                // function dataGet() {
                //     var baseUrl = "{{ url('/') }}";
                //     const modalTypes = [];




                //     $('[name="modal_type"]').each(function() {
                //         const val = $(this).val();
                //         if (val && !modalTypes.includes(val)) {
                //             modalTypes.push(val);
                //         }
                //     });




                //     modalTypes.forEach(modal => {
                //         const containerId = `#dataContainer-${modal.toLowerCase()}`;
                //         const url = `${baseUrl}/commonView/${modal}`;



                //         $.get(url, function(data) {
                //             const $container = $(containerId);

                //             $container.fadeOut(100, function() {
                //                 $container.html(data).fadeIn(200);

                //                 // Wait for new content to be inserted before initializing DataTable
                //                 // const table = $container.find('table');
                //                 const table = $container.find('table');


                //                 // Check if a DataTable is already initialized, destroy it
                //                 if ($.fn.DataTable.isDataTable(table)) {
                //                     table.DataTable().destroy();
                //                 }

                //                 // Initialize DataTable with pagination
                //                 table.DataTable({
                //                     pageLength: 10,
                //                     lengthChange: true,
                //                     searching: true,
                //                     ordering: true,
                //                     paging: true,
                //                     dom: 'Bfrtip',
                //                     buttons: [{
                //                             extend: 'excelHtml5',
                //                             text: 'Export to Excel',
                //                             title: `${modal} Report`
                //                         },
                //                         {
                //                             extend: 'pdfHtml5',
                //                             text: 'Export to PDF',
                //                             orientation: 'landscape',
                //                             pageSize: 'A4',
                //                             title: `${modal} Report`
                //                         }
                //                     ]
                //                 });

                //                 toastr.success(`${modal} data fetched successfully!`);
                //             });
                //         }).fail(function(xhr) {
                //             console.error(`Error loading ${modal}: ${xhr.status} ${xhr.statusText}`);
                //         });
                //     });
                // }

                function dataGet() {
                    var baseUrl = "{{ url('/') }}";
                    const modalTypes = [];

                    // Collect all unique modal types from inputs named 'modal_type'
                    $('[name="modal_type"]').each(function() {
                        const val = $(this).val();
                        if (val && !modalTypes.includes(val)) {
                            modalTypes.push(val);
                        }
                    });

                    // For each modal type, fetch and update its data container
                    modalTypes.forEach(modal => {
                        const containerId = `#dataContainer-${modal.toLowerCase()}`;
                        const url = `${baseUrl}/commonView/${modal}`;

                        $.get(url, function(data) {
                            const $container = $(containerId);

                            $container.fadeOut(100, function() {
                                $container.html(data).fadeIn(200);

                                // Find the table inside the container
                                const table = $container.find('table');

                                // If DataTable is already initialized, destroy it first
                                if ($.fn.DataTable.isDataTable(table)) {
                                    table.DataTable().destroy();
                                }

                                // Initialize DataTable with options
                                table.DataTable({
                                    pageLength: 10,
                                    lengthChange: true,
                                    searching: true,
                                    ordering: true,
                                    paging: true,
                                    dom: 'Bfrtip',
                                    buttons: [{
                                            extend: 'excelHtml5',
                                            text: 'Export to Excel',
                                            title: `${modal} Report`
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            text: 'Export to PDF',
                                            orientation: 'landscape',
                                            pageSize: 'A4',
                                            title: `${modal} Report`
                                        }
                                    ]
                                });

                                toastr.success(`${modal} data fetched successfully!`);
                            });
                        }).fail(function(xhr) {
                            console.error(`Error loading ${modal}: ${xhr.status} ${xhr.statusText}`);
                            //toastr.error(`Error loading ${modal}: ${xhr.status} ${xhr.statusText} | ${xhr.responseText}`);
                        });
                    });
                }
                dataGet();


            });
        </script>

        {{-- delete function --}}
        <script>
            $(document).on('click', '.delete-btn', function() {
                const modal = $(this).data('modal'); // get modal name from data attribute
                const id = $(this).data('id'); // get record ID
                var isDeleted = $(this).data('deleted') == '1';
                const baseUrl = "{{ url('/') }}"; // base URL (Blade will output Laravel base URL)
                const target = $(this).closest(
                    '.position-relative'); // find the closest parent with class 'position-relative'

                let deleteUrl = isDeleted ?
                    `${baseUrl}/common-force-delete/${modal}/${id}` :
                    `${baseUrl}/common-delete/${modal}/${id}`;

                if (confirm(isDeleted ? "Permanently delete this item? \nThis action is not irreversible" :
                        "Are you sure you want to delete this item?")) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            _method: 'DELETE', // Laravel treats this as a DELETE request
                            _token: $('meta[name="csrf-token"]').attr('content') // if CSRF token is needed
                        },
                        success: function(res) {
                            toastr.success(res.message || 'Deleted successfully.');

                            if (['Documents'].includes(modal)) {
                                target.fadeOut(500, function() {
                                    target.remove();
                                });
                            } else {
                                location.reload();
                            }

                        },
                        error: function(xhr) {
                            toastr.error('Failed to delete.');
                            console.error(xhr.responseText);
                            toastr.error(xhr.responseText);
                        }
                    });
                }
            });
        </script>

        {{-- restore function --}}
        <script>
            $(document).on('click', '.restore-btn', function() {
                var id = $(this).data('id');
                var modal = $(this).data('modal');

                if (confirm("Do you want to restore this item?")) {
                    $.ajax({
                        url: `{{ url('/') }}/common-restore/${modal}/${id}`,
                        type: 'POST',
                        data: {
                            _method: 'DELETE', // Laravel treats this as a DELETE request
                            _token: $('meta[name="csrf-token"]').attr('content') // if CSRF token is needed
                        },
                        success: function(res) {
                            toastr.success(res.message || 'Restored successfully.');
                            if (['Documents'].includes(modal)) {
                                target.fadeOut(500, function() {
                                    target.remove();
                                });
                            } else {
                                location.reload();
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Failed to restore.');
                            console.error(xhr.responseText);
                            toastr.error(xhr.responseText);
                        }
                    });
                }
            });
        </script>

        {{-- permission giving area --}}
        <script>
            $(document).on('click', '.open-permission-modal', function() {
                const roleId = $(this).data('id');
                const userId = null;

                const url = `{{ url('/set-permission-view') }}/${roleId}/${userId}`;

                $('#permissionContainer').load(url);
            });
        </script>


        {{-- change status --}}
        <script>
            $(document).on('click', '.status-change-btn', function() {
                const button = $(this);
                const modal = button.data('modal');
                const id = button.data('id');
                const baseUrl = "{{ url('/') }}";
                const endpoint = `${baseUrl}/common-status-change/${modal}/${id}`;

                if (confirm('Are you sure you want to change the status of this item?')) {
                    $.ajax({
                        url: endpoint,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            toastr.success(response.message || 'Status changed successfully.');

                            // Optional: Update the UI without reloading
                            const statusElement = $(`#status-${modal}-${id}`);
                            // const statusElement = $(`#status-${modal}-${id}`);

                            if (response.data && response.data.status !== undefined) {
                                // Update text or toggle classes (example)
                                const newStatus = response.data.status;
                                const statusText = newStatus == 1 ? 'Active' : 'Inactive';

                                // Optional: badge styles
                                const badgeClass = newStatus == 1 ? 'bg-success' : 'bg-danger';
                                statusElement
                                    .text(statusText)
                                    .removeClass('bg-success bg-danger')
                                    .addClass(badgeClass);
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Failed to change status.');
                            console.error(xhr.responseText);
                            toastr.error(xhr.responseText);
                        }
                    });
                }
            });
        </script>

        {{-- change dependent --}}

        <script>
            $(document).ready(function() {
                $('select[data-dependent]').on('change', function() {
                    let $parent = $(this);
                    let dependentId = $parent.data('dependent');
                    let baseUrl = $parent.data('url');
                    let modal = $parent.data('modal');
                    let field = $parent.data('field');
                    let value = $parent.val();

                    if (!dependentId || !baseUrl || !modal || !field) return;

                    let $child = $('#' + dependentId);
                    $child.html('<option>Loading...</option>');

                    if (value) {
                        $.ajax({
                            url: baseUrl,
                            type: 'GET',
                            data: {
                                modal: modal,
                                field: field,
                                value: value
                            },
                            success: function(data) {
                                let options =
                                    `<option value="">Select ${capitalize(modal)}</option>`;
                                $.each(data, function(key, val) {
                                    options += `<option value="${key}">${val}</option>`;
                                });
                                $child.html(options);
                            },
                            error: function() {
                                $child.html('<option value="">Error loading</option>');
                            }
                        });
                    } else {
                        $child.html(`<option value="">Select ${capitalize(modal)}</option>`);
                    }

                    function capitalize(str) {
                        return str.charAt(0).toUpperCase() + str.slice(1);
                    }
                });
            });
        </script>

        {{-- change selected branch --}}
        <script>
            $('#headerBranchSelect').on('change', function() {
                const selectedBranchId = $(this).val();

                if (!selectedBranchId) return; // do nothing if empty

                $.ajax({
                    url: "{{ url('/') }}/set-current-branch",
                    type: "POST",
                    data: {
                        currentSelectedBranch: selectedBranchId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success('Branch changed successfully');

                            location.reload();
                        } else {
                            toastr.error('Failed to change branch');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        toastr.error('Error while updating branch');
                    }
                });
            });
        </script>
        <script>
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('check-all-type')) {
                    const type = e.target.getAttribute('data-type');
                    const isChecked = e.target.checked;

                    document.querySelectorAll(`input[type="checkbox"][value$=".${type}"]`).forEach(cb => {
                        cb.checked = isChecked;
                    });
                }
            });
        </script>

        <script>
            $(document).on('submit', '#permissionForm', function(e) {
                e.preventDefault();

                const form = $(this);
                const url = form.attr('action');
                const formData = form.serialize();

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        toastr.success('Permissions saved successfully!');
                        // Optionally reload or update content
                    },
                    error: function(xhr) {
                        toastr.error('Something went wrong while saving permissions.');
                        console.error(xhr.responseText);
                        toastr.error(xhr.responseText);
                    }
                });
            });
        </script>

        {{-- generate password --}}

        <script>
            $(document).ready(function() {

                hideElements();

                function hideElements() {
                    $('.generatePassTable,.usernameParameter').addClass('d-none');
                }

                $('#generatePasswordForm').on('submit', function(e) {
                    e.preventDefault(); // prevent default form submission

                    let form = $(this);
                    let modal = form.data('modal'); // get modal type from data attribute
                    let formData = form.serializeArray(); // serialize form inputs

                    formData.push({
                        name: 'modal_type',
                        value: modal
                    }); // append modal_type

                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        data: formData,
                        beforeSend: function() {
                            // Optional: show loading indicator
                        },
                        success: function(response) {
                            // Handle success
                            toastr.success('Usernames and passwords generated successfully!');
                            hideElements();
                            $('#generatePassTable').find('tbody').html(
                                ''); // Display generated usernames
                            // Optionally reset form or reload table
                        },
                        error: function(xhr) {
                            // Handle error
                            alert('An error occurred while saving data.');
                            console.error(xhr.responseText);
                            toastr.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>

        {{-- add Documents --}}

        <script>
            $('#addDocBtn').on('click', function() {
                let category = $('#docCategory').val().trim();
                let files = $('#docFiles')[0].files;

                if (!category || files.length === 0) {
                    alert("Please enter a category and select at least one file.");
                    return;
                }

                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        let container = $(
                            '<div class="col-md-3 mb-3 text-center border rounded p-2 position-relative"></div>'
                        );
                        container.append(`<strong>${category}</strong><br>`);

                        container.append(`
                <img src="${e.target.result}" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;"><br>
                <p>${file.name}</p>
            `);

                        // Remove button
                        let removeBtn = $(
                            '<button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">&times;</button>'
                        );
                        removeBtn.on('click', function() {
                            container.remove(); // remove the whole container
                        });
                        container.append(removeBtn);

                        // Hidden inputs for Laravel
                        let fileInput = $('<input type="file" style="display:none;" name="documents[]">');
                        let categoryInput = $(`<input type="hidden" name="categories[]">`).val(category);

                        fileInput[0].files = (function() {
                            let dt = new DataTransfer();
                            dt.items.add(file);
                            return dt.files;
                        })();

                        container.append(fileInput, categoryInput);
                        container.hide();
                        $('#uploadedDocs').append(container);
                        container.fadeIn(600);
                    };

                    reader.readAsDataURL(file);
                }

                $('#docCategory').val('');
                $('#docFiles').val('');
            });
        </script>


        {{-- excel upload --}}
        <script>
            let currentJsonData = []; // Store the extracted data globally

            document.getElementById('excelFile').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const reader = new FileReader();
                $('#errorBox').addClass('d-none');

                function isExcelDate(value) {
                    return typeof value === 'number' && value > 59;
                }

                function excelDateToJSDate(serial) {
                    const utc_days = serial - 25569;
                    const utc_value = utc_days * 86400;
                    const date_info = new Date(utc_value * 1000);

                    const year = date_info.getUTCFullYear();
                    const month = (date_info.getUTCMonth() + 1).toString().padStart(2, '0');
                    const day = date_info.getUTCDate().toString().padStart(2, '0');

                    return `${year}-${month}-${day}`;
                }

                reader.onload = function(event) {
                    const data = new Uint8Array(event.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });
                    const firstSheet = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[firstSheet];
                    let jsonData = XLSX.utils.sheet_to_json(worksheet, {
                        defval: ''
                    });

                    // Convert DOB dates before saving
                    jsonData = jsonData.map(row => {
                        if (row['dob'] && isExcelDate(row['dob'])) {
                            row['dob'] = excelDateToJSDate(row['dob']);
                        }
                        return row;
                    });

                    currentJsonData = jsonData; // save globally

                    const thead = document.querySelector('#excelTable thead');
                    const tbody = document.querySelector('#excelTable tbody');
                    thead.innerHTML = '';
                    tbody.innerHTML = '';

                    if (jsonData.length > 0) {
                        const headers = Object.keys(jsonData[0]);
                        const headerRow = document.createElement('tr');
                        headers.forEach(header => {
                            const th = document.createElement('th');
                            th.textContent = header;
                            headerRow.appendChild(th);
                        });
                        thead.appendChild(headerRow);

                        jsonData.forEach(row => {
                            const tr = document.createElement('tr');
                            headers.forEach(header => {
                                const td = document.createElement('td');
                                td.textContent = row[header];
                                tr.appendChild(td);
                            });
                            tbody.appendChild(tr);
                        });
                    } else {
                        tbody.innerHTML = '<tr><td colspan="100%">No data found</td></tr>';
                    }

                    const excelModal = new bootstrap.Modal(document.getElementById('excelModal'));
                    excelModal.show();
                };

                reader.readAsArrayBuffer(file);
            });

            // Save button click handler
            document.addEventListener('click', function(e) {
                if (e.target && e.target.id === 'saveDataBtn') {
                    if (currentJsonData.length === 0) {
                        alert('No data to save!');
                        return;
                    }

                    const modalName = $('#excelFile').attr('data-modal');
                    // Send AJAX POST request to your Laravel endpoint
                    fetch(`{{ url('/excelUpload') }}/${modalName}`, { // Change this to your actual route URL
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Make sure blade renders csrf token here
                            },
                            body: JSON.stringify({
                                data: currentJsonData,
                                modal: modalName
                            })
                        })
                        .then(response => response.json())
                        .then(res => {
                            if (res.success) {
                                window.location.href = `{{ url('/') }}/${res.redirect_to}?uploadedIds=${res.inserted_ids}`;
                            } else {
                                const errorBox = document.getElementById('errorBox');
                                errorBox.classList.remove('d-none');

                                if (res.message && !res.errors) {
                                    // Single friendly error message (like "Column 'Accuracy' not found")
                                    errorBox.innerHTML = `<strong>Error:</strong><br><div>${res.message}</div>`;
                                } else if (Array.isArray(res.errors)) {
                                    // Detailed point-wise error messages
                                    errorBox.innerHTML = '<strong>Error occurred:</strong><br>' +
                                        res.errors.map(err => `<div>${err}</div>`).join('');
                                } else {
                                    errorBox.innerHTML = `<strong>Something went wrong.</strong>`;
                                }
                            }
                        })
                        .catch(error => {
                            alert("Something went wrong: " + error.message);
                        });
                }
            });
        </script>

        <script>

$(document).on('change', '.updateFieldOnChange', function () {
    let $input = $(this);
    let value = $input.val();
    let fieldName = $input.attr('name');
    let modalName = $('#modal_name').val();
    let recordId = $input.attr('data-recordId');

    if (!value || !fieldName || !modalName) {
        console.error("Missing required data attributes.");
        return;
    }

    $.ajax({
        url: '{{ url('/') }}/update-single-field', // Update this URL to your Laravel route
        method: 'POST',
        data: {
            id: recordId,
            field_name: fieldName,
            field_value: value,
            modal_name: modalName,
            _token: $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
        },
        success: function (res) {
            console.log('Updated successfully');
            // Optionally show a success message
        },
        error: function (xhr) {
            console.error('Update failed');
            // Optionally revert input value or show error
        }
    });
});
</script>


        <script>
            $(document).on('click', '.showQuestion', function() {
                const $row = $(this).closest('tr');

                const question = $row.find('td').eq(2).html(); // Question
                const ansA = $row.find('td').eq(3).html(); // Option A
                const ansB = $row.find('td').eq(4).html(); // Option B
                const ansC = $row.find('td').eq(5).html(); // Option C
                const ansD = $row.find('td').eq(6).html(); // Option D
                const correctAns = $row.find('td').eq(7).html(); // Correct Answer

                $('#thisQuestion').html(question);
                $('#thisAns_a').html(ansA);
                $('#thisAns_b').html(ansB);
                $('#thisAns_c').html(ansC);
                $('#thisAns_d').html(ansD);

                // Show correct answer with a horizontal line
                $('#thisCorrectAnsWrapper').html('<hr><b>Correct Answer:</b> ' + correctAns);

                $('#viewQuestionModal').modal('show');

                // Re-render MathJax in modal
                if (window.MathJax) {
                    MathJax.typesetPromise();
                }
            });
        </script>

        <div class="modal fade" id="viewQuestionModal" tabindex="-1" aria-labelledby="viewQuestionModal"
            aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewQuestionModal">Question Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div><b>Ques.: 1</b>
                            <div id="thisQuestion"></div>
                            <hr>
                        </div>
                        <div><span class="bg-primary p-1 text-white">A</span> <span id="thisAns_a"></span></div>
                        <div><span class="bg-primary p-1 text-white">B</span> <span id="thisAns_b"></span></div>
                        <div><span class="bg-primary p-1 text-white">C</span> <span id="thisAns_c"></span></div>
                        <div><span class="bg-primary p-1 text-white">D</span> <span id="thisAns_d"></span></div>

                        <!-- Correct answer placeholder -->
                        <div id="thisCorrectAnsWrapper" class="mt-3"></div>
                    </div>


                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="excelModal" tabindex="-1" aria-labelledby="excelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="excelModalLabel">Excel Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="excelTable">
                                <thead></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <button type="button" id="saveDataBtn" class="btn btn-primary mt-3">Save Data</button>
                        </div>
                        <div id="errorBox" class="alert alert-danger d-none mt-2" role="alert"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Common Delete Confirmation Modal -->
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="confirmDeleteBtn" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="whatsapp_error_modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="centered_flex">
                                <i class="fa fa-exclamation-triangle text-warning"></i>
                                <p>WhatsApp API Message Sending Failure</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <p id="whatsapp_error_message" class="error_message_whatsapp">
                                {{ Session::get('whatsapp_error') ?? '' }}
                            </p>
                            <input type="hidden" id="whatsapp_error_respose_id"
                                value="{{ Session::get('whatsapp_error_respose_id') ?? '' }}">
                        </div>

                        <div class="col-md-12 text-right">
                            <button class="modal_btn bg-white change_status" data-action="Discard"
                                data-bs-dismiss="modal">Discard</button>
                            <button class="modal_btn bg-warning change_status" data-action="Confirm"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>

                        <hr>

                        <div class="col-md-12">
                            <p class="whatsapp_note">
                                Please Contact your Service Provider.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <style>
            .loader {
                width: '70px';
                height: '70px';

            }
        </style>
</body>

</html>
