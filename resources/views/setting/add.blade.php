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
                            <li class="breadcrumb-item">Setting</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    
                    @if ($isEdit)
                    <div class="col-md-12 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa fa-cog"></i> &nbsp; Edit Setting</h4>
                                </div>
                                <div class="card-tools">
                                    <a href="{{ url('setting') }}" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i>
                                    <span class="Display_none_mobile"> {{ __('common.View') }} </span></a>
                            
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <form id="createCommon" data-modal="Setting">
                                    
                                        <input type='hidden' value='{{ $data->id }}' name='id' />
                                    
                                    <input type='hidden' value='Setting' name='modal_type' />
                                    <!-- <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" /> -->
                                    <!-- <input type='hidden' id="branch_id" name='branch_id' /> -->
                                    <div id="expense-container" class="bg-item mb-3 border p-3 rounded">
                                        <div class="row">
                                            <div class="col-md-3 col-12 form-group">
                                                <label for="name"> Institute Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Institute Name" data-required='true'
                                                 value="{{ old('name', $data->name ?? '') }}">     
                                            </div>
                                            <div class="col-md-3 col-12 form-group">
                                                <label for="mobile"> Mobile No.<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile No." data-required='true'
                                                 value="{{ old('mobile', $data->mobile ?? '') }}">     
                                            </div>
                                            <div class="col-md-3 col-12 form-group">
                                                <label for="gmail"> Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="gmail" name="gmail" placeholder="Enter Email Address" data-required='true'
                                                 value="{{ old('gmail', $data->gmail ?? '') }}">     
                                            </div>
                                            <div class="col-md-3">
                                                @include('commoninputs.dependentInputs', [
                                                    'modal' => 'State',
                                                    'name' => 'state_id',
                                                    'selected' => $data->state_id ?? null,
                                                    'label' => 'State',
                                                    'required' => false,
                                                    'isRequestSent' => 101,
                                                    'dependentId' => 101,
                                                    'foreignKey' => 'country_id',
                                                    'attributes' => [
                                                        'data-dependent' => 'city_id',
                                                        'data-url' => url('/get-dependent-options'),
                                                        'data-modal' => 'City',
                                                        'data-field' => 'state_id',
                                                    ],
                                                ])
                                            </div>
                                            <div class="col-md-3">
                                                @include('commoninputs.dependentInputs', [
                                                    'modal' => 'City',
                                                    'name' => 'city_id',
                                                    'selected' => $data->city_id ?? null,
                                                    'label' => 'City',
                                                    'required' => false,
                                                    'isRequestSent' => isset($data->state_id),
                                                    'dependentId' => $data->state_id ?? null,
                                                    'foreignKey' => 'state_id',
                                                ])
                                            </div>
                                            <div class="col-md-3 col-12 form-group">
                                                <label for="address"> Address <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" data-required='true'
                                                 value="{{ old('address', $data->address ?? '') }}">     
                                            </div>
                                            <div class="col-md-3">
                                                @include('commoninputs.inputs', [
                                                    'modal' => 'Sessions', // This decides the data source
                                                    'name' => 'current_active_session_id',
                                                    'selected' => $data->current_active_session_id ?? null,
                                                    'label' => 'Current Active Session',
                                                    'required' => false,
                                                ])
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Photo</label>
                                                    <input type="file" class="form-control" accept="image/*"
                                                        id="left_logo" name="left_logo">
                                                    {{-- Note: old value doesn't apply for file inputs --}}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12 m-1 text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  
                    @else
                    
                    <input type='hidden' value='Setting' name='modal_type' />
                    <!-- Setting View Column -->
                    <div class="col-md-12 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4><i class="fa fa-cog"></i> &nbsp;View Setting</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id='dataContainer'class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>SR. NO.</th>
                                                <th>Logo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataContainer-setting" class='dataContainer'style="min-height:300px">
                                           @include('common.loadskeletan',['loopCount'=>1])
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
               
                </div>
            </div>
        </section>
    </div>
@endsection
