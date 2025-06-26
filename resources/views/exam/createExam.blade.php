@extends('layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <form id="quickForm" action="{{ url('add/exam') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

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

                                        <div class="form-group">
                                            <label for="number_of_questions_per_subject" class="form-label">
                                                Number of Questions Per Subject
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="number" min='1' name="number_of_questions_per_subject" id="number_of_questions_per_subject" value="35" class="form-control" data-required='true' />
                                        </div>

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

                                    <div class="card-body ">
                                        <div id="subjectContainer" class="justify-content-center card-body d-flex flex-wrap gap-3">
                                            <span class='empty-message'>Please select a subject to see the overview.</span>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 mb-2 justify-content-center align-items-end" id="questionMarkSection">
                                            <div class="mr-2">
                                                <label for="per_question_marks" class="form-label">Per Question Marks <span class="text-danger">*</span></label>

                                                <input type="text" name="per_question_marks" id="per_question_marks" value="4" class="form-control" />
                                            </div>

                                            <div class="mr-2">
                                                <label for="total_questions" class="form-label">Total Questions <span class="text-danger">*</span></label>
                                                <input type="text" name="total_questions" id="total_questions" value="0" class="form-control" />
                                            </div>

                                            <div class="mr-2">
                                                <label for="total_marks" class="form-label">Total Marks</label>
                                                <input type="text" name="total_marks" id="total_marks" value="0" class="form-control" readonly />
                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id='questionsSelectionSection'>

                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Select Questions</h3>
                            </div>

                            <div class="card-body ">

                                <div class="row">
                                    <div class="col-md-2">
                                        @include('commoninputs.inputs', [
                                        'modal' => 'ClassType', // This decides the data source
                                        'name' => 'class_type_id',
                                        'selected' => $data->class_type_id ?? null,
                                        'label' => 'Select Class',
                                        'required' => true,
                                        ])

                                    </div>
                                    <div class="col-md-12 pt-3">
                                        <table class="table table-bordered table-striped table-hover table-responsive">
                                            <thead class="thead-primary">
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Name</th>
                                                    <th>Questions Available</th>
                                                    <th>Objective</th>
                                                    <th>Number</th>
                                                </tr>
                                            </thead>
                                            <tbody id="questionsTableBody">
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
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
    // Global variables
    let totalQuestions = 0;
    let marksPerQuestion = 4;
    let numberOfSelectedSubject = 0;

    $('#questionsSelectionSection').hide();


    function loadQuestionsTable(){
           const url = `{{ url('/getQuestionsByRequest') }}/${1}/${1}`;

                $('#questionsTableBody').load(url);
    }

    // Utility: Set total question and mark values
    function setSubjectDetails(questions, marksPerQ) {
        totalQuestions += parseInt(questions);
        marksPerQuestion = marksPerQ;
        updateTotalFields();
    }

    // Utility: Update total fields in the UI
    function updateTotalFields() {
        $('#total_questions').val(totalQuestions);
        $('#total_marks').val(totalQuestions * marksPerQuestion);
    }

    // Utility: Create subject box HTML
    function createSubjectBox(subjectId, subjectName, numberOfQuestions, marksPerQuestion) {
        let totalMarks = numberOfQuestions * marksPerQuestion;

        return `
            <div class="subject-box p-2 m-1 border rounded flex-fill subject-item position-relative" 
                 data-subject-id="${subjectId}">
                <button type="button" class="close-btn btn btn-sm btn-danger position-absolute" 
                style="top: 5px; right: 5px; z-index: 10;" 
                onclick="removeSubjectBox(this, event)">
                &times;
                </button>
                <strong><i class="fas fa-book mr-1"></i> ${subjectName}</strong><br>
                <span class="text-muted">Total Questions: ${numberOfQuestions}</span><br>
                <span class="text-muted">Marks per Question: ${marksPerQuestion}</span><br>
                <span class="text-muted">Total Marks: ${totalMarks}</span>
            </div>
        `;
    }

    // Event: Append subject on button click
    $(document).on('click', '#appendSubject', function() {
        let subjectId = $('select[name="subject_id"]').val();
        let numberOfQuestions = $('#number_of_questions_per_subject').val();
        let subjectName = $('select[name="subject_id"] option:selected').text();

        if (!subjectId) {
            toastr.warning("Please select a subject.");
            return;
        }

        if (isSubjectAlreadyAdded(subjectId)) {
            toastr.info("Subject already added.");
            return;
        }

        numberOfSelectedSubject++;
        setSubjectDetails(numberOfQuestions, marksPerQuestion);

        let subjectBoxHtml = createSubjectBox(subjectId, subjectName, numberOfQuestions, marksPerQuestion);
        $('#subjectContainer').find('.empty-message').remove();
        $('#subjectContainer').append(subjectBoxHtml);

        $('select[name="subject_id"]').val('');
    });

    // Utility: Check if subject is already added
    function isSubjectAlreadyAdded(subjectId) {
        return $(`.subject-item[data-subject-id="${subjectId}"]`).length > 0;
    }

    // Reusable: Remove subject box
    function removeSubjectBox(button, event) {
        event.stopPropagation(); // ✅ Prevent parent .subject-item click

        const subjectBox = $(button).closest('.subject-box');

        // Extract number of questions
        const questionsText = subjectBox.find('span:contains("Total Questions:")').text();
        const match = questionsText.match(/(\d+)/);

        if (match) {
            const questionsToRemove = parseInt(match[1]);
            totalQuestions -= questionsToRemove;
            if (totalQuestions < 0) totalQuestions = 0;
            updateTotalFields();
        }

        subjectBox.remove();

        // Hide if no subjects remain
        $('#questionsSelectionSection').hide();
    }

    // Optional: Subject item click handler
    $(document).on('click', '.subject-item', function() {

        let subjectId = $(this).data('subject-id');
        $('#questionsSelectionSection').show();
        loadQuestionsTable();

        $('.subject-item').removeClass('selected-subject');
        $(this).addClass('selected-subject');
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-AMS_HTML"></script>
@endsection