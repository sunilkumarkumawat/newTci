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
                                        'modal' => 'AssignedSubjects',
                                        'name' => 'subject_id',
                                        'selected' => $data->subject_id ?? null,
                                        'label' => 'Subject',
                                        'required' => true,
                                        'isRequestSent' => isset($data->class_type_id),
                                        'dependentId' => $data->class_type_id ?? null,
                                        'foreignKey' => 'class_type_id',
                                        'attributes' => [
                                        'data-dependent' => 'chapter_id',
                                        'data-url' => url(
                                        '/get-dependent-options'),
                                        'data-modal' => 'Chapter',
                                        'data-field' => 'subject_id',
                                        ],
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
                                    <div class="card-body d-flex flex-wrap gap-3">
                                        <!-- Chemistry -->
                                        <div class="subject-box p-2 m-1 border rounded flex-fill">
                                            <strong><i class="fas fa-book mr-1"></i> Chemistry</strong><br>
                                            <span class="text-muted">Total Questions: 26</span><br>
                                            <span class="text-muted">Marks per Question: 4</span><br>
                                            <span class="text-muted">Total Marks: 104</span>
                                        </div>

                                        <!-- Physics -->
                                        <div class="subject-box p-2 m-1 border rounded flex-fill">
                                            <strong><i class="fas fa-book mr-1"></i> Physics</strong><br>
                                            <span class="text-muted">Total Questions: 26</span><br>
                                            <span class="text-muted">Marks per Question: 4</span><br>
                                            <span class="text-muted">Total Marks: 104</span>
                                        </div>

                                        <!-- Mathematics -->
                                        <div class="subject-box p-2 m-1 border rounded flex-fill">
                                            <strong><i class="fas fa-book mr-1"></i> Mathematics</strong><br>
                                            <span class="text-muted">Total Questions: 26</span><br>
                                            <span class="text-muted">Marks per Question: 4</span><br>
                                            <span class="text-muted">Total Marks: 104</span>
                                        </div>
                                        <hr class="w-100">
                                        <!-- Total Summary -->
                                        <div class="subject-box p-3 border rounded flex-fill" style="min-width: 200px;">
                                            <strong><i class="fas fa-calculator mr-1"></i> Total</strong><br>
                                            <span class="text-muted">Total Questions: 78</span><br>
                                            <span class="text-muted">Total Marks: 312</span>
                                        </div>
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
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-AMS_HTML"></script>
@endsection