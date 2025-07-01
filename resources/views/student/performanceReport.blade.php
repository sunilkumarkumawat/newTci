@extends('layout.app')
@section('content')

@php
$permissions = Helper::getPermissions();
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="card card-outline card-orange col-12 p-0">
                    
                        <div class="card-header bg-primary">
                            <h3 class="card-title">
                                <i class="fas fa-chart-bar mr-2"></i>
                                Student Performance Analytics Dashboard
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm" id="refreshData">
                                    <i class="fas fa-sync-alt"></i> Refresh Data
                                </button>
                            </div>
                        </div>
                    
                </div>
            </div>

            <!-- Filter Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="filterForm" class="row">
                                <div class="col-md-3">
                                    <label for="batch_filter">Select Batch</label>
                                    <select class="form-control" id="batch_filter" name="batch_id">
                                        <option value="">All Batches</option>
                                        <option value="1">Batch A - Morning</option>
                                        <option value="2">Batch B - Afternoon</option>
                                        <option value="3">Batch C - Evening</option>
                                        <option value="4">Batch D - Weekend</option>
                                        <option value="5">Batch E - Online</option>
                                        <option value="6">Batch F - Hybrid</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="test_filter">Select Test</label>
                                    <select class="form-control" id="test_filter" name="test_id">
                                        <option value="">All Tests</option>
                                        <option value="1">Mathematics Test 1</option>
                                        <option value="2">Science Quiz</option>
                                        <option value="3">English Literature</option>
                                        <option value="4">History Assessment</option>
                                        <option value="5">Physics Lab Test</option>
                                        <option value="6">Chemistry Practical</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="date_range">Date Range</label>
                                    <input type="text" class="form-control" id="date_range" name="date_range" 
                                           placeholder="Select date range">
                                </div>
                                <div class="col-md-3">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-info btn-block">
                                        <i class="fas fa-filter"></i> Apply Filters
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="totalStudents">156</h3>
                            <p>Total Students</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="totalTests">24</h3>
                            <p>Total Tests</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="averageScore">76.8%</h3>
                            <p>Average Score</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-percentage"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="totalBatches">6</h3>
                            <p>Total Batches</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Batch-wise Analytics -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-2"></i>
                                Batch-wise Performance Analysis
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="batchPerformanceChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-2"></i>
                                Batch Distribution
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="batchDistributionChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Test-wise Analytics -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-bar mr-2"></i>
                                Test-wise Average Scores
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="testScoresChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-area mr-2"></i>
                                Test Difficulty Analysis
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="testDifficultyChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Performance Table -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-table mr-2"></i>
                                Individual Student Performance
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-success btn-sm" id="exportExcel">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" id="exportPDF">
                                    <i class="fas fa-file-pdf"></i> Export PDF
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="studentPerformanceTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Batch</th>
                                            <th>Total Tests</th>
                                            <th>Average Score</th>
                                            <th>Highest Score</th>
                                            <th>Lowest Score</th>
                                            <th>Progress Trend</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong>John Smith</strong>
                                                <br><small class="text-muted">john.smith@email.com</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">Batch A - Morning</span>
                                            </td>
                                            <td>18</td>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" style="width: 92%"></div>
                                                </div>
                                                <small>92.0%</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">98.5%</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-warning">78.0%</span>
                                            </td>
                                            <td>
                                                <i class="fas fa-arrow-up text-success"></i> Improving
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" onclick="viewStudentDetails(1)">
                                                    <i class="fas fa-eye"></i> View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Emma Johnson</strong>
                                                <br><small class="text-muted">emma.johnson@email.com</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">Batch B - Afternoon</span>
                                            </td>
                                            <td>20</td>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" style="width: 88%"></div>
                                                </div>
                                                <small>88.5%</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">95.0%</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-warning">72.0%</span>
                                            </td>
                                            <td>
                                                <i class="fas fa-arrow-up text-success"></i> Improving
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" onclick="viewStudentDetails(2)">
                                                    <i class="fas fa-eye"></i> View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Michael Brown</strong>
                                                <br><small class="text-muted">michael.brown@email.com</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">Batch C - Evening</span>
                                            </td>
                                            <td>16</td>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-warning" style="width: 75%"></div>
                                                </div>
                                                <small>75.2%</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">89.0%</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-warning">58.0%</span>
                                            </td>
                                            <td>
                                                <i class="fas fa-minus text-warning"></i> Stable
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" onclick="viewStudentDetails(3)">
                                                    <i class="fas fa-eye"></i> View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Sarah Davis</strong>
                                                <br><small class="text-muted">sarah.davis@email.com</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">Batch D - Weekend</span>
                                            </td>
                                            <td>22</td>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" style="width: 94%"></div>
                                                </div>
                                                <small>94.3%</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">99.0%</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-warning">85.0%</span>
                                            </td>
                                            <td>
                                                <i class="fas fa-arrow-up text-success"></i> Improving
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" onclick="viewStudentDetails(4)">
                                                    <i class="fas fa-eye"></i> View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>David Wilson</strong>
                                                <br><small class="text-muted">david.wilson@email.com</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">Batch E - Online</span>
                                            </td>
                                            <td>14</td>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-danger" style="width: 52%"></div>
                                                </div>
                                                <small>52.1%</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">68.0%</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">34.0%</span>
                                            </td>
                                            <td>
                                                <i class="fas fa-arrow-down text-danger"></i> Declining
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" onclick="viewStudentDetails(5)">
                                                    <i class="fas fa-eye"></i> View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Lisa Miller</strong>
                                                <br><small class="text-muted">lisa.miller@email.com</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">Batch F - Hybrid</span>
                                            </td>
                                            <td>19</td>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" style="width: 86%"></div>
                                                </div>
                                                <small>86.7%</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">93.5%</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-warning">74.0%</span>
                                            </td>
                                            <td>
                                                <i class="fas fa-arrow-up text-success"></i> Improving
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" onclick="viewStudentDetails(6)">
                                                    <i class="fas fa-eye"></i> View Details
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Advanced Analytics -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-donut mr-2"></i>
                                Grade Distribution
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="gradeDistributionChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-2"></i>
                                Performance Trend Over Time
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="performanceTrendChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Performers -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-trophy mr-2"></i>
                                Top Performers
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge badge-warning mr-2">1</span>
                                        <strong>Sarah Davis</strong>
                                        <br><small class="text-muted">Batch D - Weekend</small>
                                    </div>
                                    <span class="badge badge-success badge-pill">94.3%</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge badge-secondary mr-2">2</span>
                                        <strong>John Smith</strong>
                                        <br><small class="text-muted">Batch A - Morning</small>
                                    </div>
                                    <span class="badge badge-success badge-pill">92.0%</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge badge-info mr-2">3</span>
                                        <strong>Emma Johnson</strong>
                                        <br><small class="text-muted">Batch B - Afternoon</small>
                                    </div>
                                    <span class="badge badge-success badge-pill">88.5%</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge badge-info mr-2">4</span>
                                        <strong>Lisa Miller</strong>
                                        <br><small class="text-muted">Batch F - Hybrid</small>
                                    </div>
                                    <span class="badge badge-success badge-pill">86.7%</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge badge-info mr-2">5</span>
                                        <strong>Michael Brown</strong>
                                        <br><small class="text-muted">Batch C - Evening</small>
                                    </div>
                                    <span class="badge badge-success badge-pill">75.2%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Students Needing Attention
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>David Wilson</strong>
                                        <br><small class="text-muted">Batch E - Online</small>
                                        <br><small class="text-warning">Declining performance trend</small>
                                    </div>
                                    <span class="badge badge-danger badge-pill">52.1%</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Alex Thompson</strong>
                                        <br><small class="text-muted">Batch C - Evening</small>
                                        <br><small class="text-warning">Multiple low scores</small>
                                    </div>
                                    <span class="badge badge-danger badge-pill">58.7%</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Jennifer Lee</strong>
                                        <br><small class="text-muted">Batch B - Afternoon</small>
                                        <br><small class="text-warning">Inconsistent attendance</small>
                                    </div>
                                    <span class="badge badge-danger badge-pill">59.3%</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Jennifer Lee</strong>
                                        <br><small class="text-muted">Batch B - Afternoon</small>
                                        <br><small class="text-warning">Inconsistent attendance</small>
                                    </div>
                                    <span class="badge badge-danger badge-pill">59.3%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Details Modal -->
        <div class="modal fade" id="studentDetailsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Student Performance Details</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="studentDetailsContent">
                        <!-- Content will be loaded dynamically -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/date-fns@2.29.3/index.min.js"></script>
