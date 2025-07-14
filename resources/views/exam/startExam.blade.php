@extends('layout.app')
@section('content')

@php
use Carbon\Carbon;

$end_time = Carbon::parse($attempt->end_time);

$current_time = now();

$seconds_left = $current_time->diffInSeconds($end_time, false);

$milliseconds_left = $seconds_left * 1000;

$start_time = now()->addSeconds($seconds_left)->format('Y-m-d H:i:s');



$exam_id = 1;
@endphp

<div class="exam-container">
    <!-- Header Section -->
    <header class="exam-header">
        <div class="header-content">
            <div class="exam-info">
                <div class="exam-title">
                    <div class="exam-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="title-text">
                        <h1>{{$examData->name ?? ''}}</h1>
                        <span class="exam-subtitle">{{$examData->pattern_name ?? ''}}</span>
                    </div>
                </div>

                <div class="exam-timer">
                    <div class="timer-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="timer-content">
                        <span class="timer-label">Time Remaining</span>
                        <span class="countdown_exam">00:00:00</span>
                    </div>
                </div>
            </div>

            <div class="header-controls">
                <button type="button" class="control-btn language-btn" id="change_language">
                    <i class="fas fa-language"></i>
                    <span>English</span>
                </button>
                <button type="button" class="control-btn fullscreen-btn" data-widget="fullscreen">
                    <i class="fas fa-expand"></i>
                    <span>Full Screen</span>
                </button>
            </div>

            <div class="user-profile">
                <div class="user-avatar">
                    <img src="{{asset(Auth::guard('student')->user()->image)}}" alt="User Avatar" />
                    <div class="online-indicator"></div>
                </div>
                <div class="user-details">
                    <div class="user-name">{{ Auth::guard('student')->user()->name ?? '' }}</div>
                    <div class="user-contact">{{ Auth::guard('student')->user()->mobile ?? '' }}</div>
                    <div class="user-class">{{ Auth::guard('student')->user()->class_type_id ?? '' }}</div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="exam-main">
        <div class="exam-layout">
            <!-- Question Panel -->
            <section class="question-panel">
                <div class="question-card">
                    <div class="question-header">
                        <div class="question-meta">
                            <span class="question-number">Question 1</span>
                            <span class="question-type">Single Choice</span>
                        </div>
                        <div class="question-progress">
                            <span class="progress-text">1 of 6</span>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 16.67%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="question-content">
                        <div class="questioning_area">
                            <!-- Question content will be loaded here -->
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="action-btn clear-btn" id="clear_response">
                        <i class="fas fa-eraser"></i>
                        <span>Clear</span>
                    </button>
                    <button class="action-btn next-btn" id="save_and_next">
                        <i class="fas fa-arrow-right"></i>
                        <span>Save & Next</span>
                    </button>
                    <button class="action-btn review-btn" id="mark_review">
                        <i class="fas fa-bookmark"></i>
                        <span>Mark for Review</span>
                    </button>
                    <button class="action-btn submit-btn" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-paper-plane"></i>
                        <span>Submit</span>
                    </button>
                </div>
            </section>

            <!-- Navigation Panel -->
            <aside class="navigation-panel">
                <div class="nav-header">
                    <div class="exam-summary">
                        <h3>{{$examData->name ?? ''}}</h3>
                        <span class="exam-id">Exam ID: {{$examData->id ?? ''}}</span>
                    </div>
                </div>

                <!-- Subject Tabs -->
                <div class="subject-tabs">
                    @php
                    $subjectIds = $questionData->pluck('subject_id')->unique()->values()->toArray();
                    @endphp

                    @foreach($subjectIds as $subjectId)
                    @php
                    $value = DB::table('all_subjects')->where('id', $subjectId)->first();
                    $questionIds = $questionData->where('subject_id', $subjectId)->pluck('question_id')->toArray();
                    $questionIdsJson = json_encode($questionIds); // convert to JSON for embedding in data attribute
                    $questionTypes = $questionData->where('subject_id', $subjectId)->pluck('question_type')->toArray(); // Add this line
                    @endphp

                    <button
                        class="subject-tab get_parts"
                        data-subject_name="{{ $value->name ?? '' }}"
                        data-subject_id="{{ $value->id ?? '' }}"
                        data-questionsids='@json($questionIds)'
                        data-question_types='@json($questionTypes)'>
                        {{ $value->name ?? '' }}
                    </button>
                    @endforeach
                </div>

                <!-- Question Grid -->
                <div class="question-grid" id="ques_list">
                    <!-- Questions will be loaded here -->
                </div>

                <!-- Legend -->
                <div class="question-legend">
                    <div class="legend-item">
                        <span class="legend-color answered"></span>
                        <span>Answered</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color not-answered"></span>
                        <span>Not Answered</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color marked"></span>
                        <span>Marked</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color skipped"></span>
                        <span>Skipped</span>
                    </div>
                </div>
            </aside>
        </div>
    </main>
