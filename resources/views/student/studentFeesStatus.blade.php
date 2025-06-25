@extends('layout.app')
@section('content')

@php
$permissions = Helper::getPermissions();

// Static fee statistics
$feeStats = [
    'paid_full' => 45,
    'partial_paid' => 23,
    'pending' => 12,
    'installment' => 18
];

// Static students data
$students = collect([
    (object)[
        'id' => 1,
        'student_id' => 'STU001',
        'first_name' => 'Rahul',
        'last_name' => 'Sharma',
        'email' => 'rahul.sharma@example.com',
        'profile_image' => null,
        'class' => (object)['name' => 'Class 10'],
        'section' => (object)['name' => 'A'],
        'total_fee' => 25000,
        'paid_amount' => 25000,
        'payment_plan' => 'full',
        'last_payment_method' => 'online',
        'last_payment_date' => '2024-03-15',
        'last_payment_amount' => 25000,
        'due_date' => '2024-04-15'
    ],
    (object)[
        'id' => 2,
        'student_id' => 'STU002',
        'first_name' => 'Priya',
        'last_name' => 'Singh',
        'email' => 'priya.singh@example.com',
        'profile_image' => null,
        'class' => (object)['name' => 'Class 9'],
        'section' => (object)['name' => 'B'],
        'total_fee' => 22000,
        'paid_amount' => 15000,
        'payment_plan' => 'installment',
        'last_payment_method' => 'cash',
        'last_payment_date' => '2024-03-10',
        'last_payment_amount' => 7500,
        'due_date' => '2024-04-10'
    ],
    (object)[
        'id' => 3,
        'student_id' => 'STU003',
        'first_name' => 'Amit',
        'last_name' => 'Kumar',
        'email' => 'amit.kumar@example.com',
        'profile_image' => null,
        'class' => (object)['name' => 'Class 11'],
        'section' => (object)['name' => 'A'],
        'total_fee' => 28000,
        'paid_amount' => 0,
        'payment_plan' => 'full',
        'last_payment_method' => null,
        'last_payment_date' => null,
        'last_payment_amount' => 0,
        'due_date' => '2024-03-20'
    ],
    (object)[
        'id' => 4,
        'student_id' => 'STU004',
        'first_name' => 'Sneha',
        'last_name' => 'Gupta',
        'email' => 'sneha.gupta@example.com',
        'profile_image' => null,
        'class' => (object)['name' => 'Class 12'],
        'section' => (object)['name' => 'C'],
        'total_fee' => 30000,
        'paid_amount' => 20000,
        'payment_plan' => 'installment',
        'last_payment_method' => 'online',
        'last_payment_date' => '2024-03-05',
        'last_payment_amount' => 10000,
        'due_date' => '2024-04-05'
    ],
    (object)[
        'id' => 5,
        'student_id' => 'STU005',
        'first_name' => 'Vikash',
        'last_name' => 'Yadav',
        'email' => 'vikash.yadav@example.com',
        'profile_image' => null,
        'class' => (object)['name' => 'Class 8'],
        'section' => (object)['name' => 'A'],
        'total_fee' => 20000,
        'paid_amount' => 5000,
        'payment_plan' => 'installment',
        'last_payment_method' => 'cash',
        'last_payment_date' => '2024-02-28',
        'last_payment_amount' => 5000,
        'due_date' => '2024-03-28'
    ],
    (object)[
        'id' => 6,
        'student_id' => 'STU006',
        'first_name' => 'Kavya',
        'last_name' => 'Patel',
        'email' => 'kavya.patel@example.com',
        'profile_image' => null,
        'class' => (object)['name' => 'Class 10'],
        'section' => (object)['name' => 'B'],
        'total_fee' => 25000,
        'paid_amount' => 25000,
        'payment_plan' => 'full',
        'last_payment_method' => 'online',
        'last_payment_date' => '2024-03-12',
        'last_payment_amount' => 25000,
        'due_date' => '2024-04-12'
    ],
    (object)[
        'id' => 7,
        'student_id' => 'STU007',
        'first_name' => 'Rohit',
        'last_name' => 'Jain',
        'email' => 'rohit.jain@example.com',
        'profile_image' => null,
        'class' => (object)['name' => 'Class 9'],
        'section' => (object)['name' => 'A'],
        'total_fee' => 22000,
        'paid_amount' => 0,
        'payment_plan' => 'full',
        'last_payment_method' => null,
        'last_payment_date' => null,
        'last_payment_amount' => 0,
        'due_date' => '2024-03-25'
    ],
    (object)[
        'id' => 8,
        'student_id' => 'STU008',
        'first_name' => 'Anita',
        'last_name' => 'Verma',
        'email' => 'anita.verma@example.com',
        'profile_image' => null,
        'class' => (object)['name' => 'Class 11'],
        'section' => (object)['name' => 'B'],
        'total_fee' => 28000,
        'paid_amount' => 14000,
        'payment_plan' => 'installment',
        'last_payment_method' => 'online',
        'last_payment_date' => '2024-03-08',
        'last_payment_amount' => 7000,
        'due_date' => '2024-04-08'
    ],
    (object)[
        'id' => 9,
        'student_id' => 'STU009',
        'first_name' => 'Deepak',
        'last_name' => 'Mishra',
        'email' => 'deepak.mishra@example.com',
        'profile_image' => null,
        'class' => (object)['name' => 'Class 12'],
        'section' => (object)['name' => 'A'],
        'total_fee' => 30000,
        'paid_amount' => 30000,
        'payment_plan' => 'full',
        'last_payment_method' => 'cash',
        'last_payment_date' => '2024-03-18',
        'last_payment_amount' => 15000,
        'due_date' => '2024-04-18'
    ],
    (object)[
        'id' => 10,
        'student_id' => 'STU010',
        'first_name' => 'Meera',
        'last_name' => 'Agarwal',
        'email' => 'meera.agarwal@example.com',
        'profile_image' => null,
        'class' => (object)['name' => 'Class 8'],
        'section' => (object)['name' => 'B'],
        'total_fee' => 20000,
        'paid_amount' => 8000,
        'payment_plan' => 'installment',
        'last_payment_method' => 'online',
        'last_payment_date' => '2024-03-02',
        'last_payment_amount' => 4000,
        'due_date' => '2024-04-02'
    ]
]);

