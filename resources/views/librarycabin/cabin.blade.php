@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left section - Add Cabin/Locker Form -->
                    <div class="col-md-4 col-12">
                        <div class="card card-outline card-orange mr-1">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4>Create Cabin / Locker</h4>
                                </div>
                            </div>
                            <!-- Tabs for Cabin/Locker -->
                            <ul class="nav nav-tabs pl-3 border-0" id="addItemTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active border-0" id="cabin-tab" data-toggle="tab" href="#cabin-pane"
                                        role="tab" aria-controls="cabin-pane" aria-selected="true">
                                        <i class="fa fa-door-open"></i> Cabin
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border-0" id="locker-tab" data-toggle="tab" href="#locker-pane"
                                        role="tab" aria-controls="locker-pane" aria-selected="false">
                                        <i class="fa fa-lock"></i> Locker
                                    </a>
                                </li>
                            </ul>


                            <div class="card-body py-1">
                                <div class="tab-content" id="addItemTabsContent">
                                    <!-- Cabin Form -->
                                    <div class="tab-pane fade show active" id="cabin-pane" role="tabpanel"
                                        aria-labelledby="cabin-tab">
                                        <form class="createCommon" enctype="multipart/form-data">
                                            {{-- @if ($isEdit)
                                                <input type='hidden' value='{{ $data->id }}' name='id' />
                                            @endif --}}
                                            <input type='hidden' value='LibraryCabin' name='modal_type' />
                                            <input type='hidden' id="branch_id" name='branch_id' />
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="cabin_name">Cabin Name<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="cabin_name"
                                                            data-required="true" name="cabin_name"
                                                            placeholder="Enter Cabin no">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12 p-0 pb-2">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Locker Form -->
                                    <div class="tab-pane fade" id="locker-pane" role="tabpanel"
                                        aria-labelledby="locker-tab">
                                        <form class="createCommon" enctype="multipart/form-data">
                                            <input type='hidden' value='LibraryLocker' name='modal_type' />
                                            <input type='hidden' id="branch_id" name='branch_id' />
                                            <div class="row ">
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="locker_name">Locker No<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="locker_name"
                                                            name="locker_name" placeholder="Enter Locker no"
                                                            data-required="true">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="amount">Locker Amount<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="amount"
                                                            name="amount" placeholder="Enter Amount" data-required="true">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12 p-0 pb-2">
                                                <button type="submit" id="addCabinBtn"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Middle section - Cabin Management -->
                    <div class="col-md-4 col-12">
                        <div class="card card-outline card-orange ml-1">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa fa-door-open"></i> Cabin Management</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="cabin-grid">
                                    <div class="row" id="dataContainer-librarycabin">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right section - Locker Management -->
                    <div class="col-md-4 col-12">
                        <div class="card card-outline card-orange ml-1">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa fa-lock"></i> Locker Management</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="locker-grid">
                                    <div class="row" id="dataContainer-librarylocker">
                                    
                                      
                                    </div>
                                </div>

                                <!-- Locker details will be shown in the same item-details-container as cabins -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

   @endsection
