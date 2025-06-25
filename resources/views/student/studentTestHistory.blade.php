@extends('layout.app')
@section('content')

@php
$permissions = Helper::getPermissions();
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            {{-- ===== Test + Exam-wise Batch Comparison Section ===== --}}
            <div class="row mt-4">
                <div class="card card-outline card-orange col-12 p-0">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fa fa-chart-line mr-2"></i> Test & Exam-wise Batch Performance</h5>
                            <div class="btn-group ml-auto" role="group">
                                <button type="button" class="btn btn-sm btn-outline-light" id="tableViewBtn">
                                    <i class="fa fa-table"></i> Student Details
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-light" id="chartViewBtn">
                                    <i class="fa fa-chart-line"></i> Chart View
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label><strong>Select Batches</strong></label>
                                    <select multiple id="batchSelect" class="form-control">
                                        <option value="batch10A" selected>Class 10-A</option>
                                        <option value="batch10B" selected>Class 10-B</option>
                                        <option value="batch9A">Class 9-A</option>
                                    </select>
                                    <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple batches.</small>
                                </div>
                                <div class="col-md-6" id="examFilterDiv">
                                    <label><strong>Filter by Exam</strong></label>
                                    <select id="examFilter" class="form-control">
                                        <option value="all">All Exams</option>
                                        <option value="0">Weekly Test 1</option>
                                        <option value="1">Unit Test 1</option>
                                        <option value="2">Periodic Test 1</option>
                                        <option value="3">Half-Yearly</option>
                                        <option value="4">Weekly Test 2</option>
                                        <option value="5">Unit Test 2</option>
                                        <option value="6">Periodic Test 2</option>
                                        <option value="7">Final Exam</option>
                                    </select>
                                </div>
                            </div>
                            
                            {{-- Student Details Table View (Now Default) --}}
                            <div id="tableView">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                            </div>
                                            <input type="text" id="studentSearch" class="form-control" placeholder="Search by student name...">
                                        </div>
                                    </div>
                                </div>
                                <div id="studentDetailsContainer"></div>
                            </div>
                            
                            {{-- Chart View (Now Hidden by Default) --}}
                            <div id="chartView" style="display: none;">
                                <canvas id="performanceChart" height="120"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ===== End Section ===== --}}
        </div>
    </section>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('performanceChart').getContext('2d');

    const testExamLabels = [
        'Weekly Test 1', 
        'Unit Test 1', 
        'Periodic Test 1', 
        'Half-Yearly', 
        'Weekly Test 2', 
        'Unit Test 2', 
        'Periodic Test 2', 
        'Final Exam'
    ];

    const batchData = {
        batch10A: {
            label: 'Class 10-A',
            data: [72, 74, 78, 85, 77, 79, 82, 89],
            borderColor: '#007bff',
            backgroundColor: 'transparent',
            tension: 0.3
        },
        batch10B: {
            label: 'Class 10-B',
            data: [65, 67, 70, 75, 68, 70, 73, 78],
            borderColor: '#28a745',
            backgroundColor: 'transparent',
            tension: 0.3
        },
        batch9A: {
            label: 'Class 9-A',
            data: [58, 60, 65, 70, 62, 64, 67, 73],
            borderColor: '#ffc107',
            backgroundColor: 'transparent',
            tension: 0.3
        }
    };

    // Sample student data with individual scores
    const studentData = {
        batch10A: [
            {
                name: 'Aarav Sharma',
                rollNo: 'A001',
                scores: [75, 78, 82, 88, 80, 85, 87, 92],
                attendance: [true, true, true, true, true, true, true, true]
            },
            {
                name: 'Priya Patel',
                rollNo: 'A002',
                scores: [68, 70, 74, 82, 74, 73, 77, 86],
                attendance: [true, true, true, true, false, true, true, true]
            },
            {
                name: 'Rohan Gupta',
                rollNo: 'A003',
                scores: [72, 74, 78, 85, 77, 79, 82, 89],
                attendance: [true, true, true, true, true, true, true, true]
            },
            {
                name: 'Ananya Singh',
                rollNo: 'A004',
                scores: [79, 82, 85, 90, 83, 86, 88, 94],
                attendance: [true, true, true, true, true, true, true, true]
            },
            {
                name: 'Vikram Yadav',
                rollNo: 'A005',
                scores: [65, 68, 72, 78, 70, 72, 75, 82],
                attendance: [true, false, true, true, true, true, true, true]
            }
        ],
        batch10B: [
            {
                name: 'Sakshi Verma',
                rollNo: 'B001',
                scores: [70, 72, 75, 80, 73, 75, 78, 83],
                attendance: [true, true, true, true, true, true, true, true]
            },
            {
                name: 'Arjun Kumar',
                rollNo: 'B002',
                scores: [60, 62, 65, 70, 63, 65, 68, 73],
                attendance: [true, true, true, true, true, true, false, true]
            },
            {
                name: 'Neha Agarwal',
                rollNo: 'B003',
                scores: [65, 67, 70, 75, 68, 70, 73, 78],
                attendance: [true, true, true, true, true, true, true, true]
            },
            {
                name: 'Karan Mishra',
                rollNo: 'B004',
                scores: [62, 65, 68, 72, 66, 68, 71, 76],
                attendance: [true, true, true, false, true, true, true, true]
            }
        ],
        batch9A: [
            {
                name: 'Diya Jain',
                rollNo: 'C001',
                scores: [62, 65, 70, 75, 68, 70, 72, 78],
                attendance: [true, true, true, true, true, true, true, true]
            },
            {
                name: 'Arnav Thakur',
                rollNo: 'C002',
                scores: [54, 55, 60, 65, 56, 58, 62, 68],
                attendance: [true, true, false, true, true, true, true, true]
            },
            {
                name: 'Ishita Bansal',
                rollNo: 'C003',
                scores: [58, 60, 65, 70, 62, 64, 67, 73],
                attendance: [true, true, true, true, true, true, true, true]
            }
        ]
    };

    const chartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: testExamLabels,
            datasets: [batchData.batch10A, batchData.batch10B] // default visible
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                title: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });

    // Event listeners
    document.getElementById('batchSelect').addEventListener('change', function () {
        const selected = Array.from(this.selectedOptions).map(opt => opt.value);
        const datasets = selected.map(batch => batchData[batch]);
        chartInstance.data.datasets = datasets;
        chartInstance.update();
        
        // Update table view if it's visible
        if (document.getElementById('tableView').style.display !== 'none') {
            updateStudentTable();
        }
    });

    document.getElementById('tableViewBtn').addEventListener('click', function() {
        document.getElementById('tableView').style.display = 'block';
        document.getElementById('chartView').style.display = 'none';
        document.getElementById('examFilterDiv').style.display = 'block';
        this.classList.add('active');
        document.getElementById('chartViewBtn').classList.remove('active');
        updateStudentTable();
    });

    document.getElementById('chartViewBtn').addEventListener('click', function() {
        document.getElementById('chartView').style.display = 'block';
        document.getElementById('tableView').style.display = 'none';
        document.getElementById('examFilterDiv').style.display = 'none';
        this.classList.add('active');
        document.getElementById('tableViewBtn').classList.remove('active');
    });

    document.getElementById('examFilter').addEventListener('change', updateStudentTable);
    document.getElementById('studentSearch').addEventListener('input', updateStudentTable);

    function updateStudentTable() {
        const selectedBatches = Array.from(document.getElementById('batchSelect').selectedOptions).map(opt => opt.value);
        const examFilter = document.getElementById('examFilter').value;
        const searchTerm = document.getElementById('studentSearch').value.toLowerCase();
        const container = document.getElementById('studentDetailsContainer');
        
        let html = '';
        
        selectedBatches.forEach(batchKey => {
            const batchLabel = batchData[batchKey].label;
            const students = studentData[batchKey] || [];
            
            // Filter students by search term
            const filteredStudents = students.filter(student => 
                student.name.toLowerCase().includes(searchTerm) || 
                student.rollNo.toLowerCase().includes(searchTerm)
            );
            
            if (filteredStudents.length > 0) {
                html += `
                    <div class="mb-4">
                        <h6 class="text-primary mb-3"><i class="fa fa-users mr-2"></i>${batchLabel}</h6>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="min-width: 80px;">Roll No</th>
                                        <th style="min-width: 150px;">Student Name</th>
                                        ${examFilter === 'all' ? 
                                            testExamLabels.map(label => `<th class="text-center" style="min-width: 110px;">${label}</th>`).join('') :
                                            `<th class="text-center" style="min-width: 110px;">${testExamLabels[examFilter]}</th>`
                                        }
                                        <th class="text-center" style="min-width: 90px;">Average</th>
                                        <th class="text-center" style="min-width: 100px;">Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                `;
                
                filteredStudents.forEach(student => {
                    const average = (student.scores.reduce((a, b) => a + b, 0) / student.scores.length).toFixed(1);
                    const attendancePercentage = ((student.attendance.filter(a => a).length / student.attendance.length) * 100).toFixed(0);
                    
                    html += `
                        <tr>
                            <td><strong>${student.rollNo}</strong></td>
                            <td>${student.name}</td>
                    `;
                    
                    if (examFilter === 'all') {
                        student.scores.forEach((score, index) => {
                            const attendanceIcon = student.attendance[index] ? 
                                '<i class="fa fa-check text-success"></i>' : 
                                '<i class="fa fa-times text-danger"></i>';
                            html += `<td class="text-center">${student.attendance[index] ? score : 'AB'} ${attendanceIcon}</td>`;
                        });
                    } else {
                        const examIndex = parseInt(examFilter);
                        const score = student.scores[examIndex];
                        const attendanceIcon = student.attendance[examIndex] ? 
                            '<i class="fa fa-check text-success"></i>' : 
                            '<i class="fa fa-times text-danger"></i>';
                        html += `<td class="text-center">${student.attendance[examIndex] ? score : 'AB'} ${attendanceIcon}</td>`;
                    }
                    
                    html += `
                            <td class="text-center"><span class="badge badge-${average >= 75 ? 'success' : average >= 60 ? 'warning' : 'danger'}">${average}%</span></td>
                            <td class="text-center"><span class="badge badge-${attendancePercentage >= 80 ? 'success' : attendancePercentage >= 60 ? 'warning' : 'danger'}">${attendancePercentage}%</span></td>
                        </tr>
                    `;
                });
                
                html += `
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
            }
        });
        
        if (html === '') {
            html = '<div class="alert alert-info"><i class="fa fa-info-circle mr-2"></i>No students found matching your criteria.</div>';
        }
        
        container.innerHTML = html;
    }

    // Initialize with table view (Student Details) as default
    document.getElementById('tableViewBtn').classList.add('active');
    // Initialize the table on page load
    updateStudentTable();
</script>

<style>
    #batchSelect {
        height: 110px;
    }

    .card-header h5 {
        font-size: 1rem;
    }

    .card {
        border-radius: 10px;
    }

    canvas {
        background: #fff;
        border-radius: 10px;
    }

    .btn-group .btn.active {
        background-color: #fff;
        color: #343a40;
        border-color: #fff;
    }

    .table th {
        font-size: 0.875rem;
        font-weight: 600;
    }

    .table td {
        font-size: 0.875rem;
        vertical-align: middle;
    }

    .badge {
        font-size: 0.75rem;
    }

    .fa-check {
        font-size: 0.75rem;
    }

    .fa-times {
        font-size: 0.75rem;
    }

    .alert {
        border-radius: 8px;
    }

    .table-responsive {
        border-radius: 8px;
        overflow-x: auto;
        overflow-y: visible;
        min-height: 200px;
    }
    
    .table {
        min-width: 1200px; /* Ensure consistent minimum width */
        white-space: nowrap;
    }

    .input-group {
        max-width: 300px;
    }

    .text-primary {
        color: #007bff !important;
        font-weight: 600;
    }

    .thead-dark th {
        background-color: #343a40;
        border-color: #454d55;
    }
</style>

@endsection