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
                <div class="card card-outline card-orange col-md-12 col-12 p-0">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fa fa-chart-line mr-2"></i> Test & Exam-wise Batch Performance</h5>
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
                            </div>
                            <canvas id="performanceChart" height="120"></canvas>
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

    document.getElementById('batchSelect').addEventListener('change', function () {
        const selected = Array.from(this.selectedOptions).map(opt => opt.value);
        const datasets = selected.map(batch => batchData[batch]);
        chartInstance.data.datasets = datasets;
        chartInstance.update();
    });
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
</style>

@endsection
