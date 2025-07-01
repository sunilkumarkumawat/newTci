@extends('layout.app')

@section('content')

@php
$permissions = Helper::getPermissions();
$filterable_columns = ['class_type_id'=>true, 'subject_id'=>true, 'chapter_id'=>true, 'topic_id'=>true, 'level_id'=>true, 'suka_id'=>true, 'question_type_id'=>true, 'status'=>true, 'language'=>true, 'use'=>true, 'tags'=>true, 'source_id'=>true, 'is_deleted'=>true, 'keyword'=>true];

// Static Archive Data
$archivedDoubts = [
    (object)[
        'id' => 1,
        'student_name' => 'Rahul Sharma',
        'subject' => 'Mathematics',
        'topic' => 'Quadratic Equations',
        'doubt_text' => 'How to solve complex quadratic equations with imaginary roots?',
        'faculty_name' => 'Dr. Rajesh Kumar',
        'resolved_date' => '2024-05-15',
        'resolution_time' => '2.5h',
        'rating' => 5,
        'status' => 'Resolved'
    ],
    (object)[
        'id' => 2,
        'student_name' => 'Priya Patel',
        'subject' => 'Physics',
        'topic' => 'Newton\'s Laws',
        'doubt_text' => 'Explain the application of Newton\'s third law in rocket propulsion.',
        'faculty_name' => 'Prof. Amit Singh',
        'resolved_date' => '2024-05-14',
        'resolution_time' => '1.8h',
        'rating' => 4,
        'status' => 'Resolved'
    ],
    (object)[
        'id' => 3,
        'student_name' => 'Arjun Gupta',
        'subject' => 'Chemistry',
        'topic' => 'Organic Chemistry',
        'doubt_text' => 'What is the mechanism of SN1 and SN2 reactions?',
        'faculty_name' => 'Dr. Neha Gupta',
        'resolved_date' => '2024-05-13',
        'resolution_time' => '3.2h',
        'rating' => 5,
        'status' => 'Resolved'
    ],
    (object)[
        'id' => 4,
        'student_name' => 'Sneha Reddy',
        'subject' => 'Biology',
        'topic' => 'Cell Biology',
        'doubt_text' => 'Explain the process of mitosis and meiosis in detail.',
        'faculty_name' => 'Prof. Priya Sharma',
        'resolved_date' => '2024-05-12',
        'resolution_time' => '2.1h',
        'rating' => 4,
        'status' => 'Resolved'
    ],
    (object)[
        'id' => 5,
        'student_name' => 'Vikash Kumar',
        'subject' => 'Mathematics',
        'topic' => 'Trigonometry',
        'doubt_text' => 'How to solve trigonometric equations with multiple angles?',
        'faculty_name' => 'Dr. Rajesh Kumar',
        'resolved_date' => '2024-05-11',
        'resolution_time' => '1.9h',
        'rating' => 5,
        'status' => 'Resolved'
    ]
];

