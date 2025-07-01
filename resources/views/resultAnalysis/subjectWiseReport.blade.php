@extends('layout.app')
@section('content')

@php
$permissions = Helper::getPermissions();

// Sample data - replace with actual data from your controller
$subjects = [
    ['id' => 1, 'name' => 'Physics', 'total_questions' => 150, 'avg_score' => 72.5, 'color' => '#FF6B6B'],
    ['id' => 2, 'name' => 'Chemistry', 'total_questions' => 140, 'avg_score' => 68.3, 'color' => '#4ECDC4'],
    ['id' => 3, 'name' => 'Mathematics', 'total_questions' => 200, 'avg_score' => 75.8, 'color' => '#45B7D1']
];

$chapterData = [
    'Physics' => [
        ['name' => 'Mechanics', 'avg_score' => 78.5, 'total_attempts' => 45, 'difficulty' => 'Medium'],
        ['name' => 'Thermodynamics', 'avg_score' => 65.2, 'total_attempts' => 38, 'difficulty' => 'Hard'],
        ['name' => 'Optics', 'avg_score' => 82.1, 'total_attempts' => 42, 'difficulty' => 'Easy'],
        ['name' => 'Electromagnetism', 'avg_score' => 58.7, 'total_attempts' => 35, 'difficulty' => 'Hard'],
        ['name' => 'Modern Physics', 'avg_score' => 71.3, 'total_attempts' => 40, 'difficulty' => 'Medium']
    ],
    'Chemistry' => [
        ['name' => 'Organic Chemistry', 'avg_score' => 64.8, 'total_attempts' => 50, 'difficulty' => 'Hard'],
        ['name' => 'Inorganic Chemistry', 'avg_score' => 72.5, 'total_attempts' => 47, 'difficulty' => 'Medium'],
        ['name' => 'Physical Chemistry', 'avg_score' => 59.2, 'total_attempts' => 43, 'difficulty' => 'Hard'],
        ['name' => 'Environmental Chemistry', 'avg_score' => 79.6, 'total_attempts' => 35, 'difficulty' => 'Easy'],
        ['name' => 'Analytical Chemistry', 'avg_score' => 68.9, 'total_attempts' => 38, 'difficulty' => 'Medium']
    ],
    'Mathematics' => [
        ['name' => 'Algebra', 'avg_score' => 81.2, 'total_attempts' => 55, 'difficulty' => 'Easy'],
        ['name' => 'Calculus', 'avg_score' => 69.4, 'total_attempts' => 48, 'difficulty' => 'Hard'],
        ['name' => 'Geometry', 'avg_score' => 75.8, 'total_attempts' => 52, 'difficulty' => 'Medium'],
        ['name' => 'Statistics', 'avg_score' => 73.6, 'total_attempts' => 45, 'difficulty' => 'Medium'],
        ['name' => 'Trigonometry', 'avg_score' => 78.0, 'total_attempts' => 50, 'difficulty' => 'Easy']
    ]
];

