@extends('layout.app')
@section('content')
    <!-- Original structure maintained, PHP syntax removed -->
    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                <div class="row">

                    <!-- Left Section -->
                    <div class="col-md-3">
                        <div class="card card-primary">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4>Add Subscription Plan</h4>
                                </div>
                            </div>

                            <form id="createCommon" enctype="multipart/form-data">
                                <input type='hidden' value='Subscription' name='modal_type' />
                                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" />
                                <input type='hidden' id="branch_id" name='branch_id' value="{{Auth::user()->selectedBranchId}}"/>
                                <div class="card-body">
                                    <div class="col-md-12 col-12 ">
                                        <div class="form-group">
                                            <label for="plan_name">Plan Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="plan_name" name="plan_name" placeholder="Enter plan Name" data-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="start_time">Start Time<span class="text-danger">*</span></label>
                                            <div class="input-group " >
                                                <input type="time" class="form-control"
                                                     id="start_time" name="start_time" />
                                                    
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="end_time">End Time<span class="text-danger">*</span></label>
                                            <div class="input-group date">
                                                <input type="time" class="form-control"
                                                    id="end_time" name="end_time" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="amount">Fee Amount/Month<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Rs.
                                                </span>
                                            </div>
                                            <input class="form-control" type="text" name="amount" id="amount" data-required="true">
                                            <div class="input-group-append">
                                                <div class="input-group-text">.00</div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="col-md-12 col-12 p-0">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!-- Right Section - Updated with Subscription Management UI -->
                    <div class="col-md-9">
                        <div class="card" style="background-color: #f4f4f4;">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4>Subscription Plan List</h4>
                                </div>
                            </div>
                            <div class="card-body" style="background-color: #f4f4f4;">
                                <!-- Subscription Plans in a Row -->
                                <div class="row subscription-plans-container" id="dataContainer-subscription">

                                   

                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
