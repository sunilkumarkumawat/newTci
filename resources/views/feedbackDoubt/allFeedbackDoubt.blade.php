@extends('layout.app')

@section('content')

@php
// Static data for testing
$permissions = ['view_feedback', 'create_feedback', 'update_feedback'];
$totalFeedbacks = 45;
$openFeedbacks = 12;
$inProgressFeedbacks = 8;
$resolvedFeedbacks = 25;

// Static feedback data
$feedbacks = collect([
    (object)[
        'id' => 1,
        'student_name' => 'Rajesh Kumar',
        'student_id' => 'STU001',
        'class' => '10',
        'subject' => 'Mathematics',
        'chapter' => 'Quadratic Equations',
        'type' => 'doubt',
        'message' => 'I am having difficulty understanding the discriminant formula and how to apply it in different types of quadratic equations.',
        'status' => 'open',
        'created_at' => now()->subDays(2)
    ],
    (object)[
        'id' => 2,
        'student_name' => 'Priya Sharma',
        'student_id' => 'STU002',
        'class' => '9',
        'subject' => 'Science',
        'chapter' => 'Light and Reflection',
        'type' => 'suggestion',
        'message' => 'Could we have more practical experiments related to light reflection? It would help understand the concepts better.',
        'status' => 'in_progress',
        'created_at' => now()->subDays(1)
    ],
    (object)[
        'id' => 3,
        'student_name' => 'Amit Singh',
        'student_id' => 'STU003',
        'class' => '8',
        'subject' => 'English',
        'chapter' => 'Grammar',
        'type' => 'complaint',
        'message' => 'The homework assignments are too lengthy and difficult to complete within the given time frame.',
        'status' => 'resolved',
        'created_at' => now()->subDays(3)
    ],
    (object)[
        'id' => 4,
        'student_name' => 'Sneha Patel',
        'student_id' => 'STU004',
        'class' => '11',
        'subject' => 'History',
        'chapter' => 'Indian Independence',
        'type' => 'feedback',
        'message' => 'The teaching method for history is excellent. The use of visual aids and storytelling makes it very engaging.',
        'status' => 'open',
        'created_at' => now()->subHours(5)
    ],
    (object)[
        'id' => 5,
        'student_name' => 'Vikram Gupta',
        'student_id' => 'STU005',
        'class' => '12',
        'subject' => 'Geography',
        'chapter' => 'Climate Change',
        'type' => 'doubt',
        'message' => 'Can you explain the difference between weather and climate in more detail? I get confused between the two terms.',
        'status' => 'in_progress',
        'created_at' => now()->subHours(3)
    ]
]);

