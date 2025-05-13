@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Branch</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <!-- Branch Form Column -->
                    <div class="col-md-4 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa-solid fa-calendar-plus"></i> &nbsp;Add Branch</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <form id="createCommon" >
                                  <input type='hidden' value='Branch' name='modal_type' />
                                  <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" />
                                    <div id="expense-container" class="bg-item mb-3 border p-3 rounded">
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                <label class="text-danger" for="branch_code">Branch Code*</label>
                                                <input type="text" class="form-control" name="branch_code"
                                                    id="branch_code" value="">
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label class="text-danger" for="branch_name">Branch Name*</label>
                                                <input type="text" class="form-control" id="branch_name"
                                                    name="branch_name">
                                            </div>
                                            <div class="col-sm-6 col-12 form-group">
                                                <label for="director">Contact Person</label>
                                                <input type="text" class="form-control " id="director" name="contact_person">
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label class="text-danger" for="mobile_no">Mobile Number*</label>
                                                <input type="text" class="form-control " id="mobile_no" name="mobile">
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label class="text-danger" for="email">Email*</label>
                                                <input type="text" class="form-control " id="email" name="email">
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label for="address">Address*</label>
                                                <input type="text" class="form-control" id="address" name="address">
                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label for="address" for="pin_code">Pin Code</label>
                                                <input type="text" class="form-control" id="pin_code" name="pin_code">
                                            </div>

                                            <div class="col-12 col-md-12 ">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Branch View Column -->
                    <div class="col-md-8 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4><i class="fa fa-list"></i> &nbsp;Branch List</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>Branch Code</th>
                                                <th>Branch Name</th>
                                                <th>Administrator</th>
                                                <th>Mobile No</th>
                                                <th>Email</th>
                                                <th>Pin Code</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="branch-list">

                                            <!-- Branch entries will be loaded here -->
                                            <tr>
                                                <td>1</td>
                                                <td>hello</td>
                                                <td>Prashant Sharma</td>
                                                <td>9876543210</td>
                                                <td>pspc@gmail.com</td>
                                                <td>302002</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="btn-xs">
                                                            <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
                                                        </a>
                                                        <a href="#" class=" btn-xs">
                                                            <i class="fa fa-trash fs-6 text-danger"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="mt-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><strong>Total:</strong></span>
                                                <input type="text" class="form-control" id="list_total" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
