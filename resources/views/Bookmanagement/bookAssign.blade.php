@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content pt-3">

            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Book assign</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4>Assign Book</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <form id="assign_book">

                                    <div class="row ">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="issue_date" class="text-danger">Date Of Issue*</label>
                                                <input type="date" class="form-control" name="issue_date" id="issue_date"
                                                    value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="due_date" class="text-danger">Due Date*</label>
                                                <input type="date" class="form-control" name="due_date" id="due_date"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="admissionNo" class="text-danger">Admission No* </label>&nbsp;<a
                                                    data-toggle="modal" data-target="#searchModal"
                                                    style='cursor:pointer;vertical-align: text-top;font-size:9px;color:blue'>[
                                                    Search Student ]</a>
                                                <input type="text" class="form-control" name="admissionNo"
                                                    id="admissionNo" required placeholder="Admission No">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="accession_no" class="text-danger">Accession No*</label>
                                                <input type="text" class="form-control" name="accession_no"
                                                    id="accession_no" required placeholder="Accession No">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>&nbsp;</label><br>
                                                <button type="submit" class="btn btn-success" id="assign_btn">
                                                    <i class="fa fa-file"></i> Assign
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="card card-outline card-orange">
                                            <div class="card-header  bg-primary">
                                                <div class="card-title">
                                                    <h4><i class="fa fa-user"></i> &nbsp; Student Details
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="student_name">Student Name</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="student_name" placeholder="Student Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="father_name">Father's Name</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="father_name" placeholder="Father's Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="mobile_no">Mobile No</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="mobile_no" placeholder="Mobile No">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="address">Address</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="address" placeholder="Address">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <table id='assigned_details' class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th><input type='checkbox' id='all_checkbox' /></th>
                                                            <th>Book Name</th>
                                                            <th>Acc/Bcode Id</th>
                                                            <th>Issue Date</th>
                                                            <th>Due Date</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="books_list">
                                                        <tr class="text-center">
                                                            <td colspan="12">No Book Issued Yet.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class='text-center'id='return_book'>


                                                </div>
                                                <input type='hidden' id='for_unassigned_ids' />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-outline card-orange">
                                            <div class="card-header  bg-primary">
                                                <div class="card-title">
                                                    <h4><i class="fa fa-book"></i> &nbsp; Book Details</h4>
                                                </div>
                                            </div>
                                            <div class="card-body p-0 relative_position">
                                                <div id="already_assigned" style="display:none;">
                                                    <div class="overlay_of_body">
                                                        <p id="note_text_main"></p>
                                                    </div>
                                                </div>
                                                <div class="row p-4">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="library_name">Library Name</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="library_name" placeholder="Library Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="book_name">Book Name</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="book_name" placeholder="Book Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="author_name">Author Name</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="author_name" placeholder="Author Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="book_category">Book Category</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="book_category" placeholder="Book Category">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="quantity">Quantity</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="quantity" placeholder="Quantity">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="searchModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Search Students</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="searchForm">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="studentName">Student Name</label>
                                <input type="text" class="form-control" id="studentName" name="studentName"
                                    placeholder="Enter name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    placeholder="Enter mobile">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group col-md-3">
                                <label class='text-white'for="email">Submit</label>
                                <button type="button" class="btn btn-primary" id="searchButton">Search</button>
                            </div>
                        </div>

                    </form>

                    <div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Admission No</th>
                                    <th>First Name</th>

                                    <th>Mobile</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody id='searchResults'>
                                <!-- Table rows will be inserted here dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Loading screen modal -->
    <div class="modal" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="w-100">
                <div class="modal-body text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only text-white"></span>
                    </div>
                    <p class="mt-2 text-white">please wait...</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .relative_position {
            position: relative;
        }

        .overlay_of_body {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #808080bf;
            border-radius: 0px 0px 4px 4px;
            z-index: 11;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay_of_body p {
            color: white;
            font-size: 20px;
            font-weight: 600;
            text-shadow: -4px 3px 6px #545454;
        }

        .loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1050;
            /* Make sure this is higher than the modal backdrop */
        }
    </style>


    <script>
        $(document).ready(function() {
            $('#loadingModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            var BASEURL = ""; // URL base removed
            var assigned_book_array = [];
            var book_id = "";

            var today = new Date();
            var nextMonth = new Date(today.setMonth(today.getMonth() + 1));
            var nextMonthFormatted = nextMonth.toISOString().split('T')[0];

            $('#due_date').val(nextMonthFormatted);

            function frashStudentData() {
                $('#books_list').html("");
                $('#student_name').val("");
                $('#father_name').val("");
                $('#mobile_no').val("");
                $('#address').val("");
                $('#admissionNo').val("");

                assigned_book_array = [];

                $('#already_assigned').hide();
                $('#assign_btn').removeAttr('disabled');
            }

            function frashBookData() {
                $('#book_name').val("");
                $('#author_name').val("");
                $('#library_name').val("");
                $('#book_category').val("");
                $('#accession_no').val("");
                $('#quantity').val("");
                $('#already_assigned').hide();
                book_id = "";

                $('#assign_btn').removeAttr('disabled');
            }

            $('#admissionNo').blur(function() {
                var admissionNo = $(this).val();
                $('#loadingModal').modal('show');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: BASEURL + '/get_students_list',
                    data: {
                        admissionNo: admissionNo
                    },
                    success: function(data) {
                        frashStudentData();
                        if (!data['student']) {
                            toastr.info('Check for the student in other library');
                            toastr.error('There is no student in the library');
                            $('#loadingModal').modal('hide');

                        } else {
                            var student_name = (data['student'].first_name || '') + " " + (data[
                                'student'].last_name || '');
                            $('#student_name').val(student_name.trim());
                            $('#father_name').val(data['student'].father_name || '');
                            $('#mobile_no').val(data['student'].mobile || '');
                            $('#address').val(data['student'].address || '');
                            $('#admissionNo').val(data['student'].admissionNo || '');


                            if (data['books'] && data['books'].length > 0) {
                                for (var i = 0; i < data['books'].length; i++) {
                                    var book = data['books'][i];

                                    var status = (book.status == 0 ? 'Not Returned' :
                                        'Returned');
                                    var text_color = status == 'Not Returned' ? 'text-danger' :
                                        'text-success';
                                    var code =
                                        '<tr><td><input type="checkbox" class="assigned_checkbox" value="' +
                                        book.id + '"/></td><td>' + book.book_name +
                                        '</td><td>' + book.book_code + '</td><td>' + book
                                        .issue_date + '</td><td>' + book.due_date +
                                        '</td><td><span class=' + text_color + '>' + status +
                                        '</span></td></tr>';
                                    if (book.status == 0) {
                                        assigned_book_array.push(book.id);
                                    }
                                    $('#books_list').append(code);
                                }

                                if (assigned_book_array.includes(book_id)) {
                                    $('#already_assigned').show();
                                    $('#note_text_main').html(
                                        "Already Assigned this book for this student");
                                    $('#assign_btn').attr('disabled', true);
                                } else {
                                    $('#already_assigned').hide();
                                    $('#assign_btn').removeAttr('disabled');
                                }

                                $('#loadingModal').modal('hide');
                            } else {
                                var code = `<tr class="text-center">
                                    <td colspan="5">No Book Issued Yet.</td>
                                </tr>`;
                                $('#books_list').append(code);
                                $('#already_assigned').hide();
                                $('#assign_btn').attr('disabled', true);

                                $('#loadingModal').modal('hide');
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching student data:', error);
                        toastr.error('An error occurred while fetching student data.');
                    }
                });
            });



            $('#accession_no').blur(function() {
                $('#loadingModal').modal('show');
                var accession_no = $(this).val();
                $('#assign_btn').attr('disabled', true);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: BASEURL + '/get_book_list',
                    data: {
                        accession_no: accession_no
                    },
                    //dataType: 'json',
                    success: function(response) {
                        frashBookData();
                        var data = response.data;
                        $('#loadingModal').modal('hide');
                        if (data.length == 0) {
                            toastr.error(response.message);
                            $('#accession_no').val("");
                        } else {
                            book_id = data.id;

                            if (data.quantity == 0) {
                                $('#already_assigned').show();
                                $('#note_text_main').html("Not Available");
                                $('#assign_btn').attr('disabled', true);
                            }

                            if (assigned_book_array.includes(book_id)) {
                                $('#already_assigned').show();
                                $('#note_text_main').html(
                                    "Already Assigned this book for this student");
                                $('#assign_btn').attr('disabled', true);
                            }

                            $('#book_name').val(data.name);
                            $('#author_name').val(data.author ?? '');
                            $('#library_name').val(data.library_name ?? '');
                            $('#book_category').val(data.category_name ?? '');
                            $('#accession_no').val(data.book_code);
                            $('#quantity').val(data.quantity);
                        }
                    }
                });
            });

            $('#assign_book').submit(function(event) {
                event.preventDefault();
                $('#loadingModal').modal('show');
                var accession_no = $('#accession_no').val();
                if (accession_no == "") {
                    $('#loadingModal').modal('hide');
                    toastr.error('Please select Book');
                    return;
                }
                var formData = $(this).serialize();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: BASEURL + '/assign_book',
                    data: formData,
                    success: function(data) {
                        toastr.success(data.message);
                        $('#admissionNo').blur();
                        frashBookData();
                        $('#loadingModal').modal('hide');
                    }
                });


            });

            $('#searchButton').click(function() {
                // Get input values
                var list = $('#searchResults');

                list.html('');
                var studentName = $('#studentName').val();
                var mobile = $('#mobile').val();
                var email = $('#email').val();

                // AJAX request
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/getStudentDetail',
                    type: 'POST',
                    data: {
                        studentName: studentName,
                        mobile: mobile,
                        email: email
                    },
                    success: function(response) {
                        var data = response.data;
                        data.forEach(function(item) {
                            list.append(
                                '<tr class="selected_admission_no" data-admissionNo="' +
                                item.admissionNo + '" style="cursor:pointer"><td>' +
                                item.admissionNo + '</td><td>' + (item.first_name ??
                                    '') + ' ' + (item.last_name ?? '') +
                                '</td><td>' + item.mobile + '</td><td>' + item
                                .email + '</td></tr>');
                        });



                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        alert('Error: ' + error);
                    }
                });
            });

            $("#searchResults").on("click", ".selected_admission_no", function() {

                var admissionNo = $(this).attr('data-admissionNo');
                $('#admissionNo').val(admissionNo);
                $('#admissionNo').trigger('blur');
                $('.close').trigger('click');


            });


            $("#assigned_details").on("click", "#all_checkbox", function() {


                var count = $('.assigned_checkbox').length;



                if (count == 0) {
                    toastr.error('Nothing to select.');
                    $('#all_checkbox').prop('checked', false);
                    return;
                }

                if ($(this).is(':checked')) {

                    $('.assigned_checkbox').prop('checked', false);
                } else {
                    $('.assigned_checkbox').prop('checked', true);
                }

                $('.assigned_checkbox').trigger('click');
            });

            $("#assigned_details").on("click", ".assigned_checkbox", function() {

                var array = [];
                $(".assigned_checkbox").each(function() {

                    if ($(this).is(':checked')) {

                        array.push($(this).val());
                    }

                });

                if (array.length > 0) {
                    $('#return_book').html(
                        '<button id="confirm_return" class="btn btn-success" >Confirm Return</button>')
                } else {
                    $('#return_book').html('')
                }

                $('#for_unassigned_ids').val(array)


            });


            $('#return_book').on("click", "#confirm_return", function() {

                var array = $('#for_unassigned_ids').val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/confirmReturnBook',
                    type: 'POST',
                    data: {
                        ids: array

                    },
                    success: function(response) {

                        if (response.status) {
                            toastr.success(response.message);
                            $('#admissionNo').trigger('blur');
                        }

                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        alert('Error: ' + error);
                    }
                });
            });



        });
    </script>
@endsection
