@extends('layout.app')
@section('content')
@php
    $permissions = Helper::getPermissions();
@endphp

<style>
    .dashboard-card {
        background: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        transition: transform 0.2s;
        border: 1px solid #e9ecef;
    }
    
    .dashboard-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        margin-right: 15px;
    }
    
    .stat-content {
        flex: 1;
    }
    
    .stat-number {
        font-size: 20px;
        font-weight: bold;
        color: #2c3e50;
        margin: 0;
    }
    
    .stat-label {
        color: #6c757d;
        font-size: 14px;
        text-transform: uppercase;
        margin: 0;
    }
    
    .performer-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        margin-bottom: 8px;
        background: #ffffff;
        border-radius: 8px;
        border-left: 4px solid #007bff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .performer-rank {
        font-weight: bold;
        color: #2c3e50;
        margin-right: 10px;
        font-size: 16px;
    }
    
    .performer-name {
        flex: 1;
        font-weight: 500;
        color: #2c3e50;
    }
    
    .performer-score {
        background: #007bff;
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 14px;
        font-weight: bold;
    }
    
    .subject-score {
        background: #ffffff;
        padding: 10px 15px;
        border-radius: 6px;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #e9ecef;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    
    .subject-name {
        font-weight: 500;
        color: #2c3e50;
    }
    
    .score-value {
        font-weight: bold;
        color: #007bff;
    }
    
    .pass-fail-indicator {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
    }
    
    .pass { background-color: #28a745; }
    .fail { background-color: #dc3545; }
    
    .test-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        border-bottom: 1px solid #e9ecef;
        background: #ffffff;
        margin-bottom: 5px;
        border-radius: 6px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    
    .test-item:last-child {
        border-bottom: none;
    }
    
    .test-name {
        font-weight: 500;
        color: #2c3e50;
    }
    
    .test-date {
        font-size: 12px;
        color: #6c757d;
    }
    
    .test-participants {
        background: #007bff;
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
    }
    
    .card-header {
        font-weight: 600;
        border-bottom: 2px solid rgba(255,255,255,0.2);
    }
    
    .card-body {
        background: #f8f9fa;
    }
    
    /* Chart container styling */
    .chart-container {
        height: 250px;
        width: 250px;
        margin: 0 auto;
        position: relative;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h4>
                                    <i class="fa fa-desktop"></i> &nbsp; Admin Dashboard
                                </h4>
                            </div>
                            <div class="card-tools">
                                <span class="badge badge-light">Current Session: 2023-24</span>
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <!-- Main Statistics Cards -->
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-6">
                                    <div class="dashboard-card p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="stat-icon" style="background: #007bff;">
                                                <i class="fas fa-graduation-cap"></i>
                                            </div>
                                            <div class="stat-content">
                                                <h3 class="stat-number">225</h3>
                                                <p class="stat-label">Total Students</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-md-6">
                                    <div class="dashboard-card p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="stat-icon" style="background: #17a2b8;">
                                                <i class="fas fa-clipboard-list"></i>
                                            </div>
                                            <div class="stat-content">
                                                <h3 class="stat-number">48</h3>
                                                <p class="stat-label">Total Tests</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-md-6">
                                    <div class="dashboard-card p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="stat-icon" style="background: #6f42c1;">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <div class="stat-content">
                                                <h3 class="stat-number">78.5%</h3>
                                                <p class="stat-label">Average Score</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-md-6">
                                    <div class="dashboard-card p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="stat-icon" style="background: #28a745;">
                                                <i class="fas fa-percentage"></i>
                                            </div>
                                            <div class="stat-content">
                                                <h3 class="stat-number">82%</h3>
                                                <p class="stat-label">Pass Rate</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Top Performers and Pass/Fail Ratio -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="dashboard-card">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0"><i class="fas fa-trophy"></i> Top 10 Performers</h5>
                                        </div>
                                        <div class="card-body" style="max-height: 356px; overflow-y: auto;">
                                            <div class="performer-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="performer-rank">1.</span>
                                                    <div class="performer-name">
                                                        <strong>Rajesh Kumar</strong><br>
                                                        <small class="text-muted">Class 10-A | Roll: 15</small>
                                                    </div>
                                                </div>
                                                <span class="performer-score">95.2%</span>
                                            </div>
                                            
                                            <div class="performer-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="performer-rank">2.</span>
                                                    <div class="performer-name">
                                                        <strong>Priya Sharma</strong><br>
                                                        <small class="text-muted">Class 10-B | Roll: 22</small>
                                                    </div>
                                                </div>
                                                <span class="performer-score">94.8%</span>
                                            </div>
                                            
                                            <div class="performer-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="performer-rank">3.</span>
                                                    <div class="performer-name">
                                                        <strong>Amit Singh</strong><br>
                                                        <small class="text-muted">Class 10-A | Roll: 8</small>
                                                    </div>
                                                </div>
                                                <span class="performer-score">92.1%</span>
                                            </div>
                                            
                                            <div class="performer-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="performer-rank">4.</span>
                                                    <div class="performer-name">
                                                        <strong>Neha Gupta</strong><br>
                                                        <small class="text-muted">Class 9-A | Roll: 12</small>
                                                    </div>
                                                </div>
                                                <span class="performer-score">91.5%</span>
                                            </div>
                                            
                                            <div class="performer-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="performer-rank">5.</span>
                                                    <div class="performer-name">
                                                        <strong>Rohit Verma</strong><br>
                                                        <small class="text-muted">Class 10-C | Roll: 5</small>
                                                    </div>
                                                </div>
                                                <span class="performer-score">89.7%</span>
                                            </div>
                                            
                                            <div class="performer-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="performer-rank">6.</span>
                                                    <div class="performer-name">
                                                        <strong>Sakshi Patel</strong><br>
                                                        <small class="text-muted">Class 9-B | Roll: 18</small>
                                                    </div>
                                                </div>
                                                <span class="performer-score">88.9%</span>
                                            </div>
                                            
                                            <div class="performer-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="performer-rank">7.</span>
                                                    <div class="performer-name">
                                                        <strong>Vikram Joshi</strong><br>
                                                        <small class="text-muted">Class 10-A | Roll: 27</small>
                                                    </div>
                                                </div>
                                                <span class="performer-score">87.3%</span>
                                            </div>
                                            
                                            <div class="performer-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="performer-rank">8.</span>
                                                    <div class="performer-name">
                                                        <strong>Anita Desai</strong><br>
                                                        <small class="text-muted">Class 9-A | Roll: 9</small>
                                                    </div>
                                                </div>
                                                <span class="performer-score">86.8%</span>
                                            </div>
                                            
                                            <div class="performer-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="performer-rank">9.</span>
                                                    <div class="performer-name">
                                                        <strong>Karan Malhotra</strong><br>
                                                        <small class="text-muted">Class 10-B | Roll: 14</small>
                                                    </div>
                                                </div>
                                                <span class="performer-score">85.6%</span>
                                            </div>
                                            
                                            <div class="performer-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="performer-rank">10.</span>
                                                    <div class="performer-name">
                                                        <strong>Meera Agarwal</strong><br>
                                                        <small class="text-muted">Class 9-B | Roll: 21</small>
                                                    </div>
                                                </div>
                                                <span class="performer-score">84.2%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="dashboard-card">
                                        <div class="card-header bg-primary text-white "  >
                                            <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Pass/Fail Ratio</h5>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="chart-container">
                                                <canvas id="passFailChart"></canvas>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-6">
                                                    <div class="text-center">
                                                        <div class="pass-fail-indicator pass"></div>
                                                        <strong class="text-success">185 Students</strong><br>
                                                        <small>Passed (82%)</small>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-center">
                                                        <div class="pass-fail-indicator fail"></div>
                                                        <strong class="text-danger">40 Students</strong><br>
                                                        <small>Failed (18%)</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Average Scores and Total Tests -->
                            <div class="row mt-4">
                                <div class="col-lg-6">
                                    <div class="dashboard-card">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Average Scores (Subject-wise)</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="subject-score">
                                                <span class="subject-name">Mathematics</span>
                                                <span class="score-value">78.5%</span>
                                            </div>
                                            <div class="subject-score">
                                                <span class="subject-name">English</span>
                                                <span class="score-value">82.3%</span>
                                            </div>
                                            <div class="subject-score">
                                                <span class="subject-name">Science</span>
                                                <span class="score-value">75.8%</span>
                                            </div>
                                            <div class="subject-score">
                                                <span class="subject-name">Social Studies</span>
                                                <span class="score-value">79.2%</span>
                                            </div>
                                            <div class="subject-score">
                                                <span class="subject-name">Physics</span>
                                                <span class="score-value">73.6%</span>
                                            </div>
                                            <div class="subject-score">
                                                <span class="subject-name">Chemistry</span>
                                                <span class="score-value">76.9%</span>
                                            </div>
                                            <div class="subject-score">
                                                <span class="subject-name">Biology</span>
                                                <span class="score-value">81.4%</span>
                                            </div>
                                            <div class="subject-score">
                                                <span class="subject-name">History</span>
                                                <span class="score-value">77.1%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="dashboard-card">
                                        <div class="card-header bg-primary text-white" >
                                            <h5 class="mb-0 "><i class="fas fa-list-alt"></i> Total Tests Conducted</h5>
                                        </div>
                                        <div class="card-body" style="max-height: 469px; overflow-y: auto;">
                                            <div class="test-item">
                                                <div>
                                                    <div class="test-name">Mathematics - Unit Test 1</div>
                                                    <div class="test-date">15 Jan, 2024</div>
                                                </div>
                                                <span class="test-participants">Class 10 (75 students)</span>
                                            </div>
                                            
                                            <div class="test-item">
                                                <div>
                                                    <div class="test-name">English - Grammar Assessment</div>
                                                    <div class="test-date">18 Jan, 2024</div>
                                                </div>
                                                <span class="test-participants">Class 9 (68 students)</span>
                                            </div>
                                            
                                            <div class="test-item">
                                                <div>
                                                    <div class="test-name">Science - Chapter 1-3 Test</div>
                                                    <div class="test-date">22 Jan, 2024</div>
                                                </div>
                                                <span class="test-participants">Class 10 (75 students)</span>
                                            </div>
                                            
                                            <div class="test-item">
                                                <div>
                                                    <div class="test-name">Social Studies - History Quiz</div>
                                                    <div class="test-date">25 Jan, 2024</div>
                                                </div>
                                                <span class="test-participants">Class 9 (68 students)</span>
                                            </div>
                                            
                                            <div class="test-item">
                                                <div>
                                                    <div class="test-name">Physics - Motion and Force</div>
                                                    <div class="test-date">28 Jan, 2024</div>
                                                </div>
                                                <span class="test-participants">Class 10 (75 students)</span>
                                            </div>
                                            
                                            <div class="test-item">
                                                <div>
                                                    <div class="test-name">Chemistry - Acids and Bases</div>
                                                    <div class="test-date">02 Feb, 2024</div>
                                                </div>
                                                <span class="test-participants">Class 10 (75 students)</span>
                                            </div>
                                            
                                            <div class="test-item">
                                                <div>
                                                    <div class="test-name">Biology - Life Processes</div>
                                                    <div class="test-date">05 Feb, 2024</div>
                                                </div>
                                                <span class="test-participants">Class 10 (75 students)</span>
                                            </div>
                                            
                                            <div class="test-item">
                                                <div>
                                                    <div class="test-name">Mathematics - Algebra Test</div>
                                                    <div class="test-date">08 Feb, 2024</div>
                                                </div>
                                                <span class="test-participants">Class 9 (68 students)</span>
                                            </div>
                                            
                                            <div class="text-center mt-3">
                                                <small class="text-muted">Showing 8 of 48 total tests</small><br>
                                                <button class="btn btn-sm btn-outline-primary mt-2">View All Tests</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
// Pass/Fail Ratio Chart
const passFailCtx = document.getElementById('passFailChart').getContext('2d');
new Chart(passFailCtx, {
    type: 'doughnut',
    data: {
        labels: ['Passed', 'Failed'],
        datasets: [{
            data: [82, 18],
            backgroundColor: ['#27ae60', '#e74c3c'],
            borderWidth: 0,
            cutout: '60%'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>

@endsection