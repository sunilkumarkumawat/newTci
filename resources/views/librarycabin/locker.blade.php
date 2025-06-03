@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Locker</li>
                        </ul>
                    </div>
                </div>
                {{-- locker assign --}}
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">Locker Assign</div>
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Payment Date</label>
                                        <input type="date" class="form-control" value="2025-05-02">
                                    </div>

                                    <div class="form-group">
                                        <label>User</label>
                                        <select class="form-control select2">
                                            <option>Select</option>
                                            <option value="1">123 -- John</option>
                                            <option value="2">124 -- Alice</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Locker Fee</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <input type="checkbox" id="locker_fees" checked>
                                                </span>
                                                <span class="input-group-text">RS</span>
                                            </div>
                                            <input type="number" class="form-control" id="locker_fees_amount"
                                                value="100">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Selected Locker:</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control w-25 mr-2" id="library_locker_name"
                                                readonly>
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#LockerModal">Select Locker</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Locker Renewal Date</label>
                                        <input type="date" class="form-control" id="lockerRenewalDate">
                                    </div>

                                    <div class="form-group">
                                        <label>Total Payable Amount</label>
                                        <input type="number" class="form-control" id="totalPayableAmount" value="100"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Payable Amount</label>
                                        <input type="text" class="form-control" id="amount" value="100">
                                    </div>

                                    <div class="form-group">
                                        <label>Dues Amount</label>
                                        <input type="number" class="form-control" id="duesAmount" value="0" readonly>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-success text-white">Time Slot</div>
                            <div class="card-body">
                                <p><strong>Morning</strong> | 3 Hours | Fee: Rs. 200 / Month | Filled Seats: 5 | Available:
                                    15</p>
                                <p><strong>Evening</strong> | 2 Hours | Fee: Rs. 150 / Month | Filled Seats: 8 | Available:
                                    12</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Locker Modal -->
                <div class="modal fade" id="LockerModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Select Locker</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><img src="https://www.walsisindia.com/library/images/safe-available.png" width="20">
                                    Locker 101 (Available)</p>
                                <p><img src="https://www.walsisindia.com/library/images/safe-occupied.png" width="20">
                                    Locker 102 (Occupied)</p>
                                <!-- You can simulate selection logic here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {
            $('#locker_fees').click(function() {
                let isChecked = $(this).prop('checked');
                let amount = parseFloat($('#locker_fees_amount').val()) || 0;
                let newDate = new Date();
                newDate.setDate(newDate.getDate() + 30);
                let formatted = newDate.toISOString().split('T')[0];

                if (isChecked) {
                    $('#totalPayableAmount').val(amount);
                    $('#amount').val(amount);
                    $('#lockerRenewalDate').val(formatted);
                } else {
                    $('#totalPayableAmount').val(0);
                    $('#amount').val(0);
                    $('#lockerRenewalDate').val('');
                }
                $('#duesAmount').val(0);
            });
        });
    </script>

    
@endsection
