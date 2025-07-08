@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-orange card-outline">
                    <div class="card-header bg-light">
                        <div class="card-title">
                            <h4><i class="fa-solid fa-trash-can-arrow-up"></i> &nbsp;Archive/Recycle Bin</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-light">
                                    <th>Sr. No</th>
                                    <th>Question</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>What is the capital of India?</td>
                                        <td>
                                            <button class="btn btn-primary"><i class="fa fa-undo"></i>
                                                </button>
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i>
                                                </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Which planet is known as the Red Planet?</td>
                                        <td>
                                            <button class="btn btn-primary"><i class="fa fa-undo"></i>
                                                </button>
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i>
                                                </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Who wrote the national anthem of India?</td>
                                        <td>
                                            <button class="btn btn-primary"><i class="fa fa-undo"></i>
                                                </button>
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i>
                                                </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>What is the boiling point of water?</td>
                                        <td>
                                            <button class="btn btn-primary"><i class="fa fa-undo"></i>
                                                </button>
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i>
                                                </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Who is known as the Father of the Nation?</td>
                                        <td>
                                            <button class="btn btn-primary me-1"><i class="fa fa-undo"></i>
                                                </button>
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i>
                                                </button>
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
@endsection
