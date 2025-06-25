@extends('layout.app')
@section('content')
    <style>
        .top {
            margin-top: -12px;
        }

        /* Responsive styles */
        @media (max-width: 992px) {
            .card-tools {
                margin-top: 10px;
                display: block;
                float: none !important;
            }

            .card-title {
                display: block;
                width: 100%;
            }

            .card-header {
                flex-direction: column;
                align-items: start;
            }
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }

            #example1 {
                min-width: 800px;
            }

            .card-body {
                padding: 0.75rem;
            }

            .btn-sm {
                padding: 0.2rem 0.4rem;
                font-size: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .modal-content {
                margin-left: 0 !important;
                width: 100% !important;
            }

            .card-header h3 {
                font-size: 1.2rem;
            }
        }
    </style>
    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa fa-credit-card"></i> &nbsp;Wallet</h4>
                                </div>
                                <div class="card-tools">
                                    <!-- <a href="expenseAdd" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add</a>  -->
                                    <!--<a href="hostel_dashboard" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left"></i> Back </a>-->
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="example1"
                                            class="table table-bordered table-striped dataTable dtr-inline">
                                            <thead class="bg-light">
                                                <tr role="row">
                                                    <th>Admission No.</th>
                                                    <th>Library</th>
                                                    <th>Student Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>A4555</td>
                                                    <td>Main Library</td>
                                                    <td>Ak</td>
                                                    <td>9828753951</td>
                                                    <td>Aksh@gmail.com</td>
                                                    <td id="date-id">500/-</td>
                                                    <td>
                                                        <div class="d-flex flex-wrap gap-1">
                                                            <button class="btn btn-success btn-sm"><i
                                                                    class="bi bi-plus-lg"></i> Add</button>
                                                            <button class="btn btn-info btn-sm text-white"><i
                                                                    class="bi bi-eye"></i> Details</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-white">Total</th>
                                                    <th> </th>
                                                    <th> </th>
                                                    <th> </th>
                                                    <th> <b>Total Amount</b></th>
                                                    <th> <b id="total_amt">₹ 500</b></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- The Modal -->
    <div class="modal" id="Modal_id">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #555b5beb;">
                <div class="modal-header">
                    <h4 class="modal-title text-white">Delete Confirmation</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times"
                            aria-hidden="true"></i></button>
                </div>
                <form action="expenseDelete" method="post">
                    <div class="modal-body">
                        <input type=hidden id="delete_id" name=delete_id>
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

    <script>
        $('.deleteData').click(function() {
            var delete_id = $(this).data('id');
            $('#delete_id').val(delete_id);
        });
    </script>
@endsection