// Static installment students data
$installmentStudents = collect([
    (object)[
        'id' => 2,
        'first_name' => 'Priya',
        'last_name' => 'Singh',
        'student_id' => 'STU002',
        'installment_plan' => 'quarterly',
        'total_installments' => 4,
        'completed_installments' => 2,
        'next_due_date' => '2024-04-10',
        'next_installment_amount' => 7500
    ],
    (object)[
        'id' => 4,
        'first_name' => 'Sneha',
        'last_name' => 'Gupta',
        'student_id' => 'STU004',
        'installment_plan' => 'monthly',
        'total_installments' => 6,
        'completed_installments' => 4,
        'next_due_date' => '2024-04-05',
        'next_installment_amount' => 5000
    ],
    (object)[
        'id' => 5,
        'first_name' => 'Vikash',
        'last_name' => 'Yadav',
        'student_id' => 'STU005',
        'installment_plan' => 'quarterly',
        'total_installments' => 4,
        'completed_installments' => 1,
        'next_due_date' => '2024-03-28',
        'next_installment_amount' => 5000
    ],
    (object)[
        'id' => 8,
        'first_name' => 'Anita',
        'last_name' => 'Verma',
        'student_id' => 'STU008',
        'installment_plan' => 'monthly',
        'total_installments' => 4,
        'completed_installments' => 2,
        'next_due_date' => '2024-04-08',
        'next_installment_amount' => 7000
    ],
    (object)[
        'id' => 10,
        'first_name' => 'Meera',
        'last_name' => 'Agarwal',
        'student_id' => 'STU010',
        'installment_plan' => 'monthly',
        'total_installments' => 5,
        'completed_installments' => 2,
        'next_due_date' => '2024-04-02',
        'next_installment_amount' => 4000
    ]
]);

