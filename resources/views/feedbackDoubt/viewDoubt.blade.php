@extends('layout.app')
@section('content')

@php
// Static permissions data
$permissions = ['feedback_edit', 'feedback_respond'];

// Static feedback data
$feedback = (object) [
    'id' => 1,
    'type' => 'Doubt',
    'student_name' => 'Priya Sharma',
    'student_id' => 'STU2024001',
    'class' => 'Class 10 - Science',
    'created_at' => now()->subDays(2),
    'updated_at' => now()->subHours(5),
    'status' => 'In Progress',
    'priority' => 'High',
    'subject' => 'Physics',
    'chapter' => 'Light - Reflection and Refraction',
    'topic' => 'Lens Formula',
    'message' => 'I am having trouble understanding the lens formula and its applications. Could you please explain how to solve numerical problems related to focal length, object distance, and image distance? I find it confusing when to use positive and negative signs.',
    'audio_file' => 'sample_audio.mp3',
    'image_file' => 'sample_question.jpg',
    'attachments' => [
        (object) [
            'file_name' => 'physics_worksheet.pdf',
            'original_name' => 'Physics Worksheet - Lens Problems.pdf'
        ],
        (object) [
            'file_name' => 'diagram_attempt.jpg',
            'original_name' => 'My Diagram Attempt.jpg'
        ]
    ],
    'communications' => [
        (object) [
            'id' => 1,
            'sender_type' => 'student',
            'sender_name' => 'Priya Sharma',
            'message' => 'Hello sir, I submitted my doubt about lens formula. Please help me understand this topic.',
            'attachment' => null,
            'created_at' => now()->subDays(2)
        ],
        (object) [
            'id' => 2,
            'sender_type' => 'teacher',
            'sender_name' => 'Dr. Rajesh Kumar',
            'message' => 'Hi Priya, I have reviewed your question. Let me schedule a session to explain the lens formula step by step. I will also provide you with some practice problems.',
            'attachment' => 'lens_formula_notes.pdf',
            'created_at' => now()->subDays(1)
        ],
        (object) [
            'id' => 3,
            'sender_type' => 'student',
            'sender_name' => 'Priya Sharma',
            'message' => 'Thank you sir! The notes are helpful. I have attempted some problems. Could you please check my solutions?',
            'attachment' => 'my_solutions.pdf',
            'created_at' => now()->subHours(8)
        ]
    ]
];

// Convert created_at and updated_at to Carbon instances for formatting
$feedback->created_at = \Carbon\Carbon::parse($feedback->created_at);
$feedback->updated_at = \Carbon\Carbon::parse($feedback->updated_at);

