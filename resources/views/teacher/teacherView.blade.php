@extends('layout.app') 
@section('content')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-outline card-orange">
				<div class="card-header bg-primary flex_items_toggel">
					<h3 class="card-title"><i class="fa fa-shirtsinbulk"></i> &nbsp;View Teachers</h3>
					<div class="card-tools">
					     <a href="#" class="btn btn-primary btn-sm" title="Add Teacher">
					        <i class="fa fa-plus"></i> <span class="Display_none_mobile">Add</span>
					     </a>
			            <a href="#" class="btn btn-primary btn-sm" title="Back">
			                <i class="fa fa-arrow-left"></i> <span class="Display_none_mobile">Back</span>
			            </a>
			        </div>
				</div>   

                 <!-- Static Search Form -->
				 <form id="quickForm" action="#" method="post">
                    <div class="row m-2">
                        <div class="col-md-6">
                			<div class="form-group">
                				<label>Search By Keywords</label>
                				<input type="text" class="form-control" placeholder="Ex. Name, Mobile, Email, Aadhaar etc." value="">
                		    </div>
                		</div>
                        <div class="col-md-1 text-center">
                            <div class="Display_none_mobile">
                              <label class="text-white">Search</label>
                            </div>
                    	    <button type="submit" class="btn btn-primary">Search</button>
                    	</div>
                    </div>
                </form>
				
                <div class="card-body p-0">
                  <table class="table table-bordered table-striped dataTable dtr-inline">
                    <thead>
                      <tr role="row">
                          <th>S.NO</th>
                          <th class="text-center">Image</th>
                          <th>Teacher Name</th>
                          <th>Class Teacher</th>
                          <th>Teaching Subject</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="text-center">
                                <img class="profileImg pointer" src="https://via.placeholder.com/50" alt="Profile Image">
                            </td>
                            <td>John Doe <span class='badge badge-primary'>Class Teacher</span></td>
                            <td>Grade 5</td>
                            <td>Maths (Grade 5)<br>Science (Grade 6)</td>
                            <td>9876543210</td>
                            <td>johndoe@example.com</td>
                            <td>
                                <a class="btn btn-primary btn-xs" data-toggle="dropdown" title="Show Option"><i class="fa fa-bars"></i></a>
                                <ul class="dropdown-menu">
                                  <a href="#"><li class="dropdown-item text-success"><i class="fa fa-print text-success"></i> Joining Print</li></a>
                                  <a href="#"><li class="dropdown-item text-primary"><i class="fa fa-edit text-primary"></i> Edit</li></a>
                                  <a href="#" data-bs-toggle="modal" data-bs-target="#Modal_id" class="deleteData"><li class="dropdown-item text-danger"><i class="fa fa-trash-o text-danger"></i> Delete</li></a>
                                </ul>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td class="text-center">
                                <img class="profileImg pointer" src="https://via.placeholder.com/50" alt="Profile Image">
                            </td>
                            <td>Jane Smith</td>
                            <td>Grade 3</td>
                            <td>English (Grade 3)<br>History (Grade 4)</td>
                            <td>9123456789</td>
                            <td>janesmith@example.com</td>
                            <td>
                                <a class="btn btn-primary btn-xs" data-toggle="dropdown" title="Show Option"><i class="fa fa-bars"></i></a>
                                <ul class="dropdown-menu">
                                  <a href="#"><li class="dropdown-item text-success"><i class="fa fa-print text-success"></i> Joining Print</li></a>
                                  <a href="#"><li class="dropdown-item text-primary"><i class="fa fa-edit text-primary"></i> Edit</li></a>
                                  <a href="#" data-bs-toggle="modal" data-bs-target="#Modal_id" class="deleteData"><li class="dropdown-item text-danger"><i class="fa fa-trash-o text-danger"></i> Delete</li></a>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                  </table>
              </div>
              
            </div>
        </div>
      </div>
    </section>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal" id="Modal_id">
  <div class="modal-dialog">
    <div class="modal-content" style="background: #555b5beb;">
      <div class="modal-header">
        <h4 class="modal-title text-white">Delete Confirmation</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <form action="#" method="post">
        <div class="modal-body">
          <input type="hidden" id="delete_id" name="delete_id">
          <h5 class="text-white">Are you sure you want to delete?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
    .profileImg {
        width: 50px;
        height: 50px;
        border-radius: 10%;
        margin: 5px;
    }
</style>

<script>
    $('.deleteData').click(function() {
        var delete_id = $(this).data('id');
        $('#delete_id').val(delete_id);
    });
</script>

@endsection
