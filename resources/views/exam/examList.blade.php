@extends('layout.app')
@section('content')
    @php
        $permissions = Helper::getPermissions();
        $filterable_columns = [
            'batches' => true,
            'subject_id' => false,
            'level_id' => true,
            'suka_id' => true,
            'status' => true,
            'source_id' => true,
            'is_deleted' => false,
            'keyword' => true,
        ];
    @endphp

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12 p-0">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Exam Management</li>
                            <li class="breadcrumb-item">List</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="card card-outline card-orange col-md-12 col-12 p-0">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h4><i class="fa fa-desktop"></i> &nbsp;Exam List</h4>
                            </div>
                            <div class="card-tools">
                                @if (in_array('user_management.edit', $permissions) || Auth::user()->role_id == 1)
                                    <a href="{{ url('questions') }}" class="btn btn-primary  btn-sm"><i
                                            class="fa fa-plus"></i>
                                        <span class="Display_none_mobile"> {{ __('common.Add') }} </span></a>
                                @endif
                                {{-- <a href="{{ url('userDashboard') }}" class="btn btn-primary btn-sm"><i
                                class="fa fa-arrow-left"></i> <span class="Display_none_mobile">
                                {{ __('common.Back') }}
                            </span></a> --}}
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="bg-item border p-3 rounded">
                                <form>
                                    <!-- <input type='hidden' value='Question' name='modal_type' /> -->
                                    <div class="row">
                                        @include('commoninputs.filterinputs', [
                                            'filters' => $filterable_columns,
                                        ])
                                        <div class="col-md-1 mt-4">
                                            <button type="button" id="filterForm" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                            <div class="table-responsive">
                                <table id='examTable' class="table table-bordered table-striped mt-4">
                                    <!-- <input type='hidden' value="Exam" name='modal_type' /> -->
                                    <thead>
                                        <tr class="bg-light">
                                            <th>SR.NO</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Created By</th>
                                            <th>Status</th>
                                            <th>Assign</th>
                                            <!-- <th>Assign</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                </table>
                                <script>
                                    $(document).ready(function() {
                                        const table = $('#examTable').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: {
                                                url: "{{ url('examData') }}",
                                                data: function(d) {
                                                    const formDataArray = [];
                                                    $('#filterForm').find('input, select, textarea').each(function() {
                                                        const name = $(this).attr('name');
                                                        const value = $(this).val();
                                                        if (name && value !== null && value !== '' && value !== undefined) {
                                                            formDataArray.push({
                                                                name: name,
                                                                value: value
                                                            });
                                                        }
                                                    });
                                                    d.filterable_columns = formDataArray;
                                                }
                                            },
                                            columns: [{
                                                    data: 'DT_RowIndex',
                                                    name: 'DT_RowIndex',
                                                    orderable: false,
                                                    searchable: false
                                                }, // SR.NO
                                                {
                                                    data: 'name',
                                                    name: 'name'
                                                }, // Exam
                                                {
                                                    data: 'created_at',
                                                    name: 'created_at'
                                                }, // Created At
                                                {
                                                    data: 'created_by',
                                                    name: 'created_by'
                                                }, // Created by
                                                {
                                                    data: 'status',
                                                    name: 'status'
                                                }, // Status
                                                {
                                                    data: 'assign_to',
                                                    name: 'assign_to',
                                                    orderable: false,
                                                    searchable: false
                                                }, // Assign        
                                                {
                                                    data: 'action',
                                                    name: 'action',
                                                    orderable: false,
                                                    searchable: false
                                                } // Action
                                            ],
                                            createdRow: function(row, data, dataIndex) {
                                                $(row).addClass('examRow');
                                            }
                                        });

                                        // Reload table on filter change or submit
                                        $('#filterForm').on('click', function() {

                                            table.ajax.reload();
                                        });
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Assign Modal -->
            <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ url('assignExam') }}" method="POST">
                        @csrf
                        <input type="hidden" name="exam_id" id="assignExamId">
                        {{-- <input type='hidden' value='AssignExam' name='modal_type' />  --}}

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="assignModalLabel">Assign Exam</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="text-center">Assigning exam: <strong id="assignExamName"></strong></p>
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('commoninputs.inputs', [
                                            'modal' => 'Batches',
                                            'name' => 'class_type_id',
                                            'selected' => $assign_exams->class_type_id ?? null,
                                            'label' => 'Select Batch',
                                            'required' => true,
                                        ])
                                    </div>
                                    <div class="col-md-12">
                                        <label for="date" class="form-label">Enter Date </label>
                                        <input type="datetime-local" class="form-control" name="exam_date">
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <label for="time" class="form-label">Enter Time </label>
                                        <input type="time" class="form-control" name="time">
                                    </div> --}}
                                    <div class="col-md-12">
                                        <label for="Duration" class="form-label">Duration </label>
                                        <input type="text" class="form-control" name="duration_minutes">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Assign</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>


        </section>
    </div>

    <script>
        var checkedValues = [];
        $(document).ready(function() {
            // When a checkbox is clicked
            $('.question-checkbox').on('change', function() {
                // Initialize an array to hold checked checkbox values
                checkedValues = [];

                // Loop through all checked checkboxes and push their values into the array
                $('.question-checkbox:checked').each(function() {
                    checkedValues.push($(this).val());
                });

                // If at least one checkbox is checked, show the "Update" button
                if (checkedValues.length > 0) {
                    $('#updateButton').show();
                } else {
                    $('#updateButton').hide();
                }

                console.log(checkedValues); // This will log the array of checked values
            });

            $(document).on('click', '#updateButton', function() {
                var baseurl = "{{ url('/') }}";
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: baseurl + '/updateQuestionsAjax',
                    data: {
                        chapter_id: chapterId,
                        questionTypeId: questionTypeId,
                    },
                    method: 'post',
                    success: function(response) {


                    }
                });

            });
        });
    </script>

    {{-- show modal on click --}}
    <script>
        $(document).on('click', '.assign-btn', function() {
            const examId = $(this).data('id');
            const examName = $(this).data('name');

            $('#assignExamId').val(examId);
            $('#assignExamName').text(examName);

            $('#assignModal').modal('show');
        });
    </script>


    <script>
        $(document).ready(function() {

            $('table p').attr('style', '');
            $('table p').replaceWith(function() {
                return '<span>' + $(this).html() + '</span>';
            });

        });
        $('.deleteData').click(function() {
            var delete_id = $(this).data('id');
            $('#delete_id').val(delete_id);
        });

        $('.questionDetail').click(function() {
            $('#myModal').modal('toggle');

            var question = $(this).data('question');
            var class_type_id = $(this).data('class_type_id');
            var section_id = $(this).data('section_id');
            var subject_id1 = $(this).data('subject_id');
            var answer1 = $(this).data('opt1');
            var answer2 = $(this).data('opt2');
            var answer3 = $(this).data('opt3');
            var answer4 = $(this).data('opt4');
            var correct_ans = $(this).data('correct_ans');

            $('#question').html(question);
            $('#subject_id1').html(subject_id1);
            $('#ans1').html(answer1);
            $('#ans2').html(answer2);
            $('#ans3').html(answer3);
            $('#ans4').html(answer4);

            /*toastr.error(answer1);
            toastr.error(answer2);
            toastr.error(answer3);
            toastr.error(answer4);*/
            /*if(correct_ans == "0"){
                $('#ans1').addClass("bg-success");
                $('#ans2').removeClass("bg-success");
                $('#ans3').removeClass("bg-success");
                $('#ans4').removeClass("bg-success");
            }else if(correct_ans == "1"){
                $('#ans2').addClass("bg-success");
                $('#ans1').removeClass("bg-success");
                $('#ans3').removeClass("bg-success");
                $('#ans4').removeClass("bg-success");    
            }else if(correct_ans == "2"){
                $('#ans3').addClass("bg-success");
                $('#ans1').removeClass("bg-success");
                $('#ans2').removeClass("bg-success");
                $('#ans4').removeClass("bg-success");    
            }else{
                $('#ans4').addClass("bg-success");
                $('#ans1').removeClass("bg-success");
                $('#ans2').removeClass("bg-success");
                $('#ans3').removeClass("bg-success");    
            }*/

        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-AMS_HTML"></script>
    <script>
        // Function to initialize the DataTable
        function initializeDataTable() {
            var button = $('<button>', {
                text: 'See All/Less Questions',
                id: 'changeDataBtn',
                class: 'btn btn-primary mr-2',
            });
            var pdf = $('<button>', {
                text: 'Print/PDF',
                id: 'printPdf',
                class: 'btn btn-danger mr-2',
            });
            var update = $('<button>', {
                text: 'UpdateAll',
                id: 'updateButton',
                class: 'btn btn-success mr-2',
                css: {
                    display: 'none' // Adding display: none style
                }
            });

            var boolen = true;

            var dataTable = $('#myTable').DataTable({
                "lengthChange": true,
                "autoWidth": false,
                "lengthMenu": [
                    [25, 50, 100, 200, 500, -1],
                    [25, 50, 100, 200, 500, 'All']
                ],
            });

            // Append the button to the filter section after the table is initialized
            $('#myTable_wrapper .col-md-6:eq(0)').prepend(pdf);
            $('#myTable_wrapper .col-md-6:eq(0)').prepend(button);
            $('#myTable_wrapper .col-md-6:eq(0)').prepend(update);

            $(document).on('click', '#changeDataBtn', function() {
                boolen = !boolen; // Toggle the boolean value

                dataTable.destroy(); // Destroy the existing DataTable instance

                dataTable = $('#myTable').DataTable({
                    'paging': boolen, // Set paging based on the boolean value
                    "lengthChange": true,
                    "autoWidth": false,
                    "lengthMenu": [
                        [25, 50, 100, 200, 500, -1],
                        [25, 50, 100, 200, 500, 'All']
                    ],
                });

                // Re-append the button to ensure it's still visible
                $('#myTable_wrapper .col-md-6:eq(0)').prepend(pdf);
                $('#myTable_wrapper .col-md-6:eq(0)').prepend(button);
            });
        }

        $(document).on('click', '#printPdf', function() {
            var tableContent = $('#myTable').clone(); // Clone the table element

            // Remove elements with the class .notInclude from the cloned content
            tableContent.find('.notInclude').remove();

            var printWindow = window.open('', '', 'height=600,width=800');

            // Build the print window content with table borders
            printWindow.document.write('<html><head><title>Questions PDF</title>');
            printWindow.document.write('<style>');
            printWindow.document.write(
                'table, th, td { border: 1px solid black; border-collapse: collapse; padding: 5px; }'
            ); // Inline CSS for table borders
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(
                '<h2>Questions Table</h2>'); // Optional: add a heading to the printed document
            printWindow.document.write(tableContent.prop('outerHTML')); // Add the cloned and filtered table HTML
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
            printWindow.onafterprint = function() {
                printWindow.close();
            };
        });
        // Modify the content and initialize MathJax
        function updateEquationsInQuestion() {
            function modifiedString(item) {
                const originalString = item;
                const regex = /\$(.*?)\$/g;

                // Replace LaTeX-style $...$ with \(...\)
                const modifiedString1 = originalString.replace(regex, (match, p1) => {
                    return `\\(${p1}\\)`;
                });

                return modifiedString1;
            }

            // Iterate over each <td> element after the DOM is fully loaded
            document.querySelectorAll('tr td').forEach((td) => {
                const tdContent = td.innerHTML;
                // Apply modifiedString function to the content of each td
                const modifiedContent = modifiedString(tdContent);
                td.innerHTML = modifiedContent;
            });

            // Initialize MathJax and then initialize DataTable
            MathJax.Hub.Queue(function() {
                // Typeset the modified content
                MathJax.Hub.Typeset("td");
                // Initialize the DataTable after MathJax has finished
                //initializeDataTable();
            });



        }
    </script>
@endsection
