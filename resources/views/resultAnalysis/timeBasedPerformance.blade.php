@extends('layout.app')
@section('content')
@php
    $permissions = Helper::getPermissions();
@endphp

<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --accent-color: #3498db;
        --success-color: #27ae60;
        --warning-color: #f39c12;
        --danger-color: #e74c3c;
        --info-color: #17a2b8;
        --light-bg: #f8f9fa;
        --white: #ffffff;
        --text-dark: #2c3e50;
        --text-muted: #6c757d;
        --border-color: #dee2e6;
        --card-shadow: 0 2px 10px rgba(44, 62, 80, 0.08);
        --card-hover-shadow: 0 4px 20px rgba(44, 62, 80, 0.12);
        --border-radius: 8px;
        --transition: all 0.3s ease;
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-dark);
        line-height: 1.5;
    }

    .main-container {
        padding: 30px !important;
        max-width: 1400px;
        margin: auto;
    }

    .page-header {
        background: #002c54;
        color: var(--white);
        padding: 1rem 0;
        margin-bottom: 1.5rem;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        text-align: center;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .page-subtitle {
        font-size: 0.8rem;
        opacity: 0.9;
        font-weight: 300;
        margin: 0;
    }

    .date-filters {
        background: var(--white);
        padding: 10px;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .filter-btn {
        border: 1px solid var(--border-color);
        background: var(--white);
        color: var(--text-dark);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.85rem;
        transition: var(--transition);
        margin: 0.25rem;
        cursor: pointer;
        display: inline-block;
    }

    .filter-btn:hover {
        border-color: var(--accent-color);
        color: var(--accent-color);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(52, 152, 219, 0.2);
    }

    .filter-btn.active {
        background: var(--accent-color);
        border-color: var(--accent-color);
        color: var(--white);
        box-shadow: 0 2px 8px rgba(52, 152, 219, 0.3);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding: 0 1rem;
    }

    .metric-card {
        background: var(--white);
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        padding: 1rem 1.5rem;
        transition: var(--transition);
        overflow: hidden;
        position: relative;
        min-height: 120px;
    }

    .metric-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--card-hover-shadow);
    }

    .metric-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: var(--accent-color);
    }

    .metric-card.success::before { background: var(--success-color); }
    .metric-card.warning::before { background: var(--warning-color); }
    .metric-card.danger::before { background: var(--danger-color); }
    .metric-card.info::before { background: var(--info-color); }

    .metric-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
    }

    .metric-title {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
        line-height: 1.2;
    }

    .metric-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--white);
        background: var(--accent-color);
        flex-shrink: 0;
    }

    .metric-icon.success { background: var(--success-color); }
    .metric-icon.warning { background: var(--warning-color); }
    .metric-icon.danger { background: var(--danger-color); }
    .metric-icon.info { background: var(--info-color); }

    .metric-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .metric-growth {
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        display: inline-block;
    }

    .growth-positive {
        background: rgba(39, 174, 96, 0.1);
        color: var(--success-color);
    }

    .growth-negative {
        background: rgba(231, 76, 60, 0.1);
        color: var(--danger-color);
    }

    .content-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .chart-card {
        background: var(--white);
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        margin-bottom: 1.5rem;
        transition: var(--transition);
    }

    .chart-card:hover {
        box-shadow: var(--card-hover-shadow);
    }

    .chart-header {
        padding: 0.3rem 1.5rem;
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
    }

    .table-elegant {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--card-shadow);
        font-size: 0.9rem;
    }

    .table-elegant thead th {
        background: var(--primary-color);
        color: var(--white);
        font-weight: 600;
        padding: 0.75rem 1rem;
        border: none;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .table-elegant tbody td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }

    .table-elegant tbody tr {
        background: var(--white);
        transition: var(--transition);
    }

    .table-elegant tbody tr:hover {
        background: rgba(52, 152, 219, 0.05);
    }

    .table-elegant tbody tr:last-child td {
        border-bottom: none;
    }

    .badge-elegant {
        padding: 0.3rem 0.75rem;
        border-radius: 15px;
        font-size: 0.7rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .badge-primary { background: rgba(52, 152, 219, 0.1); color: var(--accent-color); }
    .badge-success { background: rgba(39, 174, 96, 0.1); color: var(--success-color); }
    .badge-warning { background: rgba(243, 156, 18, 0.1); color: var(--warning-color); }
    .badge-danger { background: rgba(231, 76, 60, 0.1); color: var(--danger-color); }
    .badge-info { background: rgba(23, 162, 184, 0.1); color: var(--info-color); }

    .btn-elegant {
        background: var(--primary-color);
        border: none;
        color: var(--white);
        padding: 0.6rem 1.5rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.85rem;
        transition: var(--transition);
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
    }

    .btn-elegant:hover {
        background: var(--secondary-color);
        color: var(--white);
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(44, 62, 80, 0.3);
    }

    .btn-elegant.success {
        background: var(--success-color);
    }

    .btn-elegant.success:hover {
        background: #219a52;
    }

    .custom-date-section {
        background: rgba(52, 152, 219, 0.05);
        border: 1px solid rgba(52, 152, 219, 0.1);
        border-radius: var(--border-radius);
        padding: 1rem;
        margin-top: 1rem;
    }

    .form-control-elegant {
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 0.6rem 0.75rem;
        transition: var(--transition);
        font-size: 0.9rem;
    }

    .form-control-elegant:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.1);
        outline: none;
    }

    .chart-placeholder {
        height: 250px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: var(--border-radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        font-style: italic;
        border: 2px dashed var(--border-color);
    }

    .performance-indicator {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .trend-icon {
        font-size: 0.8rem;
    }

    .trend-up { color: var(--success-color); }
    .trend-down { color: var(--danger-color); }
    .trend-stable { color: var(--warning-color); }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }
        
        .metric-card {
            padding: 1rem;
        }
        
        .chart-body {
            padding: 1rem;
        }
        
        .filter-btn {
            width: 100%;
            margin: 0.25rem 0;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            padding: 0 0.5rem;
        }

        .content-container {
            padding: 0 0.5rem;
        }
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-chart-line me-2"></i>
                Performance Analytics Dashboard
            </h1>
            <p class="page-subtitle">Comprehensive insights into student performance and growth patterns</p>
        </div>

        <!-- Date Range Filters -->
        <div class="date-filters">
            <div class="d-flex flex-wrap justify-content-center align-items-center ">
                <button class="filter-btn active">
                    <i class="fas fa-calendar-week me-1"></i>Last 7 Days
                </button>
                <button class="filter-btn">
                    <i class="fas fa-calendar-month me-1"></i>Last 30 Days
                </button>
                <button class="filter-btn">
                    <i class="fas fa-calendar-alt me-1"></i>Last 90 Days
                </button>
                <button class="filter-btn">
                    <i class="fas fa-calendar-plus me-1"></i>Custom Range
                </button>
            </div>
            
            <!-- Custom Date Range -->
            <div class="custom-date-section" style="display: none;">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Start Date</label>
                        <input type="date" class="form-control form-control-elegant">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">End Date</label>
                        <input type="date" class="form-control form-control-elegant">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-elegant success w-100">
                            <i class="fas fa-search me-1"></i>Apply Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Metrics -->
    <div class="stats-grid">
        <div class="metric-card info">
            <div class="metric-header">
                <div>
                    <h6 class="metric-title">Total Students</h6>
                    <div class="metric-value">1,247</div>
                </div>
                <div class="metric-icon info">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="metric-growth growth-positive">
                <i class="fas fa-arrow-up me-1"></i>+12.5% Growth
            </div>
        </div>

        <div class="metric-card success">
            <div class="metric-header">
                <div>
                    <h6 class="metric-title">Average Performance</h6>
                    <div class="metric-value">87.3%</div>
                </div>
                <div class="metric-icon success">
                    <i class="fas fa-chart-bar"></i>
                </div>
            </div>
            <div class="metric-growth growth-positive">
                <i class="fas fa-arrow-up me-1"></i>+5.2% Improvement
            </div>
        </div>

        <div class="metric-card warning">
            <div class="metric-header">
                <div>
                    <h6 class="metric-title">Active Sessions</h6>
                    <div class="metric-value">342</div>
                </div>
                <div class="metric-icon warning">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="metric-growth growth-positive">
                <i class="fas fa-arrow-up me-1"></i>+18.7% Activity
            </div>
        </div>

        <div class="metric-card danger">
            <div class="metric-header">
                <div>
                    <h6 class="metric-title">Completion Rate</h6>
                    <div class="metric-value">94.8%</div>
                </div>
                <div class="metric-icon danger">
                    <i class="fas fa-trophy"></i>
                </div>
            </div>
            <div class="metric-growth growth-positive">
                <i class="fas fa-arrow-up me-1"></i>+3.1% Completion
            </div>
        </div>
    </div>

    <div class="content-container">
        <!-- Charts Section -->
        <div class="row mb-4">
            <!-- Performance Trend -->
            <div class="col-lg-8 mb-4">
                <div class="chart-card">
                    <div class="chart-header">
                        <h5 class="chart-title">
                            <i class="fas fa-line-chart me-2"></i>Student Performance Trend
                        </h5>
                    </div>
                    <div class="chart-body">
                        <div class="chart-placeholder">
                            <div class="text-center">
                                <i class="fas fa-chart-line fa-2x mb-2"></i>
                                <p>Performance trend chart would be displayed here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Growth Distribution -->
            <div class="col-lg-4 mb-4">
                <div class="chart-card">
                    <div class="chart-header">
                        <h5 class="chart-title">
                            <i class="fas fa-pie-chart me-2"></i>Growth Distribution
                        </h5>
                    </div>
                    <div class="chart-body">
                        <div class="chart-placeholder" style="height: 200px;">
                            <div class="text-center">
                                <i class="fas fa-chart-pie fa-2x mb-2"></i>
                                <p>Growth distribution chart</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Analytics -->
        <div class="row mb-4">
            <!-- Growth Analysis -->
            <div class="col-lg-6 mb-4">
                <div class="chart-card">
                    <div class="chart-header">
                        <h5 class="chart-title">
                            <i class="fas fa-seedling me-2"></i>Growth Pattern Analysis
                        </h5>
                    </div>
                    <div class="chart-body">
                        <div class="table-responsive ">
                            <table id='dataContainer' class="table table-bordered table-striped ">
                                <thead>
                                    <tr class="bg-light">
                                        <th>Growth Category</th>
                                        <th>Students</th>
                                        <th>Percentage</th>
                                        <th>Trend</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="badge-elegant badge-success">Excellent Growth</span></td>
                                        <td><strong>425</strong></td>
                                        <td>34.1%</td>
                                        <td><i class="fas fa-arrow-up trend-icon trend-up"></i></td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge-elegant badge-info">Good Growth</span></td>
                                        <td><strong>378</strong></td>
                                        <td>30.3%</td>
                                        <td><i class="fas fa-arrow-up trend-icon trend-up"></i></td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge-elegant badge-warning">Moderate Growth</span></td>
                                        <td><strong>312</strong></td>
                                        <td>25.0%</td>
                                        <td><i class="fas fa-minus trend-icon trend-stable"></i></td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge-elegant badge-danger">Needs Improvement</span></td>
                                        <td><strong>132</strong></td>
                                        <td>10.6%</td>
                                        <td><i class="fas fa-arrow-down trend-icon trend-down"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Performance Metrics Chart -->
            <div class="col-lg-6 mb-4">
                <div class="chart-card">
                    <div class="chart-header">
                        <h5 class="chart-title">
                            <i class="fas fa-chart-bar me-2"></i>Performance Metrics
                        </h5>
                    </div>
                    <div class="chart-body">
                        <div class="chart-placeholder">
                            <div class="text-center">
                                <i class="fas fa-chart-bar fa-2x mb-2"></i>
                                <p>Performance metrics chart would be displayed here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Student Performance -->
        <div class="row">
            <div class="col-12">
                <div class="chart-card">
                    <div class="chart-header d-flex justify-content-between align-items-center">
                        <h5 class="chart-title">
                            <i class="fas fa-users me-2"></i>Detailed Student Performance
                        </h5>
                        <a href="#" class="btn-elegant success">
                            <i class="fas fa-download me-1"></i>Export Data
                        </a>
                    </div>
                    <div class="chart-body">
                        <div class="table-responsive">
                            <table id='dataContainer' class="table table-bordered table-striped ">
                                <thead>
                                    <tr class="bg-light">
                                        <th>Student Name</th>
                                        <th>Current Score</th>
                                        <th>Previous Score</th>
                                        <th>Growth</th>
                                        <th>Sessions</th>
                                        <th>Last Activity</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Alice Johnson</strong></td>
                                        <td><span class="badge-elegant badge-primary">92%</span></td>
                                        <td>87%</td>
                                        <td>
                                            <div class="performance-indicator">
                                                <i class="fas fa-arrow-up trend-icon trend-up"></i>
                                                <span class="badge-elegant badge-success">+5%</span>
                                            </div>
                                        </td>
                                        <td>24</td>
                                        <td>2 hours ago</td>
                                        <td><span class="badge-elegant badge-success">Excellent</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Bob Smith</strong></td>
                                        <td><span class="badge-elegant badge-primary">88%</span></td>
                                        <td>85%</td>
                                        <td>
                                            <div class="performance-indicator">
                                                <i class="fas fa-arrow-up trend-icon trend-up"></i>
                                                <span class="badge-elegant badge-success">+3%</span>
                                            </div>
                                        </td>
                                        <td>19</td>
                                        <td>5 hours ago</td>
                                        <td><span class="badge-elegant badge-info">Good</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Carol Davis</strong></td>
                                        <td><span class="badge-elegant badge-primary">85%</span></td>
                                        <td>89%</td>
                                        <td>
                                            <div class="performance-indicator">
                                                <i class="fas fa-arrow-down trend-icon trend-down"></i>
                                                <span class="badge-elegant badge-danger">-4%</span>
                                            </div>
                                        </td>
                                        <td>16</td>
                                        <td>1 day ago</td>
                                        <td><span class="badge-elegant badge-warning">Moderate</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>David Wilson</strong></td>
                                        <td><span class="badge-elegant badge-primary">91%</span></td>
                                        <td>82%</td>
                                        <td>
                                            <div class="performance-indicator">
                                                <i class="fas fa-arrow-up trend-icon trend-up"></i>
                                                <span class="badge-elegant badge-success">+9%</span>
                                            </div>
                                        </td>
                                        <td>28</td>
                                        <td>30 minutes ago</td>
                                        <td><span class="badge-elegant badge-success">Excellent</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Emma Brown</strong></td>
                                        <td><span class="badge-elegant badge-primary">79%</span></td>
                                        <td>74%</td>
                                        <td>
                                            <div class="performance-indicator">
                                                <i class="fas fa-arrow-up trend-icon trend-up"></i>
                                                <span class="badge-elegant badge-success">+5%</span>
                                            </div>
                                        </td>
                                        <td>15</td>
                                        <td>3 hours ago</td>
                                        <td><span class="badge-elegant badge-info">Good</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Frank Miller</strong></td>
                                        <td><span class="badge-elegant badge-primary">76%</span></td>
                                        <td>78%</td>
                                        <td>
                                            <div class="performance-indicator">
                                                <i class="fas fa-arrow-down trend-icon trend-down"></i>
                                                <span class="badge-elegant badge-danger">-2%</span>
                                            </div>
                                        </td>
                                        <td>12</td>
                                        <td>6 hours ago</td>
                                        <td><span class="badge-elegant badge-warning">Moderate</span></td>
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


@endsection