// Static classes for filter
$classes = collect([
    (object)['id' => 1, 'name' => 'Class 8'],
    (object)['id' => 2, 'name' => 'Class 9'],
    (object)['id' => 3, 'name' => 'Class 10'],
    (object)['id' => 4, 'name' => 'Class 11'],
    (object)['id' => 5, 'name' => 'Class 12']
]);
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="card card-outline card-orange col-12 p-0">
                    <div class="card-header bg-primary">
                        <h1 class="card-title">Student Fee Status</h1>
                        <div class="card-tools">
                            <button class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#filterModal">
                                <i class="fa fa-filter"></i> Filter
                            </button>
                            <button class="btn btn-primary  btn-sm" onclick="exportToExcel()">
                                <i class="fa fa-download"></i> Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fee Status Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $feeStats['paid_full'] ?? 0 }}</h4>
                                    <p class="mb-0">Fully Paid</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-check-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $feeStats['partial_paid'] ?? 0 }}</h4>
                                    <p class="mb-0">Partial Payment</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-clock fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $feeStats['pending'] ?? 0 }}</h4>
                                    <p class="mb-0">Pending Payment</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-exclamation-triangle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $feeStats['installment'] ?? 0 }}</h4>
                                    <p class="mb-0">On Installment</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-calendar-alt fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Fee Status Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Students Fee Status</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="feeStatusTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th>Total Fee</th>
                                            <th>Paid Amount</th>
                                            <th>Remaining</th>
                                            <th>Status</th>
                                            <th>Payment Mode</th>
                                            <th>Last Payment</th>
                                            <th>Due Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($students as $index => $student)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $student->student_id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $student->profile_image ?? asset('images/default-avatar.png') }}" 
                                                         class="rounded-circle me-2" width="30" height="30" alt="Student">
                                                    <div>
                                                        <strong>{{ $student->first_name }} {{ $student->last_name }}</strong>
                                                        <br><small class="text-muted">{{ $student->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $student->class->name ?? 'N/A' }}</td>
                                            <td>{{ $student->section->name ?? 'N/A' }}</td>
                                            <td>
                                                <strong>₹{{ number_format($student->total_fee, 2) }}</strong>
                                            </td>
                                            <td>
                                                <span class="text-success">₹{{ number_format($student->paid_amount, 2) }}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $remaining = $student->total_fee - $student->paid_amount;
                                                @endphp
                                                <span class="text-danger">₹{{ number_format($remaining, 2) }}</span>
                                            </td>
                                            <td>
                                                @if($remaining <= 0)
                                                    <span class="badge badge-success">Fully Paid</span>
                                                @elseif($student->paid_amount > 0)
                                                    <span class="badge badge-warning">Partial</span>
                                                @else
                                                    <span class="badge badge-danger">Pending</span>
                                                @endif
                                                
                                                @if($student->payment_plan == 'installment')
                                                    <br><span class="badge badge-info mt-1">Installment</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($student->last_payment_method)
                                                    <span class="badge badge-secondary">{{ ucfirst($student->last_payment_method) }}</span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($student->last_payment_date)
                                                    {{ date('d-m-Y', strtotime($student->last_payment_date)) }}
                                                    <br><small class="text-muted">₹{{ number_format($student->last_payment_amount, 2) }}</small>
                                                @else
                                                    <span class="text-muted">No Payment</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($student->due_date)
                                                    @php
                                                        $dueDate = \Carbon\Carbon::parse($student->due_date);
                                                        $isOverdue = $dueDate->isPast() && $remaining > 0;
                                                    @endphp
                                                    <span class="{{ $isOverdue ? 'text-danger' : 'text-primary' }}">
                                                        {{ $dueDate->format('d-m-Y') }}
                                                    </span>
                                                    @if($isOverdue)
                                                        <br><small class="text-danger">Overdue</small>
                                                    @endif
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-sm btn-info" onclick="viewDetails({{ $student->id }})" title="View Details">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    @if($remaining > 0)
                                                        <button class="btn btn-sm btn-success" onclick="addPayment({{ $student->id }})" title="Add Payment">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    @endif
                                                    <button class="btn btn-sm btn-primary" onclick="paymentHistory({{ $student->id }})" title="Payment History">
                                                        <i class="fa fa-history"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-secondary" onclick="generateReceipt({{ $student->id }})" title="Generate Receipt">
                                                        <i class="fa fa-receipt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="13" class="text-center">
                                                <div class="py-4">
                                                    <i class="fa fa-users fa-3x text-muted"></i>
                                                    <h5 class="mt-2 text-muted">No Students Found</h5>
                                                    <p class="text-muted">No student fee records available.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <p class="text-muted">
                                        Showing 1 to {{ $students->count() }} of {{ $students->count() }} results
                                    </p>
                                </div>
                                <div>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination pagination-sm">
                                            <li class="page-item active">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Installment Details Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Installment Payment Schedule</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Student</th>
                                            <th>Installment Plan</th>
                                            <th>Total Installments</th>
                                            <th>Completed</th>
                                            <th>Next Due Date</th>
                                            <th>Next Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($installmentStudents as $student)
                                        <tr>
                                            <td>
                                                <strong>{{ $student->first_name }} {{ $student->last_name }}</strong>
                                                <br><small class="text-muted">{{ $student->student_id }}</small>
                                            </td>
                                            <td>{{ ucfirst($student->installment_plan) }}</td>
                                            <td>{{ $student->total_installments }}</td>
                                            <td>
                                                <span class="badge badge-info">{{ $student->completed_installments }}/{{ $student->total_installments }}</span>
                                            </td>
                                            <td>
                                                @if($student->next_due_date)
                                                    {{ date('d-m-Y', strtotime($student->next_due_date)) }}
                                                @else
                                                    <span class="text-muted">Completed</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($student->next_installment_amount)
                                                    ₹{{ number_format($student->next_installment_amount, 2) }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($student->completed_installments >= $student->total_installments)
                                                    <span class="badge badge-success">Completed</span>
                                                @elseif($student->next_due_date && \Carbon\Carbon::parse($student->next_due_date)->isPast())
                                                    <span class="badge badge-danger">Overdue</span>
                                                @else
                                                    <span class="badge badge-primary">Active</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">No installment plans found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter Fee Status</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="#" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Class</label>
                        <select name="class_id" class="form-control">
                            <option value="">All Classes</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Status</label>
                        <select name="payment_status" class="form-control">
                            <option value="">All Status</option>
                            <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Fully Paid</option>
                            <option value="partial" {{ request('payment_status') == 'partial' ? 'selected' : '' }}>Partial Payment</option>
                            <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Mode</label>
                        <select name="payment_mode" class="form-control">
                            <option value="">All Modes</option>
                            <option value="cash" {{ request('payment_mode') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="online" {{ request('payment_mode') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="installment" {{ request('payment_mode') == 'installment' ? 'selected' : '' }}>Installment</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Initialize DataTable
$(document).ready(function() {
    $('#feeStatusTable').DataTable({
        "responsive": true,
        "pageLength": 25,
        "ordering": false,
        "info": false,
        "lengthChange": true,
        "searching": true,
        "paging": true,
        "columnDefs": [
            { "orderable": false, "targets": "_all" }
        ]
    });
});

// View student fee details
function viewDetails(studentId) {
    // Implement view details functionality
    window.location.href = `/students/${studentId}/fee-details`;
}

// Add payment
function addPayment(studentId) {
    // Implement add payment functionality
    window.location.href = `/students/${studentId}/add-payment`;
}

// View payment history
function paymentHistory(studentId) {
    // Implement payment history functionality
    window.location.href = `/students/${studentId}/payment-history`;
}

// Generate receipt
function generateReceipt(studentId) {
    // Implement receipt generation
    window.open(`/students/${studentId}/receipt`, '_blank');
}

// Export to Excel
function exportToExcel() {
    window.location.href = '/students/fee-status/export';
}
</script>

@endsection