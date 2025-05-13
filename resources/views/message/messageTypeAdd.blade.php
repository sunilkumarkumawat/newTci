@extends('layout.app')
@section('content')

     <div class="content-wrapper">
   
   <section class="content pt-3">
      <div class="container-fluid">
        <div class="row">    
         
        <div class="col-md-4 pr-0" id="addMessageTypeForm">
            <div class="card card-outline card-orange mr-1">
             <div class="card-header bg-primary">
                <h3 class="card-title"><i class="fab fa-whatsapp"></i> &nbsp; Message Type</h3>
                <div class="card-tools">
                </div>
            </div>                                  

            <form id="quickForm" action="messageType" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
        		<div class="row m-2">
                    <div class="col-md-12">
        				<label class="text-danger">Message Type Name *</label>
        				<input type="text" class="form-control" id="name" name="name" placeholder="Message Type Name" value="" onkeydown="return /[a-zA-Z ]/i.test(event.key)">
        			</div>
                </div>
                <div class="row m-2">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            </div>          
        </div>
        
        <div class="col-md-8 pl-0" id="viewMessageType">
            <div class="card card-outline card-orange ml-1">
             <div class="card-header bg-primary">
                <h3 class="card-title"><i class="fab fa-whatsapp"></i> &nbsp;View Message Type</h3>
                <div class="card-tools">
                    <a href="messageDashboard" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>                 
                <div class="row m-2">
                    <div class="col-md-12">
                	</div>
                    <div class="col-md-12">
                       <table id="messageTypeTable" class="table table-bordered table-striped dataTable dtr-inline">
                          <thead>
                            <tr role="row">
                              <th>SR.NO</th>
                              <th>Message Type</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- Table data will be populated dynamically -->
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
 
<script>
$('.deleteData').click(function() {
    var delete_id = $(this).data('id'); 
    $('#delete_id').val(delete_id); 
});

$('.changeStatus').click(function() {
    var status = $(this).data('status'); 
    var status_id = $(this).data('id'); 
    $('#status').val(status); 
    $('#status_id').val(status_id); 
});
</script>
  
<!-- Delete Modal -->
<div class="modal" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content" style="background: #555b5beb;">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-white">Delete Confirmation</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
      </div>

      <!-- Modal body -->
      <form action="messageTypeDelete" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-body">
          <input type="hidden" id="delete_id" name="delete_id">
          <h5 class="text-white">Are you sure you want to delete?</h5>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Status Modal -->
<div class="modal" id="statusModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Status Change Confirmation</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
      </div>

      <!-- Modal body -->
      <form action="messageTypeStatus" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-body">
          <input type="hidden" id="status_id" name="status_id">
          <input type="hidden" id="status" name="status">
          <h5>Are you sure you want to Change Status?</h5>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary waves-effect waves-light">Yes</button>
          <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection