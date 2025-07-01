@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Faculty Report</li>
                        </ul>
                    </div>
                </div>
                {{-- report form --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-orange card-outline">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4><i class="fa-solid fa-user-tie"></i> &nbsp;Faculty Contribution Report</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- no of questions added --}}
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="stat-card text-center">
                                            <div class="stat-title">Questions Added</div>
                                            <div class="stat-value">120</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stat-card text-center">
                                            <div class="stat-title">Tests Evaluated</div>
                                            <div class="stat-value">45</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stat-card text-center">
                                            <div class="stat-title">Feedback Resolved</div>
                                            <div class="stat-value">32</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stat-card text-center">
                                            <div class="stat-title">Pending Tasks</div>
                                            <div class="stat-value">8</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Leaderboard Table -->
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="card shadow" style="box-shadow: ">
                                            <div class="card-header bg-light">
                                                <div class="chart-title">
                                                    <h4>Faculty Wise Leaderboard : -</h4>
                                                </div>
                                            </div>
                                            <div class="chart-body ">
                                                <form action="#">
                                                    <div class="row mb-3">
                                                        <div class="col-md-2 form-group">
                                                            <label for="name" class="form-label">Search by Name</label>
                                                            <input type="text" name="name" class="form-control"
                                                                id="name" placeholder="search by Name">
                                                        </div>

                                                        <div class="col-md-2">
                                                            <label for="score" class="form-label">Search by Score</label>
                                                            <input type="score" class="form-control" name="score" id="score"
                                                                placeholder="search by score">
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
                                                    {{-- filters --}}

                                                </form>
                                                <div class="table-responsive">
                                                    <table class="table table-striped mb-0">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th>Rank</th>
                                                                <th>Faculty Name</th>
                                                                <th>Questions Added</th>
                                                                <th>Tests Evaluated</th>
                                                                <th>Feedback Resolved</th>
                                                                <th>Total Score</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Dr. A. Sharma</td>
                                                                <td>50</td>
                                                                <td>20</td>
                                                                <td>15</td>
                                                                <td><strong>85</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Prof. R. Mehta</td>
                                                                <td>40</td>
                                                                <td>15</td>
                                                                <td>10</td>
                                                                <td><strong>65</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Ms. P. Verma</td>
                                                                <td>30</td>
                                                                <td>10</td>
                                                                <td>7</td>
                                                                <td><strong>47</strong></td>
                                                            </tr>
                                                            <!-- Add more rows as needed -->
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

        .stat-title {
            font-size: 18px;
            font-weight: 600;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #0d6efd;
        }

        .chart-header {
            padding: 0.3rem;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .chart-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin: 0;
        }

        .chart-body {
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
    </style>
@endsection