<script>
    // Student Performance Analytics Dashboard Script
// Static data for demonstration

// Sample static data
const studentData = {
    students: [
        {
            id: 1,
            name: "John Smith",
            email: "john.smith@email.com",
            batch: "Batch A - Morning",
            batchId: 1,
            totalTests: 18,
            averageScore: 92.0,
            highestScore: 98.5,
            lowestScore: 78.0,
            trend: "improving",
            scores: [78, 82, 85, 88, 90, 92, 94, 96, 98.5, 95, 93, 91, 89, 87, 92, 94, 96, 98]
        },
        {
            id: 2,
            name: "Emma Johnson",
            email: "emma.johnson@email.com",
            batch: "Batch B - Afternoon",
            batchId: 2,
            totalTests: 20,
            averageScore: 88.5,
            highestScore: 95.0,
            lowestScore: 72.0,
            trend: "improving",
            scores: [72, 75, 78, 80, 82, 85, 87, 88, 90, 92, 93, 95, 91, 89, 86, 88, 90, 92, 94, 93]
        },
        {
            id: 3,
            name: "Michael Brown",
            email: "michael.brown@email.com",
            batch: "Batch C - Evening",
            batchId: 3,
            totalTests: 16,
            averageScore: 75.2,
            highestScore: 89.0,
            lowestScore: 58.0,
            trend: "stable",
            scores: [65, 68, 70, 72, 75, 78, 80, 82, 85, 89, 86, 83, 80, 75, 70, 58]
        },
        {
            id: 4,
            name: "Sarah Davis",
            email: "sarah.davis@email.com",
            batch: "Batch D - Weekend",
            batchId: 4,
            totalTests: 22,
            averageScore: 94.3,
            highestScore: 99.0,
            lowestScore: 85.0,
            trend: "improving",
            scores: [85, 87, 89, 91, 93, 95, 97, 99, 98, 96, 94, 92, 90, 88, 91, 93, 95, 97, 98, 96, 94, 92]
        },
        {
            id: 5,
            name: "David Wilson",
            email: "david.wilson@email.com",
            batch: "Batch E - Online",
            batchId: 5,
            totalTests: 14,
            averageScore: 52.1,
            highestScore: 68.0,
            lowestScore: 34.0,
            trend: "declining",
            scores: [68, 65, 62, 58, 55, 52, 48, 45, 42, 38, 35, 34, 40, 45]
        },
        {
            id: 6,
            name: "Lisa Miller",
            email: "lisa.miller@email.com",
            batch: "Batch F - Hybrid",
            batchId: 6,
            totalTests: 19,
            averageScore: 86.7,
            highestScore: 93.5,
            lowestScore: 74.0,
            trend: "improving",
            scores: [74, 76, 78, 80, 82, 84, 86, 88, 90, 92, 93.5, 91, 89, 87, 85, 83, 86, 88, 90]
        }
    ],
    
    batches: [
        { id: 1, name: "Batch A - Morning", students: 28, avgScore: 82.5 },
        { id: 2, name: "Batch B - Afternoon", students: 32, avgScore: 79.3 },
        { id: 3, name: "Batch C - Evening", students: 25, avgScore: 76.8 },
        { id: 4, name: "Batch D - Weekend", students: 22, avgScore: 88.2 },
        { id: 5, name: "Batch E - Online", students: 35, avgScore: 71.4 },
        { id: 6, name: "Batch F - Hybrid", students: 24, avgScore: 84.1 }
    ],
    
    tests: [
        { id: 1, name: "Mathematics Test 1", avgScore: 78.5, difficulty: "Medium" },
        { id: 2, name: "Science Quiz", avgScore: 82.3, difficulty: "Easy" },
        { id: 3, name: "English Literature", avgScore: 75.8, difficulty: "Hard" },
        { id: 4, name: "History Assessment", avgScore: 80.2, difficulty: "Medium" },
        { id: 5, name: "Physics Lab Test", avgScore: 73.6, difficulty: "Hard" },
        { id: 6, name: "Chemistry Practical", avgScore: 79.4, difficulty: "Medium" }
    ]
};

