@extends('layout.app')

@section('content')

@php
$permissions = Helper::getPermissions();

// Static Data
$totalDoubts = 1247;
$resolvedDoubts = 1089;
$pendingDoubts = 158;
$avgResolutionTime = '2.5h';
$resolutionRate = 87;
$satisfactionRate = 94;
$peakHour = '2:00 PM';
$criticalDoubts = 23;

// Top Topics Static Data
$topTopics = [
    (object)['topic_name' => 'Quadratic Equations', 'subject_name' => 'Mathematics', 'doubt_count' => 156, 'trend' => 1],
    (object)['topic_name' => 'Organic Chemistry', 'subject_name' => 'Chemistry', 'doubt_count' => 134, 'trend' => 1],
    (object)['topic_name' => 'Newton\'s Laws', 'subject_name' => 'Physics', 'doubt_count' => 98, 'trend' => -1],
    (object)['topic_name' => 'Cell Biology', 'subject_name' => 'Biology', 'doubt_count' => 87, 'trend' => 0],
    (object)['topic_name' => 'Trigonometry', 'subject_name' => 'Mathematics', 'doubt_count' => 76, 'trend' => 1]
];

// Faculty Stats Static Data
$facultyStats = [
    (object)['name' => 'Dr. Rajesh Kumar', 'resolved_count' => 234, 'avg_resolution_time' => '1.8h', 'rating' => 5, 'performance' => 95],
    (object)['name' => 'Prof. Priya Sharma', 'resolved_count' => 198, 'avg_resolution_time' => '2.1h', 'rating' => 4, 'performance' => 89],
    (object)['name' => 'Dr. Amit Singh', 'resolved_count' => 176, 'avg_resolution_time' => '2.4h', 'rating' => 4, 'performance' => 82],
    (object)['name' => 'Ms. Neha Gupta', 'resolved_count' => 145, 'avg_resolution_time' => '2.8h', 'rating' => 4, 'performance' => 78],
    (object)['name' => 'Prof. Vikram Joshi', 'resolved_count' => 132, 'avg_resolution_time' => '3.2h', 'rating' => 3, 'performance' => 71]
];

