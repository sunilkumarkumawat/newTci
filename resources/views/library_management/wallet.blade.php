@extends('layout.app')
@section('content')

<!-- Student Wallet Section -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Student Wallet</h4>
                </div>
                <div class="card-body">
                    <!-- Student Info and Balance -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Student Details</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Student ID:</th>
                                    <td>STD-2023-1458</td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td>John Smith</td>
                                </tr>
                                <tr>
                                    <th>Seat No:</th>
                                    <td>A01</td>
                                </tr>
                                <tr>
                                    <th>Contact Number:</th>
                                    <td>12345678</td>
                                </tr>
                            </table>
                            
                            
                            <div class="card border-info m-0" style="height: 36% !important">
                                <div class="card-body text-center advancePay">
                                    <h6 class="main">Total Advance Payment</h6>
                                    <h4 class="text-primary">₹8,075.75</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light h-100">
                                <div class="card-body text-center d-flex flex-column justify-content-center">
                                    <h5 class="card-title currentAmt">Current Wallet Balance</h5>
                                    <h1 class="text-success mb-0">₹12,350.75</h1>
                                    <p class="text-muted">Last Updated: May 9, 2025</p>
                                    <div class="mt-3">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-sm btn-outline-primary">Use for Library Fees</a>
                                            <a href="#" class="btn btn-sm btn-outline-success">Use for Extra Services like locker etc</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fee Payment Summary Removed From Here -->

                    <!-- Wallet Transactions -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="mb-3">Wallet Transactions</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Transaction Type</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>May 7, 2025</td>
                                            <td>Book Fine Payment</td>
                                            <td><span class="badge bg-danger">Debit</span></td>
                                            <td><span class="badge bg-secondary">General</span></td>
                                            <td>₹225</td>
                                        </tr>
                                        <tr>
                                            <td>May 2, 2025</td>
                                            <td>Extra Fee Payment (Remaining Balance)</td>
                                            <td><span class="badge bg-success">Credit</span></td>
                                            <td><span class="badge bg-warning text-dark">Extra Payment</span></td>
                                            <td>₹5,300</td>
                                        </tr>
                                        <tr>
                                            <td>April 20, 2025</td>
                                            <td>Printing Services</td>
                                            <td><span class="badge bg-danger">Debit</span></td>
                                            <td><span class="badge bg-secondary">General</span></td>
                                            <td>₹500</td>
                                        </tr>
                                        <tr>
                                            <td>April 15, 2025</td>
                                            <td>Book Reservation Fee</td>
                                            <td><span class="badge bg-danger">Debit</span></td>
                                            <td><span class="badge bg-secondary">General</span></td>
                                            <td>₹300</td>
                                        </tr>
                                        <tr>
                                            <td>April 10, 2025</td>
                                            <td>Advance Fee Payment (Exam Fee)</td>
                                            <td><span class="badge bg-success">Credit</span></td>
                                            <td><span class="badge bg-info">Advance Payment</span></td>
                                            <td>₹1,075.75</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <nav aria-label="Page navigation" class="mt-3">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <ul class="mb-0 ps-3">
                                    <li>Wallet funds can be used for library fees, printing, fines, and other services.</li>
                                    <li><span class="text-warning">Extra Payment</span>: Any extra fee payments will be automatically credited to your wallet.</li>
                                    <li><span class="text-info">Advance Payment</span>: Advance payments will be shown in your wallet.</li>
                                </ul>
                            </small>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="#" class="btn btn-sm btn-primary">Print Statement</a>
                            <a href="#" class="btn btn-sm btn-success ms-2">Deposit Fees</a>
                            <button type="button" class="btn btn-sm btn-outline-dark ms-2" data-bs-toggle="modal" data-bs-target="#transactionHistoryModal">
                                View Full History
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transaction History Modal -->
<div class="modal fade" id="transactionHistoryModal" tabindex="-1" aria-labelledby="transactionHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="transactionHistoryModalLabel">Wallet Transaction History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search transactions..." aria-label="Search transactions">
                        <button class="btn btn-outline-secondary" type="button">Search</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Transaction history table will be loaded here -->
                    <p class="text-center">Loading data...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Download Full History</button>
            </div>
        </div>
    </div>
</div>

<style>
    .main{
        color: aliceblue;
    }
    .amt{
        color: #d2e8ff !important;
    }
    .currentAmt{
        color: #d2e8ff;
    }
    .advancePay{
        background-color: #002c54 ;
    }
</style>
@endsection