</div>

<!-- Hidden Form -->
<form action="{{url('resultExam')}}" method="post" id="formAdd" style="display: none;">
    @csrf

    <input type="hidden" name="result" id="form_submit_ans" />
    <input type="hidden" name="exam_id" value="1" />
</form>

<!-- Modals -->
<div class="modal fade" id="bestOfLuckModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-body text-center">
                <div class="modal-icon">
                    <i class="fas fa-rocket"></i>
                </div>
                <h4>Ready to Begin?</h4>
                <p>Take your time, read carefully, and do your best. Good luck!</p>
                <button id="proceedExam" class="btn btn-primary btn-lg">
                    <i class="fas fa-play"></i>
                    Start Exam
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-body text-center">
                <div class="modal-icon warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h4>Submit Exam?</h4>
                <p>Are you sure you want to submit your exam? This action cannot be undone.</p>
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="hide_modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="modal-btn-confirm">
                        <i class="fas fa-check"></i>
                        Submit Exam
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Modern Professional Exam Interface Styles */
    :root {
        --primary-color: #4f46e5;
        --primary-light: #6366f1;
        --primary-dark: #3730a3;
        --secondary-color: #64748b;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --info-color: #06b6d4;

        --bg-primary: #ffffff;
        --bg-secondary: #f8fafc;
        --bg-tertiary: #f1f5f9;

        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;

        --border-color: #e2e8f0;
        --border-light: #f1f5f9;

        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);

        --radius-sm: 6px;
        --radius-md: 8px;
        --radius-lg: 12px;
        --radius-xl: 16px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: var(--bg-secondary);
        margin: 0;
        padding: 0;
        min-height: 90vh;
        color: var(--text-primary);
        line-height: 1.6;
    }

    .exam-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Header Styles */
    .exam-header {
        background: var(--bg-primary);
        border-bottom: 1px solid var(--border-color);
        padding: 0.5rem 2rem;
        box-shadow: var(--shadow-sm);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1400px;
        margin: 0 auto;
        gap: 2rem;
    }

    .exam-info {
        display: flex;
        align-items: center;
        gap: 3rem;
    }

    .exam-title {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .exam-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }

    .title-text h1 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.2;
    }

    .exam-subtitle {
        font-size: 0.875rem;
        color: var(--text-secondary);
        font-weight: 500;
    }

    .exam-timer {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: var(--bg-tertiary);
        padding: 0.5rem 1.5rem;
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
    }

    .timer-icon {
        width: 40px;
        height: 40px;
        background: var(--danger-color);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .timer-content {
        display: flex;
        flex-direction: column;
    }

    .timer-label {
        font-size: 0.75rem;
        color: var(--text-secondary);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .countdown_exam {
        font-weight: 700;
        color: var(--danger-color);
        font-size: 1.25rem;
        font-family: 'JetBrains Mono', monospace;
    }

    .header-controls {
        display: flex;
        gap: 1rem;
    }

    .control-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0.75rem 1.25rem;
        border-radius: var(--radius-md);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.875rem;
    }

    .control-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar {
        position: relative;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid var(--primary-color);
        box-shadow: var(--shadow-md);
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .online-indicator {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 14px;
        height: 14px;
        background: var(--success-color);
        border: 2px solid white;
        border-radius: 50%;
    }

    .user-details {
        text-align: right;
    }

    .user-name {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 1rem;
        margin-bottom: 2px;
    }

    .user-contact,
    .user-class {
        font-size: 0.875rem;
        color: var(--text-secondary);
        margin-bottom: 1px;
    }

    /* Main Content */
    .exam-main {
        flex: 1;
        padding: 1rem 2rem;
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
    }

    .exam-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 2rem;
        height: calc(100vh - 180px);
    }

    /* Question Panel */
    .question-panel {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .question-card {
        background: var(--bg-primary);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        /* flex: 1; */
        border: 1px solid var(--border-color);
    }

    .question-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        padding: 0.4rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .question-meta {
        /*display: flex;*/
        flex-direction: column;
        gap: 0.25rem;
    }

    .question-number {
        font-weight: 700;
        font-size: 1.25rem;
    }

    .question-type {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        width: fit-content;
    }

    .question-progress {
        text-align: right;
    }

    .progress-text {
        font-size: 0.875rem;
        opacity: 0.9;
        display: block;
        margin-bottom: 0.5rem;
    }

    .progress-bar {
        width: 120px;
        height: 6px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: white;
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    .question-content {
        padding: 1rem 2rem 2rem 2rem;
        /*min-height: 400px;*/
    }

    .questioning_area {
        font-size: 1.125rem;
        line-height: 1.7;
    }

    .question-text {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    .options-container {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .option-item {
        position: relative;
    }

    /* Enhanced Radio Button Styles */
    input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    input[type="radio"]+label {
        position: relative;
        padding: 1rem 1.5rem;
        margin: 0;
        display: flex;
        align-items: center;
        background: var(--bg-tertiary);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-lg);
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 1rem;
        font-weight: 500;
        min-height: 60px;
    }

    input[type="radio"]+label:hover {
        background: var(--bg-secondary);
        border-color: var(--primary-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    input[type="radio"]:checked+label {
        background: linear-gradient(135deg, #ede9fe, #f3f4f6);
        border-color: var(--primary-color);
        color: var(--primary-dark);
        box-shadow: var(--shadow-md);
    }

    input[type="radio"]+label::before {
        content: attr(data-letter);
        width: 36px;
        height: 36px;
        border: 2px solid var(--border-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-weight: 700;
        background: white;
        transition: all 0.2s ease;
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    input[type="radio"]:checked+label::before {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        transform: scale(1.1);
    }

    /* Action Buttons */
    .action-buttons {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    .action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.2rem;
        padding: 0.5rem;
        border: none;
        border-radius: var(--radius-lg);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        min-height: 50px;
        font-size: 0.875rem;
    }

    .action-btn i {
        font-size: 1.25rem;
    }

    .clear-btn {
        background: var(--secondary-color);
        color: white;
    }

    .clear-btn:hover {
        background: #475569;
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .next-btn {
        background: var(--primary-color);
        color: white;
    }

    .next-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .review-btn {
        background: var(--warning-color);
        color: white;
    }

    .review-btn:hover {
        background: #d97706;
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .submit-btn {
        background: var(--success-color);
        color: white;
    }

    .submit-btn:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    /* Navigation Panel - Simplified Design */
    .navigation-panel {
        background: var(--bg-primary);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        padding: 2rem;
        display: flex;
        flex-direction: column;
        gap: 2rem;
        overflow-y: auto;
        border: 1px solid var(--border-color);
        /* max-height: calc(100vh - 180px); */
        height: 435px;
    }

    .nav-header {
        text-align: center;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-light);
    }

    .exam-summary h3 {
        margin: 0 0 0.5rem 0;
        color: var(--text-primary);
        font-size: 1.25rem;
        font-weight: 700;
    }

    .exam-id {
        color: var(--text-secondary);
        font-size: 1rem;
        font-weight: 500;
    }

    /* Subject Tabs - Horizontal Layout */
    .subject-tabs {
        display: flex;
        gap: 0.5rem;
    }

    .subject-tab {
        flex: 1;
        padding: 0.5rem 1rem;
        background: var(--bg-tertiary);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        cursor: pointer;
        font-weight: 600;
        text-align: center;
        transition: all 0.2s ease;
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .subject-tab:hover {
        background: var(--bg-secondary);
        border-color: var(--primary-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    .subject-tab.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        box-shadow: var(--shadow-md);
    }

    /* Question Grid - Larger Buttons */
    .question-grid {
        display: flex;
        gap: 1rem;
        justify-content: flex-start;
    }

    .question_number {
        width: 50px;
        height: 30px;
        border: 2px solid var(--border-color);
        background: var(--secondary-color);
        border-radius: var(--radius-md);
        cursor: pointer;
        font-weight: 700;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        color: white;
    }

    .question_number:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .question_number.btn-primary {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        box-shadow: var(--shadow-md);
    }

    .question_number.btn-success {
        background: var(--success-color);
        color: white;
        border-color: var(--success-color);
    }

    .question_number.btn-danger {
        background: var(--danger-color);
        color: white;
        border-color: var(--danger-color);
    }

    .question_number.btn-maroon {
        background: var(--warning-color);
        color: white;
        border-color: var(--warning-color);
    }

    .question_number.btn-secondary {
        background: var(--secondary-color);
        color: white;
        border-color: var(--secondary-color);
    }

    /* Legend - 2x2 Grid Layout */
    .question-legend {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: var(--radius-sm);
    }

    .legend-color.answered {
        background: var(--success-color);
    }

    .legend-color.not-answered {
        background: var(--danger-color);
    }

    .legend-color.marked {
        background: var(--warning-color);
    }

    .legend-color.skipped {
        background: var(--secondary-color);
    }

    /* Modal Styles */
    .modern-modal {
        border: none;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-xl);
        overflow: hidden;
    }

    .modern-modal .modal-body {
        padding: 3rem 2rem;
    }

    .modal-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
    }

    .modal-icon.warning {
        background: linear-gradient(135deg, var(--warning-color), #f59e0b);
    }

    .modern-modal h4 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-primary);
    }

    .modern-modal p {
        color: var(--text-secondary);
        margin-bottom: 2rem;
        font-size: 1rem;
    }

    .modal-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .btn {
        padding: 0.75rem 2rem;
        border: none;
        border-radius: var(--radius-md);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-secondary {
        background: var(--secondary-color);
        color: white;
    }

    .btn-secondary:hover {
        background: #475569;
    }

    .btn-lg {
        padding: 1rem 2.5rem;
        font-size: 1.125rem;
    }

    /* Animations */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-in {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
        }

        50% {
            transform: translateX(5px);
        }

        75% {
            transform: translateX(-5px);
        }
    }

    .shake {
        animation: shake 0.5s ease;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .pulse {
        animation: pulse 2s infinite;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .exam-layout {
            grid-template-columns: 1fr 320px;
        }
    }

    @media (max-width: 1024px) {
        .exam-layout {
            grid-template-columns: 1fr;
            grid-template-rows: 1fr auto;
        }

        .navigation-panel {
            max-height: 400px;
        }

        .header-content {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .exam-info {
            flex-direction: column;
            gap: 1rem;
        }
    }

    @media (max-width: 768px) {
        .exam-main {
            padding: 1rem;
        }

        .action-buttons {
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        .question-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .question-content {
            padding: 1.5rem;
        }

        .header-content {
            padding: 1rem;
        }
    }

    /* Hide default elements */
    .main-header,
    .main-sidebar,
    footer {
        display: none !important;
    }

    .content-wrapper {
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Custom scrollbar */
    .navigation-panel::-webkit-scrollbar {
        width: 6px;
    }

    .navigation-panel::-webkit-scrollbar-track {
        background: var(--bg-tertiary);
        border-radius: 3px;
    }

    .navigation-panel::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 3px;
    }

    .navigation-panel::-webkit-scrollbar-thumb:hover {
        background: var(--text-muted);
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

<script>
    $(document).ready(function() {
        const questionCache = {}; // Store question_id → question_data
        var languageField = 'English';
        let currentQuestion = '';
        let currentSelectedAns = '';





        function updateQuestionProgress(currentIndex, total) {
            $('.progress-text').text(`${currentIndex} of ${total}`);
            let percentage = (currentIndex / total) * 100;
            $('.progress-fill').css('width', percentage + '%');
        }

        function updateQuestionMeta(index, type) {
            $('.question-number').text(`Question ${index}`);
            $('.question-type').text(type);
        }


        function modifiedString(item) {
            if (!item) return '';
            const originalString = item;
            const regex = /\$(.*?)\$/g;
            const modifiedString1 = originalString.replace(regex, (match, p1) => {
                return `\$$${p1}\$$`;
            });
            return modifiedString1;
        }

        function renderQuestion(questionData) {
            const display = questionData.type === 'numeric' ? 2 : 1;

            // Determine language prefix
            let prefix = '';
            if (languageField === 'हिंदी') {
                prefix = 'hi_';
            }

            const questionText = modifiedString(questionData[prefix + 'name'] || questionData.name || 'No Question');
            const ansA = modifiedString(questionData[prefix + 'ans_a'] || '');
            const ansB = modifiedString(questionData[prefix + 'ans_b'] || '');
            const ansC = modifiedString(questionData[prefix + 'ans_c'] || '');
            const ansD = modifiedString(questionData[prefix + 'ans_d'] || '');

            // Use stored answer if available (optional)
            // const currentAns = ansArray[currentIndex] ? (ansArray[currentIndex]['ans'] || '') : '';

            const questionHtml = `
        <h5 class="question-text">${questionText}</h5>

        <div class="options-container" style="display: ${display === 1 ? 'block' : 'none'}">
            <div class="option-item"> 
                <input name="radios" value="1" type="radio" id="o1" data-id="${questionData.id}">
                <label for="o1" data-letter="A">${ansA}</label>
            </div>
            <div class="option-item"> 
                <input name="radios" value="2" type="radio" id="o2" data-id="${questionData.id}">
                <label for="o2" data-letter="B">${ansB}</label>
            </div>
            <div class="option-item"> 
                <input name="radios" value="3" type="radio" id="o3" data-id="${questionData.id}">
                <label for="o3" data-letter="C">${ansC}</label>
            </div>
            <div class="option-item"> 
                <input name="radios" value="4" type="radio" id="o4" data-id="${questionData.id}">
                <label for="o4" data-letter="D">${ansD}</label>
            </div>
        </div>

        <div class="numeric-input" style="display: ${display === 2 ? 'block' : 'none'}">
            <label>Your Answer:</label>
            <input name="numeric_ans" class="form-control" type="text" id="numeric_ans" value="${'1'}">
        </div>
    `;

            $('.questioning_area').html(questionHtml).addClass('slide-in');
            // ✅ Initialize MathJax rendering
            if (window.MathJax && MathJax.typesetPromise) {
                MathJax.typesetPromise(['.questioning_area']).catch((err) => console.error('MathJax error:', err));
            }
        }

        $(document).on("click", ".option-item label", function() {
            const inputId = $(this).attr('for'); // e.g., "o2"
            const $radio = $('#' + inputId); // get the matching input

            const value = $radio.val(); // radio value (e.g., "2")
            const dataId = $radio.data('id'); // data-id (e.g., "6")

            currentQuestion = dataId;
            currentSelectedAns = value;

        });



        function saveAns() {
            $.ajax({
                url: '{{url("/")}}/save-ans', // Your API endpoint
                method: 'POST',
                data: {
                    question_id: currentQuestion,
                    choice: currentSelectedAns,
                    unique_id: "{{$attempt->unique_id}}",
                    _token: '{{ csrf_token() }}' // Laravel CSRF protection
                },
                success: function(response) {


                    if (response.status) {
                        console.log('Answer saved for question:', currentQuestion);

                        var $questions = $('.question_number');
                        var foundNext = false;

                        $questions.each(function(index) {
                            if ($(this).data('question_id') == currentQuestion) {
                                var $next = $questions.eq(index + 1);
                                if ($next.length) {
                                    console.log('Moving to next question:', $next.data('question_id'));
                                    $next.trigger('click');
                                    foundNext = true;
                                }
                                return false; // break loop
                            }
                        });

                        if (!foundNext) {
                            console.log('No more questions in this subject.');

                            // Find current subject tab
                            var $currentTab = $('.get_parts.active');
                            var $nextTab = $('.get_parts').eq($('.get_parts').index($currentTab) + 1);

                            if ($nextTab.length) {
                                console.log('Moving to next subject tab:', $nextTab.data('subject_id'));
                                $nextTab.trigger('click');

                                // Wait for questions to render, then auto-click first question
                                setTimeout(function() {
                                    $('.question_number').eq(0).trigger('click');
                                }, 200);
                            } else {
                                alert('No more subjects.');
                                // Optional: show finish/submit UI
                            }
                        }
                    } else {
                        alert('Something Went Wrong')
                    }


                },
                error: function() {
                    $('#question_detail').html(`<p>Error fetching question.</p>`);
                }
            });
        }
        $(document).on("click", "#save_and_next", function() {
            saveAns();


        });

        $(".get_parts").on("click", function() {
            let questions = $(this).attr('data-questionsids');
            let types = $(this).attr('data-question_types');

            $(".subject-tab").removeClass('active');
            $(this).addClass('active');

            let questionHtml = '';
            let questionArray = [];
            let questionTypeArray = [];

            try {
                questionArray = JSON.parse(questions);
                questionTypeArray = JSON.parse(types);

                questionArray.forEach(function(id, index) {
                    const qType = questionTypeArray[index] || 'Single Choice';
                    questionHtml += `
                    <button class="question_number" data-question_id="${id}" data-question_type="${qType}">
                        ${index + 1}
                    </button>
                `;
                });

                updateQuestionProgress(1, questionArray.length);
                updateQuestionMeta(1, questionTypeArray[0] || 'Single Choice');

            } catch (e) {
                console.error("Invalid JSON", e);
            }

            $("#ques_list").html(questionHtml);

            setTimeout(function() {
                $('.question_number').first().trigger('click');
            }, 100);
        });

        $(document).on("click", ".question_number", function() {



            $(".question_number").removeClass('btn-primary');
            $(this).addClass('btn-primary');

            let currentIndex = $(this).index() + 1;
            let total = $(".question_number").length;
            let questionId = $(this).attr('data-question_id');



            let questionType = $(this).attr('data-question_type') || 'Single Choice';

            updateQuestionProgress(currentIndex, total);
            updateQuestionMeta(currentIndex, questionType);





            // Check in cache
            if (questionCache[questionId]) {

                renderQuestion(questionCache[questionId]); // Use cached data
            } else {
                // AJAX fetch if not in cache
                $.ajax({
                    url: '{{url("/")}}/initialize-question', // Your API endpoint
                    method: 'POST',
                    data: {
                        question_id: questionId,
                        _token: '{{ csrf_token() }}' // Laravel CSRF protection
                    },
                    success: function(response) {
                        if (response.status && response.data) {

                            questionCache[questionId] = response.data;
                            renderQuestion(response.data);
                            console.log(questionCache)

                        } else {
                            $('#question_detail').html(`<p>Question not found.</p>`);
                        }
                    },
                    error: function() {
                        $('#question_detail').html(`<p>Error fetching question.</p>`);
                    }
                });
            }
        });

        // Initial load
        if ($('.get_parts').length) {
            $('.get_parts').eq(0).trigger('click');
        }

        $("#change_language").on("click", function() {
            if (languageField === 'हिंदी') {

                $(this).find('span').text('English');
                languageField = 'English';
            } else {
                $(this).find('span').text('हिंदी');
                languageField = 'हिंदी';
            }

            $('.question_number.btn-primary').trigger('click');
        });
    });
</script>


<script>
    // Timer functionality
    $(document).ready(function() {
        function setTimmer() {
            var currentDate = new Date();
            var session_time = '{{ $start_time }}';
            var futureDate = new Date(session_time);
            var timeDifference = (futureDate - currentDate) / 1000;
            var hours = Math.floor(timeDifference / 3600);
            var minutes = Math.floor((timeDifference % 3600) / 60);
            var seconds = (timeDifference % 60).toFixed(0);

            $('.countdown_exam').text(hours + ':' + String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0'));

            if (parseInt(minutes) <= 0 && parseInt(seconds) <= 0 && parseInt(hours) <= 0) {
                clearInterval(intervalId);
                $("#formAdd").trigger("submit");
            }
        }

        setTimmer();
        var intervalId = setInterval(setTimmer, 1000);
    });

    // Modal functionality
    document.addEventListener("DOMContentLoaded", () => {
        const modalElement = document.getElementById("bestOfLuckModal");
        const proceed = document.getElementById("proceedExam");

        if (typeof bootstrap !== 'undefined') {
            const modal = new bootstrap.Modal(modalElement, {
                backdrop: "static",
                keyboard: false
            });
            modal.show();

            proceed.addEventListener("click", () => {
                modal.hide();
            });
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

@endsection