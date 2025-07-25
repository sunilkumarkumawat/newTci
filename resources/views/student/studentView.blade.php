@extends('layout.app')
@section('content')
    @php
        $permissions = Helper::getPermissions();
        $filterable_columns = ['branch' => true, 'keyword' => true];
        $data = isset($data) ? $data : [];
    @endphp


    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12 p-0">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">StudentView</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="card card-outline card-orange col-md-12 col-12 p-0">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h4><i class="fa fa-desktop"></i>
                                    &nbsp;{{ empty($data) ? 'View Student' : 'Uploaded Data By Excel' }}</h4>
                            </div>
                            <div class="card-tools">
                                @if (in_array('student_management.`add`', $permissions) || Auth::user()->role_id == 1)
                                    <a href="{{ url('studentAdd') }}"
                                        class="student_management.add btn btn-primary  btn-sm"><i class="fa fa-plus"></i>
                                        <span class="Display_none_mobile"> {{ __('common.Add') }} </span></a>
                                @endif

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bg-item border p-3 rounded">
                                @if (empty($data))
                                    {{-- Filter for all student data --}}
                                    <form id="studentFilterForm" method="post">
                                        <div class="row">
                                            @include('commoninputs.filterinputs', [
                                                'filters' => $filterable_columns,
                                            ])
                                            <div class="col-md-1 mt-4">
                                                <button type="submit" id="studentFilterFormButton"
                                                    class="btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    {{-- Filter only for Excel uploaded data --}}
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="globalClass" class="form-label">Select Class</label>
                                            @include('commoninputs.inputs', [
                                                'modal' => 'Batches',
                                                'name' => 'global_class_type_id', // give a unique name
                                                'selected' => null,
                                                'label' => false,
                                                'required' => false,
                                                'className' => 'form-control global-class-type',
                                                'recordId' => null,
                                            ])
                                        </div>

                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" id="applyClassToAllBtn" class="btn btn-primary">
                                                Apply to All
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Table Section --}}
                            <div class="table-responsive mt-3">
                                <table id="studentTable" class="table table-bordered table-striped mt-1">
                                    <thead>
                                        <tr class="bg-light">
                                            <th>SR.NO</th>
                                            <th class="text-center">Image</th>
                                            @if (empty($data))
                                                <th>Admission No</th>
                                            @endif
                                            <th>Name</th>
                                            <th>Batch</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @include('student.view', ['data' => $data])
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modals -->
            <div class="modal fade" id="statusModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="background: #555b5beb;">
                        <div class="modal-header">
                            <h5 class="modal-title text-white">Change Status Confirmation</h5>
                            <button type="button" class="close text-white" data-dismiss="modal"><i
                                    class="fa fa-times"></i></button>
                        </div>
                        <div class="modal-body text-white">
                            Are you sure you want to change status?
                            <input type="hidden" id="status_id">
                            <input type="hidden" id="id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="Modal_id">
                <div class="modal-dialog">
                    <div class="modal-content" style="background: #555b5beb;">
                        <div class="modal-header">
                            <h5 class="modal-title text-white">Delete Confirmation</h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal"><i
                                    class="fa fa-times"></i></button>
                        </div>
                        <div class="modal-body text-white">
                            Are you sure you want to delete?
                            <input type="hidden" id="delete_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="profileImgModal" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close text-dark" data-bs-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <img id="profileImg" src="" width="100%" height="100%">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @if (empty($data))
        <script>
            $(document).ready(function() {
                const table = $('#studentTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('studentData') }}",
                        data: function(d) {
                            const formDataArray = [];
                            $('#studentFilterForm').find('input, select, textarea').each(function() {
                                const name = $(this).attr('name');
                                const value = $(this).val();
                                if (name && value !== null && value !== '' && value !== undefined) {
                                    formDataArray.push({
                                        name,
                                        value
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
                        },
                        {
                            data: 'image',
                            name: 'image',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'admissionNo',
                            name: 'admission_no'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'batch',
                            name: 'batch'
                        },
                        {
                            data: 'mobile',
                            name: 'mobile'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'gender',
                            name: 'gender'
                        },
                        {
                            data: 'dob',
                            name: 'dob'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    drawCallback: function() {
                        if (typeof updateEquationsInQuestion === 'function') {
                            updateEquationsInQuestion();
                        }
                    }
                });

                // Reload DataTable on filter button click
                $('#studentFilterFormButton').on('click', function(e) {
                    e.preventDefault();
                    table.ajax.reload();
                });

                // Show student image in modal
                $(document).on('click', '.profileImg', function() {
                    const profileImgUrl = $(this).attr('src');
                    if (profileImgUrl) {
                        $('#profileImg').attr('src', profileImgUrl);
                        $('#profileImgModal').modal('show');
                    }
                });
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            // When "Apply to All" or Class is changed
            $('#applyClassAll, #globalClass').on('change', function() {
                const applyToAll = $('#applyClassAll').val();
                const selectedClass = $('#globalClass').val();

                // If "Apply to All" is "yes" and class is selected
                if (applyToAll === 'yes' && selectedClass) {
                    // Loop through each class_type_id select in table
                    $('select[name="class_type_id"]').each(function() {
                        $(this).val(selectedClass).trigger('change');
                    });
                }
            });

            // Optional: clear filter if needed when user resets form
            $('#studentFilterForm').on('reset', function() {
                $('#globalClass').val('');
                $('#applyClassAll').val('');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#applyClassToAllBtn').on('click', function() {
                const selectedClass = $('select[name="global_class_type_id"]').val();

                if (!selectedClass) {
                    alert('Please select a class first.');
                    return;
                }

                $('select[name="class_type_id"]').each(function() {
                    $(this).val(selectedClass).trigger('change');
                });
            });
        });
    </script>
@endsection
