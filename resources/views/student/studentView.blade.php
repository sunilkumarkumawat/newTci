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
                            <li class="breadcrumb-item">StudentView</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="card card-outline card-orange col-md-12 col-12 p-0">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h4><i class="fa fa-desktop"></i> &nbsp;View Student</h4>
                            </div>
                            <div class="card-tools">
                                <a href="{{ url('studentAdd') }}" class="btn btn-primary  btn-sm"><i class="fa fa-plus"></i>
                                    <span class="Display_none_mobile"> {{ __('common.Add') }} </span></a>
                                {{-- <a href="{{ url('studentAdd') }}" class="btn btn-primary  btn-sm"><i
                                        class="fa fa-arrow-left"></i> <span class="Display_none_mobile"> {{ __('common.Back') }}
                                    </span></a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bg-item border p-3 rounded">

                                <form id="quickForm" method="post">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>Search By Registration No</label>
                                            <input type="text" class="form-control" id="registration_no"
                                                name="registration_no" placeholder="Registration No" value="">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Search By Keywords</label>
                                            <input type="text" class="form-control"
                                                placeholder="Ex. Name, Mobile, Email, Aadhaar etc.">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Search By Desk No</label>
                                            <input type="number" class="form-control" id="desk_no" name="registration_no"
                                                placeholder="Desk No" value="">
                                        </div>

                                        <div class="col-md-1 mt-4">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mt-4">
                                    <thead>
                                        <tr class="bg-light">
                                            <th>SR.NO</th>
                                            <th class="text-center">Image</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>E-Mail</th>
                                            <th>Admission Date</th>
                                            <th>City</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Sample Static Row -->


                                        @if(!empty($student))
                                        @foreach ($student as $index => $studentAdd)

                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="text-center">
                                                <img src="{{ $studentAdd->image ? url('public/' . $studentAdd->image) : url('images/default_user_image.jpg') }}" class="profileImg" alt="User Image">
                                            </td>
                                            <td>{{ $studentAdd -> student_name ?? '' }}</td>
                                            <td>{{ $studentAdd -> mobile ?? '' }}</td>
                                            <td>{{ $studentAdd -> email ?? '' }}</td>
                                            <td>{{ $studentAdd -> admission_date ?? '' }}</td>
                                            <td>{{ $studentAdd -> city_id ?? '' }}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm w-75">Active</button>
                                            </td>
                                            <td>
                                                <a href="{{ url('studentEdit') }}" class="btn-xs"><i
                                                        class="fa fa-edit text-primary"></i></a>
                                                <a class=" btn-xs delete-btn" data-modal="admission" data-id="{{$studentAdd->id}}">
                                                    <i class="fa fa-trash fs-6 text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach 
                                        @endif
                                        <!-- Add more rows as needed -->
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
