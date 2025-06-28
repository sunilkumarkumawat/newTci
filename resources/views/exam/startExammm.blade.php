@extends('layout.app') 
@section('content')

@php
// Static exam start time (2 hours from now)
$start_time = now()->addHours(2)->format('Y-m-d H:i:s');
$exam_id = 1;
@endphp

<div class="exam-container">
    <!-- Header Section -->
    <header class="exam-header">
        <div class="header-content">
            <div class="exam-info">
                <div class="exam-title">
                    <i class="fas fa-graduation-cap"></i>
                    <h1>Mathematics Mock Test</h1>
                </div>
                <div class="exam-timer">
                    <i class="fas fa-clock"></i>
                    <span class="countdown_exam">2:00:00</span>
                </div>
            </div>
            
            <div class="header-controls">
                <button type="button" class="control-btn language-btn" id="change_language">
                    <i class="fas fa-language"></i>
                    <span>हिंदी</span>
                </button>
                <button type="button" class="control-btn fullscreen-btn" data-widget="fullscreen">
                    <i class="fas fa-expand"></i>
                    <span>Full Screen</span>
                </button>
            </div>
            
            <div class="user-profile">
                <div class="user-avatar">
                    <img src="{{env('IMAGE_SHOW_PATH')}}default/user_image.jpg" alt="User Avatar" />
                </div>
                <div class="user-details">
                    <div class="user-name">John Doe</div>
                    <div class="user-contact">9876543210</div>
                    <div class="user-class">Class 12th Science</div>
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
                        <span class="question-number">Question 1</span>
                        <span class="question-type">Single Choice</span>
                    </div>
                    
                    <div class="question-content">
                        <div class="questioning_area">
                            <!-- Question content will be loaded here -->
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="action-btn secondary" id="clear_response">
                        <i class="fas fa-eraser"></i>
                        Clear
                    </button>
                    <button class="action-btn primary" id="save_and_next">
                        <i class="fas fa-arrow-right"></i>
                        Save & Next
                    </button>
                    <button class="action-btn warning" id="mark_review">
                        <i class="fas fa-bookmark"></i>
                        Mark for Review
                    </button>
                    <button class="action-btn success" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-check"></i>
                        Submit
                    </button>
                </div>
            </section>

            <!-- Navigation Panel -->
            <aside class="navigation-panel">
                <div class="exam-summary">
                    <div class="summary-header">
                        <h3>Mathematics Mock Test</h3>
                        <span class="exam-id">ID: 1</span>
                    </div>
                </div>

                <!-- Subject Tabs -->
                <div class="subject-tabs">
                    @php
                    $uniqueSubjects1 = [
                        (object)['subject' => '1: Mathematics', 'subject_id' => 1],
                        (object)['subject' => '2: Physics', 'subject_id' => 2],
                        (object)['subject' => '3: Chemistry', 'subject_id' => 3]
                    ];
                    @endphp
                    
                    @foreach($uniqueSubjects1 as $item)
                        @php
                        preg_match('/\d+\s*:\s*([a-zA-Z\s]+)/', $item->subject ?? '', $matches);
                        @endphp
                        <button class="subject-tab get_parts" data-subject_name="{{$item->subject ?? ''}}" data-subject_id="{{$item->subject_id ?? ''}}">
                            {{ $matches[1] ?? '' }}
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
    <input type="hidden" id="currentSubjectId"/>
    <input type="hidden" name="result" id="form_submit_ans"/>
    <input type="hidden" name="exam_id" value="1" />
</form>

<!-- Modals -->
<div class="modal fade" id="bestOfLuckModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-star text-warning"></i>
                    Best of Luck!
                </h5>
            </div>
            <div class="modal-body text-center">
                <p>Ready to begin your exam? Take your time and do your best!</p>
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
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-question-circle text-warning"></i>
                    Confirm Submission
                </h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to submit your exam? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
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

<style>
/* Modern Professional Exam Interface Styles */
* {
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    margin: 0;
    padding: 0;
    min-height: 100vh;
}

.exam-container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Header Styles */
.exam-header {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    padding: 1rem 2rem;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
}

.exam-info {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.exam-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.exam-title i {
    color: #667eea;
    font-size: 1.5rem;
}

.exam-title h1 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    color: #2d3748;
}

.exam-timer {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: #f7fafc;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.exam-timer i {
    color: #e53e3e;
}

.countdown_exam {
    font-weight: 600;
    color: #e53e3e;
    font-size: 1.1rem;
}

