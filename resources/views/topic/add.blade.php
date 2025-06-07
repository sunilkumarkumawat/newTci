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
                            <li class="breadcrumb-item">Topic</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <!-- Topic Form Column -->
                    <div class="col-md-4 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa fa-user-circle-o"></i> &nbsp;Add Topic</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <form id="createCommon" data-modal="Topic">
                                    @if ($isEdit)
                                        <input type='hidden' value="{{ $data->id ?? '' }}" name='id' />
                                    @endif
                                    <input type='hidden' value='Topic' name='modal_type' />
                                    <!-- <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" /> -->
                                    <!-- <input type='hidden' id="branch_id" name='branch_id' /> -->
                                    <div id="expense-container" class="bg-item mb-3 border p-3 rounded">
                                        <div class="row">
                                            <div class="col-md-12 col-12 ">
                                                @include('commoninputs.inputs', [
                                                    'modal' => 'ClassType', 
                                                    'name' => 'class_type_id',
                                                    'selected' => $data->class_type_id ?? null,
                                                    'label' => 'Class',
                                                    'required' => true,
                                                    'attributes' => [
                                                        'data-dependent' => 'subject_id',
                                                        'data-url' => url(
                                                            '/get-dependent-options'),
                                                        'data-modal' => 'Subject',
                                                        'data-field' => 'class_type_id',
                                                    ],
                                                ])
                                            </div>
                                            <div class="col-md-12 col-12 ">
                                                @include('commoninputs.inputs', [
                                                    'modal' => 'Subject',
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
                                            </div>
                                            <div class="col-md-12 col-12 ">
                                                @include('commoninputs.dependentInputs', [
                                                    'modal' => 'Chapter',
                                                    'name' => 'chapter_id',
                                                    'selected' => $data->chapter_id ?? null,
                                                    'label' => 'Chapter',
                                                    'required' => true,
                                                    'isRequestSent' => isset($data->subject_id),
                                                    'dependentId' => $data->subject_id ?? null,
                                                    'foreignKey' => 'subject_id',
                                                ])
                                            </div>
                                            <div class="col-md-12 col-12 form-group">
                                                <label for="name"> Topic Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Topic Name" data-required='true'
                                                 value="{{ old('name', $data->name ?? '') }}">     
                                            </div>
                                            

                                            <div class="col-12 col-md-12 text-center mt-2">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Topic View Column -->
                    <div class="col-md-8 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4><i class="fa fa-user-circle"></i> &nbsp;View Topic</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id='topicTable'class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>SR. NO.</th>
                                                <th>Topic</th>
                                                <th>Class</th>
                                                <th>Subject</th>
                                                <th>Chapter</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                      
                                    </table>
                                    <script>
                                        $(function() {
                                            $('#topicTable').DataTable({
                                                processing: true,
                                                serverSide: true,
                                                ajax: "{{url('topicData')}}", // <-- Update to your chapters data route
                                                columns: [{
                                                        data: 'DT_RowIndex',
                                                        name: 'DT_RowIndex',
                                                        orderable: false,
                                                        searchable: false
                                                    }, // For SR. NO.
                                                    {
                                                        data: 'name',
                                                        name: 'name'
                                                    },
                                                    {
                                                        data: 'class_name',
                                                        name: 'class_name'
                                                    },
                                                    {
                                                        data: 'subject_name',
                                                        name: 'subject_name'
                                                    }, // Chapter Name
                                                    {
                                                        data: 'chapter_name',
                                                        name: 'chapter_name'
                                                    },
                                                    {
                                                        data: 'action',
                                                        name: 'action',
                                                        orderable: false,
                                                        searchable: false
                                                    }
                                                ]
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </section>
    </div>





@endsection