$totalArchived = count($archivedDoubts);
$monthlyStats = [
    'current_month' => 156,
    'last_month' => 142,
    'avg_resolution_time' => '2.3h',
    'satisfaction_rate' => 94
];
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            
            {{-- Header Section --}}
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Doubts Archive</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Feedback Management</li>
                                <li class="breadcrumb-item active">Archive</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-white shadow-sm">
                        <div class="inner">
                            <h3 class="text-primary">{{ number_format($totalArchived) }}</h3>
                            <p class="text-muted mb-0">Total Archived</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-archive text-primary"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-white shadow-sm">
                        <div class="inner">
                            <h3 class="text-success">{{ $monthlyStats['current_month'] }}</h3>
                            <p class="text-muted mb-0">This Month</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check text-success"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-white shadow-sm">
                        <div class="inner">
                            <h3 class="text-warning">{{ $monthlyStats['avg_resolution_time'] }}</h3>
                            <p class="text-muted mb-0">Avg Resolution</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock text-warning"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-white shadow-sm">
                        <div class="inner">
                            <h3 class="text-info">{{ $monthlyStats['satisfaction_rate'] }}%</h3>
                            <p class="text-muted mb-0">Satisfaction</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-thumbs-up text-info"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Archive Card --}}
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="card-title">
                                        <i class="fas fa-folder-open mr-1"></i>
                                        Archived Doubts & Feedback
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-download mr-1"></i> Export
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" onclick="exportData('excel')">
                                                <i class="fas fa-file-excel text-success mr-2"></i>Export as Excel
                                            </a>
                                            <a class="dropdown-item" href="#" onclick="exportData('pdf')">
                                                <i class="fas fa-file-pdf text-danger mr-2"></i>Export as PDF
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" onclick="generateMonthlyReport()">
                                                <i class="fas fa-chart-line text-info mr-2"></i>Monthly Report
                                            </a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm ml-2" data-toggle="modal" data-target="#filterModal">
                                        <i class="fas fa-filter mr-1"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Filter Bar --}}
                        <div class="card-body border-bottom">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label class="form-label text-muted">Subject</label>
                                        <select class="form-control form-control-sm" id="subjectFilter">
                                            <option value="">All Subjects</option>
                                            <option value="Mathematics">Mathematics</option>
                                            <option value="Physics">Physics</option>
                                            <option value="Chemistry">Chemistry</option>
                                            <option value="Biology">Biology</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label class="form-label text-muted">Date Range</label>
                                        <select class="form-control form-control-sm" id="dateFilter">
                                            <option value="">All Time</option>
                                            <option value="today">Today</option>
                                            <option value="week">This Week</option>
                                            <option value="month">This Month</option>
                                            <option value="quarter">This Quarter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label class="form-label text-muted">Faculty</label>
                                        <select class="form-control form-control-sm" id="facultyFilter">
                                            <option value="">All Faculty</option>
                                            <option value="Dr. Rajesh Kumar">Dr. Rajesh Kumar</option>
                                            <option value="Prof. Amit Singh">Prof. Amit Singh</option>
                                            <option value="Dr. Neha Gupta">Dr. Neha Gupta</option>
                                            <option value="Prof. Priya Sharma">Prof. Priya Sharma</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label class="form-label text-muted">Search</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" placeholder="Search doubts..." id="searchInput">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Archive Table --}}
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id='dataContainer' class="table table-bordered table-striped m-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 40px">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="selectAll">
                                                    <label for="selectAll" class="custom-control-label"></label>
                                                </div>
                                            </th>
                                            <th>Student</th>
                                            <th>Subject/Topic</th>
                                            <th>Doubt Summary</th>
                                            <th>Faculty</th>
                                            <th>Resolved Date</th>
                                            <th>Resolution Time</th>
                                            <th>Rating</th>
                                            <th style="width: 100px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($archivedDoubts as $doubt)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input row-checkbox" type="checkbox" id="check{{ $doubt->id }}" value="{{ $doubt->id }}">
                                                    <label for="check{{ $doubt->id }}" class="custom-control-label"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle mr-2">
                                                        {{ substr($doubt->student_name, 0, 2) }}
                                                    </div>
                                                    <span class="font-weight-medium">{{ $doubt->student_name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <span class="badge badge-light">{{ $doubt->subject }}</span>
                                                    <br>
                                                    <small class="text-muted">{{ $doubt->topic }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="doubt-summary">
                                                    {{ Str::limit($doubt->doubt_text, 60) }}
                                                    @if(strlen($doubt->doubt_text) > 60)
                                                        <a href="#" class="text-primary" onclick="showFullDoubt({{ $doubt->id }})">...more</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">{{ $doubt->faculty_name }}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted">{{ date('M d, Y', strtotime($doubt->resolved_date)) }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $doubt->resolution_time }}</span>
                                            </td>
                                            <td>
                                                <div class="rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $doubt->rating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-muted"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-outline-primary" onclick="viewDoubt({{ $doubt->id }})" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-success" onclick="downloadDoubt({{ $doubt->id }})" title="Download">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Pagination --}}
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col">
                                    <small class="text-muted">
                                        Showing 1 to {{ count($archivedDoubts) }} of {{ $totalArchived }} entries
                                    </small>
                                </div>
                                <div class="col-auto">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bulk Actions Bar --}}
            <div class="row mt-3" id="bulkActionsBar" style="display: none;">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <div class="row align-items-center">
                            <div class="col">
                                <span id="selectedCount">0</span> items selected
                            </div>
                            <div class="col-auto">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm" onclick="bulkExport('excel')">
                                        <i class="fas fa-file-excel mr-1"></i> Export Selected (Excel)
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="bulkExport('pdf')">
                                        <i class="fas fa-file-pdf mr-1"></i> Export Selected (PDF)
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="clearSelection()">
                                        <i class="fas fa-times mr-1"></i> Clear Selection
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

