@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Feedback & Doubt Report</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card card-orange card-outline">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4><i class="fas fa-comment-dots"></i> &nbsp;Feedback & Doubt Resolution Report</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Stat Cards -->
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="card-stat p-3 text-center shadow-sm rounded">
                                            <h6>Total Doubts/Feedback</h6>
                                            <div class="stat-value text-primary">184</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-stat p-3 text-center shadow-sm rounded">
                                            <h6>Solved Doubts</h6>
                                            <div class="stat-value text-success">142</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-stat p-3 text-center shadow-sm rounded">
                                            <h6>Average Response Time</h6>
                                            <div class="stat-value text-warning">1h 32m</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-stat p-3 text-center shadow-sm rounded">
                                            <h6>Pending Doubts</h6>
                                            <div class="stat-value text-danger">42</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Doubts Per Subject -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <div class="card-title">
                                            <h4><i class="fas fa-book"></i> Doubts Per Subject</h4>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <form action="#">
                                            {{-- filters --}}
                                            <div class="row mb-2">
                                                <div class="col-md-2 form-group">
                                                    <label for="class" class="form-label">Search by Keywords</label>
                                                    <input type="text" name="time" class="form-control" id="class"
                                                        placeholder="Ex. subject, pending, solved">
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
                                        <table class="table table-bordered table-striped">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Subject</th>
                                                    <th>Total Doubts</th>
                                                    <th>Solved</th>
                                                    <th>Avg. Response Time</th>
                                                    <th>Pending</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Physics</td>
                                                    <td>54</td>
                                                    <td>48</td>
                                                    <td>1h 12m</td>
                                                    <td>6</td>
                                                </tr>
                                                <tr>
                                                    <td>Chemistry</td>
                                                    <td>42</td>
                                                    <td>39</td>
                                                    <td>1h 45m</td>
                                                    <td>3</td>
                                                </tr>
                                                <tr>
                                                    <td>Maths</td>
                                                    <td>60</td>
                                                    <td>45</td>
                                                    <td>2h 10m</td>
                                                    <td>15</td>
                                                </tr>
                                                <tr>
                                                    <td>Biology</td>
                                                    <td>28</td>
                                                    <td>22</td>
                                                    <td>50m</td>
                                                    <td>6</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Faculty-Wise Stats -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <div class="card-title">
                                            <h4><i class="fas fa-chalkboard-teacher"></i> Faculty-Wise Response Stats</h4>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <form action="#">
                                            {{-- filters --}}
                                            <div class="row mb-2">
                                                <div class="col-md-2 form-group">
                                                    <label for="class" class="form-label">Search by Keywords</label>
                                                    <input type="text" name="time" class="form-control" id="class"
                                                        placeholder="Ex. Faculty, time, solved">
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
                                                    <th>Faculty</th>
                                                    <th>Subject</th>
                                                    <th>Doubts Solved</th>
                                                    <th>Avg. Response Time</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Dr. Sharma</td>
                                                    <td>Physics</td>
                                                    <td>40</td>
                                                    <td>58m</td>

                                                </tr>
                                                <tr>
                                                    <td>Ms. Gupta</td>
                                                    <td>Chemistry</td>
                                                    <td>35</td>
                                                    <td>1h 20m</td>
                                                </tr>
                                                <tr>
                                                    <td>Mr. Verma</td>
                                                    <td>Maths</td>
                                                    <td>30</td>
                                                    <td>2h 05m</td>
                                                </tr>
                                                <tr>
                                                    <td>Dr. Ritu</td>
                                                    <td>Biology</td>
                                                    <td>22</td>
                                                    <td>45m</td>
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
        </section>
    </div>

    <style>
        .card-stat {
            background: #dadada;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            height: 90%;
        }

        .stat-value {
            font-size: 26px;
            font-weight: bold;
            height: 30px;
            line-height: 1;
        }
    </style>
@endsection
