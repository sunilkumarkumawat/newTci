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
                                            {{ $examDetails->name ?? 'NA' }}
                                        </span>

                                        <hr>

                                        <strong><i class="fas fa-map-marker-alt mr-1"></i>Exam Pattern</strong></br>

                                        <span class="text-muted">{{ $examDetails->exam_pattern_name ?? 'NA' }}</span>

                                        <hr>

                                        <strong><i class="fas fa-pencil-alt mr-1"></i>Exam Type </strong>

                                        <p class="text-muted">{{ $examDetails->exam_type_name ?? 'NA' }}</p>

                                        <hr>

                                        <strong><i class="far fa-file-alt mr-1"></i>Created At</strong>

                                        <p class="text-muted">{{ $examDetails->created_at ?? 'NA' }}</p>
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

                                            <input type="number" min='1' name="number_of_questions_per_subject"
                                                id="number_of_questions_per_subject" value="35" class="form-control"
                                                data-required='true' />
                                        </div>

                                        <button class='btn-xs btn btn-info' type='button' id='appendSubject'>Append
                                            Subject</button>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Subject(s) Overview</h3>
                                    </div>

                                    <div class="card-body">
                                        <div id="subjectContainer" class="justify-content-center card-body d-flex flex-wrap gap-3">
                                            <span class="empty-message">Please select a subject to see the overview.</span>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 mb-2 justify-content-center align-items-end" id="questionMarkSection">
                                            <div class="me-2">
                                                <label for="per_question_marks" class="form-label">Per Question Marks <span class="text-danger">*</span></label>
                                                <input type="text" name="per_question_marks" id="per_question_marks" value="4" class="form-control" />
                                            </div>

                                            <div class="me-2">
                                                <label for="total_questions" class="form-label">Total Questions <span class="text-danger">*</span></label>
                                                <input type="text" name="total_questions" id="total_questions" value="0" class="form-control" />
                                            </div>

                                            <div class="me-2">
                                                <label for="total_marks" class="form-label">Total Marks</label>
                                                <input type="text" name="total_marks" id="total_marks" value="0" class="form-control" readonly />
                                            </div>
                                        </div>

                                        <!-- Horizontal Line -->
                                        <hr class="my-4">

                                        <!-- Preview Button Centered -->
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-primary" id="generatePreview">
                                                <i class="fas fa-eye me-1"></i> Paper Preview
                                            </button>
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
                                                    <th>Chapter's Name</th>
                                                    <th>Availability</th>
                                                    <th>Objective</th>
                                                    <th>Numeric</th>
                                                    <th>Preview</th>
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

<!-- Paper Preview Modal -->
<div class="modal fade" id="paperPreviewModal" tabindex="-1" aria-labelledby="paperPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="paperPreviewModalLabel">Paper Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div id="paperPreviewContent">
                    <!-- Dynamically loaded paper content will go here -->
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- get Paper Preview Modal -->
<div class="modal fade" id="getPaperPreviewModal" tabindex="-1" aria-labelledby="getPaperPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="getPaperPreviewModalLabel">Paper Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div id="getPaperPreviewContent">
                    <!-- Dynamically loaded paper content will go here -->
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<!-- Chapter Questions List Modal -->
<div class="modal fade" id="questionsListModal" tabindex="-1" aria-labelledby="questionsListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="questionsListModalLabel">Questions List For Chapter [....]</h5>
                <button type="button" class="btn chapter_times_button" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <!-- Back to Sub-topics Modal -->
                <button type="button" class="btn topic_times_button" onclick="goBackToSubTopics()">
                    <i class="fa fa-arrow-left"></i>
                </button>
            </div>

            <div class="modal-body" id="appendQuestionData">
                <!-- Loaded dynamically via jQuery load -->
            </div>

        </div>
    </div>
</div>


