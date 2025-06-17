@extends('layout.app')
@section('content')

<div class="content-wrapper">

    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card card-outline card-orange ">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><i class="nav-icon fas fa fa-book"></i>
                                &nbsp;{{__('Create Exam') }}</h3>
                            <div class="card-tools">
                               
                                <a href="{{url('examination_dashboard')}}" class="btn btn-primary  btn-sm"
                                    title="Back"><i class="fa fa-arrow-left"></i> {{ __('common.Back') }} </a>

                            </div>

                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-center ">
                                    <div class="w-100" style="max-width: 500px;">
                                        <form id="createCommon" action="{{ url('add/exam') }}" method="post" enctype="multipart/form-data">

                                            @csrf
        <input type='hidden' value='Exam' name='modal_type' />
        <input type='hidden' value="{{Session::get('current_session')}}" name='session_id' />
        <input type='hidden' value="{{Auth::user()->id}}" name='user_id' />
                                            <!-- Exam Name -->
                                            <div class="form-group">
                                                <label for="examName">Exam Name <span
                                                                class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="examName" name="name" placeholder="Enter exam name" data-required='true'>
                                            </div>

                                            <!-- Exam Pattern -->
                                            @include('commoninputs.inputs',[
                                                    'modal' => 'ExamPattern',
                                                    'name' => 'exam_pattern_id',
                                                    'selected' => $data->exam_pattern_id ?? null,
                                                    'label' => 'Exam Pattern',
                                                    'required' => true,
                                                ])

                                            <!-- Test Type -->
                                             @include('commoninputs.inputs',[
                                                    'modal' => 'ExamType',
                                                    'name' => 'exam_type_id',
                                                    'selected' => $data->exam_type_id ?? null,
                                                    'label' => 'Exam Type',
                                                    'required' => true,
                                                ])

                                            <!-- Exam Default Duration -->
                                            <!-- <div class="form-group">
                                                <label for="examDuration">Exam Default Duration (minutes)</label>
                                                <input type="number" class="form-control" id="examDuration" name="exam_duration" placeholder="Enter duration in minutes" min="30" max="300" value="180" required>
                                            </div> -->

                                            <!-- Created Date -->
                                            <div class="form-group">
                                                <label for="createdDate">Created Date</label>
                                                <input type="text" class="form-control" id="createdDate" value="{{date('Y-m-d')}}" readonly>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="form-group text-center pt-5">
                                                <a href="{{ url('exams') }}" class="btn btn-secondary mx-2">Cancel</a>
                                                <button type="submit" class="btn btn-primary mx-2" name="action" value="generate">Generate</button>
                                            
                                            </div>
                                        </form>
                                    </div>
                                </div>
                             <div class="col-md-6 d-flex justify-content-center ">
    <div class="text-left">
        <h5 style="color: red;">How to Create an Exam</h5>
        <p style="color: red;">1. Enter the exam name and select the exam pattern (NEET, IIT JEE Main, or Advanced).</p>
        <p style="color: red;">2. Choose the test type (Practice, Mock, or Chapter Wise).</p>
        <p style="color: red;">3. Set the exam duration (default is 180 minutes).</p>
        <p style="color: red;">4. Review the created date (auto-filled as today).</p>
        <p style="color: red;">5. Click "Generate" to proceed or "Save" to store the exam details.</p>
    </div>
</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection