@extends('layout.app')
@section('content')
    @php
        $isEdit = isset($data);
    @endphp

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Batches</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <!-- Add Batch Column -->
                    <div class="col-md-4 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa fa-layer-group"></i> &nbsp;Add Batch</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="createCommon" data-modal="Role">
                                    @csrf
                                    @if ($isEdit)
                                        <input type='hidden' value='{{ $data->id }}' name='id' />
                                    @endif
                                     <input type='hidden' value='Batches' name='modal_type' />
                                   
                             
                                      <input type='hidden' value="{{Session::get('current_session')}}" name='session_id' />
                                    <div class="row">
                                        <div class="col-md-12 col-12 ">
                                            <div class="form-group">
                                                <label for="name">Batch Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Batch Name" data-required="true"
                                                
                                                value="{{ old('name', $data->name ?? '') }}">     
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12 ">
                                        @include('commoninputs.inputs', [
                                                        'modal' => 'ExamPattern', // This decides the data source
                                                        'name' => 'category_id',
                                                        'selected' => $data->category_id ?? null,
                                                        'label' => 'Category',
                                                        'required' => true,
                                                        ])
                                        </div>
                                        <div class="col-md-12 col-12 text-center mt-2">
                                            <button type="submit" class="btn btn-primary text-center">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Batch List Column -->
                    <div class="col-md-8 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4><i class="fa fa-layer-group"></i> &nbsp;View Batches</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataContainer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>SR. NO.</th>
                                                <th>Session</th>
                                                <th>Batch Name</th>
                                                <th>Exam Pattern Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataContainer-batches" class="dataContainer" style="min-height:300px">
                                          
                                            @include('common.loadskeletan',['loopCount'=>6])
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                  
                </div>
            </div>
        </section>
    </div>


@endsection