.header-controls {
    display: flex;
    gap: 1rem;
}

.control-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: #667eea;
    color: white;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.control-btn:hover {
    background: #5a67d8;
    transform: translateY(-1px);
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #667eea;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-details {
    text-align: right;
}

.user-name {
    font-weight: 600;
    color: #2d3748;
    font-size: 1rem;
}

.user-contact, .user-class {
    font-size: 0.875rem;
    color: #718096;
    margin-top: 2px;
}

/* Main Content */
.exam-main {
    flex: 1;
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
}

.exam-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 2rem;
    height: calc(100vh - 140px);
}

/* Question Panel */
.question-panel {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.question-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    flex: 1;
}

.question-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.question-number {
    font-weight: 600;
    font-size: 1.1rem;
}

.question-type {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
}

.question-content {
    padding: 2rem;
    min-height: 400px;
}

.questioning_area {
    font-size: 1rem;
    line-height: 1.6;
}

/* Radio Button Styles */
input[type="radio"] {
    position: absolute;
    opacity: 0;
}

input[type="radio"] + label {
    position: relative;
    padding: 1rem;
    margin: 0.5rem 0;
    display: flex;
    align-items: center;
    background: #f7fafc;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
}

input[type="radio"] + label:hover {
    background: #edf2f7;
    border-color: #667eea;
}

input[type="radio"]:checked + label {
    background: #ebf4ff;
    border-color: #667eea;
    color: #2b6cb0;
}

input[type="radio"] + label::before {
    content: attr(data-letter);
    width: 32px;
    height: 32px;
    border: 2px solid #cbd5e0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-weight: 600;
    background: white;
    transition: all 0.2s ease;
}

input[type="radio"]:checked + label::before {
    background: #667eea;
    border-color: #667eea;
    color: white;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 1rem;
    padding: 0 1rem;
}

.action-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.875rem 1rem;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.action-btn.primary {
    background: #667eea;
    color: white;
}

.action-btn.primary:hover {
    background: #5a67d8;
}

.action-btn.secondary {
    background: #718096;
    color: white;
}

.action-btn.secondary:hover {
    background: #4a5568;
}

.action-btn.warning {
    background: #d69e2e;
    color: white;
}

.action-btn.warning:hover {
    background: #b7791f;
}

.action-btn.success {
    background: #38a169;
    color: white;
}

.action-btn.success:hover {
    background: #2f855a;
}

/* Navigation Panel */
.navigation-panel {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    overflow-y: auto;
}

