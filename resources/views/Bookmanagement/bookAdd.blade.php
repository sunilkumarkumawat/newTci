@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Book mangement</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa fa-book"></i> &nbsp; Add Library Books</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <form action="library_book_add" id="submit_form" method="post"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="">
                                    <div class="row pb-2">
                                        <div class="col-md-12 col-12">
                                            <label>Upload Excel</label>
                                            <span>
                                                <i class="fa-solid fa-file-excel"></i>
                                                <input class="form-control" type="file" id="excel" name="excel">
                                            </span>
                                        </div>
                                        {{-- <div class="col-md-3 col-3 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div> --}}
                                    </div>
                                    <div class="bg-item border rounded p-3">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>Library Select<span class="text-danger">*</span></label>
                                                <select class="form-control invalid" id="library_id" name="library_id"
                                                    placeholder="Select Library" required>
                                                    <option value="">Select</option>
                                                    <option value="1">gh</option>
                                                    <!-- Library options will be populated here -->
                                                </select>

                                                <span class="invalid-feedback" id="library_id_invalid" role="alert">
                                                    <strong>Library Required</strong>
                                                </span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Book Category</label>
                                                <select class="form-control" id="category_id" name="category_id"
                                                    placeholder="Select Category">
                                                    <option value="">Select Category</option>
                                                    <option value="1">th</option>
                                                    <!-- Category options will be populated here -->
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Accession/Barcode ID<span class="text-danger">*</span></label>
                                                <input class="form-control invalid" type="text" id="book_code"
                                                    name="book_code" placeholder="Barcode ID">
                                                <span class="invalid-feedback" id="book_code_invalid" role="alert">
                                                    <strong>Barcode Id Required</strong>
                                                </span>
                                            </div>


                                            <div class="col-md-6">
                                                <label>Book Name<span class="text-danger">*</span></label>
                                                <input class="form-control invalid" type="text" id="name"
                                                    name="name" placeholder="Book Name">
                                                <span class="invalid-feedback" id="name_invalid" role="alert">
                                                    <strong>Name field is required</strong>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Author Name</label>
                                                <input class="form-control" type="text" id="author" name="author"
                                                    onkeydown="return /[a-zA-Z ]/i.test(event.key)"
                                                    placeholder="Author Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Publisher Name</label>
                                                <input class="form-control" type="text" id="publisher" name="publisher"
                                                    onkeydown="return /[a-zA-Z ]/i.test(event.key)"
                                                    placeholder="Publisher Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Date</label>
                                                <input class="form-control" type="date" id="date" name="date"
                                                    placeholder="date" value="">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Edition</label>
                                                <input class="form-control" type="text" id="edition" name="edition"
                                                    placeholder="Edition">
                                            </div>

                                            <div class="col-md-6 d-none">
                                                <label>Brand</label>
                                                <input class="form-control" type="text" id="brand" name="brand"
                                                    placeholder="Brand">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Quantity</label>
                                                <input class="form-control" onkeypress="javascript:return isNumber(event)"
                                                    type="int" id="quantity" name="quantity"
                                                    placeholder="Quantity">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="">Book Image</label>
                                                <input class="form-control" type="file" id="image" name="image"
                                                    placeholder="image" accept="image/png, image/jpg, image/jpeg">
                                                <p class="text-danger" id="image_error"></p>
                                            </div>

                                            <div class="col-md-6">
                                                <label>MRP</label>
                                                <input class="form-control" onkeypress="javascript:return isNumber(event)"
                                                    type="int" id="mrp" name="mrp" placeholder="MRP.">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Almari No.</label>
                                                <input class="form-control" onkeypress="javascript:return isNumber(event)"
                                                    type="int" id="almari_no" name="almari_no"
                                                    placeholder="Almari No.">
                                            </div>

                                            <div class="col-md-6">
                                                <label>With Cover</label><br>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label cursor">
                                                        <input type="radio" class="form-check-input xl" id="cover-yes"
                                                            name="cover" value="1">Yes
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label cursor">
                                                        <input type="radio" class="form-check-input xl no_checked"
                                                            id="cover-no" name="cover" value="0">No
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <button class="btn btn-primary" type="submit"
                                                    id="is-invalid">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- right section (8 columns) -->
                    <div class="col-12 col-md-8">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa fa-list"></i> View Library Books</h4>
                                </div>
                                {{-- <div class="card-tools">
                                    <button type="button" class="btn btn-primary btn-sm" id="barcode-btn">
                                        <i class="fa fa-barcode"></i> Barcode
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" id="add-btn">
                                        <i class="fa fa-plus"></i> Add
                                    </button> 
                                    <button type="button" class="btn btn-primary btn-sm" id="back-btn">
                                        <i class="fa fa-arrow-left"></i> Back
                                    </button>
                                </div> --}}
                            </div>
                            <div class="card-body">
                                <div class="bg-item border rounded p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <label for="library-filter">library name</label>
                                            <select class="form-control" id="library-filter">
                                                <option value="">Select Library</option>
                                                <!-- Library options will be populated here -->
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <label for="search-keywords">Search by Keywords</label>
                                            <input type="text" class="form-control" placeholder="Search Keywords"
                                                id="search-keywords">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button class="btn btn-primary mt-3 mt-md-0" type="button"
                                                id="search-btn">Search</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>SR.NO</th>
                                                <th>Library</th>
                                                <th>Book Category</th>
                                                <th>Book Name</th>
                                                <th>Scan Bar Code</th>
                                                <th>Author Name</th>
                                                <th>Publisher Name</th>
                                                <!-- <th>Edition</th> -->
                                                <th>Almari No.</th>
                                                <th>Quantity</th>
                                                <th>MRP</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>main branch</td>
                                                <td>behuda</td>
                                                <td>Gujara</td>
                                                <td>123</td>
                                                <td>akshay sharma</td>
                                                <td>sunil kumawat</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>free</td>
                                                <td>888</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="btn-xs">
                                                            <i class="fa fa-eye  fs-6  text-info"></i>
                                                        </a>

                                                        <a href="#" class="btn-xs">
                                                            <i class="fa fa-edit fs-6 mx-2 text-warning"></i>
                                                        </a>
                                                        <a href="#" class=" btn-xs">
                                                            <i class="fa fa-trash fs-6 text-danger"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <p>Showing 0 to 0 of 0 entries</p>
                                    </div>
                                    <div class="col-md-6">
                                        <nav aria-label="Page navigation" class="float-right">
                                            <ul class="pagination pagination-sm">
                                                <li class="page-item disabled">
                                                    <a class="page-link bg" href="#" tabindex="-1">Previous</a>
                                                </li>
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