// Chart Data
$chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
$doubtsData = [89, 156, 134, 178, 145, 167];
$resolvedData = [76, 142, 118, 156, 132, 145];
$statusData = [87, 13, 8];
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            
            {{-- Header Section --}}
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Feedback Analytics</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Feedback Analytics</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-white shadow-sm">
                        <div class="inner">
                            <h3 class="text-primary">{{ number_format($totalDoubts) }}</h3>
                            <p class="text-muted mb-0">Total Doubts</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-question-circle text-primary"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-white shadow-sm">
                        <div class="inner">
                            <h3 class="text-success">{{ number_format($resolvedDoubts) }}</h3>
                            <p class="text-muted mb-0">Resolved</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-white shadow-sm">
                        <div class="inner">
                            <h3 class="text-warning">{{ $avgResolutionTime }}</h3>
                            <p class="text-muted mb-0">Avg Resolution Time</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock text-warning"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-white shadow-sm">
                        <div class="inner">
                            <h3 class="text-danger">{{ number_format($pendingDoubts) }}</h3>
                            <p class="text-muted mb-0">Pending</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hourglass-half text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Charts Section --}}
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header  border-0">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-1"></i>
                                Doubts Trend
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="position: relative; height: 300px;">
                                <canvas id="doubtsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Status Overview
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="position: relative; height: 200px;">
                                <canvas id="statusChart"></canvas>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted"><i class="fas fa-circle text-success mr-2"></i>Resolved</span>
                                    <span class="font-weight-bold">{{ $statusData[0] }}%</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted"><i class="fas fa-circle text-danger mr-2"></i>Pending</span>
                                    <span class="font-weight-bold">{{ $statusData[1] }}%</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted"><i class="fas fa-circle text-warning mr-2"></i>In Progress</span>
                                    <span class="font-weight-bold">{{ $statusData[2] }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Data Tables Section --}}
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-trophy mr-1"></i>
                                Top Topics
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id='dataContainer' class="table table-bordered table-striped m-0">
                                    <thead>
                                        <tr class="bg-light">
                                            <th style="width: 10px">#</th>
                                            <th>Topic</th>
                                            <th>Subject</th>
                                            <th style="width: 80px">Count</th>
                                            <th style="width: 40px">Trend</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topTopics as $index => $topic)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="font-weight-bold">{{ $topic->topic_name }}</td>
                                            <td><span class="badge badge-light">{{ $topic->subject_name }}</span></td>
                                            <td><span class="badge badge-primary">{{ $topic->doubt_count }}</span></td>
                                            <td class="text-center">
                                                @if($topic->trend > 0)
                                                    <i class="fas fa-arrow-up text-success"></i>
                                                @elseif($topic->trend < 0)
                                                    <i class="fas fa-arrow-down text-danger"></i>
                                                @else
                                                    <i class="fas fa-minus text-muted"></i>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-users mr-1"></i>
                                Faculty Performance
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id='dataContainer' class="table table-bordered table-striped m-0">
                                    <thead>
                                        <tr class="bg-light">
                                            <th>Faculty</th>
                                            <th style="width: 80px">Resolved</th>
                                            <th style="width: 80px">Avg Time</th>
                                            <th style="width: 100px">Performance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($facultyStats as $faculty)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle mr-2">
                                                        {{ substr($faculty->name, 0, 2) }}
                                                    </div>
                                                    <span class="font-weight-medium">{{ $faculty->name }}</span>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-success">{{ $faculty->resolved_count }}</span></td>
                                            <td><span class="text-muted">{{ $faculty->avg_resolution_time }}</span></td>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar 
                                                        @if($faculty->performance >= 90) bg-success
                                                        @elseif($faculty->performance >= 80) bg-primary
                                                        @elseif($faculty->performance >= 70) bg-warning
                                                        @else bg-danger
                                                        @endif" 
                                                        style="width: {{ $faculty->performance }}%">
                                                    </div>
                                                </div>
                                                <small class="text-muted">{{ $faculty->performance }}%</small>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Key Metrics Section --}}
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-chart-bar mr-1"></i>
                                Key Metrics
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-primary"><i class="fas fa-percentage"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Resolution Rate</span>
                                            <span class="info-box-number">{{ $resolutionRate }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-success"><i class="fas fa-thumbs-up"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Satisfaction</span>
                                            <span class="info-box-number">{{ $satisfactionRate }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Peak Hour</span>
                                            <span class="info-box-number">{{ $peakHour }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Critical</span>
                                            <span class="info-box-number">{{ $criticalDoubts }}</span>
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

{{-- Chart.js Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Doubts Trend Chart
    const doubtsCtx = document.getElementById('doubtsChart').getContext('2d');
    const doubtsChart = new Chart(doubtsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Doubts Received',
                data: {!! json_encode($doubtsData) !!},
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#007bff',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }, {
                label: 'Doubts Resolved',
                data: {!! json_encode($resolvedData) !!},
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#28a745',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        color: '#6c757d'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        color: '#6c757d'
                    }
                }
            }
        }
    });

    // Status Pie Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Resolved', 'Pending', 'In Progress'],
            datasets: [{
                data: {!! json_encode($statusData) !!},
                backgroundColor: [
                    '#28a745',
                    '#dc3545',
                    '#ffc107'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>

<style>
/* Clean, minimal styling */
.content-wrapper {
    background-color: #f8f9fa;
}

.small-box {
    border-radius: 8px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.small-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}

.small-box .inner {
    padding: 20px;
    line-height: 1;
}

.small-box .inner h3 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.small-box .icon {
    /* position: absolute; */
    top: 20px;
    right: 20px;
}

.small-box .icon i {
    font-size: 2rem;
    opacity: 0.7;
}

.card {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.04);
}

.card-header {
    background-color: #fff;
    border-bottom: 1px solid #e9ecef;
    padding: 0.5rem 1.25rem;
}

.card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #495057;
    margin: 0;
}

.chart-container {
    position: relative;
    overflow: hidden;
}

.chart-container canvas {
    max-height: 100% !important;
    max-width: 100% !important;
}

.table {
    font-size: 0.9rem;
}

.table th {
    border-top: none;
    font-weight: 600;
    /* color: #495057;
    background-color: #f8f9fa; */
    border-bottom: 1px solid #dee2e6;
}

.table td {
    vertical-align: middle;
    border-top: 1px solid #f1f3f4;
}

.badge {
    font-size: 0.75rem;
    font-weight: 500;
}

.badge-light {
    background-color: #f8f9fa;
    color: #6c757d;
    border: 1px solid #e9ecef;
}

.avatar-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #007bff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.progress-sm {
    height: 0.5rem;
}

.info-box {
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.info-box-icon {
    border-radius: 8px 0 0 8px;
}

.breadcrumb {
    background-color: transparent;
    padding: 0;
    margin: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: #6c757d;
}

.content-header h1 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #495057;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .small-box .inner h3 {
        font-size: 1.5rem;
    }
    
    .chart-container {
        height: 250px !important;
    }
    
    .card-body {
        padding: 1rem;
    }
}
</style>

@endsection