.exam-summary {
    text-align: center;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.summary-header h3 {
    margin: 0 0 0.5rem 0;
    color: #2d3748;
    font-size: 1.1rem;
}

.exam-id {
    color: #718096;
    font-size: 0.875rem;
}

/* Subject Tabs */
.subject-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.subject-tab {
    flex: 1;
    padding: 0.75rem;
    background: #f7fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    text-align: center;
    transition: all 0.2s ease;
}

.subject-tab:hover {
    background: #edf2f7;
}

.subject-tab.active {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

/* Question Grid */
.question-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.5rem;
}

.question_number {
    width: 100%;
    height: 40px;
    border: 1px solid #e2e8f0;
    background: #f7fafc;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.question_number:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.question_number.btn-primary {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.question_number.btn-success {
    background: #38a169;
    color: white;
    border-color: #38a169;
}

.question_number.btn-danger {
    background: #e53e3e;
    color: white;
    border-color: #e53e3e;
}

.question_number.btn-maroon {
    background: #d69e2e;
    color: white;
    border-color: #d69e2e;
}

.question_number.btn-secondary {
    background: #a0aec0;
    color: white;
    border-color: #a0aec0;
}

/* Legend */
.question-legend {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.legend-color {
    width: 16px;
    height: 16px;
    border-radius: 3px;
}

.legend-color.answered {
    background: #38a169;
}

.legend-color.not-answered {
    background: #e53e3e;
}

.legend-color.marked {
    background: #d69e2e;
}

.legend-color.skipped {
    background: #a0aec0;
}

/* Modal Styles */
.modern-modal {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
}

.modern-modal .modal-header {
    background: #f7fafc;
    border-bottom: 1px solid #e2e8f0;
    border-radius: 12px 12px 0 0;
}

.modern-modal .modal-footer {
    background: #f7fafc;
    border-top: 1px solid #e2e8f0;
    border-radius: 0 0 12px 12px;
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
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
}

.shake {
    animation: shake 0.5s ease;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .exam-layout {
        grid-template-columns: 1fr;
        grid-template-rows: 1fr auto;
    }
    
    .navigation-panel {
        max-height: 300px;
    }
    
    .header-content {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .exam-main {
        padding: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .question-grid {
        grid-template-columns: repeat(3, 1fr);
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
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script>
// All the existing JavaScript functionality remains the same
// Static exam configuration
var part_a_compulsory = 2;
var part_b_compulsory = 0;
var lengthB = 0;
var count_plus = 0;
var question_id = '';
var currentIndex = '';
var currentKey = '';

let uniqueSubjects = ['1: Mathematics', '2: Physics', '3: Chemistry'];

// Static questions data
var myArray = [
    {id: 1, name: 'What is 2+2?', ans_a: '3', ans_b: '4', ans_c: '5', ans_d: '6', correct_ans: '2', subject_id: 1, question_type_id: 1, hi_name: '2+2 क्या है?', hi_ans_a: '3', hi_ans_b: '4', hi_ans_c: '5', hi_ans_d: '6'},
    {id: 2, name: 'What is 3×3?', ans_a: '6', ans_b: '9', ans_c: '12', ans_d: '15', correct_ans: '2', subject_id: 1, question_type_id: 1, hi_name: '3×3 क्या है?', hi_ans_a: '6', hi_ans_b: '9', hi_ans_c: '12', hi_ans_d: '15'},
    {id: 3, name: 'What is the unit of force?', ans_a: 'Joule', ans_b: 'Newton', ans_c: 'Watt', ans_d: 'Pascal', correct_ans: '2', subject_id: 2, question_type_id: 1, hi_name: 'बल की इकाई क्या है?', hi_ans_a: 'जूल', hi_ans_b: 'न्यूटन', hi_ans_c: 'वाट', hi_ans_d: 'पास्कल'},
    {id: 4, name: 'What is the speed of light?', ans_a: '3×10⁸ m/s', ans_b: '3×10⁶ m/s', ans_c: '3×10⁷ m/s', ans_d: '3×10⁹ m/s', correct_ans: '1', subject_id: 2, question_type_id: 1, hi_name: 'प्रकाश की गति क्या है?', hi_ans_a: '3×10⁸ m/s', hi_ans_b: '3×10⁶ m/s', hi_ans_c: '3×10⁷ m/s', hi_ans_d: '3×10⁹ m/s'},
    {id: 5, name: 'What is H₂O?', ans_a: 'Hydrogen', ans_b: 'Oxygen', ans_c: 'Water', ans_d: 'Carbon dioxide', correct_ans: '3', subject_id: 3, question_type_id: 1, hi_name: 'H₂O क्या है?', hi_ans_a: 'हाइड्रोजन', hi_ans_b: 'ऑक्सीजन', hi_ans_c: 'पानी', hi_ans_d: 'कार्बन डाइऑक्साइड'},
    {id: 6, name: 'What is NaCl?', ans_a: 'Sugar', ans_b: 'Salt', ans_c: 'Acid', ans_d: 'Base', correct_ans: '2', subject_id: 3, question_type_id: 1, hi_name: 'NaCl क्या है?', hi_ans_a: 'चीनी', hi_ans_b: 'नमक', hi_ans_c: 'अम्ल', hi_ans_d: 'क्षार'}
];

var paper_medium = {medium: 1};
var ansArray = [];

// Static questions structure
var questionsTemp = [
    {ques_id: 1, subject: '1: Mathematics', part: 'A', subject_id: 1},
    {ques_id: 2, subject: '1: Mathematics', part: 'A', subject_id: 1},
    {ques_id: 3, subject: '2: Physics', part: 'A', subject_id: 2},
    {ques_id: 4, subject: '2: Physics', part: 'A', subject_id: 2},
    {ques_id: 5, subject: '3: Chemistry', part: 'A', subject_id: 3},
    {ques_id: 6, subject: '3: Chemistry', part: 'A', subject_id: 3}
];

$(myArray).each(function(index) {
    var part = '';
    $(questionsTemp).each(function(key, item) {
        if(item['ques_id'] == myArray[index].id) {
            part = item['part'];
        }
    });
    
    ansArray[index] = {
        'que_id': myArray[index].id,
        'ans': null,
        'correct': 0,
        'time': 0,
        'visited_count': 0,
        'subject_id': myArray[index].subject_id,
        'q_type': myArray[index].question_type_id,
        'part': part
    }
});

$(document).ready(function(){
    
    function toSaveIntoInput(){
        $('#form_submit_ans').val(JSON.stringify(ansArray));
    }
    
    let timerInterval;

    function myTimer() {
        if(currentIndex !== '' && ansArray[currentIndex]) {
            ansArray[currentIndex]['time'] = Number(ansArray[currentIndex]['time'])+1;
        }
    }

    function addTimer() {
        timerInterval = setInterval(myTimer, 1000);
    }

    function stopTimer() {
        clearInterval(timerInterval);
    }
    
    if ($('.get_parts').length) { 
        $('.get_parts').eq(0).click(); 
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
   
    function setQuestion(){
        stopTimer();
        $('.questioning_area').html('');
        
        var language_field = '';   
        
        if(paper_medium.medium == 2) {
            language_field = 'hi_';
        } else {
            language_field = '';
        }
        
        var filteredArray = myArray.filter(function(item) {
            return item.id == question_id;
        });
        
        if(filteredArray.length === 0) return;
        
        var display = filteredArray[0]['question_type_id'];
        
        const questionHtml = `
            <h5 class="question-text">${modifiedString(filteredArray[0][language_field+'name'])}</h5>
           
            <div class="options-container" style='display:${display == 1 ? "block" : "none" }'>
                <div class="option-item"> 
                    <input name="radios" value="1" type="radio" id="o1" >
                    <label for="o1" data-letter="A">
                        ${modifiedString(filteredArray[0][language_field+'ans_a'])}
                    </label>
                </div>
                <div class="option-item">
                    <input name="radios" value="2" type="radio" id="o2" >
                    <label for="o2" data-letter="B">
                        ${modifiedString(filteredArray[0][language_field+'ans_b'])}
                    </label>
                </div>
                <div class="option-item">
                    <input name="radios" value="3" type="radio" id="o3" >
                    <label for="o3" data-letter="C">
                        ${modifiedString(filteredArray[0][language_field+'ans_c'])}
                    </label>
                </div>
                <div class="option-item">
                    <input name="radios" value="4" type="radio" id="o4" >
                    <label for="o4" data-letter="D">
                        ${modifiedString(filteredArray[0][language_field+'ans_d'])}
                    </label>
                </div>
            </div>
            <div class="numeric-input" style='display:${display == 2 ? "block" : "none" }'>
                <label>Your Answer:</label>
                <input name="numeric_ans" class="form-control" type="text" id="numeric_ans" value="${ansArray[currentIndex] ? ansArray[currentIndex]['ans'] || '' : ''}">
            </div>
        `;
        
        $('.questioning_area').html(questionHtml);
        $('.questioning_area').addClass('slide-in');
        
        // Set previously selected answer
        if(ansArray[currentIndex] && ansArray[currentIndex]['ans']) {
            $("input[name='radios'][value=" + ansArray[currentIndex]['ans'] + "]").prop('checked', true);
        }
        
        ansArray[currentIndex]['visited_count'] = Number(ansArray[currentIndex]['visited_count'])+1;
        addTimer();
        
        setTimeout(function() {
            $('.questioning_area').removeClass('slide-in');
        }, 500);
    }

    // Event handlers
    $("#mark_review").on("click", function(e){
        $(`[data-question="${question_id}"]`).removeClass('btn-success btn-danger btn-secondary').addClass("btn-maroon");
        navigateToNext();
    });

    $("#save_and_next").on("click", function(e){
        saveCurrentAnswer();
        navigateToNext();
        toSaveIntoInput();
    });

    function navigateToNext() {
        if (currentIndex !== -1) {
            let nextIndex;
            if (currentIndex < $('.question_number').length - 1) {
                nextIndex = currentIndex + 1;
            } else {
                nextIndex = 0;
            }
            let nextQuestion = $('.question_number').eq(nextIndex);
            if (nextQuestion.length) {
                nextQuestion.trigger('click');
            }
        }
    }

    function saveCurrentAnswer() {
        var ansValue = '';
        var correctAns = 1;
     
        var questionArray = myArray.filter(function(item) {
            return item.id == question_id;
        });
        
        if(questionArray.length === 0) return;
     
        if(questionArray[0]['question_type_id'] == 2) {
            ansValue = $('#numeric_ans').val();
            if(ansValue == questionArray[0]['ans_a']) {
                correctAns = 2;
            } else {
                correctAns = 1;
            }
        } else {
            ansValue = $('input[name="radios"]:checked').val();
            if(ansValue == questionArray[0]['correct_ans']) {
                correctAns = 2;
            } else if(ansValue == undefined) {
                correctAns = '';
            } else {
                correctAns = 1;
            }
        }

        if(ansArray[currentIndex]) {
            ansArray[currentIndex]['ans'] = ansValue || null;
            ansArray[currentIndex]['correct'] = correctAns;
            ansArray[currentIndex]['time'] = '';
            
            $('.question_number').eq(currentIndex).removeClass('btn-success btn-danger btn-maroon btn-secondary');
            
            if(ansArray[currentIndex]['ans'] !== null) {
                $('.question_number').eq(currentIndex).addClass('btn-success');
            } else {
                $('.question_number').eq(currentIndex).addClass('btn-danger');
            }
        }
    }

    $(document).on("click", ".question_number", function() {
        $(".question_number").removeClass('btn-primary');
        $(this).addClass('btn-primary');
        
        currentIndex = $('.question_number').index(this);
        question_id = $(this).attr('data-question');
        currentKey = $(this).attr('data-index');

        setQuestion();
    });

    $("#change_language").on("click", function(){
        if (paper_medium.medium === 1) {
            paper_medium.medium = 2;
            $(this).find('span').text('English');
        } else {
            paper_medium.medium = 1;
            $(this).find('span').text('हिंदी');
        }
        setQuestion();
    });

    $("#clear_response").on("click", function() {
        $('input[name="radios"]').prop('checked', false);
        $("#numeric_ans").val('');
        
        if(ansArray[currentIndex]) {
            ansArray[currentIndex]['ans'] = null;
            ansArray[currentIndex]['correct'] = 0;
            $('.question_number').eq(currentIndex).removeClass('btn-success btn-maroon').addClass('btn-danger');
        }
        
        $('.questioning_area').addClass('shake');
        setTimeout(function() {
            $('.questioning_area').removeClass('shake');
        }, 1200);
    });

    $("#modal-btn-confirm").on("click", function () {
        $("#hide_modal").trigger("click");
        $("#formAdd").trigger("submit");
    });

    toSaveIntoInput();
});

// Subject and question management
var questionsData = JSON.stringify([
    {ques_id: 1, subject: '1: Mathematics', part: 'A', subject_id: 1},
    {ques_id: 2, subject: '1: Mathematics', part: 'A', subject_id: 1},
    {ques_id: 3, subject: '2: Physics', part: 'A', subject_id: 2},
    {ques_id: 4, subject: '2: Physics', part: 'A', subject_id: 2},
    {ques_id: 5, subject: '3: Chemistry', part: 'A', subject_id: 3},
    {ques_id: 6, subject: '3: Chemistry', part: 'A', subject_id: 3}
]);
var questions = JSON.parse(questionsData);

$(".get_parts").on("click", function() {
    var subject = $(this).attr('data-subject_name');
    var currentSubjectId = $(this).attr('data-subject_id');
    
    $("#currentSubjectId").val(currentSubjectId);
    
    $(".subject-tab").removeClass('active');
    $(this).addClass('active');

    var subjectQuestions = questions.filter(function(question) {
        return question.subject === subject;
    }); 

    var partAQuestions = subjectQuestions.filter(q => q.part === 'A');
    var questionHtml = '';

    partAQuestions.forEach(function(question, index) {
        var visited = 0;
        ansArray.forEach(function(item) {
            if(item.que_id == question.ques_id && item.ans !== null) {
                visited = 1;
            }
        });
        
        questionHtml += `
            <button class="question_number ${visited == 1 ? "btn-success" : "btn-secondary"}" data-index="${index}" data-question="${question.ques_id}">
                ${index+1}
            </button>
        `;
    });
    
    $("#ques_list").html(questionHtml);

    setTimeout(function() {
        $('.question_number').first().trigger('click');
    }, 100);
});

// Timer functionality
$(document).ready(function(){
    function setTimmer(){
        var currentDate = new Date();
        var session_time = '{{ $start_time }}';
        var futureDate = new Date(session_time);
        var timeDifference = (futureDate - currentDate)/1000;
        var hours = Math.floor(timeDifference / 3600);
        var minutes = Math.floor((timeDifference % 3600) / 60);
        var seconds = (timeDifference % 60).toFixed(0);
        
        $('.countdown_exam').text(hours + ':' + String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0'));
        
        if(parseInt(minutes) <= 0 && parseInt(seconds) <= 0 && parseInt(hours) <= 0) {
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

    if(typeof bootstrap !== 'undefined') {
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

@endsection
