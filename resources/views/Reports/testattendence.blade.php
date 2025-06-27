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
                            <li class="breadcrumb-item">Test Schedule & Attendance</li>
                        </ul>
                    </div>
                </div>

                <!-- Main Card -->
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card card-orange card-outline">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4><i class="fas fa-calendar-check"></i> &nbsp;Test Schedule & Attendance Report</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                {{-- filters --}}
                                <form action="#">
                                    {{-- filters --}}
                                    <div class="row mb-2">
                                        <div class="col-md-2 form-group">
                                            <label for="class" class="form-label">Select a class</label>
                                            <select name="class" id="class" class="form-control">
                                                <option selected>select</option>
                                                <option value="1">NEET</option>
                                                <option value="2">IIT</option>
                                                <option value="3">CUET</option>
                                                <option value="4">12</option>
                                                <option value="5">11</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <button class="btn btn-primary mt-md-4 my-2"
                                                style="vertical-align: bottom">Search</button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Stat Cards -->
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="card-stat p-3 text-center shadow-sm rounded">
                                            <h6>Total Tests Conducted</h6>
                                            <div class="stat-value text-primary">12</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-stat p-3 text-center shadow-sm rounded">
                                            <h6>Total Students</h6>
                                            <div class="stat-value text-info">150</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-stat p-3 text-center shadow-sm rounded">
                                            <h6>Avg Attendance Rate</h6>
                                            <div class="stat-value text-success">86%</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-stat p-3 text-center shadow-sm rounded">
                                            <h6>Late Submissions</h6>
                                            <div class="stat-value text-danger">8 Cases</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Test-wise Attendance Table -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <div class="card-title">
                                            <h4><i class="fas fa-list-alt"></i> Test-wise Attendance</h4>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <form action="#">
                                            {{-- filters --}}
                                            <div class="row mb-2">
                                                <div class="col-md-2 form-group">
                                                    <label for="class" class="form-label">Search by Keywords</label>
                                                    <input type="text" name="time" class="form-control" id="class"
                                                        placeholder="Ex. testname, absent student,">
                                                </div>

                                                <div class="col-md-4">
                                                    <button class="btn btn-primary mt-md-4 my-2"
                                                        style="vertical-align: bottom">Search</button>
                                                </div>
                                                <div class="text-md-right col-md-6 col-12 align-content-end mb-md-2">
                                                    <button class="btn btn-outline-primary mb-md-0 mb-1"><i
                                                            class="fas fa-file-download"></i> Export
                                                        PDF</button>
                                                    <button class="btn btn-outline-secondary"><i
                                                            class="fas fa-file-download"></i>
                                                        Export CSV</button>
                                                </div>
                                            </div>
                                        </form>
                                        <table class="table table-striped table-bordered">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Test Name</th>
                                                    <th>Date</th>
                                                    <th>Students Present</th>
                                                    <th>Students Absent</th>
                                                    <th>Late Submissions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Test 1</td>
                                                    <td>2024-06-05</td>
                                                    <td>140</td>
                                                    <td>10</td>
                                                    <td>2</td>
                                                </tr>
                                                <tr>
                                                    <td>Test 2</td>
                                                    <td>2024-06-10</td>
                                                    <td>132</td>
                                                    <td>18</td>
                                                    <td>4</td>
                                                </tr>
                                                <tr>
                                                    <td>Test 3</td>
                                                    <td>2024-06-15</td>
                                                    <td>138</td>
                                                    <td>12</td>
                                                    <td>2</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Missed Tests Table -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <div class="card-title">
                                            <h4><i class="fas fa-user-times"></i> Missed Tests List</h4>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <form action="#">
                                            {{-- filters --}}
                                            <div class="row mb-2">
                                                <div class="col-md-2 form-group">
                                                    <label for="class" class="form-label">Search by Keywords</label>
                                                    <input type="text" name="time" class="form-control" id="class"
                                                        placeholder="Ex. Student Name, Roll no, reason">
                                                </div>

                                                <div class="col-md-4">
                                                    <button class="btn btn-primary mt-md-4 my-2"
                                                        style="vertical-align: bottom">Search</button>
                                                </div>
                                                <div class="text-md-right col-md-6 col-12 align-content-end mb-md-2">
                                                    <button class="btn btn-outline-primary mb-md-0 mb-1"><i
                                                            class="fas fa-file-download"></i> Export
                                                        PDF</button>
                                                    <button class="btn btn-outline-secondary"><i
                                                            class="fas fa-file-download"></i>
                                                        Export CSV</button>
                                                </div>
                                            </div>
                                        </form>
                                        <table class="table table-striped table-bordered">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Roll No</th>
                                                    <th>Missed Test</th>
                                                    <th>Reason</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Rahul Singh</td>
                                                    <td>1024</td>
                                                    <td>Test 2</td>
                                                    <td>Sick Leave</td>
                                                </tr>
                                                <tr>
                                                    <td>Priya Mehta</td>
                                                    <td>1032</td>
                                                    <td>Test 1</td>
                                                    <td>Uninformed</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="text-end">
                                    <button class="btn btn-outline-primary me-2"><i class="fas fa-file-download"></i>
                                        Download Logs (PDF)</button>
                                    <button class="btn btn-outline-secondary"><i class="fas fa-file-csv"></i> Export
                                        CSV</button>
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
            background: #f0f0f0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            height: 85%;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            height: 25px;
            line-height: 1;
        }
    </style>
@endsection
