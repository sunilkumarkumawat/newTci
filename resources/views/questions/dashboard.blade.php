
@extends('layout.app')
@section('content')
@php
    $permissions = Helper::getPermissions();
    $getSubject = Helper::getAllData('Subject');
    $getUsedUnusedQuestionCount = Helper::getUsedUnusedQuestionCount();
@endphp

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4>
                                        <i class="fa fa-desktop"></i> &nbsp; Question Bank Dashboard
                                    </h4>
                                </div>
                                <div class="card-tools">
                                    <!-- Optional button here -->
                                </div>
                            </div>
                            <div class="card-body ">
                            

                            <div class="row">

                                @if(in_array('question_bank.view', $permissions)  || Auth::user()->role_id == 1)
                                    <div class="col-6 col-sm-3 col-md-3">
                                        <a href="{{ url('questionView') }}">
                                            <div class="info-box mb-3 text-dark">
                                                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check-square"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">TOTAL QUESTIONS</span>
                                                    <span class="info-box-number mt-n1">{{ Helper::getCount('Question') ?? '0' }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif

                                
                                    
                                @if(in_array('question_bank.view', $permissions)  || Auth::user()->role_id == 1)
                                    <div class="col-6 col-sm-3 col-md-3">
                                        <a href="{{ url('questionView') }}">
                                            <div class="info-box mb-3 text-dark">
                                                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-check-square"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">RECENTLY-ADDED QUES.</span>
                                                    <span class="info-box-number mt-n1">{{ Helper::countQuestionByLatestCreatedDate('Question') ?? '0' }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif

                                @if(in_array('question_bank.view', $permissions)  || Auth::user()->role_id == 1)
                                    <div class="col-6 col-sm-3 col-md-3">
                                        <a href="{{ url('questionView') }}">
                                            <div class="info-box mb-3 text-dark">
                                                <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-check-square"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">PENDING APPROVAL</span>
                                                    <span class="info-box-number mt-n1">{{ Helper::countByCondition('Question', ['status' => 0]) }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif

                                @if(in_array('question_bank.view', $permissions)  || Auth::user()->role_id == 1)
                                    <div class="col-6 col-sm-3 col-md-3">
                                        <a href="{{ url('questionView') }}">
                                            <div class="info-box mb-3 text-dark">
                                                <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-check-square"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">QUESTION USES</span>
                                                    <span class="info-box-number mt-n1">
                                                        <span class="badge badge-danger">Used : {{ $getUsedUnusedQuestionCount['used'] ?? '' }}</span>    
                                                        <span class="badge badge-success">Untouched : {{ $getUsedUnusedQuestionCount['unused'] ?? '' }}</span> 
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif

                                @if(in_array('question_bank.view', $permissions)  || Auth::user()->role_id == 1)
                                    <div class="col-6 col-sm-3 col-md-3">
                                        <a href="{{ url('questionView') }}">
                                            <div class="info-box mb-3 text-dark">
                                                <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-check-square"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">SUBJECT-WISE QUESTIONS</span>
                                                    <span class="info-box-number mt-n1">
                                                        @if(!empty($getSubject))
                                                        @foreach($getSubject as $subject)
                                                            <span class="badge badge-info">{{ $subject->name ?? '' }} : {{ Helper::countByColumnValue('Question', 'subject_id', $subject->id) ?? '0' }}</span>
                                                        @endforeach   
                                                        @endif 
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                    
                            </div>
                           
                           
                            </div>
                        </div>


                    <div>
                           
                        </div>

                        
                    </div>
                </div>
            </div>
        </section>
    </div>

   

@endsection