// Chart configurations
let charts = {};

// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
    initializeDashboard();
    setupEventListeners();
});

function initializeDashboard() {
    updateSummaryCards();
    initializeCharts();
    initializeDateRangePicker();
}

function updateSummaryCards() {
    document.getElementById('totalStudents').textContent = studentData.students.length;
    document.getElementById('totalTests').textContent = studentData.tests.length;
    document.getElementById('totalBatches').textContent = studentData.batches.length;
    
    const avgScore = studentData.students.reduce((sum, student) => sum + student.averageScore, 0) / studentData.students.length;
    document.getElementById('averageScore').textContent = avgScore.toFixed(1) + '%';
}

function initializeCharts() {
    initializeBatchPerformanceChart();
    initializeBatchDistributionChart();
    initializeTestScoresChart();
    initializeTestDifficultyChart();
    initializeGradeDistributionChart();
    initializePerformanceTrendChart();
}

function initializeBatchPerformanceChart() {
    const ctx = document.getElementById('batchPerformanceChart').getContext('2d');
    
    charts.batchPerformance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: studentData.batches.map(batch => batch.name),
            datasets: [{
                label: 'Average Score (%)',
                data: studentData.batches.map(batch => batch.avgScore),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
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
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y.toFixed(1) + '%';
                        }
                    }
                }
            }
        }
    });
}

