@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Time Analysis</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card card-orange card-outline">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4><i class="fa-solid fa-clock"></i> &nbsp;Time Analysis Report</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Stat Cards -->
                                <div class="row mb-4">
                                    <div class="col-md-12 mb-3">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="class" class="form-label">Search by class</label>
                                                    <select name="class" id="class" class="form-control">
                                                        <option value="1">Neet</option>
                                                        <option value="2">IIT</option>
                                                        <option value="3">12th</option>
                                                        <option value="3">11th</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="class" class="form-label">Search by Test</label>
                                                    <select name="class" id="class" class="form-control">
                                                        <option value="1">Test-1</option>
                                                        <option value="2">Test-2</option>
                                                        <option value="3">Test-3</option>
                                                        <option value="3">Test-4</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-primary mt-4"
                                                        style="vertical-align: bottom">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-stat p-3 text-center shadow-sm rounded">
                                            <h6>Average Time Per Question</h6>
                                            <div class="stat-value">42 sec</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-stat p-3 text-center shadow-sm rounded">
                                            <h6 class="m-0">Time Taken vs Accuracy</h6>
                                            <div class="stat-value">89% Accuracy</div>
                                            <small class="text-muted d-block">Avg Time: 40s | High Score</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-stat p-3 text-center shadow-sm rounded">
                                            <h6>Slowest Question</h6>
                                            <div class="stat-value">Q.12 – 2 min 18 sec</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="row">
                                    <div class="col-md-12 col-12">


                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <div class="card-title">
                                                    <h4>Question-wise Time & Accuracy</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form action="#">
                                                    {{-- filters --}}
                                                    <div class="row mb-3">
                                                        <div class="col-md-2 form-group">
                                                            <label for="class" class="form-label">Search by Time</label>
                                                            <input type="text" name="time" class="form-control" id="class" placeholder="search by time">
                                                        </div>

                                                        <div class="col-md-2">
                                                            <label for="class" class="form-label">Search by Test</label>
                                                            <input type="text" class="form-control" name="answer" placeholder="search by answer">
                                                        </div>
                                                        <div class="col-md-2">
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
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th>Q.No</th>
                                                                <th>Time Taken</th>
                                                                <th>Answer</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>38 sec</td>
                                                                <td>A</td>
                                                                <td><span class="badge bg-success">Correct</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>51 sec</td>
                                                                <td>C</td>
                                                                <td><span class="badge bg-danger">Wrong</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>12</td>
                                                                <td><strong>2 min 18 sec</strong></td>
                                                                <td>B</td>
                                                                <td><span class="badge bg-success">Correct</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        .stat-card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            padding: 10px;
            background: #dadada;
            height: 90%;
        }

        .card-stat {
            background: #dadada;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            height: 90%;
        }

        .stat-value {
            font-size: 26px;
            font-weight: bold;
            color: #0d6efd;
            height: 30px;
            line-height: 1;
        }
    </style>
@endsection
