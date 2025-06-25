@extends('layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <form id="quickForm" action="{{ url('add/exam') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row border-bottom border-warning">

                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Basic Details</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body ">
                                        <strong><i class="fas fa-book mr-1"></i> Exam Name</strong></br>

                                        <span class="text-muted">
                                            {{$examDetails->name ?? 'NA'}}
                                        </span>

                                        <hr>

                                        <strong><i class="fas fa-map-marker-alt mr-1"></i>Exam Pattern</strong></br>

                                        <span class="text-muted">{{$examDetails->exam_pattern_name ?? 'NA'}}</span>

                                        <hr>

                                        <strong><i class="fas fa-pencil-alt mr-1"></i>Exam Type </strong>

                                        <p class="text-muted">{{$examDetails->exam_type_name ?? 'NA'}}</p>

                                        <hr>

                                        <strong><i class="far fa-file-alt mr-1"></i>Created At</strong>

                                        <p class="text-muted">{{$examDetails->created_at ?? 'NA'}}</p>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>




                        </div>

                    </div>

                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Select Subjects</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body ">
            
                    
                                        @include('commoninputs.dependentInputs', [
                                        'modal' => 'Subject',
                                        'name' => 'subject_id',
                                        'selected' => $data->subject_id ?? null,
                                        'label' => 'Subject',
                                        'required' => true,
                                        'isRequestSent' => isset($examDetails->exam_pattern_id),
                                        'dependentId' => $examDetails->exam_pattern_id ?? null,
                                        'foreignKey' => 'exam_pattern_id',
                                        ])

                                        <button class='btn-xs btn btn-info' type='button' id='appendSubject'>Append Subject</button>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Subject(s) Overview</h3>
                                    </div>

                                    
                                    <!-- /.card-header -->
                                 <div class="d-flex flex-wrap gap-2 mb-2 align-items-end" id="questionMarkSection">
    <div class="me-3">
        <label for="per_question_marks" class="form-label">Per Question Marks</label>
        <input type="text" name="per_question_marks" id="per_question_marks" value="4" class="form-control" />
    </div>

    <div class="me-3">
        <label for="total_questions" class="form-label">Total Questions</label>
        <input type="text" name="total_questions" id="total_questions" value="0" class="form-control" />
    </div>

    <div class="me-3">
        <label for="total_marks" class="form-label">Total Marks</label>
        <input type="text" name="total_marks" id="total_marks" value="0" class="form-control" readonly />
    </div>
</div>
                                    <div id="subjectContainer" class="card-body d-flex flex-wrap gap-3">
                                        
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- Questions Modal -->
<div class="modal fade" id="questionsModal" tabindex="-1" aria-labelledby="questionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg <div class=" modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="questionsModalLabel">Questions by Subject</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div id="questionsContainer"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<!-- Subtopic Modal -->
<div class="modal fade" id="subtopicModal" tabindex="-1" aria-labelledby="subtopicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subtopicModalLabel">Subtopic List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div id="selector_sub_topics"></div>
                <table id="modal_subtopic" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Subtopic</th>
                            <th>Objective</th>
                            <th>Numeric</th>
                        </tr>
                    </thead>
                    <tbody id="subtopicTableBody"></tbody>
                </table>
                <span id="total_selected_questions"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success d-none" id="create_questions_topic_wise">Create</button>
                <div id="show_message" class="text-danger"></div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control {
        height: 24px;
    }

    table {
        font-size: small;
    }

    .bold-input {
        font-weight: bold;
    }

    #appendChapterData,
    #appendTopicData {
        height: 400px;
        overflow-y: auto;
    }

    .typewriter {
        font-size: 18px;
        white-space: nowrap;
    }

.selected-subject {
    border: 2px solid #007bff !important;
    background-color: #f0f8ff;
}
</style>


<script>
// Global variables (can be updated from anywhere)
let totalQuestions = 0;
let marksPerQuestion = 0;

// Function to update subject details from another function
function setSubjectDetails(questions, marksPerQ) {
    totalQuestions = questions;
    marksPerQuestion = marksPerQ;
}

// Append subject on button click
$(document).on('click', '#appendSubject', function () {
    let subjectId = $('select[name="subject_id"]').val();
    let subjectName = $('select[name="subject_id"] option:selected').text();

    if (!subjectId) {
        toastr.warning("Please select a subject.");
        return;
    }

    // Check for duplicate subject
    if ($(`.subject-item[data-subject-id="${subjectId}"]`).length > 0) {
        toastr.info("Subject already added.");
        return;
    }

    let totalMarks = totalQuestions * marksPerQuestion;

    let subjectBox = `
        <div class="subject-box p-2 m-1 border rounded flex-fill subject-item" 
             data-subject-id="${subjectId}">
            <strong><i class="fas fa-book mr-1"></i> ${subjectName}</strong><br>
            <span class="text-muted">Total Questions: ${totalQuestions}</span><br>
            <span class="text-muted">Marks per Question: ${marksPerQuestion}</span><br>
            <span class="text-muted">Total Marks: ${totalMarks}</span>
        </div>
    `;

    $('#subjectContainer').append(subjectBox);
 $('select[name="subject_id"]').val('');

});

// Optional: Click handler for subject box (for future use)
$(document).on('click', '.subject-item', function () {
    let subjectId = $(this).data('subject-id');
    // alert('You clicked subject ID: ' + subjectId);

    // Remove 'selected' class from all boxes
    $('.subject-item').removeClass('selected-subject');

    // Add 'selected' class to the clicked one
    $(this).addClass('selected-subject');
});

// Example call to set dynamic values
setSubjectDetails(26, 4); // Can be updated anytime from elsewhere
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-AMS_HTML"></script>
@endsection