function initializeBatchDistributionChart() {
    const ctx = document.getElementById('batchDistributionChart').getContext('2d');
    
    charts.batchDistribution = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: studentData.batches.map(batch => batch.name),
            datasets: [{
                data: studentData.batches.map(batch => batch.students),
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF',
                    '#FF9F40'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 10
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + ' students';
                        }
                    }
                }
            }
        }
    });
}

function initializeTestScoresChart() {
    const ctx = document.getElementById('testScoresChart').getContext('2d');
    
    charts.testScores = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: studentData.tests.map(test => test.name),
            datasets: [{
                label: 'Average Score (%)',
                data: studentData.tests.map(test => test.avgScore),
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Average: ' + context.parsed.x.toFixed(1) + '%';
                        }
                    }
                }
            }
        }
    });
}

function initializeTestDifficultyChart() {
    const ctx = document.getElementById('testDifficultyChart').getContext('2d');
    
    const difficultyData = {
        'Easy': studentData.tests.filter(test => test.difficulty === 'Easy').length,
        'Medium': studentData.tests.filter(test => test.difficulty === 'Medium').length,
        'Hard': studentData.tests.filter(test => test.difficulty === 'Hard').length
    };
    
    charts.testDifficulty = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: Object.keys(difficultyData),
            datasets: [{
                data: Object.values(difficultyData),
                backgroundColor: [
                    '#28a745',
                    '#ffc107',
                    '#dc3545'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + ' tests';
                        }
                    }
                }
            }
        }
    });
}

