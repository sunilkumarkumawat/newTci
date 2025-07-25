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

                    <div class="col-md-9" id="createdPaperMessage" style="display: {{ $examDetails->questions_id == null ? 'none' : 'block' }}">
                        <div class="card card-primary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Generated Paper Preview</h3>
                                <button type="button" class="btn btn-sm btn-primary" id="editPaperBtn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type='button' id="downloadPdfBtn" class="btn btn-primary">Download PDF</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id='renderGeneratedQuestions'>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-9" id='paperCreationSection' style="display: {{$examDetails->questions_id == null ? 'block' : 'none'}}">
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

                                    <div class="card-body" id='subject_overview'>
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
                                            <button type='button' class='btn btn-sm bg-primary ml-2'
                                                onclick="generatePaper()">Generate Paper</button>

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
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
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
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
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
                <button type="button" class="btn topic_times_button" onclick="goBackToSubTopics()" data-chapterId='' data-topicId=''>
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
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
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

    let finalArray = @json($questioningData) || {};
    let overviewMap = @json($overviewingData ?? null);
    let finalQuestionArray = @json($finalQuestionArray ?? []);
let generatedQuestions = JSON.parse(@json($examDetails->questions_id ?? '[]'));


let hasQuestions = Object.values(generatedQuestions).some(arr => Array.isArray(arr) && arr.length > 0);

