@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left section - Add Cabin/Locker Form -->
                    <div class="col-md-3 pr-0">
                        <div class="card card-outline card-orange mr-1">
                            <div class="card-header bg-primary">
                                <h3 class="card-title">Create Cabin / Locker</h3>
                            </div>
                            <!-- Tabs for Cabin/Locker -->
                            <ul class="nav nav-tabs" id="addItemTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active linkTab" id="cabin-tab" data-toggle="tab" href="#cabin-pane"
                                        role="tab" aria-controls="cabin-pane" aria-selected="true">
                                        <i class="fa fa-door-open"></i> Cabin
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link linkTab" id="locker-tab" data-toggle="tab" href="#locker-pane"
                                        role="tab" aria-controls="locker-pane" aria-selected="false">
                                        <i class="fa fa-lock"></i> Locker
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="addItemTabsContent">
                                <!-- Cabin Form -->
                                <div class="tab-pane fade show active" id="cabin-pane" role="tabpanel"
                                    aria-labelledby="cabin-tab">
                                    <form id="addCabinForm" action="cabin_add" method="post">
                                        <div class="row m-2">
                                            <div class="col-md-12">
                                                <label style="color:red;">Select Library*</label>
                                                <select class="select2 form-control" id="library_id" name="library_id">
                                                    <option value="">Select</option>
                                                    <option value="1">Main Library</option>
                                                    <option value="2">Research Library</option>
                                                    <option value="3">Digital Library</option>
                                                </select>
                                            </div>

                                            <div class="col-md-12">
                                                <label style="color:red;">Total Cabin No.*</label>
                                                <input class="form-control" type="text" name="name" id="cabin_number"
                                                    placeholder="Total Cabin No." value="">
                                            </div>
                                        </div>

                                        <div class="row m-2">
                                            <div class="col-md-12 ">
                                                <button type="button" id="addCabinBtn"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Locker Form -->
                                <div class="tab-pane fade" id="locker-pane" role="tabpanel" aria-labelledby="locker-tab">
                                    <form id="addLockerForm" action="locker_add" method="post">
                                        <div class="row m-2">
                                            <div class="col-md-12">
                                                <label style="color:red;">Select Library*</label>
                                                <select class="select2 form-control" id="locker_library_id"
                                                    name="library_id">
                                                    <option value="">Select</option>
                                                    <option value="1">Main Library</option>
                                                    <option value="2">Research Library</option>
                                                    <option value="3">Digital Library</option>
                                                </select>
                                            </div>

                                            <div class="col-md-12">
                                                <label style="color:red;">Total Locker No*</label>
                                                <input class="form-control" type="text" name="name" id="locker_number"
                                                    placeholder="Locker Number" value="">
                                            </div>
                                        </div>

                                        <div class="row m-2">
                                            <div class="col-md-12  ">
                                                <button type="button" id="addLockerBtn"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Middle section - Cabin Management -->
                    <div class="col-md-5 pl-0">
                        <div class="card card-outline card-orange ml-1">
                            <div class="card-header bg-primary">
                                <h3 class="card-title"><i class="fa fa-door-open"></i> Cabin Management</h3>
                            </div>

                            <div class="card-body">
                                <h4 class="library-name">Main Library</h4>
                                <div class="cabin-grid">
                                  <div class="row">
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A1</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A2</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A3</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A4</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box occupied cabin" data-type="cabin">A5</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A6</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A7</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A8</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A9</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box occupied cabin" data-type="cabin">A10</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A11</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A12</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A13</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A14</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box occupied cabin" data-type="cabin">A15</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A16</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A17</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A18</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A19</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box occupied cabin" data-type="cabin">A20</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A21</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A22</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A23</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A24</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box occupied cabin" data-type="cabin">A25</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A26</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A27</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A28</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A29</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box occupied cabin" data-type="cabin">A30</div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-3 pb-2">
                                       <div class="item-box available cabin" data-type="cabin">A31</div>
                                    </div>
                                 </div> 
                               </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right section - Locker Management -->
                    <div class="col-md-4 pl-0">
                        <div class="card card-outline card-orange ml-1">
                            <div class="card-header bg-primary">
                                <h3 class="card-title"><i class="fa fa-lock"></i> Locker Management</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="locker-library-name">Locker List</h4>
                                <div class="locker-grid">
                                  <div class="row">
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L1</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L2</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L3</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L4</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box occupied locker" data-type="locker">L5</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L6</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L7</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L8</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L9</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box occupied locker" data-type="locker">L10</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L11</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L12</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L13</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L14</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box occupied locker" data-type="locker">L15</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L16</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L17</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L18</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box available locker" data-type="locker">L19</div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-3  ">
                                      <div class="item-box occupied locker" data-type="locker">L20</div>
                                    </div>
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

    <!-- The Modal (keep the same) -->
    <div class="modal" id="Modal_id">
        <div class="modal-dialog">
            <div class="modal-content" style="background: #555b5beb;">
                <div class="modal-header">
                    <h4 class="modal-title text-white">Delete Confirmation</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times"
                            aria-hidden="true"></i></button>
                </div>
                <form action="item_delete" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="delete_id" name="delete_id">
                        <input type="hidden" id="delete_type" name="delete_type">
                        <h5 class="text-white">Are you sure you want to delete?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success message alert -->
    <div class="alert alert-success alert-dismissible fade" id="successAlert" role="alert"
        style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
        <strong>Success!</strong> <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endsection