{{-- View Doubt Modal --}}
<div class="modal fade" id="viewDoubtModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Doubt Details</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="doubtDetails">
                <!-- Doubt details will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="downloadCurrentDoubt()">
                    <i class="fas fa-download mr-1"></i> Download
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Archive Management Functions
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Handle select all checkbox
    $('#selectAll').change(function() {
        $('.row-checkbox').prop('checked', this.checked);
        updateBulkActions();
    });
    
    // Handle individual checkboxes
    $('.row-checkbox').change(function() {
        updateBulkActions();
    });
    
    // Filter functionality
    $('#subjectFilter, #dateFilter, #facultyFilter').change(function() {
        applyFilters();
    });
    
    // Search functionality
    $('#searchInput').on('keyup', function() {
        searchTable();
    });
});

function updateBulkActions() {
    const selectedCount = $('.row-checkbox:checked').length;
    $('#selectedCount').text(selectedCount);
    
    if (selectedCount > 0) {
        $('#bulkActionsBar').show();
    } else {
        $('#bulkActionsBar').hide();
    }
}

function clearSelection() {
    $('.row-checkbox, #selectAll').prop('checked', false);
    updateBulkActions();
}

function exportData(format) {
    // Show loading
    showLoading('Preparing ' + format.toUpperCase() + ' export...');
    
    // Simulate export process
    setTimeout(function() {
        hideLoading();
        showSuccess('Export completed successfully!');
        // Here you would trigger the actual download
        console.log('Exporting all data as ' + format);
    }, 2000);
}

function bulkExport(format) {
    const selectedIds = $('.row-checkbox:checked').map(function() {
        return this.value;
    }).get();
    
    if (selectedIds.length === 0) {
        showError('Please select items to export');
        return;
    }
    
    showLoading('Preparing ' + format.toUpperCase() + ' export for ' + selectedIds.length + ' items...');
    
    setTimeout(function() {
        hideLoading();
        showSuccess('Export completed successfully!');
        console.log('Exporting selected items:', selectedIds, 'as', format);
    }, 2000);
}

function generateMonthlyReport() {
    showLoading('Generating monthly report...');
    
    setTimeout(function() {
        hideLoading();
        showSuccess('Monthly report generated successfully!');
        console.log('Generating monthly report');
    }, 3000);
}

function viewDoubt(id) {
    // Load doubt details into modal
    const doubtDetails = `
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-muted">Student Information</h6>
                <p><strong>Name:</strong> Rahul Sharma</p>
                <p><strong>Class:</strong> 12th Science</p>
                <p><strong>Roll No:</strong> 2024001</p>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted">Doubt Information</h6>
                <p><strong>Subject:</strong> Mathematics</p>
                <p><strong>Topic:</strong> Quadratic Equations</p>
                <p><strong>Date:</strong> May 15, 2024</p>
            </div>
        </div>
        <hr>
        <h6 class="text-muted">Doubt Description</h6>
        <p>How to solve complex quadratic equations with imaginary roots? I'm having trouble understanding the concept of complex numbers and how they apply to quadratic equations.</p>
        <hr>
        <h6 class="text-muted">Resolution</h6>
        <p><strong>Faculty:</strong> Dr. Rajesh Kumar</p>
        <p><strong>Resolution Time:</strong> 2.5 hours</p>
        <p><strong>Rating:</strong> ⭐⭐⭐⭐⭐</p>
        <p><strong>Solution:</strong> Complex quadratic equations can be solved using the quadratic formula. When the discriminant is negative, the roots are complex numbers...</p>
    `;
    
    $('#doubtDetails').html(doubtDetails);
    $('#viewDoubtModal').modal('show');
}