// Topics needing revision (score < 65%)
$revisionTopics = [];
foreach($chapterData as $subject => $chapters) {
    foreach($chapters as $chapter) {
        if($chapter['avg_score'] < 65) {
            $revisionTopics[] = [
                'subject' => $subject,
                'chapter' => $chapter['name'],
                'score' => $chapter['avg_score'],
                'priority' => $chapter['avg_score'] < 55 ? 'High' : 'Medium'
            ];
        }
    }
}
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            {{-- Breadcrumb --}}
            <div class="row">
                <div class="col-md-12 col-12 p-0">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Analytics</li>
                        <li class="breadcrumb-item">Subject Wise Report</li>
                    </ul>
                </div>
            </div>

            {{-- Header Section --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header" style="background-color: #002C54 !important; color: white;" >
                            <div class="card-title">
                                <h4><i class="fa fa-chart-line"></i> &nbsp;Subject Wise Performance Analysis</h4>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm" onclick="exportReport()">
                                    <i class="fa fa-download"></i> Export Report
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" onclick="printReport()">
                                    <i class="fa fa-print"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="row">
                @foreach($subjects as $subject)
                <div class="col-lg-4 col-md-6">
                    <div class="card bg-gradient-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="text-white">{{ $subject['name'] }}</h3>
                                    <p class="text-light mb-0">{{ $subject['total_questions'] }} Questions</p>
                                    <h4 class="text-white font-weight-bold">{{ number_format($subject['avg_score'], 1) }}%</h4>
                                </div>
                                <div class="text-right">
                                    <i class="fa fa-book fa-3x text-white-50"></i>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height: 5px;">
                                <div class="progress-bar bg-light" style="width: {{ $subject['avg_score'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Charts Section --}}
            <div class="row">
                {{-- Subject Comparison Bar Chart --}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fa fa-bar-chart"></i> Subject Performance Comparison</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="subjectBarChart" height="300"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Overall Performance Pie Chart --}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fa fa-pie-chart"></i> Question Distribution</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="distributionChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chapter-wise Heatmap --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fa fa-fire"></i> Chapter-wise Performance Heatmap</h5>
                            <div class="card-tools">
                                <select id="subjectFilter" class="form-control form-control-sm" style="width: 200px;">
                                    <option value="all">All Subjects</option>
                                    <option value="Physics">Physics</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Mathematics">Mathematics</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="heatmapContainer">
                                @foreach($chapterData as $subject => $chapters)
                                <div class="subject-heatmap" data-subject="{{ $subject }}">
                                    <h6 class="text-center font-weight-bold mb-3">{{ $subject }}</h6>
                                    <div class="row">
                                        @foreach($chapters as $chapter)
                                        @php
                                            $scoreClass = '';
                                            if($chapter['avg_score'] >= 80) $scoreClass = 'bg-success';
                                            elseif($chapter['avg_score'] >= 70) $scoreClass = 'bg-warning';
                                            elseif($chapter['avg_score'] >= 60) $scoreClass = 'bg-info';
                                            else $scoreClass = 'bg-danger';
                                        @endphp
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                            <div class="heatmap-cell {{ $scoreClass }} text-white text-center p-3 rounded" 
                                                 data-toggle="tooltip" 
                                                 title="Chapter: {{ $chapter['name'] }}<br>Score: {{ $chapter['avg_score'] }}%<br>Attempts: {{ $chapter['total_attempts'] }}<br>Difficulty: {{ $chapter['difficulty'] }}">
                                                <div class="font-weight-bold">{{ substr($chapter['name'], 0, 8) }}{{ strlen($chapter['name']) > 8 ? '...' : '' }}</div>
                                                <div class="h4 mb-0">{{ number_format($chapter['avg_score'], 1) }}%</div>
                                                <small>{{ $chapter['total_attempts'] }} attempts</small>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            {{-- Heatmap Legend --}}
                            <div class="mt-4">
                                <h6>Performance Scale:</h6>
                                <div class="d-flex align-items-center">
                                    <div class="bg-danger text-white px-3 py-1 rounded mr-2">0-59% (Needs Attention)</div>
                                    <div class="bg-info text-white px-3 py-1 rounded mr-2">60-69% (Below Average)</div>
                                    <div class="bg-warning text-white px-3 py-1 rounded mr-2">70-79% (Good)</div>
                                    <div class="bg-success text-white px-3 py-1 rounded">80-100% (Excellent)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Revision Recommendations --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h5 class="card-title text-white"><i class="fa fa-exclamation-triangle"></i> Topics Requiring More Revision</h5>
                        </div>
                        <div class="card-body">
                            @if(count($revisionTopics) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Priority</th>
                                            <th>Subject</th>
                                            <th>Chapter</th>
                                            <th>Current Score</th>
                                            <th>Target Score</th>
                                            <th>Improvement Needed</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($revisionTopics as $topic)
                                        <tr>
                                            <td>
                                                <span class="badge badge-{{ $topic['priority'] == 'High' ? 'danger' : 'warning' }}">
                                                    {{ $topic['priority'] }}
                                                </span>
                                            </td>
                                            <td>{{ $topic['subject'] }}</td>
                                            <td>{{ $topic['chapter'] }}</td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar bg-{{ $topic['score'] < 55 ? 'danger' : 'warning' }}" 
                                                         style="width: {{ $topic['score'] }}%">
                                                        {{ number_format($topic['score'], 1) }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="text-success font-weight-bold">75%</span></td>
                                            <td><span class="text-primary">+{{ number_format(75 - $topic['score'], 1) }}%</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" onclick="generateStudyPlan('{{ $topic['subject'] }}', '{{ $topic['chapter'] }}')">
                                                    <i class="fa fa-book"></i> Study Plan
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="alert alert-success">
                                <i class="fa fa-check-circle"></i> Great job! All topics are performing well. Keep up the good work!
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detailed Chapter Analysis --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fa fa-analytics"></i> Detailed Chapter Analysis</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($chapterData as $subject => $chapters)
                                <div class="col-lg-4 mb-4">
                                    <div class="card border-left-primary">
                                        <div class="card-header bg-primary text-white">
                                            <h6 class="mb-0">{{ $subject }}</h6>
                                        </div>
                                        <div class="card-body p-0">
                                            <canvas id="chart{{ $subject }}" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

{{-- Include Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip({
        html: true
    });

    // Subject filter functionality
    $('#subjectFilter').on('change', function() {
        const selectedSubject = $(this).val();
        $('.subject-heatmap').hide();
        
        if (selectedSubject === 'all') {
            $('.subject-heatmap').show();
        } else {
            $(`.subject-heatmap[data-subject="${selectedSubject}"]`).show();
        }
    });

    // Initialize Charts
    initializeCharts();
});

function initializeCharts() {
    // Subject Bar Chart
    const subjectCtx = document.getElementById('subjectBarChart').getContext('2d');
    new Chart(subjectCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($subjects, 'name')) !!},
            datasets: [{
                label: 'Average Score (%)',
                data: {!! json_encode(array_column($subjects, 'avg_score')) !!},
                backgroundColor: ['#FF6B6B', '#4ECDC4', '#45B7D1'],
                borderColor: ['#FF5252', '#26A69A', '#2196F3'],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            }
        }
    });

    // Distribution Pie Chart
    const distributionCtx = document.getElementById('distributionChart').getContext('2d');
    new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_column($subjects, 'name')) !!},
            datasets: [{
                data: {!! json_encode(array_column($subjects, 'total_questions')) !!},
                backgroundColor: ['#FF6B6B', '#4ECDC4', '#45B7D1'],
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Individual Subject Charts
    @foreach($chapterData as $subject => $chapters)
    const {{ strtolower($subject) }}Ctx = document.getElementById('chart{{ $subject }}').getContext('2d');
    new Chart({{ strtolower($subject) }}Ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($chapters, 'name')) !!},
            datasets: [{
                label: 'Performance',
                data: {!! json_encode(array_column($chapters, 'avg_score')) !!},
                borderColor: '{{ $subjects[array_search($subject, array_column($subjects, 'name'))]['color'] ?? '#007bff' }}',
                backgroundColor: '{{ $subjects[array_search($subject, array_column($subjects, 'name'))]['color'] ?? '#007bff' }}20',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
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
    @endforeach
}

function generateStudyPlan(subject, chapter) {
    // This would typically open a modal or redirect to a study plan page
    alert(`Generating study plan for ${subject} - ${chapter}`);
    // Implementation would depend on your specific requirements
}

function exportReport() {
    // Implementation for exporting report as PDF/Excel
    window.print();
}

function printReport() {
    window.print();
}

// Custom CSS for heatmap cells
const style = document.createElement('style');
style.textContent = `
    .heatmap-cell {
        transition: all 0.3s ease;
        cursor: pointer;
        min-height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .heatmap-cell:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .card-header.bg-primary {
        background: linear-gradient(45deg, #007bff, #0056b3) !important;
    }
    
    .card-header.bg-warning {
        background: linear-gradient(45deg, #ffc107, #e0a800) !important;
    }
    
    .bg-gradient-info {
        background: linear-gradient(45deg, #17a2b8, #138496) !important;
    }
    
    @media print {
        .no-print {
            display: none !important;
        }
        .card {
            break-inside: avoid;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection