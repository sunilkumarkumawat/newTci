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

                            <form action="library/time_slot" method="post">
                                <input type="hidden" name="_token" value="csrf_token_placeholder">
                                <div class="card-body">
                                    <div class="col-md-12 col-12 p-0">
                                         <div class="form-group">
                                            <label for="plan_name">Plan Name</label>
                                            <input type="text" class="form-control" id="plan_name" name="plan_name">
                                         </div>
                                    </div>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#timepicker" data-toggle="datetimepicker" id="timepicker" name="start_time" />
                                                <div class="input-group-append" data-target="#timepicker"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <div class="input-group date" id="timepicker_end1" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#timepicker_end" data-toggle="datetimepicker"
                                                    id="timepicker_end" name="end_time" />
                                                <div class="input-group-append" data-target="#timepicker_end"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Fee Amount/Month</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Rs.
                                                </span>
                                            </div>
                                            <input class="form-control" type="text" name="amount" id="amount">
                                            <div class="input-group-append">
                                                <div class="input-group-text">.00</div>
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
                                <div class="row subscription-plans-container">

                                    {{-- basic plan --}}
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                        <div class="card mb-3 subscription-plan-card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="font-weight-bold">Platinum</h4>
                                                        <p class="text-muted m-0 fs-5">10:00 AM to 10:00 PM</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <h4 class="font-weight-bold">₹200<span
                                                                class="text-muted">/month</span></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <ul class="list-unstyled">
                                                            <li class="fs-6"><i class="fa fa-check text-success mr-2"></i>
                                                                2 active member</li>
                                                            <li class="fs-6"><i class="fa fa-check text-success mr-2"></i>
                                                                Access to
                                                                reading rooms (2 hours/day)</li>
                                                            <li class="fs-6"><i class="fa fa-check text-success mr-2"></i>
                                                                Online reservation system
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 d-flex align-items-end action-buttons">
                                                        <button
                                                            class="btn btn-outline-primary action-btn mr-2">Edit</button>
                                                        <button class="btn btn-outline-danger action-btn">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Premium/gold Plan -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                        <div class="card mb-3 subscription-plan-card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="font-weight-bold">Gold</h4>
                                                        <p class="text-muted mb-0 fs-5">10:00 AM to 10:00 PM</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <h4 class="font-weight-bold">₹300<span
                                                                class="text-muted">/month</span></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <ul class="list-unstyled">
                                                            <li class="fs-6"><i
                                                                    class="fa fa-check text-success mr-2"></i> 1 active
                                                                member</li>
                                                            <li class="fs-6"><i
                                                                    class="fa fa-check text-success mr-2"></i>
                                                                Access to reading rooms(5hr/day)</li>
                                                            <li class="fs-6"><i
                                                                    class="fa fa-check text-success mr-2"></i>
                                                                Priority reservation system</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 d-flex align-items-end action-buttons">
                                                        <button
                                                            class="btn btn-outline-primary action-btn mr-2">Edit</button>
                                                        <button class="btn btn-outline-danger action-btn">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- diamond Plan -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                        <div class="card mb-3 subscription-plan-card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="font-weight-bold">Diamond</h4>
                                                        <p class="text-muted mb-0 fs-5">10:00 AM to 10:00 PM</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <h4 class="font-weight-bold">₹500<span
                                                                class="text-muted">/month</span></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <ul class="list-unstyled">
                                                            <li class="fs-6"><i
                                                                    class="fa fa-check text-success mr-2"></i> 3 active
                                                                member</li>
                                                            <li class="fs-6"><i
                                                                    class="fa fa-check text-success mr-2"></i>
                                                                Unlimited access to reading rooms</li>
                                                            <li class="fs-6"><i
                                                                    class="fa fa-check text-success mr-2"></i>
                                                                Priority reservation system</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 d-flex align-items-end action-buttons">
                                                        <button
                                                            class="btn btn-outline-primary action-btn mr-2">Edit</button>
                                                        <button class="btn btn-outline-danger action-btn">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
