@extends('layout.app')
@section('content')

@php
$permissions = Helper::getPermissions();
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            {{-- breadcrumb --}}
            <div class="row">
                <div class="col-md-12 col-12 p-0">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Student Test Performance Report</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="card card-outline card-orange col-md-12 col-12 p-0">
                    <div class="card-header bg-primary">
                        <div class="card-title">
                            <h4><i class="fa fa-chart-line"></i> &nbsp;Student Test Performance Report</h4>
                        </div>
                        <div class="card-tools">
                            @if(in_array('result_analysis.edit', $permissions) || Auth::user()->role_id == 1)
                            <a href="{{ url('userAdd') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                <span class="Display_none_mobile"> {{ __('common.Add') }} </span></a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="bg-item border p-3 rounded mb-3">
                            <form id="quickForm" method="post" action="#">
                                <div class="row">
                                    <div class="col-md-2 col-12">
                                        <label>Search By Class</label>
                                        <select class="form-control" id="classFilter">
                                            <option>Select Class</option>
                                            <option>Class 9-A</option>
                                            <option>Class 10-A</option>
                                            <option>Class 10-B</option>
                                            <option>Class 10-C</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2 col-12">
                                        <label>Test Type</label>
                                        <select class="form-control" id="testTypeFilter">
                                            <option>All Tests</option>
                                            <option>Unit Test</option>
                                            <option>Monthly Test</option>
                                            <option>Quarterly Exam</option>
                                            <option>Annual Exam</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <label>Search By Keywords</label>
                                        <input type="text" class="form-control" id="searchKeywords"
                                            placeholder="Ex. Name, Roll No, Student ID etc.">
                                    </div>

                                    <div class="col-md-1 col-12 mt-4">
                                        <button type="button" class="btn btn-primary" id="searchBtn">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="row">
                            <!-- Table Section -->
                            <div class="col-md-9">
                                <div class="table-responsive">
                                    <table id='dataContainer' class="table table-bordered table-striped">
                                        <input type='hidden' value="StudentTestReport" name='modal_type' />
                                        <thead>
                                            <tr class="bg-light">
                                                <th>SR.NO</th>
                                                <th>Student Name</th>
                                                <th>Class</th>
                                                <th>Test Performance</th>
                                                <th>Weakest Subject</th>
                                                <th>Improvement Suggestion</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataContainer-student-report" class='dataContainer' style="min-height:300px">
                                            <!-- Sample Data Rows -->
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <strong>John Doe</strong><br>
                                                    <small class="text-muted">ID: STU001 | Roll: 15</small>
                                                </td>
                                                <td>Class 10-A</td>
                                                <td>
                                                    <div class="test-performance">
                                                        <div class="test-item">
                                                            <span class="test-label">Unit Test 1:</span>
                                                            <span class="badge badge-warning">65%</span>
                                                        </div>
                                                        <div class="test-item">
                                                            <span class="test-label">Unit Test 2:</span>
                                                            <span class="badge badge-success">78%</span>
                                                        </div>
                                                        <div class="test-item">
                                                            <span class="test-label">Monthly Test:</span>
                                                            <span class="badge badge-info">72%</span>
                                                        </div>
                                                        <div class="test-avg">
                                                            <strong>Avg: 71.7%</strong>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="weak-subject">
                                                        <span class="subject-name text-danger">
                                                            <strong>Mathematics</strong>
                                                        </span>
                                                        <div class="subject-scores">
                                                            <small>UT1: 45% | UT2: 52% | MT: 48%</small>
                                                        </div>
                                                        <div class="subject-avg">
                                                            <span class="badge badge-danger">Avg: 48.3%</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="improvement-suggestion">
                                                        <ul class="suggestion-list">
                                                            <li>Focus on basic algebra concepts</li>
                                                            <li>Practice more word problems</li>
                                                            <li>Attend extra math sessions</li>
                                                        </ul>
                                                        <div class="priority">
                                                            <span class="badge badge-warning">High Priority</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">Needs Improvement</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-info" title="View Details">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-primary" title="Test History">
                                                            <i class="fa fa-history"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-success" title="Download Report">
                                                            <i class="fa fa-download"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <strong>Jane Smith</strong><br>
                                                    <small class="text-muted">ID: STU002 | Roll: 22</small>
                                                </td>
                                                <td>Class 10-B</td>
                                                <td>
                                                    <div class="test-performance">
                                                        <div class="test-item">
                                                            <span class="test-label">Unit Test 1:</span>
                                                            <span class="badge badge-success">85%</span>
                                                        </div>
                                                        <div class="test-item">
                                                            <span class="test-label">Unit Test 2:</span>
                                                            <span class="badge badge-success">88%</span>
                                                        </div>
                                                        <div class="test-item">
                                                            <span class="test-label">Monthly Test:</span>
                                                            <span class="badge badge-success">92%</span>
                                                        </div>
                                                        <div class="test-avg">
                                                            <strong>Avg: 88.3%</strong>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="weak-subject">
                                                        <span class="subject-name text-warning">
                                                            <strong>Physics</strong>
                                                        </span>
                                                        <div class="subject-scores">
                                                            <small>UT1: 75% | UT2: 78% | MT: 82%</small>
                                                        </div>
                                                        <div class="subject-avg">
                                                            <span class="badge badge-warning">Avg: 78.3%</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="improvement-suggestion">
                                                        <ul class="suggestion-list">
                                                            <li>Strengthen problem-solving skills</li>
                                                            <li>Practice numerical problems</li>
                                                            <li>Review conceptual physics</li>
                                                        </ul>
                                                        <div class="priority">
                                                            <span class="badge badge-info">Medium Priority</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Excellent</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-info" title="View Details">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-primary" title="Test History">
                                                            <i class="fa fa-history"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-success" title="Download Report">
                                                            <i class="fa fa-download"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <strong>Mike Johnson</strong><br>
                                                    <small class="text-muted">ID: STU003 | Roll: 8</small>
                                                </td>
                                                <td>Class 9-A</td>
                                                <td>
                                                    <div class="test-performance">
                                                        <div class="test-item">
                                                            <span class="test-label">Unit Test 1:</span>
                                                            <span class="badge badge-danger">42%</span>
                                                        </div>
                                                        <div class="test-item">
                                                            <span class="test-label">Unit Test 2:</span>
                                                            <span class="badge badge-danger">38%</span>
                                                        </div>
                                                        <div class="test-item">
                                                            <span class="test-label">Monthly Test:</span>
                                                            <span class="badge badge-warning">55%</span>
                                                        </div>
                                                        <div class="test-avg">
                                                            <strong>Avg: 45.0%</strong>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="weak-subject">
                                                        <span class="subject-name text-danger">
                                                            <strong>English</strong>
                                                        </span>
                                                        <div class="subject-scores">
                                                            <small>UT1: 28% | UT2: 32% | MT: 45%</small>
                                                        </div>
                                                        <div class="subject-avg">
                                                            <span class="badge badge-danger">Avg: 35.0%</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="improvement-suggestion">
                                                        <ul class="suggestion-list">
                                                            <li>Intensive reading practice</li>
                                                            <li>Grammar fundamentals</li>
                                                            <li>Vocabulary building</li>
                                                            <li>One-on-one tutoring</li>
                                                        </ul>
                                                        <div class="priority">
                                                            <span class="badge badge-danger">Critical Priority</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-danger">Critical Attention</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-info" title="View Details">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-primary" title="Test History">
                                                            <i class="fa fa-history"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-success" title="Download Report">
                                                            <i class="fa fa-download"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>4</td>
                                                <td>
                                                    <strong>Sarah Wilson</strong><br>
                                                    <small class="text-muted">ID: STU004 | Roll: 5</small>
                                                </td>
                                                <td>Class 10-C</td>
                                                <td>
                                                    <div class="test-performance">
                                                        <div class="test-item">
                                                            <span class="test-label">Unit Test 1:</span>
                                                            <span class="badge badge-success">92%</span>
                                                        </div>
                                                        <div class="test-item">
                                                            <span class="test-label">Unit Test 2:</span>
                                                            <span class="badge badge-success">95%</span>
                                                        </div>
                                                        <div class="test-item">
                                                            <span class="test-label">Monthly Test:</span>
                                                            <span class="badge badge-success">89%</span>
                                                        </div>
                                                        <div class="test-avg">
                                                            <strong>Avg: 92.0%</strong>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="weak-subject">
                                                        <span class="subject-name text-warning">
                                                            <strong>History</strong>
                                                        </span>
                                                        <div class="subject-scores">
                                                            <small>UT1: 85% | UT2: 82% | MT: 80%</small>
                                                        </div>
                                                        <div class="subject-avg">
                                                            <span class="badge badge-warning">Avg: 82.3%</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="improvement-suggestion">
                                                        <ul class="suggestion-list">
                                                            <li>Enhance timeline memorization</li>
                                                            <li>Focus on essay writing</li>
                                                            <li>Practice date-event correlation</li>
                                                        </ul>
                                                        <div class="priority">
                                                            <span class="badge badge-success">Low Priority</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Outstanding</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-info" title="View Details">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-primary" title="Test History">
                                                            <i class="fa fa-history"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-success" title="Download Report">
                                                            <i class="fa fa-download"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            @include('common.loadskeletan',['loopCount'=>2])
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Charts Section -->
                            <div class="col-md-3">
                                <!-- Chart Toggle Buttons -->
                                <div class="btn-group btn-group-sm w-100 mb-3" role="group">
                                    <button type="button" class="btn btn-outline-primary active" data-chart="test-trends">
                                        <i class="fa fa-chart-line"></i> Test Trends
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" data-chart="weak-subjects">
                                        <i class="fa fa-exclamation-triangle"></i> Weak Subjects
                                    </button>
                                </div>

                                <!-- Test Performance Trends Chart -->
                                <div class="card card-outline card-primary mb-3 chart-card" id="test-trends-card">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <i class="fa fa-chart-line"></i> Test Performance Trends
                                            <button class="btn btn-sm btn-outline-light float-right" id="refreshTestTrends">
                                                <i class="fa fa-sync-alt"></i>
                                            </button>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="testTrendsChart"></canvas>
                                        </div>
                                        <div class="mt-3 trend-stats">
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <div class="trend-item">
                                                        <i class="fa fa-arrow-up text-success"></i>
                                                        <span>Improvement Rate</span>
                                                        <strong class="text-success">+5.2%</strong>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="trend-item">
                                                        <i class="fa fa-chart-line text-info"></i>
                                                        <span>Best Test</span>
                                                        <strong class="text-info">Monthly Test</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Weakest Subjects Analysis -->
                                <div class="card card-outline card-danger mb-3 chart-card d-none" id="weak-subjects-card">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <i class="fa fa-exclamation-triangle"></i> Weakest Subjects Analysis
                                            <button class="btn btn-sm btn-outline-light float-right" id="refreshWeakSubjects">
                                                <i class="fa fa-sync-alt"></i>
                                            </button>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="weakSubjectsChart"></canvas>
                                        </div>
                                        <div class="mt-3">
                                            <div class="subject-stats">
                                                <div class="stat-item">
                                                    <span class="stat-label text-danger">Mathematics</span>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-danger" style="width: 45%"></div>
                                                    </div>
                                                    <span class="stat-value">45% students struggling</span>
                                                </div>
                                                <div class="stat-item">
                                                    <span class="stat-label text-warning">English</span>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-warning" style="width: 35%"></div>
                                                    </div>
                                                    <span class="stat-value">35% students struggling</span>
                                                </div>
                                                <div class="stat-item">
                                                    <span class="stat-label text-info">Physics</span>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-info" style="width: 28%"></div>
                                                    </div>
                                                    <span class="stat-value">28% students struggling</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Test Status Overview -->
                                <div class="card card-outline card-info mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <i class="fa fa-chart-pie"></i> Test Status Overview
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="status-stats">
                                            <div class="status-item">
                                                <div class="status-info">
                                                    <span class="status-name">Outstanding</span>
                                                    <span class="status-count">15 students</span>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success progress-bar-animated" style="width: 15%">15%</div>
                                                </div>
                                            </div>
                                            <div class="status-item">
                                                <div class="status-info">
                                                    <span class="status-name">Excellent</span>
                                                    <span class="status-count">35 students</span>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-primary progress-bar-animated" style="width: 35%">35%</div>
                                                </div>
                                            </div>
                                            <div class="status-item">
                                                <div class="status-info">
                                                    <span class="status-name">Needs Improvement</span>
                                                    <span class="status-count">40 students</span>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning progress-bar-animated" style="width: 40%">40%</div>
                                                </div>
                                            </div>
                                            <div class="status-item">
                                                <div class="status-info">
                                                    <span class="status-name">Critical Attention</span>
                                                    <span class="status-count">10 students</span>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-danger progress-bar-animated" style="width: 10%">10%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Actions -->
                                <div class="card card-outline card-dark">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <i class="fa fa-bolt"></i> Quick Actions
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="quick-actions">
                                            <button class="btn btn-primary btn-sm btn-block mb-2">
                                                <i class="fa fa-file-export"></i> Export All Reports
                                            </button>
                                            <button class="btn btn-warning btn-sm btn-block mb-2">
                                                <i class="fa fa-bell"></i> Send Alerts to Parents
                                            </button>
                                            <button class="btn btn-info btn-sm btn-block mb-2">
                                                <i class="fa fa-calendar-plus"></i> Schedule Remedial Classes
                                            </button>
                                            <button class="btn btn-success btn-sm btn-block">
                                                <i class="fa fa-chart-bar"></i> Generate Summary Report
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals -->
        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background: #555b5beb;">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">Change Status Confirmation</h5>
                        <button type="button" class="close text-white" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body text-white">
                        Are you sure you want to change status?
                        <input type="hidden" id="status_id">
                        <input type="hidden" id="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Chart toggle functionality
    const chartButtons = document.querySelectorAll('[data-chart]');
    const chartCards = {
        'test-trends': document.getElementById('test-trends-card'),
        'weak-subjects': document.getElementById('weak-subjects-card')
    };

    chartButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Remove active class from all buttons
            chartButtons.forEach(btn => btn.classList.remove('active'));
            // Add active to clicked one
            this.classList.add('active');

            // Hide all chart cards
            Object.values(chartCards).forEach(card => card.classList.add('d-none'));
            // Show the selected chart
            const selectedChart = this.getAttribute('data-chart');
            chartCards[selectedChart].classList.remove('d-none');
        });
    });

    // Refresh buttons
    document.getElementById('refreshTestTrends').addEventListener('click', function () {
        alert("Test Trends chart refreshed!");
        // Optionally re-fetch and update the chart data here
    });

    document.getElementById('refreshWeakSubjects').addEventListener('click', function () {
        alert("Weak Subjects chart refreshed!");
        // Optionally re-fetch and update the chart data here
    });

    // Sample chart setup - Chart.js required
    const testTrendsCtx = document.getElementById('testTrendsChart').getContext('2d');
    new Chart(testTrendsCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr'],
            datasets: [{
                label: 'Performance (%)',
                data: [65, 70, 75, 80],
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    const weakSubjectsCtx = document.getElementById('weakSubjectsChart').getContext('2d');
    new Chart(weakSubjectsCtx, {
        type: 'bar',
        data: {
            labels: ['Mathematics', 'English', 'Physics'],
            datasets: [{
                label: 'Struggling Students (%)',
                data: [45, 35, 28],
                backgroundColor: ['#dc3545', '#ffc107', '#17a2b8']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
});
</script>

<style>
    /* Fix for chart height issue */
    .card-body canvas {
        max-height: 200px !important;
        width: 100% !important;
        height: 200px !important;
    }

    /* Specific chart container styling */
    #performanceChart, #subjectChart {
        max-height: 200px !important;
        height: 200px !important;
        width: 100% !important;
    }

    /* Chart container wrapper */
    .chart-container {
        position: relative;
        height: 200px;
        width: 100%;
        overflow: hidden;
    }

    /* Original styles */
    .card {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    .progress {
        height: 20px;
    }
    
    .progress-bar {
        line-height: 20px;
        font-size: 12px;
    }
    
    .table th {
        font-size: 12px;
        padding: 8px 4px;
    }
    
    .table td {
        font-size: 11px;
        padding: 8px 4px;
    }
    
    .btn-group .btn {
        padding: 2px 6px;
    }
</style>
@endsection