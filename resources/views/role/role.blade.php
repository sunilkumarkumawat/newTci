@extends('layout.app')
@section('content')
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
                                    <div id="expense-container" class="bg-item mb-3 border p-3 rounded">
                                        <input type='hidden' value='Role' name='modal_type' />
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" />
                                        <input type='hidden' id="branch_id" name='branch_id' />
                                        <div class="row">
                                            <div class="col-md-12 col-12 form-group">
                                                <label for="name"> Role Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="role_name" name="role_name"
                                                    data-required='true'>
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
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>SR. NO.</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="branch-list">
                                            @if (!empty($data))
                                                @foreach ($data as $index => $role)
                                                    <tr id="row-{{ $role->id }}">
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $role->role_name ?? '' }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="#" class="btn-xs">
                                                                    <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
                                                                </a>
                                                                <a class=" btn-xs delete-btn" 
                                                                    data-modal='Role' data-id='{{$role->id}}'>
                                                                    <i class="fa fa-trash fs-6 text-danger"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
