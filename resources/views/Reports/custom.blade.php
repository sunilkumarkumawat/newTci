@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item">Custom Report Generator</li>
                    </ul>
                </div>
            </div>

            <!-- Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-orange card-outline">
                        <div class="card-header bg-light">
                            <div class="card-title">
                                <h4><i class="fas fa-cogs"></i> &nbsp;Custom Report Generator</h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Filters -->
                            <form action="#" method="POST" id="reportForm">
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <label class="form-label">Student</label>
                                        <select class="form-control" name="student">
                                            <option value="">All</option>
                                            <option value="1">Rahul Sharma</option>
                                            <option value="2">Neha Patel</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Test</label>
                                        <select class="form-control" name="test">
                                            <option value="">All</option>
                                            <option value="test1">Test 1</option>
                                            <option value="test2">Test 2</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Subject</label>
                                        <select class="form-control" name="subject">
                                            <option value="">All</option>
                                            <option value="maths">Maths</option>
                                            <option value="physics">Physics</option>
                                            <option value="chemistry">Chemistry</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Date</label>
                                        <input type="date" name="date" class="form-control">
                                    </div>

                                    <div class="col-md-2 mt-md-4 my-2">
                                     <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>

                                <!-- Select Columns -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Select Data Columns</label>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="columns[]" value="student_name" checked>
                                                    <label class="form-check-label">Student Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="columns[]" value="subject" checked>
                                                    <label class="form-check-label">Subject</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="columns[]" value="test">
                                                    <label class="form-check-label">Test</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="columns[]" value="score">
                                                    <label class="form-check-label">Score</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="columns[]" value="attendance">
                                                    <label class="form-check-label">Attendance</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="columns[]" value="submission_time">
                                                    <label class="form-check-label">Submission Time</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Generate Report</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn btn-outline-success"><i class="fas fa-save"></i> Save Format</button>
                                        <button type="button" class="btn btn-outline-primary"><i class="fas fa-file-download"></i> Download Report</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Report Output Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Subject</th>
                                            <th>Test</th>
                                            <th>Score</th>
                                            <th>Attendance</th>
                                            <th>Submission Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Rahul Sharma</td>
                                            <td>Physics</td>
                                            <td>Test 1</td>
                                            <td>88</td>
                                            <td>Present</td>
                                            <td>10:32 AM</td>
                                        </tr>
                                        <tr>
                                            <td>Neha Patel</td>
                                            <td>Maths</td>
                                            <td>Test 2</td>
                                            <td>74</td>
                                            <td>Present</td>
                                            <td>11:05 AM</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .card-stat {
        background: #f5f5f5;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        height: 100%;
    }

    .stat-value {
        font-size: 24px;
        font-weight: bold;
        height: 30px;
        line-height: 1;
    }
</style>
@endsection
