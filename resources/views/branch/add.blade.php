@extends('layout.app')
@section('content')
    @php
        $isEdit = isset($data);
    @endphp

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
                                <form id="createCommon" enctype="multipart/form-data">
                                    @if ($isEdit)
                                        <input type='hidden' value='{{ $data->id }}' name='id' />
                                    @endif
                                    <input type='hidden' value='Branch' name='modal_type' />
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label for="branch_code">Branch Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="branch_code" id="branch_code"
                                                placeholder="Enter Branch Code" data-required="true"
                                                value="{{ old('branch_code', $data->branch_code ?? '') }}" />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="name">Branch Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter Branch Name" data-required="true"
                                                value="{{ old('name', $data->name ?? '') }}" />
                                        </div>
                                        <div class="col-sm-6 col-12 form-group">
                                            <label for="director">Contact Person <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="contact_person"
                                                name="contact_person" data-required="true" placeholder="Enter Person Name"
                                                value="{{ old('contact_person', $data->contact_person ?? '') }}" />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="mobile" id="mobile"
                                                data-required="true" data-type="mobile" placeholder="Enter Mobile No"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ old('mobile', $data->mobile ?? '') }}" />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                placeholder="Enter Email" value="{{ old('email', $data->email ?? '') }}" />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Enter Address"
                                                value="{{ old('address', $data->address ?? '') }}" />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="pin_code">Pin Code</label>
                                            <input type="text" class="form-control" id="pin_code" name="pin_code"
                                                placeholder="Enter Pin Code"
                                                value="{{ old('pin_code', $data->pin_code ?? '') }}" />
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                                <th>Sr. No</th>
                                                <th>Branch Code</th>
                                                <th>Branch Name</th>
                                                <th>Person</th>
                                                <th>Mobile No</th>
                                                <th>Email</th>
                                                <th>Pin Code</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataContainer-branch" class='dataContainer'style="min-height:300px">
                                            @include('common.loadskeletan',['loopCount'=>6])
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
