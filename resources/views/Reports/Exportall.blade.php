@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Export All Data</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card card-orange card-outline">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4><i class="fas fa-file-export"></i> &nbsp;7. Export All Data</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <p><strong>🛠 उपयोग:</strong> एक क्लिक में सभी रिपोर्ट्स का डाउनलोड विकल्प।</p>
                                        <p><strong>🔍 फीचर्स:</strong></p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Test Result</li>
                                            <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Question Bank</li>
                                            <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Student Profiles</li>
                                            <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Attendance</li>
                                            <li class="list-group-item"><i class="fas fa-file-alt text-info me-2"></i>Format: Excel / CSV / PDF</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Export All as PDF</button>
                                    <button class="btn btn-outline-success"><i class="fas fa-download"></i> Export All as Excel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <style>
        .list-group-item {
            font-size: 15px;
        }
    </style>
@endsection