<!-- Sub-topics Modal -->
<div class="modal fade" id="subTopicsModal" tabindex="-1" aria-labelledby="subTopicsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="subTopicsModalLabel">Sub-topic List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body" id="appendTopicData">
                <!-- Loaded dynamically via jQuery load -->
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


    function loadQuestionsTable(classTypeId, subjectId) {
        const url = `{{ url('/getChaptersByRequest') }}/${classTypeId}/${subjectId}`;

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
                <span class="text-muted subject_selected_question" data-subject_id="${subjectId}">Selected Questions: ${0}</span><br>
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

    var subjectId = '';

    // Optional: Subject item click handler
    $(document).on('click', '.subject-item', function() {

        subjectId = $(this).data('subject-id');
        let classTypeId = $('#class_type_id').val();
        $('#questionsSelectionSection').show();
        $('.subject-item').removeClass('selected-subject');
        $(this).addClass('selected-subject');
    });
    $(document).on('change', '#class_type_id', function() {
        let classTypeId = $(this).val();
        loadQuestionsTable(classTypeId, subjectId);

    });

    // Optional: Subject item click handler
    $(document).on('click', '#generatePreview', function() {
        let questionIds = {
            'Physics': [1, 3, 4],
            'Chemistry': [5, 7, 9]
        };
        loadPreview(questionIds);
    });

    // Optional: Subject item click handler
    $(document).on('click', '.getPreview', function() {
        const objective = ($(this).data('objective') || '').toString().split(',').filter(Boolean);
        const numeric = ($(this).data('numeric') || '').toString().split(',').filter(Boolean);

        const questionIds = [...objective, ...numeric].join(',');
        getPreview(questionIds);
    });






    $(document).on('keyup', '.selected_topic_objective_questions, .selected_topic_numeric_questions', function() {
        const $input = $(this);
        const value = parseInt($input.val());
        const $tr = $input.closest('tr');
        const $preview = $tr.find('.topic_preview');

        const isObjective = $input.hasClass('selected_topic_objective_questions');
        const type = isObjective ? 'objective' : 'numeric';
        const dataKey = isObjective ? 'objective_ids' : 'numeric_ids';

        const idsStr = $tr.data(dataKey);
        const idArray = idsStr ? idsStr.toString().split(',').filter(Boolean) : [];

        // Clear preview if input is invalid or exceeds available IDs
        if (isNaN(value) || value <= 0 || value > idArray.length) {
            $preview.html('');
            return;
        }

        // Generate random unique IDs
        const selected = [];
        const used = new Set();
        while (selected.length < value) {
            const randomIndex = Math.floor(Math.random() * idArray.length);
            const id = idArray[randomIndex];
            if (!used.has(id)) {
                used.add(id);
                selected.push(id);
            }
        }

        // Get existing span or create new
        let $span = $preview.find('span');
        if ($span.length === 0) {
            $span = $('<span style="text-decoration: underline; cursor: pointer;" class="getPreview">Preview</span>');
            $preview.html($span);
        }

        // Set the correct data attribute and avoid duplication
        const selectedStr = selected.join(',');
        if (type === 'objective') {
            $span.attr('data-objective', selectedStr);
        } else {
            $span.attr('data-numeric', selectedStr);
        }

        // Hide preview span if both values are empty
        const objVal = $span.attr('data-objective');
        const numVal = $span.attr('data-numeric');
        if (!objVal && !numVal) {
            $preview.html('');
        }
    });

    $(document).on('keyup', '.selected_objective_questions, .selected_numeric_questions', function() {
        const $input = $(this);
        const value = parseInt($input.val());
        const $tr = $input.closest('tr');
        const $preview = $tr.find('.preview');

        const isObjective = $input.hasClass('selected_objective_questions');
        const type = isObjective ? 'objective' : 'numeric';
        const dataKey = isObjective ? 'objective_ids' : 'numeric_ids';

        const idsStr = $tr.data(dataKey);
        const idArray = idsStr ? idsStr.toString().split(',').filter(Boolean) : [];

        // Clear preview if input is invalid or exceeds available IDs
        if (isNaN(value) || value <= 0 || value > idArray.length) {
            $preview.html('');
            return;
        }

        // Generate random unique IDs
        const selected = [];
        const used = new Set();
        while (selected.length < value) {
            const randomIndex = Math.floor(Math.random() * idArray.length);
            const id = idArray[randomIndex];
            if (!used.has(id)) {
                used.add(id);
                selected.push(id);
            }
        }

        // Get existing span or create new
        let $span = $preview.find('span');
        if ($span.length === 0) {
            $span = $('<span style="text-decoration: underline; cursor: pointer;" class="getPreview">Preview</span>');
            $preview.html($span);
        }

        // Set the correct data attribute and avoid duplication
        const selectedStr = selected.join(',');
        if (type === 'objective') {
            $span.attr('data-objective', selectedStr);
        } else {
            $span.attr('data-numeric', selectedStr);
        }

        // Hide if both are empty
        const objVal = $span.attr('data-objective');
        const numVal = $span.attr('data-numeric');
        if (!objVal && !numVal) {
            $preview.html('');
        }
    });




    function loadPreview(questionIds) {
        const url = `{{ url('/paperPreview') }}`;

        $('#paperPreviewModal').modal('show');

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                questionIds: JSON.stringify(questionIds),
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#paperPreviewContent').html(response);
                // Re-render MathJax after content is injected

            },
            error: function(xhr) {
                console.error("Preview load failed:", xhr);
            }
        });
    }

    function getPreview(questionIds) {
        const url = `{{ url('/getPaperPreview') }}`;

        $('#getPaperPreviewModal').modal('show');

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                questionIds: JSON.stringify(questionIds),
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#getPaperPreviewContent').html(response);
                // Re-render MathJax after content is injected

            },
            error: function(xhr) {
                console.error("Preview load failed:", xhr);
            }
        });
    }

    function openQuestionsList(chapterId) {

        $('.chapter_times_button').show();
        $('.topic_times_button').hide();
        $('#questionsListModal').modal('show');
        const url = `{{ url('/getQuestionsByChapterId') }}/${chapterId}`;
        $('#appendQuestionData').load(url);
    }


 
  function openSubTopics(chapterId) {
    $('#subTopicsModal').modal('show');

    const url = `{{ url('/getSubTopicsByRequest') }}/${chapterId}`;

    $('#appendTopicData').load(url, function () {

        // ⏳ Delay execution to ensure DOM is ready and smoother transition
        setTimeout(() => {
            $('#appendTopicData .topic_preview').each(function () {
                const $topicPreview = $(this);
                const topicChapterId = $topicPreview.data('chapter_id');

                const $modalRow = $topicPreview.closest('tr');
                const inputObjectiveIds = ($modalRow.attr('data-objective_ids') || '').split(',').map(id => id.trim());
                const inputNumericIds = ($modalRow.attr('data-numeric_ids') || '').split(',').map(id => id.trim());

                const $chapterRow = $(`tr[data-chapter_id="${topicChapterId}"]`);
                const mainPreviewHtml = $chapterRow.find('.preview').html();

                let mainObjectiveIds = '';
                let mainNumericIds = '';

                if (mainPreviewHtml && mainPreviewHtml.trim() !== '') {
                    const $mainPreview = $('<div>' + mainPreviewHtml + '</div>');

                    mainObjectiveIds = ($mainPreview.find('*').data('objective') || '').toString().split(',').map(id => id.trim());
                    mainNumericIds = ($mainPreview.find('*').data('numeric') || '').toString().split(',').map(id => id.trim());

                    const matchedObjectiveIds = mainObjectiveIds.filter(id => inputObjectiveIds.includes(id) && id !== '');
                    const matchedNumericIds = mainNumericIds.filter(id => inputNumericIds.includes(id) && id !== '');

                    // Set counts in inputs
                    $modalRow.find('.selected_topic_objective_questions').val(matchedObjectiveIds.length);
                    $modalRow.find('.selected_topic_numeric_questions').val(matchedNumericIds.length);

                    // Create or update the <span> inside topicPreview
                    let $span = $topicPreview.find('span');
                    if ($span.length === 0) {
                        $span = $('<span style="text-decoration: underline; cursor: pointer;">Preview</span>');
                        $topicPreview.html($span); // clear previous content and append span
                    }

                    // Set matched IDs as data attributes on the <span>
                    $span.attr('data-objective', matchedObjectiveIds.join(','));
                    $span.attr('data-numeric', matchedNumericIds.join(','));
                }
            });
        }, 300); // Delay of 300ms (adjust if needed)
    });
}


    function goBackToSubTopics() {
        $('#subTopicsModal').modal('show');
        $('#questionsListModal').modal('hide');
    }

    function questionsListBySubtopic(topicId) {
        $('.chapter_times_button').hide();
        $('.topic_times_button').show();
        $('#subTopicsModal').modal('hide');
        $('#questionsListModal').modal('show');
        const url = `{{ url('/getQuestionsByTopicId') }}/${topicId}`;
        $('#appendQuestionData').load(url);
    }
</script>
@endsection