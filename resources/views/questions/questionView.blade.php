@extends('layout.app')
@section('content')

@php
    $permissions = Helper::getPermissions();
@endphp

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12 p-0">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Question Bank</li>
                            <li class="breadcrumb-item">Question List</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="card card-outline card-orange col-md-12 col-12 p-0">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h4><i class="fa fa-desktop"></i> &nbsp;View Questions</h4>
                            </div>
                            <div class="card-tools">
                                @if(in_array('user_management.edit', $permissions)  || Auth::user()->role_id == 1)
                                <a href="{{ url('questions') }}" class="btn btn-primary  btn-sm"><i class="fa fa-plus"></i>
                                    <span class="Display_none_mobile"> {{ __('common.Add') }} </span></a>
                                @endif
                                {{-- <a href="{{ url('userDashboard') }}" class="btn btn-primary  btn-sm"><i
                                        class="fa fa-arrow-left"></i> <span class="Display_none_mobile">
                                        {{ __('common.Back') }}
                                    </span></a> --}}
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="bg-item border p-3 rounded">
                                <form id="quickForm" method="post" action="#">
                                    <div class="row">
                                        <div class="col-md-2 col-12">
                                            <label>Search By Role</label>
                                            <select class="form-control">
                                                <option>Select</option>
                                                <option>Admin</option>
                                                <option>Teacher</option>
                                                <option>Student</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <label>Search By Keywords</label>
                                            <input type="text" class="form-control"
                                                placeholder="Ex. Name, Mobile, Email, Aadhaar etc.">
                                        </div>

                                        <div class="col-md-1 col-12 mt-4">
                                            <button type="button" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table id='questionTable' class="table table-bordered table-striped mt-4">
                                    <input type='hidden' value="Question" name='modal_type' />
                                    <thead>
                                        <tr class="bg-light">
                                            <th>SR.NO</th>
                                            <th class="text-center">Image</th>
                                            <th>Role</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>E-Mail</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                </table>
                                <script>
                                        $(function() {
                                            $('#questionTable').DataTable({
                                                processing: true,
                                                serverSide: true,
                                                ajax: "{{url('questionData')}}", // <-- Update to your chapters data route
                                                columns: [{
                                                        data: 'DT_RowIndex',
                                                        name: 'DT_RowIndex',
                                                        orderable: false,
                                                        searchable: false
                                                    }, // For SR. NO.
                                                    {
                                                        data: 'name',
                                                        name: 'name'
                                                    },
                                                    {
                                                        data: 'class_name',
                                                        name: 'class_name'
                                                    },
                                                    {
                                                        data: 'subject_name',
                                                        name: 'subject_name'
                                                    }, // Chapter Name
                                                    {
                                                        data: 'chapter_name',
                                                        name: 'chapter_name'
                                                    },
                                                    {
                                                        data: 'action',
                                                        name: 'action',
                                                        orderable: false,
                                                        searchable: false
                                                    }
                                                ]
                                            });
                                        });
                                    </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>


@endsection