// Convert communication timestamps
foreach($feedback->communications as $comm) {
    $comm->created_at = \Carbon\Carbon::parse($comm->created_at);
}
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            
            <!-- Header Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            
                            <h4 class="mb-1 text-dark font-weight-bold">Feedback Detail</h4>
                            
                        </div>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                            @if(in_array('feedback_edit', $permissions))
                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#updateStatusModal">
                                <i class="fas fa-edit mr-1"></i> Update Status
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-8">
                    
                    <!-- Student Query Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0 font-weight-semibold text-dark">
                                <i class="fas fa-question-circle text-primary mr-2"></i>
                                Student Query
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <!-- Query Message -->
                            <div class="mb-4">
                                <p class="text-muted mb-3 line-height-relaxed">{{ $feedback->message }}</p>
                            </div>

                            <!-- Media Attachments -->
                            @if(isset($feedback->audio_file) || isset($feedback->image_file))
                            <div class="mb-4">
                                <h6 class="text-muted mb-3 font-weight-semibold">Media Attachments</h6>
                                <div class="row">
                                    @if(isset($feedback->audio_file) && $feedback->audio_file)
                                    <div class="col-md-6 mb-3">
                                        <div class="media-item p-3 bg-light rounded">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-microphone text-success mr-2"></i>
                                                <small class="text-muted">{{ $feedback->audio_file }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset($feedback->image_file) && $feedback->image_file)
                                    <div class="col-md-6 mb-3">
                                        <div class="media-item p-3 bg-light rounded">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-image text-warning mr-2"></i>
                                                <small class="text-muted">{{ $feedback->image_file }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- File Attachments -->
                            @if(isset($feedback->attachments) && count($feedback->attachments) > 0)
                            <div class="mb-3">
                                <h6 class="text-muted mb-3 font-weight-semibold">Attachments</h6>
                                <div class="row">
                                    @foreach($feedback->attachments as $attachment)
                                    <div class="col-md-6 mb-3">
                                        <div class="attachment-item p-3 bg-light rounded d-flex align-items-center">
                                            @if(in_array(pathinfo($attachment->file_name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                <i class="fas fa-image text-info mr-3"></i>
                                            @elseif(pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'pdf')
                                                <i class="fas fa-file-pdf text-danger mr-3"></i>
                                            @else
                                                <i class="fas fa-file text-muted mr-3"></i>
                                            @endif
                                            <div class="flex-grow-1">
                                                <p class="mb-0 font-weight-medium">{{ $attachment->original_name ?? 'File' }}</p>
                                                <small class="text-muted">{{ strtoupper(pathinfo($attachment->file_name, PATHINFO_EXTENSION)) }}</small>
                                            </div>
                                            <button class="btn btn-sm btn-outline-primary" onclick="alert('File download requires actual file in storage')">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Communication History -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0 font-weight-semibold text-dark">
                                <i class="fas fa-comments text-primary mr-2"></i>
                                Communication History
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            @if(isset($feedback->communications) && count($feedback->communications) > 0)
                                <div class="communication-timeline">
                                    @foreach($feedback->communications as $index => $comm)
                                    <div class="communication-item {{ $index !== count($feedback->communications) - 1 ? 'mb-4' : '' }}">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="avatar-circle {{ $comm->sender_type == 'teacher' ? 'bg-success' : 'bg-primary' }}">
                                                    <i class="fas fa-{{ $comm->sender_type == 'teacher' ? 'chalkboard-teacher' : 'user-graduate' }} text-white"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="mb-0 font-weight-semibold">{{ $comm->sender_name }}</h6>
                                                        <small class="text-muted">{{ ucfirst($comm->sender_type) }}</small>
                                                    </div>
                                                    <small class="text-muted">{{ $comm->created_at->diffForHumans() }}</small>
                                                </div>
                                                <div class="message-content p-3 bg-light rounded">
                                                    <p class="mb-0">{{ $comm->message }}</p>
                                                    @if($comm->attachment)
                                                    <div class="mt-2 pt-2 border-top">
                                                        <small class="text-primary">
                                                            <i class="fas fa-paperclip mr-1"></i>
                                                            {{ $comm->attachment }}
                                                        </small>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">No Communication History</h6>
                                    <p class="text-muted mb-0">This is the first message in this conversation.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Response Section -->
                    @if(in_array('feedback_respond', $permissions))
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0 font-weight-semibold text-dark">
                                <i class="fas fa-reply text-primary mr-2"></i>
                                Send Response
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <form action="#" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); alert('Form submission disabled in static demo');">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="response_message" class="form-label font-weight-semibold">Response Message</label>
                                    <textarea class="form-control" 
                                              id="response_message" 
                                              name="response_message" 
                                              rows="4" 
                                              placeholder="Type your response here..."
                                              required></textarea>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="response_attachment" class="form-label font-weight-semibold">Attach File (Optional)</label>
                                    <div class="custom-file">
                                        <input type="file" 
                                               class="custom-file-input" 
                                               id="response_attachment" 
                                               name="response_attachment"
                                               accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                        <label class="custom-file-label" for="response_attachment">Choose file</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Allowed formats: JPG, PNG, PDF, DOC, DOCX (Max: 5MB)
                                    </small>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="update_status" class="form-label font-weight-semibold">Update Status</label>
                                        <select class="form-control" id="update_status" name="update_status">
                                            <option value="In Progress" {{ $feedback->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="Resolved" {{ $feedback->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                            <option value="Open" {{ $feedback->status == 'Open' ? 'selected' : '' }}>Open</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="priority" class="form-label font-weight-semibold">Set Priority</label>
                                        <select class="form-control" id="priority" name="priority">
                                            <option value="Normal" {{ ($feedback->priority ?? 'Normal') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                            <option value="High" {{ ($feedback->priority ?? '') == 'High' ? 'selected' : '' }}>High</option>
                                            <option value="Urgent" {{ ($feedback->priority ?? '') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-outline-secondary mr-2" onclick="document.getElementById('response_message').value='';">
                                        <i class="fas fa-eraser mr-1"></i>Clear
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane mr-1"></i>Send Response
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                </div>

                <!-- Right Sidebar -->
                <div class="col-lg-4">
                    
                    <!-- Student Information -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0 font-weight-semibold text-dark">
                                <i class="fas fa-user text-primary mr-2"></i>
                                Student Information
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="info-item mb-3">
                                <label class="text-muted font-weight-semibold">Name</label>
                                <p class="mb-0 font-weight-medium">{{ $feedback->student_name ?? 'N/A' }}</p>
                            </div>
                            <div class="info-item mb-3">
                                <label class="text-muted font-weight-semibold">Student ID</label>
                                <p class="mb-0">{{ $feedback->student_id ?? 'N/A' }}</p>
                            </div>
                            <div class="info-item mb-3">
                                <label class="text-muted font-weight-semibold">Class</label>
                                <span class="badge badge-light">{{ $feedback->class ?? 'N/A' }}</span>
                            </div>
                            <div class="info-item">
                                <label class="text-muted font-weight-semibold">Submission Date</label>
                                <p class="mb-0">{{ $feedback->created_at ? $feedback->created_at->format('M d, Y') : 'N/A' }}</p>
                                <small class="text-muted">{{ $feedback->created_at ? $feedback->created_at->format('h:i A') : '' }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Status & Details -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0 font-weight-semibold text-dark">
                                <i class="fas fa-info-circle text-primary mr-2"></i>
                                Status & Details
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="info-item mb-3">
                                <label class="text-muted font-weight-semibold">Status</label>
                                <div>
                                    <span class="status-badge 
                                        @if($feedback->status == 'Open') status-open
                                        @elseif($feedback->status == 'In Progress') status-progress
                                        @elseif($feedback->status == 'Resolved') status-resolved
                                        @else status-default @endif">
                                        {{ $feedback->status ?? 'Open' }}
                                    </span>
                                </div>
                            </div>
                            <div class="info-item mb-3">
                                <label class="text-muted font-weight-semibold">Type</label>
                                <div>
                                    <span class="badge badge-primary">{{ $feedback->type ?? 'Doubt' }}</span>
                                </div>
                            </div>
                            <div class="info-item mb-3">
                                <label class="text-muted font-weight-semibold">Priority</label>
                                <div>
                                    <span class="priority-badge 
                                        @if($feedback->priority == 'High') priority-high
                                        @elseif($feedback->priority == 'Urgent') priority-urgent
                                        @else priority-normal @endif">
                                        {{ $feedback->priority ?? 'Normal' }}
                                    </span>
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="text-muted font-weight-semibold">Last Updated</label>
                                <p class="mb-0">{{ $feedback->updated_at ? $feedback->updated_at->diffForHumans() : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Subject Information -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0 font-weight-semibold text-dark">
                                <i class="fas fa-book text-primary mr-2"></i>
                                Subject Details
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="info-item mb-3">
                                <label class="text-muted font-weight-semibold">Subject</label>
                                <p class="mb-0 font-weight-medium">{{ $feedback->subject ?? 'N/A' }}</p>
                            </div>
                            <div class="info-item mb-3">
                                <label class="text-muted font-weight-semibold">Chapter</label>
                                <p class="mb-0">{{ $feedback->chapter ?? 'N/A' }}</p>
                            </div>
                            <div class="info-item">
                                <label class="text-muted font-weight-semibold">Topic</label>
                                <p class="mb-0">{{ $feedback->topic ?? 'General' }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title font-weight-semibold" id="updateStatusModalLabel">Update Feedback Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Status update disabled in static demo'); $('#updateStatusModal').modal('hide');">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="form-group mb-4">
                        <label for="modal_status" class="form-label font-weight-semibold">Status</label>
                        <select class="form-control" id="modal_status" name="status" required>
                            <option value="Open" {{ $feedback->status == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="In Progress" {{ $feedback->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Resolved" {{ $feedback->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="modal_notes" class="form-label font-weight-semibold">Notes (Optional)</label>
                        <textarea class="form-control" id="modal_notes" name="notes" rows="3" placeholder="Add any notes about this status update..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Clean and Modern Styling */
.content-wrapper {
    background-color: #f8f9fa;
    min-height: 100vh;
}

/* Cards */
.card {
    border-radius: 12px;
    transition: all 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
    padding: 1.25rem 1.5rem;
}

/* Typography */
.font-weight-semibold {
    font-weight: 600;
}

.line-height-relaxed {
    line-height: 1.7;
}

/* Status Badges */
.status-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-open {
    background-color: #fee2e2;
    color: #dc2626;
}

.status-progress {
    background-color: #fef3c7;
    color: #d97706;
}

.status-resolved {
    background-color: #d1fae5;
    color: #059669;
}

.status-default {
    background-color: #f3f4f6;
    color: #6b7280;
}

/* Priority Badges */
.priority-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.priority-normal {
    background-color: #d1fae5;
    color: #059669;
}

.priority-high {
    background-color: #fecaca;
    color: #dc2626;
}

.priority-urgent {
    background-color: #f3e8ff;
    color: #7c3aed;
}

/* Info Items */
.info-item label {
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
    display: block;
}

/* Communication Timeline */
.communication-timeline {
    position: relative;
}

.communication-item {
    position: relative;
}

.communication-item:not(:last-child):before {
    content: '';
    position: absolute;
    left: 24px;
    top: 50px;
    width: 2px;
    height: calc(100% - 50px);
    background: #e5e7eb;
}

.avatar-circle {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.message-content {
    border-left: 3px solid #e5e7eb;
}

/* Form Styling */
.form-control {
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    padding: 0.75rem 1rem;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-label {
    margin-bottom: 0.5rem;
    color: #374151;
}

/* Buttons */
.btn {
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
}

.btn-primary {
    background-color: #3b82f6;
    border-color: #3b82f6;
}

.btn-primary:hover {
    background-color: #2563eb;
    border-color: #2563eb;
    transform: translateY(-1px);
}

.btn-outline-primary {
    color: #3b82f6;
    border-color: #3b82f6;
}

.btn-outline-primary:hover {
    background-color: #3b82f6;
    border-color: #3b82f6;
    transform: translateY(-1px);
}

.btn-outline-secondary {
    color: #6b7280;
    border-color: #d1d5db;
}

.btn-outline-secondary:hover {
    background-color: #6b7280;
    border-color: #6b7280;
    transform: translateY(-1px);
}

/* Media Items */
.media-item, .attachment-item {
    border: 1px solid #e5e7eb;
    transition: all 0.2s ease;
}

.media-item:hover, .attachment-item:hover {
    border-color: #3b82f6;
    background-color: #f8faff !important;
}

/* Breadcrumb */
.breadcrumb-item a {
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

/* Modal */
.modal-content {
    border-radius: 16px;
}

.modal-header {
    border-radius: 16px 16px 0 0;
}

/* Badge Styling */
.badge {
    padding: 0.375rem 0.75rem;
    border-radius: 12px;
    font-weight: 500;
}

.badge-light {
    background-color: #f8f9fa;
    color: #495057;
    border: 1px solid #e9ecef;
}

.badge-primary {
    background-color: #3b82f6;
}

/* Responsive */
@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem !important;
    }
    
    .d-flex.gap-2 {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .btn-sm {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Additional Utility Classes */
.shadow-soft {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.text-soft {
    color: #6b7280;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

/* Animation keyframes */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.5s ease-out;
}

/* Focus states for accessibility */
.btn:focus,
.form-control:focus,
.custom-file-input:focus ~ .custom-file-label {
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}

/* Custom file upload styling */
.custom-file-label {
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    padding: 0.75rem 1rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.custom-file-label:hover {
    border-color: #3b82f6;
    background-color: #f8faff;
}

.custom-file-input:focus ~ .custom-file-label {
    border-color: #3b82f6;
}

/* Loading states */
.btn.loading {
    position: relative;
    color: transparent;
}

.btn.loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    top: 50%;
    left: 50%;
    margin-left: -8px;
    margin-top: -8px;
    border: 2px solid #ffffff;
    border-radius: 50%;
    border-top-color: transparent;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* Improved spacing utilities */
.mb-6 {
    margin-bottom: 3rem;
}

.mt-6 {
    margin-top: 3rem;
}

.p-6 {
    padding: 3rem;
}

/* Text selection styling */
::selection {
    background-color: rgba(59, 130, 246, 0.2);
    color: #1e40af;
}

::-moz-selection {
    background-color: rgba(59, 130, 246, 0.2);
    color: #1e40af;
}

/* Print styles */
@media print {
    .btn, .modal, .breadcrumb {
        display: none !important;
    }
    
    .card {
        border: 1px solid #000 !important;
        box-shadow: none !important;
    }
    
    .card-body {
        padding: 1rem !important;
    }
}
</style>

@endsection