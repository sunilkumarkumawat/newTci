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
                            <h3 class="card-title">Add Subscription Plan</h3>
                        </div>

                        <form action="library/time_slot" method="post">
                            <input type="hidden" name="_token" value="csrf_token_placeholder">
                            <div class="card-body">
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" data-toggle="datetimepicker" id="timepicker" name="start_time" />
                                            <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <div class="input-group date" id="timepicker_end1" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#timepicker_end" data-toggle="datetimepicker" id="timepicker_end" name="end_time" />
                                            <div class="input-group-append" data-target="#timepicker_end" data-toggle="datetimepicker">
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
                                        <input class="form-control" type="text" name="amount" id="amount" style="height: 38px;">
                                        <div class="input-group-append">
                                            <div class="input-group-text">.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Right Section - Updated with Subscription Management UI -->
                <div class="col-md-9">
                    <div class="card" style="background-color: #f4f4f4;">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white">Subscription Plan List</h3>
                        </div>
                        <div class="card-body" style="background-color: #f4f4f4;">
                            <!-- Subscription Plans in a Row -->
                            <div class="row subscription-plans-container">
                                <!-- Basic Plan -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card mb-3 subscription-plan-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="font-weight-bold">Subscription Plan</h5>
                                                    <p class="text-muted mb-0">10:00 AM to 10:00 PM</p>
                                                </div>
                                                <div class="text-right">
                                                    <h4 class="font-weight-bold">₹200<span class="text-muted">/month</span></h4>
                                                    <!-- <small class="text-muted">2 active members</small> -->
                                                </div>
                                            </div>
                                            
                                            <hr>
                                            
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> 2 active member</li>
                                                        <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> Access to reading rooms (2 hours/day)</li>
                                                        <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> Online reservation system</li>
                                                        <!-- <li class="mb-2"><i class="fa fa-times text-muted mr-2"></i> Access to digital library</li> -->
                                                    </ul>
                                                </div>
                                                <div class="col-md-12 col-sm-12 d-flex align-items-end action-buttons">
                                                    <button class="btn btn-outline-primary action-btn mr-2">Edit</button>
                                                    <button class="btn btn-outline-danger action-btn">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Premium Plan -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card mb-3 subscription-plan-card">
                                        <div class="card-body">
                                            <!-- <div class="badge badge-primary float-right">Popular</div> -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="font-weight-bold">Subscription Plan</h5>
                                                    <p class="text-muted mb-0">10:00 AM to 10:00 PM</p>
                                                </div>
                                                <div class="text-right">
                                                    <h4 class="font-weight-bold">₹200<span class="text-muted">/month</span></h4>
                                                    <!-- <small class="text-muted">1 active member</small> -->
                                                </div>
                                            </div>
                                            
                                            <hr>
                                            
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> 1 active member</li>
                                                        <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> Unlimited access to reading rooms</li>
                                                        <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> Priority reservation system</li>
                                                        <!-- <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> Full access to digital library</li> -->
                                                    </ul>
                                                </div>
                                                <div class="col-md-12 col-sm-12 d-flex align-items-end action-buttons">
                                                    <button class="btn btn-outline-primary action-btn mr-2">Edit</button>
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

<style>
    .card-title {
        font-size: 1.2rem;
        font-weight: 400;
        margin: 0;
    }
    
    .badge-primary {
        background-color: #4e73df;
        color: white;
        padding: 0.25em 0.5em;
        font-size: 0.75em;
        border-radius: 0.25rem;
    }
    
    .text-success {
        color: #1cc88a !important;
    }
    
    .text-muted {
        color: #858796 !important;
    }
    
    /* Fixed size for subscription plan cards */
    .subscription-plan-card {
        height: 280px;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Optimized button size */
    .action-btn {
        padding: 6px 12px;
        font-size: 0.9rem;
        min-width: 60px;
        margin-bottom: 10px;
    }
    
    /* For button container */
    .action-buttons {
        justify-content: flex-end;
    }
    
    /* Media queries for responsiveness */
    @media (max-width: 1199px) {
        .subscription-plan-card {
            height: 300px; /* Slightly taller on medium screens */
        }
    }
    
    @media (max-width: 991px) {
        .subscription-plan-card {
            height: 320px; /* Taller on small screens */
        }
        
        .action-btn {
            padding: 5px 10px;
            font-size: 0.85rem;
        }
    }
    
    @media (max-width: 767px) {
        .subscription-plan-card {
            height: auto; /* Auto height on mobile */
            margin-bottom: 20px;
        }
        
        .col-md-4, .col-md-8 {
            width: 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .action-buttons {
            margin-top: 15px;
            justify-content: flex-start !important;
            width: 100%;
            display: flex;
        }
        
        .action-btn {
            flex: 1;
            text-align: center;
        }
    }
    
    @media (max-width: 575px) {
        .card-body {
            padding: 15px;
        }
        
        h5.font-weight-bold, h4.font-weight-bold {
            font-size: 1rem;
        }
        
        .text-muted {
            font-size: 0.85rem;
        }
        
        ul.list-unstyled li {
            font-size: 0.9rem;
        }
        
        .d-flex.justify-content-between {
            flex-direction: column;
        }
        
        .d-flex.justify-content-between .text-right {
            margin-top: 10px;
            text-align: left !important;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .action-btn {
            width: 100%;
            margin-right: 0 !important;
        }
    }
    
    /* For smaller form on mobile */
    @media (max-width: 767px) {
        .col-md-3 {
            margin-bottom: 20px;
        }
    }
</style>

@endsection