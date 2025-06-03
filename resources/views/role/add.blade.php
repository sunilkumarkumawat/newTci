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
                            <li class="breadcrumb-item">Role</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <!-- role Form Column -->
                    <div class="col-md-4 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa fa-user-circle-o"></i> &nbsp;Add Role</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <form id="createCommon" data-modal="Role">
                                    @if ($isEdit)
                                        <input type='hidden' value='{{ $data->id }}' name='id' />
                                    @endif
                                    <input type='hidden' value='Role' name='modal_type' />
                                    <!-- <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" /> -->
                                    <!-- <input type='hidden' id="branch_id" name='branch_id' /> -->
                                    <div id="expense-container" class="bg-item mb-3 border p-3 rounded">
                                        <div class="row">
                                            <div class="col-md-12 col-12 form-group">
                                                <label for="name"> Role Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="role_name" name="name" placeholder="Enter Role Name" data-required='true'
                                                 value="{{ old('name', $data->name ?? '') }}">     
                                            </div>

                                            <div class="col-12 col-md-12 ">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- role View Column -->
                    <div class="col-md-8 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4><i class="fa fa-user-circle"></i> &nbsp;View Role</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id='dataContainer'class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>SR. NO.</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataContainer-role" class='dataContainer'style="min-height:300px">
                                           @include('common.loadskeletan',['loopCount'=>6])
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-md-12" id="permissionContainer">

                </div>
                </div>
            </div>
        </section>
    </div>
@endsection
