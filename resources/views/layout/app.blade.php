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
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
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
            $('#country_id').on('change', function(e) {
                var baseurl = "{{ url('/') }}";
                var country_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: baseurl + '/countryData/' + country_id,
                    success: function(data) {
                        $("#state_id").html(data);
                    }
                });

            });
            $('#state_id').on('change', function(e) {
                var baseurl = "{{ url('/') }}";
                var state_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: baseurl + '/stateData/' + state_id,
                    success: function(data) {
                        $("#city_id").html(data);
                    }
                });

            });

            $('#class_type_id').on('change', function(e) {
                var baseurl = "{{ url('/') }}";
                var class_type_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: baseurl + '/subjectGetData/' + class_type_id,
                    success: function(data) {
                        $("#subject_id").html(data);
                    }
                });
            });
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


        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#headerBranchSelect').on('change', function() {
                    const selectedBranchId = $(this).val();
                    $('#branch_id').val(selectedBranchId); // sync to form
                });

                // Apply to multiple forms
                $('#createCommon').on('submit', function(e) {
                    e.preventDefault();

                    // Get branch_id just before submission
                    const selectedBranchId = $('#headerBranchSelect').val();
                    $('#branch_id').val(selectedBranchId); // set it again


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

                                case 'branch_code':
                                    if (value === '') {
                                        message = 'Branch code is required.';
                                    }
                                    break;
                                case 'branch_name':
                                    if (value === '') {
                                        message = 'Branch name is required.';
                                    }
                                    break;
                                case 'contact_person':
                                    if (value === '') {
                                        message = 'Contact Person is required.';
                                    }
                                    break;
                                case 'role_id':
                                    if (value === '') {
                                        message = 'Role name is required.';
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

                                case 'password':
                                    if (value === '') {
                                        message = 'Password is required.';
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

                                case 'address':
                                    if (value === '') {
                                        message = 'address is required.';
                                    }
                                    break;

                                case 'gender':
                                    if (value === '') {
                                        message = 'Gender is required';
                                    }
                                    break;

                                case 'library_id':
                                    if (value === '') {
                                        message = 'select library';
                                    }
                                    break;

                                case 'book_name':
                                    if (value === '') {
                                        message = 'Book Name is required';
                                    }
                                    break;


                                    // Add other validations for different fields here
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


                    // Optional helper to format field names like "mobile_no" to "Mobile No"
                    function formatFieldName(name) {
                        return name
                            .replace(/_/g, ' ')
                            .replace(/\b\w/g, l => l.toUpperCase());
                    }

                    const $form = $(this);

                    if (!validateForm($form)) return;
                    const endpoint = "{{ url('/') }}/api/createCommon";

                    const formData = $form.serialize();

                    $.post(endpoint, formData)
                        .done(function(response) {
                            console.log(response);
                            $form[0].reset();

                            toastr.success('Form Submitted Successfully')
                        })
                        .fail(function(xhr) {
                            alert('Failed to submit form.');
                            console.error(xhr.responseText);
                        });
                });
            });
        </script>

        


        {{-- convert excel data into array --}}
        <script>
            document.getElementById('excelFile').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) {
                    alert("No file selected.");
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });

                    const sheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[sheetName];
                    const jsonData = XLSX.utils.sheet_to_json(worksheet, {
                        header: 1
                    });

                    // 🔥 Filter out empty rows
                    const filteredData = jsonData.filter(row =>
                        Array.isArray(row) &&
                        row.some(cell => cell !== null && cell !== undefined && String(cell).trim() !== "")
                    );

                    alert(JSON.stringify(filteredData, null, 2)); // Show filtered data
                };

                reader.readAsArrayBuffer(file);
            });
        </script>

        {{-- delete entry --}}
        <script>
            $(document).on('click', '.delete-btn', function() {
                const model = $(this).data('modal');
                const id = $(this).data('id');
                const baseUrl = "{{ url('/') }}";
                if (confirm('Are you sure you want to delete this item?')) {
                    const endpoint = `${baseUrl}/api/common-delete/${model}/${id}`;

                    $.post(endpoint, {
                            _method: 'DELETE',
                            _token: $('meta[name="csrf-token"]').attr('content') // Optional for API routes
                        })
                        .done(function(response) {
                            console.log(response);
                            toastr.success(response.message || 'Item deleted successfully.');
                            location.reload();
                        })
                        .fail(function(xhr) {
                            toastr.error('Failed to delete item.');
                            console.error(xhr.responseText);
                        });
                }
            });
        </script>


        <!-- Common Delete Confirmation Modal -->
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
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
                                {{ Session::get('whatsapp_error') ?? '' }}</p>
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

</body>

</html>