function initializeGradeDistributionChart() {
    const ctx = document.getElementById('gradeDistributionChart').getContext('2d');
    
    // Calculate grade distribution
    const gradeRanges = {
        'A (90-100%)': 0,
        'B (80-89%)': 0,
        'C (70-79%)': 0,
        'D (60-69%)': 0,
        'F (0-59%)': 0
    };
    
    studentData.students.forEach(student => {
        const score = student.averageScore;
        if (score >= 90) gradeRanges['A (90-100%)']++;
        else if (score >= 80) gradeRanges['B (80-89%)']++;
        else if (score >= 70) gradeRanges['C (70-79%)']++;
        else if (score >= 60) gradeRanges['D (60-69%)']++;
        else gradeRanges['F (0-59%)']++;
    });
    
    charts.gradeDistribution = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: Object.keys(gradeRanges),
            datasets: [{
                data: Object.values(gradeRanges),
                backgroundColor: [
                    '#28a745',
                    '#17a2b8',
                    '#ffc107',
                    '#fd7e14',
                    '#dc3545'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 8
                    }
                }
            }
        }
    });
}

function initializePerformanceTrendChart() {
    const ctx = document.getElementById('performanceTrendChart').getContext('2d');
    
    // Generate trend data for last 12 months
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const trendData = months.map((month, index) => {
        return 75 + Math.sin(index * 0.5) * 10 + Math.random() * 5;
    });
    
    charts.performanceTrend = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Average Performance (%)',
                data: trendData,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: false,
                    min: 60,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
}

function initializeDateRangePicker() {
    // Initialize date range picker (placeholder - would need actual date picker library)
    const dateRangeInput = document.getElementById('date_range');
    dateRangeInput.placeholder = 'Select date range';
    dateRangeInput.addEventListener('click', function() {
        // This would integrate with a date picker library like daterangepicker
        console.log('Date range picker clicked');
    });
}

function setupEventListeners() {
    // Filter form submission
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        applyFilters();
    });
    
    // Refresh data button
    document.getElementById('refreshData').addEventListener('click', function() {
        refreshDashboard();
    });
    
    // Export buttons
    document.getElementById('exportExcel').addEventListener('click', function() {
        exportToExcel();
    });
    
    document.getElementById('exportPDF').addEventListener('click', function() {
        exportToPDF();
    });
}

function applyFilters() {
    const batchFilter = document.getElementById('batch_filter').value;
    const testFilter = document.getElementById('test_filter').value;
    const dateRange = document.getElementById('date_range').value;
    
    console.log('Applying filters:', { batchFilter, testFilter, dateRange });
    
    // Filter data based on selections
    let filteredStudents = studentData.students;
    
    if (batchFilter) {
        filteredStudents = filteredStudents.filter(student => student.batchId == batchFilter);
    }
    
    // Update charts with filtered data
    updateChartsWithFilteredData(filteredStudents);
    
    // Show filter applied message
    showNotification('Filters applied successfully!', 'success');
}

function updateChartsWithFilteredData(filteredStudents) {
    // Update batch performance chart
    if (charts.batchPerformance) {
        const batchScores = {};
        filteredStudents.forEach(student => {
            if (!batchScores[student.batch]) {
                batchScores[student.batch] = [];
            }
            batchScores[student.batch].push(student.averageScore);
        });
        
        const batchAverages = Object.keys(batchScores).map(batch => {
            const scores = batchScores[batch];
            return scores.reduce((sum, score) => sum + score, 0) / scores.length;
        });
        
        charts.batchPerformance.data.datasets[0].data = batchAverages;
        charts.batchPerformance.update();
    }
}

function refreshDashboard() {
    showNotification('Refreshing dashboard data...', 'info');
    
    // Simulate data refresh
    setTimeout(() => {
        updateSummaryCards();
        Object.values(charts).forEach(chart => {
            if (chart && chart.update) {
                chart.update();
            }
        });
        showNotification('Dashboard refreshed successfully!', 'success');
    }, 1000);
}

