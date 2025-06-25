@extends('layout.app')
@section('content')

@php
$permissions = Helper::getPermissions();
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Header Section -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">
                                    <i class="fas fa-question-circle mr-2"></i>
                                    Feedback Detail - {{ $feedback->type ?? 'Doubt' }}
                                </h3>
                                <div>
                                    <a href="{{ route('student.feedback.index') }}" class="btn btn-light btn-sm">
                                        <i class="fas fa-arrow-left mr-1"></i> Back to List
                                    </a>
                                    @if(in_array('feedback_edit', $permissions))
                                    <button class="btn btn-warning btn-sm ml-2" data-toggle="modal" data-target="#updateStatusModal">
                                        <i class="fas fa-edit mr-1"></i> Update Status
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Information Card -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user mr-2"></i>Student Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <strong>Name:</strong><br>
                                    <span class="text-primary">{{ $feedback->student_name ?? 'N/A' }}</span>
                                </div>
                                <div class="col-6">
                                    <strong>Student ID:</strong><br>
                                    <span class="text-muted">{{ $feedback->student_id ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <strong>Class:</strong><br>
                                    <span class="badge badge-info">{{ $feedback->class ?? 'N/A' }}</span>
                                </div>
                                <div class="col-6">
                                    <strong>Submission Date:</strong><br>
                                    <span class="text-muted">{{ $feedback->created_at ? $feedback->created_at->format('d M Y, h:i A') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Status and Priority Card -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-flag mr-2"></i>Status & Priority
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <strong>Current Status:</strong><br>
                                    <span class="badge 
                                        @if($feedback->status == 'Open') badge-danger
                                        @elseif($feedback->status == 'In Progress') badge-warning
                                        @elseif($feedback->status == 'Resolved') badge-success
                                        @else badge-secondary @endif">
                                        {{ $feedback->status ?? 'Open' }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    <strong>Type:</strong><br>
                                    <span class="badge 
                                        @if($feedback->type == 'Doubt') badge-primary
                                        @elseif($feedback->type == 'Suggestion') badge-info
                                        @elseif($feedback->type == 'Complaint') badge-danger
                                        @else badge-secondary @endif">
                                        {{ $feedback->type ?? 'Doubt' }}
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <strong>Last Updated:</strong><br>
                                    <span class="text-muted">{{ $feedback->updated_at ? $feedback->updated_at->format('d M Y, h:i A') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subject & Chapter Information -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-book mr-2"></i>Subject & Chapter Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Subject:</strong><br>
                                    <span class="text-primary">{{ $feedback->subject ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <strong>Chapter:</strong><br>
                                    <span class="text-info">{{ $feedback->chapter ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <strong>Topic:</strong><br>
                                    <span class="text-secondary">{{ $feedback->topic ?? 'General' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Message Card -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-comment-dots mr-2"></i>Student Message
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Text Message -->
                            @if($feedback->message)
                            <div class="mb-3">
                                <h6 class="text-primary"><i class="fas fa-comment mr-1"></i> Text Message:</h6>
                                <div class="border-left border-primary pl-3">
                                    <p class="mb-0">{{ $feedback->message }}</p>
                                </div>
                            </div>
                            @endif

                            <!-- Audio Message -->
                            @if(isset($feedback->audio_file) && $feedback->audio_file)
                            <div class="mb-3">
                                <h6 class="text-success"><i class="fas fa-microphone mr-1"></i> Audio Message:</h6>
                                <audio controls class="w-100">
                                    <source src="{{ asset('storage/feedback/audio/' . $feedback->audio_file) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                            @endif

                            <!-- Image Message -->
                            @if(isset($feedback->image_file) && $feedback->image_file)
                            <div class="mb-3">
                                <h6 class="text-warning"><i class="fas fa-image mr-1"></i> Image Message:</h6>
                                <div class="text-center">
                                    <img src="{{ asset('storage/feedback/images/' . $feedback->image_file) }}" 
                                         alt="Student Image" 
                                         class="img-fluid rounded border"
                                         style="max-height: 400px; cursor: pointer;"
                                         data-toggle="modal" 
                                         data-target="#imageModal">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attachments Card -->
            @if(isset($feedback->attachments) && count($feedback->attachments) > 0)
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-paperclip mr-2"></i>Attachments & Screenshots
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($feedback->attachments as $attachment)
                                <div class="col-md-3 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            @if(in_array(pathinfo($attachment->file_name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset('storage/feedback/attachments/' . $attachment->file_name) }}" 
                                                     alt="Attachment" 
                                                     class="img-fluid rounded mb-2"
                                                     style="max-height: 100px;">
                                            @else
                                                <i class="fas fa-file fa-3x text-muted mb-2"></i>
                                            @endif
                                            <h6 class="card-title">{{ $attachment->original_name ?? 'File' }}</h6>
                                            <a href="{{ asset('storage/feedback/attachments/' . $attachment->file_name) }}" 
                                               class="btn btn-primary btn-sm" 
                                               download>
                                                <i class="fas fa-download mr-1"></i>Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Communication History Card -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-purple text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-history mr-2"></i>Communication History
                            </h5>
                        </div>
                        <div class="card-body">
                            @if(isset($feedback->communications) && count($feedback->communications) > 0)
                                <div class="timeline">
                                    @foreach($feedback->communications as $comm)
                                    <div class="time-label">
                                        <span class="bg-info">{{ $comm->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-{{ $comm->sender_type == 'teacher' ? 'chalkboard-teacher' : 'user-graduate' }} bg-{{ $comm->sender_type == 'teacher' ? 'success' : 'primary' }}"></i>
                                        <div class="timeline-item">
                                            <span class="time">
                                                <i class="fas fa-clock"></i> {{ $comm->created_at->format('h:i A') }}
                                            </span>
                                            <h3 class="timeline-header">
                                                <strong>{{ $comm->sender_name }}</strong> 
                                                <small class="text-muted">({{ ucfirst($comm->sender_type) }})</small>
                                            </h3>
                                            <div class="timeline-body">
                                                {{ $comm->message }}
                                                @if($comm->attachment)
                                                <br><br>
                                                <a href="{{ asset('storage/communications/' . $comm->attachment) }}" 
                                                   class="btn btn-xs btn-info" 
                                                   target="_blank">
                                                    <i class="fas fa-paperclip mr-1"></i>View Attachment
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-comments fa-3x mb-3"></i>
                                    <h5>No Communication History</h5>
                                    <p>This is the first message in this conversation.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Response Section -->
            @if(in_array('feedback_respond', $permissions))
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-reply mr-2"></i>Send Response
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('student.feedback.respond', $feedback->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="response_message">Your Response <span class="text-danger">*</span></label>
                                    <textarea class="form-control" 
                                              id="response_message" 
                                              name="response_message" 
                                              rows="4" 
                                              placeholder="Type your response here..."
                                              required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="response_attachment">Attach File (Optional)</label>
                                    <input type="file" 
                                           class="form-control-file" 
                                           id="response_attachment" 
                                           name="response_attachment"
                                           accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                    <small class="form-text text-muted">
                                        Allowed formats: JPG, PNG, PDF, DOC, DOCX (Max: 5MB)
                                    </small>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="update_status">Update Status</label>
                                        <select class="form-control" id="update_status" name="update_status">
                                            <option value="In Progress" {{ $feedback->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="Resolved" {{ $feedback->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                            <option value="Open" {{ $feedback->status == 'Open' ? 'selected' : '' }}>Open</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="priority">Set Priority</label>
                                        <select class="form-control" id="priority" name="priority">
                                            <option value="Normal" {{ ($feedback->priority ?? 'Normal') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                            <option value="High" {{ ($feedback->priority ?? '') == 'High' ? 'selected' : '' }}>High</option>
                                            <option value="Urgent" {{ ($feedback->priority ?? '') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane mr-1"></i>Send Response
                                    </button>
                                    <button type="button" class="btn btn-secondary ml-2" onclick="document.getElementById('response_message').value='';">
                                        <i class="fas fa-eraser mr-1"></i>Clear
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </section>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Student Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if(isset($feedback->image_file) && $feedback->image_file)
                <img src="{{ asset('storage/feedback/images/' . $feedback->image_file) }}" 
                     alt="Student Image" 
                     class="img-fluid">
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">Update Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('student.feedback.updateStatus', $feedback->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="modal_status">Status</label>
                        <select class="form-control" id="modal_status" name="status" required>
                            <option value="Open" {{ $feedback->status == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="In Progress" {{ $feedback->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Resolved" {{ $feedback->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="modal_notes">Notes (Optional)</label>
                        <textarea class="form-control" id="modal_notes" name="notes" rows="3" placeholder="Add any notes about this status update..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    margin: 0 0 30px 0;
    padding: 0;
    list-style: none;
}

.timeline:before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    width: 4px;
    background: #ddd;
    left: 31px;
    margin: 0;
    border-radius: 2px;
}

.timeline > li {
    position: relative;
    margin: 0 0 20px 0;
    padding: 0;
}

.timeline > li > .timeline-item {
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    border-radius: 3px;
    margin-top: 0;
    background: #fff;
    color: #444;
    margin-left: 60px;
    margin-right: 15px;
    padding: 0;
    position: relative;
}

.timeline > li > .fa,
.timeline > li > .glyphicon,
.timeline > li > .ion {
    width: 30px;
    height: 30px;
    font-size: 15px;
    line-height: 30px;
    position: absolute;
    color: #666;
    background: #d2d6de;
    border-radius: 50%;
    text-align: center;
    left: 18px;
    top: 0;
}

.timeline > .time-label > span {
    font-weight: 600;
    color: #fff;
    border-radius: 4px;
    display: inline-block;
    padding: 5px;
}

.timeline-header {
    margin: 0;
    color: #555;
    border-bottom: 1px solid #f4f4f4;
    padding: 10px;
    font-weight: 600;
    font-size: 16px;
}

.timeline-body,
.timeline-footer {
    padding: 10px;
}

.bg-purple {
    background-color: #605ca8 !important;
}
</style>

@endsection