function downloadDoubt(id) {
    showLoading('Preparing download...');
    
    setTimeout(function() {
        hideLoading();
        showSuccess('Download started!');
        console.log('Downloading doubt ID:', id);
    }, 1500);
}

function downloadCurrentDoubt() {
    showLoading('Preparing download...');
    
    setTimeout(function() {
        hideLoading();
        showSuccess('Download started!');
        $('#viewDoubtModal').modal('hide');
    }, 1500);
}

function showFullDoubt(id) {
    viewDoubt(id);
}

function applyFilters() {
    const subject = $('#subjectFilter').val();
    const dateRange = $('#dateFilter').val();
    const faculty = $('#facultyFilter').val();
    
    console.log('Applying filters:', { subject, dateRange, faculty });
    // Here you would implement the actual filtering logic
    showInfo('Filters applied successfully');
}

function searchTable() {
    const searchTerm = $('#searchInput').val().toLowerCase();
    
    $('#archiveTable tbody tr').each(function() {
        const text = $(this).text().toLowerCase();
        $(this).toggle(text.includes(searchTerm));
    });
}

// Utility functions
function showLoading(message) {
    $('body').append(`
        <div class="loading-overlay">
            <div class="loading-content">
                <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                <p class="mt-2">${message}</p>
            </div>
        </div>
    `);
}

function hideLoading() {
    $('.loading-overlay').remove();
}

function showSuccess(message) {
    toastr.success(message);
}

function showError(message) {
    toastr.error(message);
}

function showInfo(message) {
    toastr.info(message);
}
</script>

<style>
/* Archive Page Styling */
.content-wrapper {
    background-color: #f8f9fa;
}

.small-box {
    border-radius: 8px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.small-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}

.small-box .inner {
    padding: 20px;
    line-height: 1;
}

.small-box .inner h3 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.small-box .icon {
    /* position: absolute; */
    top: 20px;
    right: 20px;
}

.small-box .icon i {
    font-size: 2rem;
    opacity: 0.7;
}

.card {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.04);
}

.card-header {
    background-color: #fff;
    border-bottom: 1px solid #e9ecef;
    padding: 1rem 1.25rem;
}

.card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #495057;
    margin: 0;
}

.table {
    font-size: 0.9rem;
}

/* .table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 12px 8px;
} */

.table td {
    vertical-align: middle;
    border-top: 1px solid #f1f3f4;
    padding: 12px 8px;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.badge {
    font-size: 0.75rem;
    font-weight: 500;
}

.badge-light {
    background-color: #f8f9fa;
    color: #6c757d;
    border: 1px solid #e9ecef;
}

.avatar-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #007bff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.rating {
    font-size: 0.8rem;
}

.doubt-summary {
    max-width: 200px;
    line-height: 1.4;
}

.form-label {
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 4px;
}

.breadcrumb {
    background-color: transparent;
    padding: 0;
    margin: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: #6c757d;
}

.content-header h1 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #495057;
}

.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-content {
    text-align: center;
    padding: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.btn-group-sm > .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.8rem;
}

.custom-control-label::before {
    border-radius: 3px;
}

.custom-control-input:checked ~ .custom-control-label::before {
    background-color: #007bff;
    border-color: #007bff;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .small-box .inner h3 {
        font-size: 1.5rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .table-responsive {
        font-size: 0.8rem;
    }
    
    .doubt-summary {
        max-width: 150px;
    }
}
</style>

@endsection