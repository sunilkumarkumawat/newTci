@extends('layout.app')
@section('content')

@php
$permissions = Helper::getPermissions();
$filterable_columns = ['class_type_id'=>true, 'subject_id'=>true, 'chapter_id'=>true, 'topic_id'=>true, 'level_id'=>true, 'suka_id'=>true, 'question_type_id'=>true, 'status'=>true, 'language'=>true, 'use'=>true, 'tags'=>true, 'source_id'=>true, 'is_deleted'=>true, 'keyword'=>true];
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            {{-- breadcrumb --}}
            <div class="row">
                <div class="col-md-12 col-12 p-0">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Test-wise Report</li>
                        <li class="breadcrumb-item">Results</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="card card-outline card-orange col-md-12 col-12 p-0" >
                    <div class="card-header bg-primary">
                        <div class="card-title">
                            <h4><i class="fa fa-desktop"></i> &nbsp;Test-wise Report</h4>
                        </div>
                        <div class="card-tools">
                            @if(in_array('user_management.edit', $permissions) || Auth::user()->role_id == 1)
                            <a href="{{ url('questions') }}" class="btn btn-primary  btn-sm"><i class="fa fa-plus"></i>
                                <span class="Display_none_mobile"> {{ __('common.Add') }} </span></a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="bg-item border p-3 rounded">
                            <form id="filterForm">
                                <div class="row">
                                    @include('commoninputs.filterinputs', [
                                    'filters' => $filterable_columns
                                    ])
                                    <div class="col-md-1 mt-4">
                                        <button type="button" id="filterForm" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header bg-info text-white" style="background-color: #002c54 !important;;">
                                <h5 class="mb-0" >📋 Test Result Summary</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Left Side - Marks Statistics -->
                                    <div class="col-md-6">
                                        <h6 class="mb-3">📊 <strong>Marks Statistics</strong></h6>
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <div class="border rounded p-2 hav  d-flex justify-content-between align-items-center">
                                                    <span><strong>Highest Marks:</strong></span>
                                                    <span class="badge badge-light text-dark" id="highestMarks">--</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="border rounded p-2 hav  d-flex justify-content-between align-items-center">
                                                    <span><strong>Average Marks:</strong></span>
                                                    <span class="badge badge-light text-dark" id="averageMarks">--</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="border rounded p-2 hav  d-flex justify-content-between align-items-center">
                                                    <span><strong>Lowest Marks:</strong></span>
                                                    <span class="badge badge-light text-dark" id="lowestMarks">--</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Right Side - Top Rankers -->
                                    <div class="col-md-6">
                                        <h6 class="mb-3">🏆 <strong>Top Rankers</strong></h6>
                                        <div class="border rounded p-3 back_color" style="max-height: 150px; overflow-y: auto;">
                                            <div id="topRankers">
                                                <!-- Top rankers will be populated here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Table Column -->
                            <div class="col-md-9">
                                <div class="table-responsive">
                                    <table id='questionTable' class="table table-bordered table-striped mt-4">
                                        <input type='hidden' value="Question" name='modal_type' />
                                        <thead>
                                            <tr class="bg-light">
                                                <th>Rank</th>
                                                <th>Student Name</th>
                                                <th>Roll No</th>
                                                <th>Class</th>
                                                <th>Test Name</th>
                                                <th>Marks Obtained</th>
                                                <th>Total Marks</th>
                                                <th>Percentage (%)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <!-- Chart Column -->
                            <div class="col-md-3" style="margin-top: 34px; font-size: 0.875rem;" >
                                <!-- Student Performance Distribution Chart -->
                                <div class="card">
                                    
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="mb-0">📊 Student Performance Distribution</h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <canvas id="studentDistributionChart" width="300" height="300"></canvas>
                                        
                                        <!-- Statistics Summary -->
                                        <div class="mt-3">
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <div class="border rounded p-2 bg-success text-white">
                                                        <small><strong>High Performers</strong></small>
                                                        <div id="highPerformersCount" class="h5 mb-0">0</div>
                                                        <small id="highPerformersPercent">0%</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="border rounded p-2 bg-warning text-white">
                                                        <small><strong>Average</strong></small>
                                                        <div id="averagePerformersCount" class="h5 mb-0">0</div>
                                                        <small id="averagePerformersPercent">0%</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="border rounded p-2 bg-danger text-white">
                                                        <small><strong>Low Performers</strong></small>
                                                        <div id="lowPerformersCount" class="h5 mb-0">0</div>
                                                        <small id="lowPerformersPercent">0%</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Total Students -->
                                        <div class="text-center mt-3">
                                            <div class="border rounded p-2 bg-info text-white">
                                                <strong>Total Students: <span id="totalStudents">0</span></strong>
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

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(document).ready(function() {
    let studentDistributionChart;
    
    // Initialize chart
    function initializeChart() {
        // Student Performance Distribution Chart (Doughnut Chart)
        const chartCtx = document.getElementById('studentDistributionChart').getContext('2d');
        studentDistributionChart = new Chart(chartCtx, {
            type: 'doughnut',
            data: {
                labels: ['High Performers (80-100%)', 'Average Performers (50-79%)', 'Low Performers (0-49%)'],
                datasets: [{
                    data: [0, 0, 0], // Will be updated with real data
                    backgroundColor: [
                        '#28a745', // Green for high performers
                        '#ffc107', // Yellow for average performers
                        '#dc3545'  // Red for low performers
                    ],
                    borderColor: [
                        '#1e7e34',
                        '#e0a800',
                        '#c82333'
                    ],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: 11
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return `${label}: ${value} students (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '50%', // Makes it a doughnut chart
                animation: {
                    animateRotate: true,
                    animateScale: true
                }
            }
        });
    }

    // Static sample data for demonstration
    const staticData = {
        student_distribution: {
            high_performers: 18,    // Students with 80-100%
            average_performers: 32, // Students with 50-79%
            low_performers: 8       // Students with 0-49%
        },
        statistics: {
            highest: 96,
            lowest: 35,
            average: 74.5
        },
        top_rankers: [
            { name: 'Rajesh Kumar', percentage: 96 },
            { name: 'Priya Sharma', percentage: 94 },
            { name: 'Amit Singh', percentage: 91 },
            { name: 'Neha Gupta', percentage: 89 },
            { name: 'Rohit Verma', percentage: 87 }
        ]
    };

    // Function to update chart with data
    function updateChart(data = staticData) {
        if (data.student_distribution) {
            const highPerformers = data.student_distribution.high_performers || 0;
            const averagePerformers = data.student_distribution.average_performers || 0;
            const lowPerformers = data.student_distribution.low_performers || 0;
            const totalStudents = highPerformers + averagePerformers + lowPerformers;

            // Update chart data
            studentDistributionChart.data.datasets[0].data = [
                highPerformers,
                averagePerformers,
                lowPerformers
            ];
            studentDistributionChart.update();

            // Update summary statistics
            $('#highPerformersCount').text(highPerformers);
            $('#averagePerformersCount').text(averagePerformers);
            $('#lowPerformersCount').text(lowPerformers);
            $('#totalStudents').text(totalStudents);

            // Calculate and update percentages
            if (totalStudents > 0) {
                $('#highPerformersPercent').text(Math.round((highPerformers / totalStudents) * 100) + '%');
                $('#averagePerformersPercent').text(Math.round((averagePerformers / totalStudents) * 100) + '%');
                $('#lowPerformersPercent').text(Math.round((lowPerformers / totalStudents) * 100) + '%');
            }
        }

        // Update summary display
        if (data.statistics) {
            $('#highestMarks').text(data.statistics.highest || '--');
            $('#lowestMarks').text(data.statistics.lowest || '--');
            $('#averageMarks').text(Math.round(data.statistics.average || 0));
        }

        // Update top rankers
        if (data.top_rankers) {
            let topRankersHtml = '';
            data.top_rankers.forEach((student, index) => {
                topRankersHtml += `
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <small><strong>${index + 1}. ${student.name}</strong></small>
                        <span class="badge badge-success">${student.percentage}%</span>
                    </div>
                `;
            });
            $('#topRankers').html(topRankersHtml || '<small class="text-muted">No data available</small>');
        }
    }

    // DataTable initialization
    const table = $('#questionTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('questionData') }}", // Update to your test results data route
            data: function(d) {
                const formDataArray = [];
                $('#filterForm').find('input, select, textarea').each(function() {
                    const name = $(this).attr('name');
                    const value = $(this).val();
                    if (name && value !== null && value !== '' && value !== undefined) {
                        formDataArray.push({
                            name: name,
                            value: value
                        });
                    }
                });
                d.filterable_columns = formDataArray;
            },
            dataSrc: function(json) {
                // Update chart when data is received (or use static data if no real data)
                if (json && json.student_distribution) {
                    updateChart(json);
                } else {
                    // Keep using static data if backend doesn't provide the required data structure
                    console.log('Using static data for chart display');
                }
                return json.data || [];
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'student_name', name: 'student_name' },
            { data: 'roll_no', name: 'roll_no' },
            { data: 'class', name: 'class' },
            { data: 'test_name', name: 'test_name' },
            { data: 'marks_obtained', name: 'marks_obtained' },
            { data: 'total_marks', name: 'total_marks' },
            { data: 'percentage', name: 'percentage' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        drawCallback: function() {
            // Any additional callbacks after table draw
        }
    });

    // Initialize chart
    initializeChart();
    
    // Load static data immediately to show the chart
    updateChart();

    // Handle filter form submission
    $('#filterForm').on('click', function(e) {
        table.ajax.reload();
    });
});
</script>

<style>
.card {
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border-radius: 8px;
}

.card-header {
    border-bottom: 1px solid rgba(0,0,0,0.1);
    /* border-radius: 8px 8px 0 0 !important; */
}

#studentDistributionChart {
    max-height: 300px !important;
}

#topRankers {
    max-height: 150px;
    overflow-y: auto;
}

.badge {
    font-size: 10px;
}
.back_color{
    color: black;
    background-color: #f1f3f5;
}
.hav{
     color: black;
    background-color: #f1f3f5;
}

.border.rounded {
    border-radius: 6px !important;
}

.bg-success {
    background-color: #28a745 !important;
}

.bg-warning {
    background-color: #ffc107 !important;
}

.bg-danger {
    background-color: #dc3545 !important;
}

.bg-info {
    background-color: #17a2b8 !important;
}

.text-center small {
    font-size: 11px;
}

.h5 {
    font-size: 1.1rem;
    font-weight: bold;
}
</style>
@endsection