// Add pagination properties to the collection
$feedbacks->firstItem = function() { return 1; };
$feedbacks->appends = function($query) { return $this; };
$feedbacks->links = function() { return ''; };
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-md-12 col-12 p-0">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Student Feedback</li>
                    </ul>
                </div>
            </div>

            <!-- Main Card Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h4><i class="fa fa-desktop"></i> &nbsp;Student Feedback & Doubts</h4>
                            </div>
                            <div class="card-tools">
                                @if(in_array('user_management.edit', $permissions) || Auth::user()->role_id == 1)
                                <a href="{{ url('questions') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                    <span class="Display_none_mobile"> {{ __('common.Add') }} </span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Filters</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="#" id="filterForm">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="subject_filter">Subject</label>
                                            <select name="subject" id="subject_filter" class="form-control">
                                                <option value="">All Subjects</option>
                                                <option value="Mathematics" {{ request('subject') == 'Mathematics' ? 'selected' : '' }}>Mathematics</option>
                                                <option value="Science" {{ request('subject') == 'Science' ? 'selected' : '' }}>Science</option>
                                                <option value="English" {{ request('subject') == 'English' ? 'selected' : '' }}>English</option>
                                                <option value="History" {{ request('subject') == 'History' ? 'selected' : '' }}>History</option>
                                                <option value="Geography" {{ request('subject') == 'Geography' ? 'selected' : '' }}>Geography</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="class_filter">Class</label>
                                            <select name="class" id="class_filter" class="form-control">
                                                <option value="">All Classes</option>
                                                <option value="6" {{ request('class') == '6' ? 'selected' : '' }}>Class 6</option>
                                                <option value="7" {{ request('class') == '7' ? 'selected' : '' }}>Class 7</option>
                                                <option value="8" {{ request('class') == '8' ? 'selected' : '' }}>Class 8</option>
                                                <option value="9" {{ request('class') == '9' ? 'selected' : '' }}>Class 9</option>
                                                <option value="10" {{ request('class') == '10' ? 'selected' : '' }}>Class 10</option>
                                                <option value="11" {{ request('class') == '11' ? 'selected' : '' }}>Class 11</option>
                                                <option value="12" {{ request('class') == '12' ? 'selected' : '' }}>Class 12</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="type_filter">Type</label>
                                            <select name="type" id="type_filter" class="form-control">
                                                <option value="">All Types</option>
                                                <option value="doubt" {{ request('type') == 'doubt' ? 'selected' : '' }}>Doubt</option>
                                                <option value="suggestion" {{ request('type') == 'suggestion' ? 'selected' : '' }}>Suggestion</option>
                                                <option value="complaint" {{ request('type') == 'complaint' ? 'selected' : '' }}>Complaint</option>
                                                <option value="feedback" {{ request('type') == 'feedback' ? 'selected' : '' }}>General Feedback</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status_filter">Status</label>
                                            <select name="status" id="status_filter" class="form-control">
                                                <option value="">All Status</option>
                                                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-filter"></i> Apply Filters
                                        </button>
                                        <a href="#" class="btn btn-secondary" onclick="clearFilters()">
                                            <i class="fas fa-times"></i> Clear Filters
                                        </a>
                                        <a href="#" class="btn btn-success float-right" onclick="addNewFeedback()">
                                            <i class="fas fa-plus"></i> Add New Feedback
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalFeedbacks }}</h3>
                            <p>Total Submissions</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-comments"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $openFeedbacks }}</h3>
                            <p>Open Items</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $inProgressFeedbacks }}</h3>
                            <p>In Progress</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-spinner"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $resolvedFeedbacks }}</h3>
                            <p>Resolved</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feedback List -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student Feedback & Doubts List</h3>
                        </div>
                        <div class="card-body">
                            @if($feedbacks->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="feedbackTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th>S.No</th>
                                            <th>Student Name/ID</th>
                                            <th>Class</th>
                                            <th>Subject/Chapter</th>
                                            <th>Type</th>
                                            <th>Message</th>
                                            <th>Date & Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($feedbacks as $index => $feedback)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $feedback->student_name ?? 'N/A' }}</strong><br>
                                                <small class="text-muted">ID: {{ $feedback->student_id ?? 'N/A' }}</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">Class {{ $feedback->class ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <strong>{{ $feedback->subject ?? 'N/A' }}</strong>
                                                @if($feedback->chapter)
                                                <br><small class="text-muted">Ch: {{ $feedback->chapter }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @switch($feedback->type ?? 'feedback')
                                                @case('doubt')
                                                <span class="badge badge-warning">Doubt</span>
                                                @break
                                                @case('suggestion')
                                                <span class="badge badge-info">Suggestion</span>
                                                @break
                                                @case('complaint')
                                                <span class="badge badge-danger">Complaint</span>
                                                @break
                                                @default
                                                <span class="badge badge-secondary">Feedback</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                <div class="message-preview">
                                                    {{ Str::limit($feedback->message ?? 'No message', 50) }}
                                                </div>
                                            </td>
                                            <td>
                                                <small>
                                                    {{ $feedback->created_at ? $feedback->created_at->format('d M Y') : 'N/A' }}<br>
                                                    {{ $feedback->created_at ? $feedback->created_at->format('h:i A') : '' }}
                                                </small>
                                            </td>
                                            <td>
                                                @switch($feedback->status ?? 'open')
                                                @case('open')
                                                <span class="badge badge-danger">Open</span>
                                                @break
                                                @case('in_progress')
                                                <span class="badge badge-warning">In Progress</span>
                                                @break
                                                @case('resolved')
                                                <span class="badge badge-success">Resolved</span>
                                                @break
                                                @default
                                                <span class="badge badge-secondary">Unknown</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-info view-feedback"
                                                        data-toggle="modal" data-target="#viewFeedbackModal"
                                                        data-id="{{ $feedback->id }}"
                                                        data-student="{{ $feedback->student_name }}"
                                                        data-message="{{ $feedback->message }}"
                                                        data-subject="{{ $feedback->subject }}"
                                                        data-chapter="{{ $feedback->chapter }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    @if($feedback->status !== 'resolved')
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-warning dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="#" class="dropdown-item" onclick="updateStatus({{ $feedback->id }}, 'in_progress')">
                                                                <i class="fas fa-spinner text-warning"></i> Mark In Progress
                                                            </a>
                                                            <a href="#" class="dropdown-item" onclick="updateStatus({{ $feedback->id }}, 'resolved')">
                                                                <i class="fas fa-check text-success"></i> Mark Resolved
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
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
                            @else
                            <div class="text-center py-4">
                                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                <h5>No feedback found</h5>
                                <p class="text-muted">No student feedback or doubts match your current filters.</p>
                                <a href="#" class="btn btn-primary" onclick="addNewFeedback()">
                                    <i class="fas fa-plus"></i> Add First Feedback
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- View Feedback Modal -->
<div class="modal fade" id="viewFeedbackModal" tabindex="-1" role="dialog" aria-labelledby="viewFeedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewFeedbackModalLabel">Feedback Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Student Name:</strong>
                        <p id="modal-student-name">-</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Subject:</strong>
                        <p id="modal-subject">-</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Chapter:</strong>
                        <p id="modal-chapter">-</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Message:</strong>
                        <p id="modal-message">-</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#feedbackTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "paging": false,
            "order": [
                [6, "desc"]
            ] // Sort by date column
        });

        // View feedback modal
        $('.view-feedback').on('click', function() {
            var studentName = $(this).data('student');
            var message = $(this).data('message');
            var subject = $(this).data('subject');
            var chapter = $(this).data('chapter');

            $('#modal-student-name').text(studentName || 'N/A');
            $('#modal-subject').text(subject || 'N/A');
            $('#modal-chapter').text(chapter || 'N/A');
            $('#modal-message').text(message || 'No message provided');
        });

        // Auto-submit form on filter change
        $('#subject_filter, #class_filter, #type_filter, #status_filter').on('change', function() {
            // For demo purposes, just show alert
            alert('Filter changed to: ' + $(this).val());
        });

        // Show success message
        showMessage('Page loaded successfully with static data!', 'success');
    });

    // Helper functions
    function updateStatus(feedbackId, status) {
        alert('Status updated for feedback ID: ' + feedbackId + ' to: ' + status);
        // In real application, this would make an AJAX call to update the status
    }

    function clearFilters() {
        $('#filterForm')[0].reset();
        alert('Filters cleared!');
    }

    function addNewFeedback() {
        alert('Add new feedback functionality would be implemented here.');
    }

    function showMessage(message, type) {
        // Simple message display (replace with your preferred notification system)
        var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
            message +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>';

        // Insert at the top of content
        $('.content-wrapper .content').prepend(alertHtml);

        // Auto-hide after 3 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
    }
</script>
@endsection

@section('styles')
<style>
    .message-preview {
        max-width: 200px;
        word-wrap: break-word;
    }

    .small-box .icon {
        top: 10px;
        right: 10px;
    }

    .btn-group .dropdown-menu {
        min-width: 160px;
    }

    .table th {
        white-space: nowrap;
    }

    .badge {
        font-size: 11px;
    }

    .card-tools .btn-tool {
        color: #6c757d;
    }

    /* Additional styling for better appearance */
    .content-wrapper {
        padding: 20px;
    }

    .small-box {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .table-responsive {
        border-radius: 10px;
    }

    .btn {
        border-radius: 5px;
    }

    .badge {
        border-radius: 15px;
        padding: 5px 10px;
    }
</style>
@endsection