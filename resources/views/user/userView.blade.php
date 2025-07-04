@extends('layout.app')

@section('content')
@php
    $permissions = Helper::getPermissions();
    $filterable_columns = ['role_id' => true, 'keyword' => true];
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            {{-- Breadcrumb --}}
            <div class="row">
                <div class="col-md-12 col-12 p-0">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">UserView</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="card card-outline card-orange col-md-12 col-12 p-0">
                    <div class="card-header bg-primary">
                        <div class="card-title">
                            <h4><i class="fa fa-desktop"></i> &nbsp;View User</h4>
                        </div>
                        <div class="card-tools">
                            @if(in_array('user_management.edit', $permissions) || Auth::user()->role_id == 1)
                                <a href="{{ url('userAdd') }}" class="btn btn-sm btn-light text-primary">
                                    <i class="fa fa-plus"></i>
                                    <span class="d-none d-sm-inline">{{ __('common.Add') }}</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="bg-item border p-3 rounded">
                            <form id="filterForm">
                                <div class="row">
                                    @include('commoninputs.filterinputs', ['filters' => $filterable_columns])
                                    <div class="col-md-1 mt-4">
                                        <button type="button" id="filterFormButton" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table id="userTable" class="table table-bordered table-striped mt-4">
                                <thead class="bg-light">
                                    <tr>
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
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals -->

            {{-- Change Status Modal --}}
            <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title">Change Status Confirmation</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to change status?
                            <input type="hidden" id="status_id">
                            <input type="hidden" id="id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Delete Modal --}}
            <div class="modal fade" id="Modal_id" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Confirmation</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                            <input type="hidden" id="delete_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Profile Image Preview Modal --}}
            <div class="modal fade" id="profileImgModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img id="profileImg" src="" class="img-fluid" alt="Profile Image">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>


<script>
    $(document).ready(function () {
        const table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('userData') }}",
                data: function (d) {
                    const formDataArray = [];
                    $('#filterForm').find('input, select, textarea').each(function () {
                        const name = $(this).attr('name');
                        const value = $(this).val();
                        if (name && value !== null && value !== '' && value !== undefined) {
                            formDataArray.push({ name, value });
                        }
                    });
                    d.filterable_columns = formDataArray;
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'role_name', name: 'role' },
                { data: 'name', name: 'name' },
                { data: 'mobile', name: 'mobile' },
                { data: 'email', name: 'email' },
                { data: 'gender', name: 'gender' },
                { data: 'dob', name: 'dob' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            drawCallback: function () {
                if (typeof updateEquationsInQuestion === 'function') {
                    updateEquationsInQuestion();
                }
            }
        });

        $('#filterFormButton').on('click', function () {
            table.ajax.reload();
        });

        $(document).on('click', '.profileImg', function () {
            const profileImgUrl = $(this).attr('src');
            if (profileImgUrl) {
                $('#profileImg').attr('src', profileImgUrl);
                $('#profileImgModal').modal('show');
            }
        });
    });
</script>


@endsection
