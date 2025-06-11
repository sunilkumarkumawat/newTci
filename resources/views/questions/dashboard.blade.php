
@extends('layout.app')
@section('content')
@php
    $permissions = Helper::getPermissions();
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
                                        <a href="{{ url('studentView') }}">
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
                                        <a href="{{ url('studentView') }}">
                                            <div class="info-box mb-3 text-dark">
                                                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-graduation-cap"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">SUBJECT-WISE QUESTIONS</span>
                                                    <span class="info-box-number mt-n1">{{ Helper::countByColumnValue('Question', 'class_type_id', '1') ?? '0' }}</span>
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
