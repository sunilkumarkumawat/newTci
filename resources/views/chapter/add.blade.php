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
                        <li class="breadcrumb-item">Chapter</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <!-- Chapter Form Column -->
                <div class="col-md-4 col-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h4><i class="fa fa-user-circle-o"></i> &nbsp;Add Chapter</h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="createCommon" data-modal="Chapter">
                                @if ($isEdit)
                                <input type='hidden' value="{{ $data->id ?? '' }}" name='id' />
                                @endif
                                <input type='hidden' value='Chapter' name='modal_type' />

                                <div class="bg-item mb-3 border p-3 rounded">
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
                                            @include('commoninputs.dependentInputs', [
                                            'modal' => 'Subject',
                                            'name' => 'subject_id',
                                            'selected' => $data->subject_id ?? null,
                                            'label' => 'Subject',
                                            'required' => true,
                                            'isRequestSent' => isset($data->subject_id),
                                            'dependentId' => $data->class_type_id ?? null,
                                            'foreignKey' => 'class_type_id',
                                            ])
                                        </div>
                                        <div class="col-md-12 col-12 form-group">
                                            <label for="name"> Chapter Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Chapter Name" data-required='true'
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

                <!-- Chapter View Column -->
                <div class="col-md-8 col-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-light">
                            <div class="card-title">
                                <h4><i class="fa fa-user-circle"></i> &nbsp;View Chapter</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="chapterTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SR. NO.</th>
                                            <th>Subject</th>
                                            <th>Chapter Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>

                                <script>
                                    $(function() {
                                        $('#chapterTable').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: "{{url('/chapters/data')}}", // <-- Update to your chapters data route
                                            columns: [{
                                                    data: 'DT_RowIndex',
                                                    name: 'DT_RowIndex',
                                                    orderable: false,
                                                    searchable: false
                                                }, // For SR. NO.
                                                {
                                                    data: 'subject_name',
                                                    name: 'subject_name'
                                                },
                                                {
                                                    data: 'name',
                                                    name: 'name'
                                                }, // Chapter Name
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
                <div class="col-md-12 p-0" id="permissionContainer">

                </div>
            </div>
        </div>
    </section>
</div>





@endsection