function exportToExcel() {
    showNotification('Exporting to Excel...', 'info');
    
    // Create CSV content
    let csvContent = "Student Name,Email,Batch,Total Tests,Average Score,Highest Score,Lowest Score,Trend\n";
    
    studentData.students.forEach(student => {
        csvContent += `"${student.name}","${student.email}","${student.batch}",${student.totalTests},${student.averageScore}%,${student.highestScore}%,${student.lowestScore}%,${student.trend}\n`;
    });
    
    // Create and download file
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'student_performance_data.csv';
    a.click();
    window.URL.revokeObjectURL(url);
    
    showNotification('Excel file downloaded successfully!', 'success');
}

function exportToPDF() {
    showNotification('PDF export feature would be implemented with a PDF library like jsPDF', 'info');
}

function viewStudentDetails(studentId) {
    const student = studentData.students.find(s => s.id === studentId);
    if (!student) return;
    
    const modalContent = document.getElementById('studentDetailsContent');
    modalContent.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <h5>Student Information</h5>
                <p><strong>Name:</strong> ${student.name}</p>
                <p><strong>Email:</strong> ${student.email}</p>
                <p><strong>Batch:</strong> ${student.batch}</p>
                <p><strong>Total Tests:</strong> ${student.totalTests}</p>
                <p><strong>Average Score:</strong> ${student.averageScore}%</p>
                <p><strong>Highest Score:</strong> ${student.highestScore}%</p>
                <p><strong>Lowest Score:</strong> ${student.lowestScore}%</p>
                <p><strong>Trend:</strong> <span class="text-capitalize">${student.trend}</span></p>
            </div>
            <div class="col-md-6">
                <h5>Score History</h5>
                <canvas id="studentScoreChart" height="200"></canvas>
            </div>
        </div>
    `;
    
    // Show modal
    $('#studentDetailsModal').modal('show');
    
    // Create student score chart after modal is shown
    $('#studentDetailsModal').on('shown.bs.modal', function() {
        const ctx = document.getElementById('studentScoreChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: student.scores.map((_, index) => `Test ${index + 1}`),
                datasets: [{
                    label: 'Score (%)',
                    data: student.scores,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show`;
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    
    notification.innerHTML = `
        ${message}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 3000);
}

// Initialize DataTable for student performance table
$(document).ready(function() {
    if ($.fn.DataTable) {
        $('#studentPerformanceTable').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[3, 'desc']], // Sort by average score descending
            columnDefs: [
                { orderable: false, targets: [6, 7] } // Disable sorting for trend and action columns
            ]
        });
    }
});

// Utility functions
function formatPercentage(value) {
    return value.toFixed(1) + '%';
}

function getGradeFromScore(score) {
    if (score >= 90) return 'A';
    if (score >= 80) return 'B';
    if (score >= 70) return 'C';
    if (score >= 60) return 'D';
    return 'F';
}

function getTrendIcon(trend) {
    switch (trend) {
        case 'improving':
            return '<i class="fas fa-arrow-up text-success"></i>';
        case 'declining':
            return '<i class="fas fa-arrow-down text-danger"></i>';
        case 'stable':
            return '<i class="fas fa-minus text-warning"></i>';
        default:
            return '<i class="fas fa-minus text-muted"></i>';
    }
}

// Additional chart update functions
function updateChartColors(chartInstance, colors) {
    if (chartInstance && chartInstance.data && chartInstance.data.datasets) {
        chartInstance.data.datasets.forEach((dataset, index) => {
            if (colors[index]) {
                dataset.backgroundColor = colors[index].background;
                dataset.borderColor = colors[index].border;
            }
        });
        chartInstance.update();
    }
}

// Export functions for external use
window.studentAnalytics = {
    charts,
    studentData,
    viewStudentDetails,
    refreshDashboard,
    applyFilters,
    exportToExcel,
    exportToPDF
};
</script>
@endsection