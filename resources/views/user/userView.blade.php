@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
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
                                <a href="{{ url('userAdd') }}" class="btn btn-primary  btn-sm"><i class="fa fa-plus"></i>
                                    <span class="Display_none_mobile"> {{ __('common.Add') }} </span></a>
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
                                <table class="table table-bordered table-striped mt-4">
                                     <input type='hidden' value="User" name='modal_type'/>
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
                                    <tbody id="dataContainer-user">
                                       
                                      
                                    </tbody>
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


    {{-- style css --}}

    <style>

    </style>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            $('.profileImg').click(function() {
                var profileImgUrl = $(this).attr('src');
                if (profileImgUrl) {
                    $('#profileImgModal').modal('show');
                    $('#profileImg').attr('src', profileImgUrl);
                }
            });
        });
    </script>
@endsection