if (hasQuestions) {
    loadPreview(generatedQuestions, 'renderGeneratedQuestions');
} else {
    console.log("No questions found.");
}


    if (overviewMap.length > 0) {
        $('#subject_overview').html($(overviewMap)); // Set the subject_overview_id if available
    }

    let totalQuestions = parseInt($('#total_questions').val());
    let marksPerQuestion = parseInt($('#per_question_marks').val());
    let numberOfSelectedSubject = 0;


    function draftArray(classTypeId, subjectId) {
        if (!finalArray[classTypeId]) {
            finalArray[classTypeId] = {};
        }

        // 🔁 Copy and sync input values
        let $originalRows = $('#questionsTableBody').children();
        let $clonedRows = $originalRows.clone();

        $clonedRows.each(function(i) {
            const $originalInputs = $originalRows.eq(i).find('input, select, textarea');
            const $clonedInputs = $(this).find('input, select, textarea');

            $clonedInputs.each(function(j) {
                const $original = $originalInputs.eq(j);
                const type = $(this).attr('type');

                if (type === 'checkbox' || type === 'radio') {
                    $(this).prop('checked', $original.prop('checked'));
                } else {
                    $(this).val($original.val());
                }
            });
        });

        // ✅ Store updated HTML
        let container = $('<div>').append($clonedRows);
        finalArray[classTypeId][subjectId] = container.html();

        updateSelectedQuestionCountsBySubject();

        const subjectOverview = $('#subject_overview').html(); // Or use `.data('overview-id')` from somewhere

        // ✅ Store subject_overview_id
        overviewMap = subjectOverview;
        // 🔁 Save both arrays
        draftExam(finalArray, overviewMap);

    }

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
        $('#total_questions').attr('value', totalQuestions);
        $('#total_marks').val(totalQuestions * marksPerQuestion);
        $('#total_marks').attr('value', totalQuestions * marksPerQuestion);
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
                <span class="text-muted subject_selected_question" data-subject_id="${subjectId}" data-subject_name="${subjectName}">Selected Questions: ${0}</span><br>
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

        // ✅ Get subject_overview_id from somewhere, e.g., a hidden input or attribute
        const subjectOverview = $('#subject_overview').html(); // Or use `.data('overview-id')` from somewhere

        // ✅ Store subject_overview_id
        overviewMap = subjectOverview;

        draftExam(finalArray, overviewMap);

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

            const questionsInCurrentSubject = parseInt($('#number_of_questions_per_subject').val());
            const totalTillNow = parseInt($('#total_questions').val());
            const perQuestionsMarks = parseInt($('#per_question_marks').val());

            $('#total_questions').val(totalTillNow - questionsInCurrentSubject);
            $('#total_questions').attr('value', totalTillNow - questionsInCurrentSubject);
            $('#total_marks').val((totalTillNow - questionsInCurrentSubject) * perQuestionsMarks);
            $('#total_marks').attr('value', totalTillNow * perQuestionsMarks);


        }


        subjectBox.remove();
        const subjectOverview = $('#subject_overview').html(); // Or use `.data('overview-id')` from somewhere

        // ✅ Store subject_overview_id
        overviewMap = subjectOverview;
        draftExam(finalArray, overviewMap);
        // Hide if no subjects remain
        $('#questionsSelectionSection').hide();

    }

    var subjectId = '';

    // Optional: Subject item click handler
    $(document).on('click', '.subject-item', function() {
        $('#questionsTableBody').html('');
        $('#class_type_id').val('');

        subjectId = $(this).data('subject-id');
        // let classTypeId = $('#class_type_id').val();
        $('#questionsSelectionSection').show();
        $('.subject-item').removeClass('selected-subject');
        $(this).addClass('selected-subject');
    });
    $(document).on('change', '#class_type_id', function() {
        let classTypeId = $(this).val();


        if (finalArray[classTypeId] && finalArray[classTypeId][subjectId]) {
            // Restore saved HTML content
            $('#questionsTableBody').html(finalArray[classTypeId][subjectId]);
        } else {
            // No draft, load fresh
            loadQuestionsTable(classTypeId, subjectId);
        }
    });


    // Optional: Subject item click handler
    $(document).on('click', '#generatePreview', function() {
        let questionIds = {};

        $('.subject_selected_question').each(function() {
            const subjectId = $(this).data('subject_id');
            const objectiveStr = $(this).attr('data-objective') || '';
            const numericStr = $(this).attr('data-numeric') || '';

            const objectiveIds = objectiveStr.split(',').filter(Boolean);
            const numericIds = numericStr.split(',').filter(Boolean);

            questionIds[subjectId] = [...objectiveIds, ...numericIds];
        });

        // 🔥 Now call your preview function
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

        $input.attr('value', value); // Update input value
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
        const classTypeId = $('#class_type_id').val();
        draftArray(classTypeId, subjectId);
        updateSelectedQuestionCountsBySubject();
    });




    function draftExam(draftArray, overviewMap) {
        const url = `{{ url('/draftExam') }}`;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                draftArray: JSON.stringify(draftArray),
                overviewMap: JSON.stringify(overviewMap),
                exam_id: '{{ $examDetails->id ?? 0 }}',
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {
                    // toastr.success("Draft saved successfully.");
                } else {
                    toastr.error("Failed to save draft.");
                }
            },
            error: function(xhr) {
                console.error("Draft save failed:", xhr);
            }
        });
    }

    function updateSelectedQuestionCountsBySubject() {
        let results = {};

        for (let classTypeId in finalArray) {
            if (!finalArray.hasOwnProperty(classTypeId)) continue;

            for (let subjectId in finalArray[classTypeId]) {
                if (!finalArray[classTypeId].hasOwnProperty(subjectId)) continue;

                const html = finalArray[classTypeId][subjectId];
                const $parsed = $('<div>').html(html);

                let objective = 0;
                let numeric = 0;

                // ✅ Initialize ID arrays
                let objectiveIds = [];
                let numericIds = [];

                // Sum all selected_objective_questions and collect IDs
                $parsed.find('.getPreview').each(function() {
                    const obj = $(this).attr('data-objective') || '';
                    const num = $(this).attr('data-numeric') || '';

                    if (obj) {
                        const ids = obj.split(',').filter(Boolean);
                        objective += ids.length;
                        objectiveIds = objectiveIds.concat(ids);
                    }

                    if (num) {
                        const ids = num.split(',').filter(Boolean);
                        numeric += ids.length;
                        numericIds = numericIds.concat(ids);
                    }
                });

                // Prepare results
                if (!results[subjectId]) {
                    results[subjectId] = {
                        objective: 0,
                        numeric: 0,
                        objective_ids: [],
                        numeric_ids: []
                    };
                }

                results[subjectId].objective += objective;
                results[subjectId].numeric += numeric;
                results[subjectId].objective_ids = results[subjectId].objective_ids.concat(objectiveIds);
                results[subjectId].numeric_ids = results[subjectId].numeric_ids.concat(numericIds);

                // ✅ Update text in UI
                const $target = $(`#subjectContainer [data-subject_id="${subjectId}"].subject_selected_question`);
                if ($target.length > 0) {
                    $target.text(`Selected Questions: ${objective + numeric}`);
                } else {
                    console.warn('Target not found for subjectId:', subjectId);
                }
            }
        }

        console.log(results); // Optional

        $(`.subject_selected_question[data-subject_id="${subjectId}"]`).attr('data-objective', results[subjectId].objective_ids.join(','));
        $(`.subject_selected_question[data-subject_id="${subjectId}"]`).attr('data-numeric', results[subjectId].numeric_ids.join(','));

    }


    function loadPreview(questionIds, renderId = null) {

        const url = `{{ url('/paperPreview') }}`;


        if (renderId == null) {
            $('#paperPreviewModal').modal('show');
        }


        $.ajax({
            url: url,
            type: 'POST',
            data: {
                questionIds: JSON.stringify(questionIds),
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {

                if (renderId !== null) {
                    $('#' + renderId).html(response);
                } else {
                    $('#paperPreviewContent').html(response);
                }


                // Re-render MathJax after content is injected

            },
            error: function(xhr) {
                console.error("Preview load failed:", xhr);
            }
        });
    }

    function getPreview(questionIds) {


        const url = `{{ url('/getQuestionsPreview') }}`;

        $('#paperPreviewModal').modal('show');

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                questionIds: questionIds,
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

    function openQuestionsList(chapterId) {
        $('.chapter_times_button').show();
        $('.topic_times_button').hide();
        $('#questionsListModal').modal('show');

        const url = `{{ url('/getQuestionsByChapterId') }}/${chapterId}`;

        $('#appendQuestionData').load(url, function() {
            // This runs after the questions are loaded
            checkSelectedQuestions(chapterId);
        });
    }

    function checkSelectedQuestions(chapterId) {
        const $chapterRow = $(`tr[data-chapter_id="${chapterId}"]`);

        const objectiveStr = $chapterRow.find('.getPreview').attr('data-objective') || '';
        const numericStr = $chapterRow.find('.getPreview').attr('data-numeric') || '';

        const objectiveArr = objectiveStr.split(',').filter(Boolean);
        const numericArr = numericStr.split(',').filter(Boolean);

        const allQuestionIds = [...objectiveArr, ...numericArr];

        // Optional: Clear previous highlights
        $('.question-row').css('background-color', '');

        // Highlight matching rows
        $('.question-row').each(function() {
            const dataId = $(this).attr('data-id');
            if (allQuestionIds.includes(dataId)) {
                $(this).css('background-color', '#d1ffd1'); // light green
            }
        });

        return {
            objective: objectiveArr,
            numeric: numericArr
        };
    }


    function selectQuestion(questionId, questionTypeId, chapterId) {
        const $chapterRow = $(`#questionsTableBody tr[data-chapter_id="${chapterId}"]`);
        let $previewSpan = $chapterRow.find('.getPreview');

        // ✅ Ensure .getPreview span exists
        if ($previewSpan.length === 0) {
            $previewSpan = $('<span class="getPreview" style="text-decoration: underline; cursor: pointer;"data-objective="" data-numeric="" ">Preview</span>');
            $chapterRow.find('td.preview').append($previewSpan); // ✅ Append to <td class="preview">
        }

        let objectiveIds = ($previewSpan.attr('data-objective') || '').split(',').filter(Boolean);
        let numericIds = ($previewSpan.attr('data-numeric') || '').split(',').filter(Boolean);

        questionId = String(questionId); // Ensure comparison as string
        let isSelected = false;

        if (questionTypeId === 1) {
            const index = objectiveIds.indexOf(questionId);
            if (index === -1) {
                objectiveIds.push(questionId);
                isSelected = true;
            } else {
                objectiveIds.splice(index, 1);
            }
        } else if (questionTypeId === 2) {
            const index = numericIds.indexOf(questionId);
            if (index === -1) {
                numericIds.push(questionId);
                isSelected = true;
            } else {
                numericIds.splice(index, 1);
            }
        }

        // Update data attributes
        $previewSpan.attr('data-objective', objectiveIds.join(','));
        $previewSpan.attr('data-numeric', numericIds.join(','));

        // Update per-topic values
        $chapterRow.find('.selected_topic_objective_questions').val(objectiveIds.length);
        $chapterRow.find('.selected_topic_numeric_questions').val(numericIds.length);

        // Highlight selection
        const $questionRow = $(`.question-row[data-id="${questionId}"]`);
        if (isSelected) {
            $questionRow.css('background-color', '#d1ffd1');
        } else {
            $questionRow.css('background-color', '');
        }

        // ✅ Calculate total questions in current chapter row
        let totalObjective = 0;
        let totalNumeric = 0;

        $chapterRow.find('.getPreview').each(function() {
            let objStr = $(this).attr('data-objective') || '';
            let numStr = $(this).attr('data-numeric') || '';

            totalObjective += objStr.split(',').filter(Boolean).length;
            totalNumeric += numStr.split(',').filter(Boolean).length;
        });

        $chapterRow.find('.selected_objective_questions')
            .val(totalObjective)
            .attr('value', totalObjective);

        $chapterRow.find('.selected_objective_numeric')
            .val(totalNumeric)
            .attr('value', totalNumeric);

        const classTypeId = $('#class_type_id').val();

        // ✅ Ensure subjectId is defined somewhere
        draftArray(classTypeId, subjectId);
    }




    function openSubTopics(chapterId) {
        $('#subTopicsModal').modal('show');

        const url = `{{ url('/getSubTopicsByRequest') }}/${chapterId}`;

        $('#appendTopicData').load(url, function() {

            // ⏳ Delay execution to ensure DOM is ready and smoother transition
            setTimeout(() => {
                $('#appendTopicData .topic_preview').each(function() {
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
                            $span = $('<span style="text-decoration: underline; cursor: pointer;" class="getPreview">Preview</span>');
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
        const topicId = $('.topic_times_button').attr('data-topicId');
        const chapterId = $('.topic_times_button').attr('data-chapterId');
        $('#questionsListModal').modal('hide');
        openSubTopics(chapterId);

    }

    function questionsListBySubtopic(topicId, chapterId) {
        $('.chapter_times_button').hide();
        $('.topic_times_button').show();
        $('#subTopicsModal').modal('hide');
        $('#questionsListModal').modal('show');
        const url = `{{ url('/getQuestionsByTopicId') }}/${topicId}`;
        // $('#appendQuestionData').load(url);
        $('.topic_times_button').attr('data-topicId', topicId);
        $('.topic_times_button').attr('data-chapterId', chapterId);

        $('#appendQuestionData').load(url, function() {
            // This runs after the questions are loaded
            checkSelectedQuestions(chapterId);
        });
    }

    function generatePaper(type = null) {
        let questionIds = {};
        let perSubjectQuestions = parseInt($("#number_of_questions_per_subject").val()) || 0;

        let isValid = true;
        let invalidSubjects = [];

        $('.subject_selected_question').each(function() {
            const subjectId = $(this).data('subject_id');
            const subjectName = $(this).data('subject_name');


            const objectiveStr = $(this).attr('data-objective') || '';
            const numericStr = $(this).attr('data-numeric') || '';

            const objectiveIds = objectiveStr.split(',').filter(Boolean);
            const numericIds = numericStr.split(',').filter(Boolean);

            const allQuestions = [...objectiveIds, ...numericIds];
            questionIds[subjectId] = allQuestions;

            // ✅ Validate total selected questions for the subject
            if (allQuestions.length !== perSubjectQuestions) {
                isValid = false;
                invalidSubjects.push(subjectName);
            }
        });

        // ✅ Stop execution if any subject doesn't match the required count
        if (!isValid) {
            alert(`Each subject must have exactly ${perSubjectQuestions} questions.\nMismatched subject(s): ${invalidSubjects.join(', ')}`);
            return;
        }

        const url = `{{ url('/saveGeneratedPaper') }}`;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                questions: JSON.stringify(questionIds),
                exam_id: '{{ $examDetails->id ?? 0 }}',
                type: type,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#questionsSelectionSection').hide();

                    if (type !== 'reset') {
                        toastr.success(response.message);
                        window.location.href = window.location.href; // reload page
                    }
                } else {
                    toastr.error("Failed to save draft.");
                }
            },
            error: function(xhr) {
                console.error("Draft save failed:", xhr);
            }
        });
    }





    $('#editPaperBtn').on('click', function() {
        $('#createdPaperMessage').hide();
        $('#paperCreationSection').show();

        generatePaper('reset')

    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


<script>
 document.getElementById("downloadPdfBtn").addEventListener("click", async function () {
    const el = document.getElementById("renderGeneratedQuestions");

    // Wait for MathJax if used
    if (typeof MathJax !== "undefined" && MathJax.typesetPromise) {
        await MathJax.typesetPromise();
    }

    // Use html2canvas to create screenshot
    const canvas = await html2canvas(el, {
        scale: 2,
        useCORS: true,
        backgroundColor: "#ffffff"
    });

    const imgData = canvas.toDataURL("image/jpeg", 1.0);

    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF("p", "mm", "a4");

    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = pdf.internal.pageSize.getHeight();

    const imgWidth = pdfWidth;
    const imgHeight = (canvas.height * imgWidth) / canvas.width;

    // Multi-page support
    let heightLeft = imgHeight;
    let position = 0;

    if (heightLeft <= pdfHeight) {
        pdf.addImage(imgData, "JPEG", 0, 0, imgWidth, imgHeight);
    } else {
        while (heightLeft > 0) {
            pdf.addImage(imgData, "JPEG", 0, position, imgWidth, imgHeight);
            heightLeft -= pdfHeight;
            position -= pdfHeight;
            if (heightLeft > 0) {
                pdf.addPage();
            }
        }
    }

    pdf.save("math_questions.pdf");
});

</script>


@endsection