@extends('layout.app')
@section('content')

<div class="content-wrapper">
   <section class="content pt-3">
      <div class="container-fluid">
         <div class="row">
            <!-- Add Message Template - Left Side 4 columns -->
            <div class="col-md-4">
               <div class="card card-outline card-orange">
                  <div class="card-header bg-primary">
                     <h3 class="card-title"><i class="fab fa-whatsapp"></i> &nbsp; Add Message Template </h3>
                     <div class="card-tools">
                        <a href="messageDashboard" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back </a>
                     </div>
                  </div>
                  <div class="card-body">
                     <form id="quickForm" action="messageTemplate" method="post">
                        <div class="row">
                           <div class="col-md-12">
                              <label class="text-danger">Message Type *</label>
                              <select class="form-control select2" name="message_type_id" id="message_type_id">
                                 <option value="">Select</option>
                                 <option value="1">Type 1</option>
                                 <option value="2">Type 2</option>
                                 <option value="3">Type 3</option>
                              </select>
                           </div>
                           <div class="col-md-12 mt-2">
                              <label class="text-danger">Subject/ Title Name*</label>
                              <input class="form-control" type="text" name="title" id="title" placeholder="Message Title" value="">
                           </div>
                           <div class="col-md-12 pt-2">
                              <div class="form-group">
                                  <div>
                                    <label class="text-danger"><b>E-mail Content*</b></label>
                                    </div>
                                    <textarea type="text" class="form-control pad" id="editor1" name="email_content" value="" placeholder="E-mail Content" rows="5"></textarea>
                                 <div>
                                    <label><b>Email Status</b></label>
                                    <label class="switch_check">
                                       <input type="checkbox" class="check_new changeStatus" id="email_status" name="email_status" value="1" checked>
                                       <span class="slider_check"></span>
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label><b>SMS Content</b></label>
                                 <textarea type="text" class="form-control pad" id="sms_content" name="sms_content" value="" placeholder="SMS Content" rows="5"></textarea>
                                 <div>
                                    <label><b>Sms Status</b></label>
                                    <label class="switch_check">
                                       <input type="checkbox" class="check_new changeStatus" id="sms_status" name="sms_status" value="1" checked>
                                       <span class="slider_check"></span>
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <label><b>SMS Template Id</b></label>
                              <input class="form-control" type="text" name="template_id" id="template_id" onkeypress="javascript:return isNumber(event)" placeholder="SMS Template Id" value="">
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label><b>Whatsapp Content</b></label>
                                 <textarea type="text" class="form-control pad" id="whatsapp_content" name="whatsapp_content" value="" placeholder="Whatsapp Content" rows="5"></textarea>
                                 <div>
                                    <label><b>Whatsapp Status</b></label>
                                    <label class="switch_check">
                                       <input type="checkbox" class="check_new changeStatus" id="whatsapp_status" name="whatsapp_status" value="1" checked>
                                       <span class="slider_check"></span>
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row m-2">
                           <div class="col-md-12 text-center">
                              <button type="submit" class="btn btn-primary">Submit </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            
            <!-- View Message Template - Right Side 8 columns -->
            <div class="col-md-8">
               <div class="card card-outline card-orange">
                  <div class="card-header bg-primary">
                     <h3 class="card-title"><i class="fab fa-whatsapp"></i> &nbsp;View Message Template </h3>
                  </div>
                  <div class="card-body">
                     <table id="example1" class="table table-bordered table-striped dataTable">
                        <thead>
                           <tr role="row">
                              <th>SR.NO</th>
                              <th>Type</th>
                              <th>Title</th>
                              <th>Content</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>1</td>
                              <td>Type 1</td>
                              <td>Welcome Message</td>
                              <td><small><u class="text-danger">Email :</u> <span>Welcome to our platform...</span> <br><u class="text-primary">SMS :</u> Welcome to our platform...<br><u class="text-success">Whatsapp :</u> Welcome to our platform...</small></td>
                              <td>
                                 <a href="messageTemplateEdit/1" class="btn btn-primary btn-xs" title="Edit Content"><i class="fa fa-edit"></i></a>
                                 <a href="javascript:;" data-id='1' data-bs-toggle="modal" data-bs-target="#deleteModal" class="deleteData btn btn-danger btn-xs ml-3" title="Delete Content"><i class="fa fa-trash"></i></a>
                              </td>
                           </tr>
                           <tr>
                              <td>2</td>
                              <td>Type 2</td>
                              <td>Notification Message</td>
                              <td><small><u class="text-danger">Email :</u> <span>This is a notification about...</span> <br><u class="text-primary">SMS :</u> This is a notification about...<br><u class="text-success">Whatsapp :</u> This is a notification about...</small></td>
                              <td>
                                 <a href="messageTemplateEdit/2" class="btn btn-primary btn-xs" title="Edit Content"><i class="fa fa-edit"></i></a>
                                 <a href="javascript:;" data-id='2' data-bs-toggle="modal" data-bs-target="#deleteModal" class="deleteData btn btn-danger btn-xs ml-3" title="Delete Content"><i class="fa fa-trash"></i></a>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<!-- The Modal -->
<div class="modal" id="deleteModal">
   <div class="modal-dialog">
      <div class="modal-content" style="background: #555b5beb;">
         <div class="modal-header">
            <h4 class="modal-title text-white">Delete Confirmation</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
         </div>
         <form action="messageTemplateDelete" method="post">
            <div class="modal-body">
               <input type=hidden id="delete_id" name=delete_id>
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

<style>
   .switch_check {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 25px;
      margin-top: 10px;
   }
   
   .switch_check .check_new {
      opacity: 0;
      width: 0;
      height: 0;
   }
   
   .slider_check {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      border-radius: 34px;
      transition: 0.4s;
   }
   
   .slider_check::before {
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      left: 9px;
      bottom: 3px;
      background-color: white;
      border-radius: 50%;
      transition: 0.4s;
   }
   
   .check_new:checked+.slider_check {
      background-color: #2196F3;
   }
   
   .check_new:checked+.slider_check::before {
      transform: translateX(26px);
   }
.pad{
    padding-top: 10px;
}

</style>

<script>


function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

@endsection