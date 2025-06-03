{{-- first  --}}
@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4>
                                        <i class="fa fa-book"></i> &nbsp; Admin Dashboard
                                    </h4>
                                </div>
                                <div class="card-tools">
                                    <!-- Optional button here -->
                                </div>
                            </div>
                            <div class="card-body ">
                            
                                <!-- <div class="row mb-3">
                                    <div class="col-md-9 col-12">
                                        <div class="card">
                                            <div class="card-header bg-primary">
                                                <div class="card-title">
                                                    <h4>Recent Book Checkouts</h4>
                                                </div>
                                                <div class="card-tools fs-5">
                                                    <a href="{{ url('bookAdd') }}" class="px-1 text-light"><i
                                                            class="fa fa-eye"></i> View</a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="table-light">
                                                            <th>MEMBER</th>
                                                            <th>BOOK</th>
                                                            <th>DATE</th>
                                                            <th>STATUS</th>
                                                            <th>ACTION</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>John Doe</td>
                                                                <td>The Great Gatsby</td>
                                                                <td>May 3,205</td>
                                                                <td><span
                                                                        class="border rounded p-1 bg-success">Active</span>
                                                                </td>
                                                                <td>Extend</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jack Smith</td>
                                                                <td>The Great Gatsby</td>
                                                                <td>May 9,205</td>
                                                                <td><span
                                                                        class="border rounded p-1 bg-success">Active</span>
                                                                </td>
                                                                <td>Extend</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <div class="card-title">
                                                    <h4>Updates &#38; Notifications</h4>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="text-secondary fs-6">
                                                    No Notifications to Display
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 col-12">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <div class="card-title">
                                                    <h4>Student Management</h4>
                                                </div>
                                                {{-- <div class="card-tools">
                                                    <a href="{{ url('studentAdd') }}" class="btn btn-primary"><i
                                                            class="fa fa-plus"></i>
                                                        Add</a>
                                                </div> --}}
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="table-light">
                                                            <th>Sr. No.</th>
                                                            <th>Name</th>
                                                            <th>Father's Nmae</th>
                                                            <th>Mobile</th>
                                                            <th>Admission Date</th>
                                                            <th>Action</th>
                                                        </thead>
                                                        <tbody>
                                                            <td>1</td>
                                                            <td>John Doe</td>
                                                            <td>Jack Doe</td>
                                                            <td>9977678754</td>
                                                            <td>10-may-2025</td>
                                                            <td>
                                                                <a href="{{ url('studentEdit') }}" class="btn-xs"><i
                                                                        class="fa fa-edit text-primary"></i></a>
                                                                <a href="#" class=" btn-xs">
                                                                    <i class="fa fa-trash fs-6 text-danger"></i></a>
                                                            </td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div> -->


                           
                           
                            </div>
                        </div>

















                        {{-- Add students and remider boxes --}}
                        {{-- <div class="row">
                            <div class="col-12 col-sm-4 col-md-3">
                                <a href="/library_assign" class="blink">
                                    <div class="info-box mb-3 text-dark bg-info">
                                        <input type="hidden" class="form-control" id="filter" name="filter"
                                            value="active_user">
                                        <span class="info-box-icon bg-dark elevation-1">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <button type="submit" class="btn btn-info">
                                                <span>New Enrollment</span>
                                            </button>
                                            <span class="info-box-number">
                                                Click here to add new students.
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <form id="myForm" action="/library_student_view" method="post">
                                    <input type="hidden" class="form-control" id="filter" name="filter"
                                        value="overdue_till_14_days">
                                    <div class="info-box mb-3 text-dark">
                                        <span class="info-box-icon bg-danger elevation-1"><i
                                                class="fa fa-clock-o"></i></span>
                                        <div class="info-box-content">
                                            <button type="submit" class="bg-white"
                                                style="border:hidden;text-align:left">
                                                <span class="info-box-text">OverDue [Within 14Days]</span>
                                            </button>
                                            <span class="info-box-number">
                                                <span class='badge badge-info'>Locker : <span
                                                        class='isBlink'>30</span></span>
                                                <span class='badge badge-info'>Library : <span
                                                        class='isBlink'>60</span></span>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12 col-sm-6 col-md-3">
                                <form id="myForm" action="/library_student_view" method="post">
                                    <input type="hidden" class="form-control" id="filter" name="filter"
                                        value="due_3_days">
                                    <div class="info-box mb-3 text-dark">
                                        <span class="info-box-icon bg-danger elevation-1"><i
                                                class="fa fa-clock-o"></i></span>
                                        <div class="info-box-content">
                                            <button type="submit" class="bg-white"
                                                style="border:hidden;text-align:left">
                                                <span class="info-box-text">DueDate [Within 3Days]</span>
                                            </button>
                                            <span class="info-box-number">
                                                <span class='badge badge-info'>Locker : <span
                                                        class='isBlink'>18</span></span>
                                                <span class='badge badge-info'>Library : <span
                                                        class='isBlink'>40</span></span>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3 text-dark">
                                    <span class="info-box-icon bg-success elevation-1"><i
                                            class="fa fa-credit-card"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Today EXPENSES</span>
                                        <span class="info-box-number">1,200/-</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    
                        <div>
                            <h5 class="mb-3">Collection Report</h5>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-2">
                                    <div class="info-box mb-3 text-dark">
                                        <span class="info-box-icon bg-success elevation-1"><i
                                                class="fa fa-inr"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Today</span>
                                            <span class="info-box-number">2,500.00/-</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-2">
                                    <div class="info-box mb-3 text-dark">
                                        <span class="info-box-icon bg-success elevation-1"><i
                                                class="fa fa-inr"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Yesterday</span>
                                            <span class="info-box-number">3,000.00/-</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-2 text-dark">
                                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-inr"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Dues</span>
                                            <span class="info-box-number">
                                                <span class='badge badge-danger'>Invoiced: <span
                                                        class='isBlink'>10,500.00</span>/-</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="card">
                                    <div class="card-header ui-sortable-handle">
                                        <h3 class="card-title">
                                            <i class="ion ion-clipboard mr-1"></i> To Do List
                                        </h3>
                                        <div class="card-tools">
                                            <div class="row">
                                                <div class="col-md-8 col-9">
                                                    <input type="text" class="form-control form-control-border"
                                                        placeholder="Enter Task..">
                                                </div>
                                                <div class="col-md-4 col-3">
                                                    <button type="button"
                                                        class="add_task btn btn-primary float-right btn-xs">
                                                        <i class="fa fa-plus"></i> Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <ul class="todo-list">
                                            <li>
                                                <span class="handle">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </span>
                                                <div class="icheck-primary d-inline ml-2">
                                                    <input type="checkbox" id="task1">
                                                    <label for="task1"></label>
                                                </div>
                                                <span class="text">Complete homepage design</span>
                                                <small class="badge badge-primary"><i class="fa fa-clock"></i> 1
                                                    week</small>
                                                <div class="tools">
                                                    <i class="fa fa-trash-o"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <span class="handle">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </span>
                                                <div class="icheck-primary d-inline ml-2">
                                                    <input type="checkbox" id="task2" checked>
                                                    <label for="task2"></label>
                                                </div>
                                                <span class="text">Update pricing table</span>
                                                <small class="badge badge-primary"><i class="fa fa-clock"></i> 3
                                                    days</small>
                                                <div class="tools">
                                                    <i class="fa fa-trash-o"></i>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                          
                            <div class="col-md-5 col-12">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fa fa-bell"></i> Birthday Notification</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <marquee direction="up" scrollamount="4" onMouseOver="this.stop()"
                                            onMouseOut="this.start()">
                                            <ul class="todo-list">
                                                <li>
                                                    <a href="#">
                                                        <span class="text text-dark">John Doe</span>
                                                        <small class="badge badge-danger"><i class="fa fa-envelope-o"></i>
                                                            New</small>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="text text-dark">Jane Smith</span>
                                                        <small class="badge badge-danger"><i class="fa fa-envelope-o"></i>
                                                            New</small>
                                                    </a>
                                                </li>
                                            </ul>
                                        </marquee>
                                    </div>
                                </div>
                            </div>

                     
                            <div class="col-md-7 col-12">
                                <div class="card">
                                    <div class="card-header ui-sortable-handle">
                                        <h3 class="card-title">
                                            <i class="fa fa-bell-o mr-1"></i> Notifications
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <marquee direction="up" scrollamount="4" onMouseOver="this.stop()"
                                            onMouseOut="this.start()">
                                            <ul class="todo-list">
                                                <li>
                                                    <a href="#">
                                                        <span class="text text-dark">New library timings updated</span>
                                                        <small class="badge badge-danger"><i class="fa fa-envelope-o"></i>
                                                            New</small>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="text text-dark">Exam schedule released</span>
                                                        <small class="badge badge-danger"><i class="fa fa-envelope-o"></i>
                                                            New</small>
                                                    </a>
                                                </li>
                                            </ul>
                                        </marquee>
                                    </div>
                                </div>
                            </div>
                        </div>

                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="text-center">
                                            <h3 class="mb-1">Due List</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="example12" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th><input type='checkbox' id='checkbox_select_all' /></th>
                                                    <th>Name</th>
                                                    <th>Mobile</th>
                                                    <th>Admission No</th>
                                                    <th>Slots</th>
                                                    <th>Renew</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="library_plan_101">
                                                    <td><input type='checkbox' class='checkbox_id' name='checkbox[]'
                                                            data-mobile='9876543210' value='1' /></td>
                                                    <td class="student_name">Rahul Sharma</td>
                                                    <td>9876543210</td>
                                                    <td class="admissionNo">A12345</td>
                                                    <td>Cabin A (10 AM - 12 PM)</td>
                                                    <td>20-04-2025</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary data"
                                                            data-id="1" data-library_plan_id="101" data-toggle="modal"
                                                            data-target="#exampleModal" data-whatever="@mdo">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr id="library_plan_102">
                                                    <td><input type='checkbox' class='checkbox_id' name='checkbox[]'
                                                            data-mobile='9123456789' value='2' /></td>
                                                    <td class="student_name">Anjali Verma</td>
                                                    <td>9123456789</td>
                                                    <td class="admissionNo">A12346</td>
                                                    <td>Cabin B (12 PM - 2 PM)</td>
                                                    <td>18-04-2025</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary data"
                                                            data-id="2" data-library_plan_id="102" data-toggle="modal"
                                                            data-target="#exampleModal" data-whatever="@mdo">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade exampleModal" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title " id="exampleModalLabel">Ledger History</h5>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body response"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
    </div>

    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fullcalendar/main.css">
    <script src="https://adminlte.io/themes/v3/plugins/fullcalendar/main.js"></script>

    <script>
        function sendMessages() {
            var formData = new FormData();
            var checkboxes = document.querySelectorAll('input.checkbox_id');
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var mobile = checkbox.getAttribute('data-mobile');
                    var message = checkbox.getAttribute('data-pendings');
                    var id = checkbox.value;
                    formData.append('mobile[]', mobile);
                    formData.append('message[]', message);
                    formData.append('id[]', id);
                }
            });

            $.ajax({
                url: '/sendRemainderMessages',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    toastr.success('Remainders Sent Successfully');
                },
                error: function(data) {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }

        $(document).ready(function() {
            function createButton() {
                return $('<button>', {
                    text: 'Send Reminder Message',
                    class: 'btn btn-primary',
                    click: function(event) {
                        event.preventDefault();
                        sendMessages();
                    }
                });
            }

            function toggleButton() {
                if ($('#checkbox_select_all').is(':checked') || $('.checkbox_id:checked').length > 0) {
                    if ($('#example12_wrapper .col-md-6:eq(1) .btn').length === 0) {
                        $('#example12_wrapper .col-md-6:eq(1)').append(createButton());
                    }
                } else {
                    $('#example12_wrapper .col-md-6:eq(1) .btn').remove();
                }
            }

            $('#checkbox_select_all').on('change', function() {
                $('.checkbox_id').prop('checked', $(this).prop('checked'));
                toggleButton();
            });

            $(document).on('change', '.checkbox_id', function() {
                toggleButton();
            });

            toggleButton();

            function generateLibraryReminder(studentName, Admission_No, libraryName, amount, plans, librarian,
                libraryMobile) {
                var messageTemplate =
                    `Dear *${studentName}*
      Reg. No.~ 
      ${Admission_No}
      आपकी लाइब्रेरी की सदस्यता का माह पूर्ण हो चुका हैं। कृप्या  सदस्यता शुल्क जमा करें।
       फ़ीस जमा करने की अंतिम तारीख़ से तीन दिवस के भीतर फ़ीस जमा करने की कृपा करें।🙏🏻
      👉🏻फ़ीस जमा करते समय अपना आईडी कार्ड साथ में लाना अनिवार्य हैं। 
      👉🏻 फ़ीस में किसी कारणवश विलंब होने की स्थिति में आप हमें फ़ोन और मेसेज के माध्यम से सूचित कर दें, ताकि हम जानकारी अपडेट कर सकें। (इसी स्थिति में तारीख़ में संसोधन किया जाएगा)T&C
      
      _${plans}_
      
      आप ऑनलाइन माध्यम से भी फ़ीस जमा कर सकते हैं:- 📲
      9479468878@ybl
      
                       《धन्यवाद》
      कृप्या अपने एक्सपीरिएंस शेयर करे📃
                             *****
      https://g.co/kgs/eyZ1BKT
      
                       📱संपर्क करें-
      
      ${libraryName}
      ${libraryMobile}`;
                return messageTemplate;
            }

            $('tr').each(function() {
                var studentName = $(this).find('td.student_name').text().trim();
                var Admission_No = $(this).find('td.admissionNo').text().trim();
                var libraryName = "Bright Future Library";
                var amount = "₹1000";
                var plans = "Monthly Plan";
                var librarian = "Mr. Ajay Sharma";
                var libraryMobile = "9876543210";
                var messageId = generateLibraryReminder(studentName, Admission_No, libraryName, amount,
                    plans, librarian, libraryMobile);
                $(this).find('input.checkbox_id').attr('data-pendings', messageId);
            });
        });
    </script>

    <script>
        $(function() {
            $("#example12").DataTable({
                "autoWidth": false,
                "lengthMenu": [25, 50, 100, 200, 500],
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example12_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".data").click(function() {
                var id = $(this).data("id");
                var library_plan_id = $(this).data("library_plan_id");
                $.ajax({
                    type: 'post',
                    url: '/library_due_amount_new',
                    data: {
                        admission_id: id,
                        library_plan_id: library_plan_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $(".response").html(response.html);
                    }
                });
            });
        });
    </script>

    <style>
        .blink {
            animation: blink-animation 4s infinite step-start;
        }

        @keyframes blink-animation {
            0% {
                opacity: 1;
            }

            5% {
                opacity: 0.1;
            }

            100% {
                opacity: 1;
            }
        }

        .blink2 {
            animation: blink-animation 0.5s infinite step-start;
        }
    </style>

   

    <script>
        $(document).ready(function() {
            $('.isBlink').each(function() {
                if ($(this).text().trim() > 0) {
                    $(this).closest('.badge').addClass('bg-danger blink2');
                }
            });

            var BASEURL = "http://localhost";

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': 'STATIC_CSRF_TOKEN'
                },
                url: BASEURL + '/check_library_renew',
                type: 'GET',
                success: function(data) {
                    if (data.status === true) {
                        toastr.info('Seats Cleared Successfully');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error: ', textStatus, errorThrown);
                    toastr.error('An error occurred. Please try again.');
                }
            });
        });
    </script>

    <script>
        $(function() {
            function ini_events(ele) {
                ele.each(function() {
                    var eventObject = {
                        title: $.trim($(this).text())
                    };

                    $(this).data('eventObject', eventObject);
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true,
                        revertDuration: 0
                    });
                });
            }

            ini_events($('#external-events div.external-event'));

            var date = new Date();
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl).getPropertyValue(
                            'background-color'),
                        borderColor: window.getComputedStyle(eventEl).getPropertyValue(
                            'background-color'),
                        textColor: window.getComputedStyle(eventEl).getPropertyValue('color'),
                    };
                }
            });

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                events: [{
                        title: 'All Day Event',
                        start: new Date(y, m, 1),
                        backgroundColor: '#f56954',
                        borderColor: '#f56954',
                        allDay: true
                    },
                    {
                        title: 'Long Event',
                        start: new Date(y, m, d - 5),
                        end: new Date(y, m, d - 2),
                        backgroundColor: '#f39c12',
                        borderColor: '#f39c12'
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                        backgroundColor: '#0073b7',
                        borderColor: '#0073b7'
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        backgroundColor: '#00c0ef',
                        borderColor: '#00c0ef'
                    },
                    {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false,
                        backgroundColor: '#00a65a',
                        borderColor: '#00a65a'
                    },
                    {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'https://www.google.com/',
                        backgroundColor: '#3c8dbc',
                        borderColor: '#3c8dbc'
                    }
                ],
                editable: true,
                droppable: true,
                drop: function(info) {
                    if (checkbox.checked) {
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });

            calendar.render();

            var currColor = '#3c8dbc';

            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault();
                currColor = $(this).css('color');
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                });
            });

            $('#add-new-event').click(function(e) {
                e.preventDefault();
                var val = $('#new-event').val();
                if (val.length === 0) return;

                var event = $('<div />');
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event').text(val);

                $('#external-events').prepend(event);
                ini_events(event);
                $('#new-event').val('');
            });
        });
    </script>

    <script>
        $(document).on('click', ".add_task", function() {
            var task = $('#task').val();
            var data = {
                task: task
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': 'STATIC_CSRF_TOKEN'
                }
            });

            $.ajax({
                type: "POST",
                url: "/add/task",
                data: data,
                dataType: "html",
                success: function() {
                    toastr.success('Task Added Successfully.');
                }
            });
        });

        $(document).on('click', ".task_status", function() {
            var id = $(this).data('id');
            var status = $(this).data('status');

            $.ajax({
                url: '/status/task',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': 'STATIC_CSRF_TOKEN'
                },
                data: {
                    status: status,
                    id: id
                },
                success: function() {
                    toastr.success('Record Saved Successfully.');
                }
            });
        });

        $(document).on('click', ".task_delete", function() {
            var task_id = $(this).data('id');
            var data = {
                task_id: task_id
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': 'STATIC_CSRF_TOKEN'
                }
            });

            $.ajax({
                type: "POST",
                url: "/delete/task",
                data: data,
                dataType: "html",
                success: function() {
                    $("#task_li").remove();
                    toastr.success('Task Deleted Successfully.');
                }
            });
        });
    </script>

    <script>
        $(function() {
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d');

            var areaChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                        label: 'Digital Goods',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                        label: 'Electronics',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [65, 59, 80, 81, 56, 55, 40]
                    }
                ]
            };

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            };

            new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            });
        });
    </script>


   

    <script>
        $(document).ready(function() {
      
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d');
            var areaChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                        label: 'Digital Goods',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                        label: 'Electronics',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                ]
            };

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            };

            new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            });

   
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
            var lineChartOptions = $.extend(true, {}, areaChartOptions);
            var lineChartData = $.extend(true, {}, areaChartData);
            lineChartData.datasets[0].fill = false;
            lineChartData.datasets[1].fill = false;
            lineChartOptions.datasetFill = false;

            new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            });

   
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
            var donutData = {
                labels: [
                    'Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'
                ],
                datasets: [{
                    data: [700, 500, 400, 600, 300, 100],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }]
            };
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };

            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            });

 
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };

            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            });

   
            var barChartCanvas = $('#barChart').get(0).getContext('2d');
            var barChartData = $.extend(true, {}, areaChartData);
            var temp0 = areaChartData.datasets[0];
            var temp1 = areaChartData.datasets[1];
            barChartData.datasets[0] = temp1;
            barChartData.datasets[1] = temp0;

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            };

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            });

   
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d');
            var stackedBarChartData = $.extend(true, {}, barChartData);
            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            };

            new Chart(stackedBarChartCanvas, {
                type: 'bar',
                data: stackedBarChartData,
                options: stackedBarChartOptions
            });
        });
    </script> --}}
                    @endsection
