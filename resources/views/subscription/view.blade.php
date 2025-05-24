@if (!empty($data))
    @foreach ($data as $subscription)
        {{-- basic plan --}}
        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
            <div class="card mb-3 subscription-plan-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold">{{$subscription->plan_name}}</h4>
                            <p class="text-muted m-0 fs-5">{{$subscription->start_time}} AM to {{$subscription->end_time}} PM</p>
                        </div>
                        <div class="text-right">
                            <h4 class="font-weight-bold">₹{{$subscription->amount}}<span class="text-muted">/month</span></h4>
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
                            <button class="btn btn-outline-primary action-btn mr-2">Edit</button>
                            <button class="btn btn-outline-danger action-btn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
