@if (!empty($data) && count($data) > 0)

@foreach ($data as $subscription)
        {{-- basic plan --}}


  @php
    $durationText = '';
    $startFormatted = '';
    $endFormatted = '';

    if (!empty($subscription->start_time) && !empty($subscription->end_time)) {
        $start = \Carbon\Carbon::parse($subscription->start_time);
        $end = \Carbon\Carbon::parse($subscription->end_time);

        // Format time in 12-hour with AM/PM
        $startFormatted = $start->format('h:i A');
        $endFormatted = $end->format('h:i A');

        // Get duration
        if ($end->gt($start)) {
            $diff = $start->diff($end);
            $durationText = '(';
            if ($diff->h > 0) {
                $durationText .= $diff->h . ' hour' . ($diff->h > 1 ? 's' : '');
            }
            if ($diff->i > 0) {
                $durationText .= ($diff->h > 0 ? ' ' : '') . $diff->i . ' minute' . ($diff->i > 1 ? 's' : '');
            }
            $durationText .= '/day)';
        }
    }
@endphp



        <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
            <div class="card mb-3 subscription-plan-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold">{{$subscription->plan_name}} (BranchId : {{$subscription->branch_id}})</h4>
                         <p class="text-muted m-0 fs-5">
    {{ $startFormatted }} to {{ $endFormatted }}
</p>
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
                                    1 active member</li>
                             <li class="fs-6">
    <i class="fa fa-check text-success mr-2"></i>
    Access to reading rooms {!! $durationText !!} <br>
  
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
    @else
      @include('common.noDataFound')
@endif
