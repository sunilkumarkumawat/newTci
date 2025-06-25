@extends('layout.app')
@section('content')

<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-orange ">
                        <!-- Header -->
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h4><i class="fas fa-chart-line"></i> &nbsp;Analysis Exam - JEE Main Mock Test 2024</h4>
                            </div>
                            <div class="card-tools">
                                <a href="{{url('analysisPanel')}}" class="btn btn-primary  btn-sm">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </a>
                            </div>
                        </div>


                        <div class="card-body">
                            <!-- Language Toggle -->
                            <div class="mb-4">
                                <button type="button" class="btn btn-info" id="change_language">
                                    <i class="fas fa-language me-2"></i>HI
                                </button>
                            </div>

                            <div class="row">
                                <!-- Question Section -->
                                <div class="col-lg-8">
                                    <div class="question-card">
                                        <!-- Question Display -->
                                        <div class="question-section review_hide">
                                            <div class="question-box">
                                                <h5 class="question-text" id="q1">
                                                    Q. 1 If the roots of the equation x² - 3x + 2 = 0 are α and β, then find the value of α + β.
                                                </h5>
                                            </div>

                                            <!-- Multiple Choice Options -->
                                            <div class="options-list objective">
                                                <div class="option-row">
                                                    <span class="option-label">a)</span>
                                                    <span id='ans_a' class="option-text">2</span>
                                                </div>
                                                <div class="option-row">
                                                    <span class="option-label">b)</span>
                                                    <span id='ans_b' class="option-text">3</span>
                                                </div>
                                                <div class="option-row">
                                                    <span class="option-label">c)</span>
                                                    <span id='ans_c' class="option-text">4</span>
                                                </div>
                                                <div class="option-row">
                                                    <span class="option-label">d)</span>
                                                    <span id='ans_d' class="option-text">5</span>
                                                </div>
                                            </div>

                                            <!-- Numeric Answer -->
                                            <div class="numeric-section numeric" style="display: none;">
                                                <div class="form-group">
                                                    <label>Your Answer</label>
                                                    <input name="numeric_ans" class='form-control' type="text" id="numeric_ans" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Review Section -->
                                        <div class="review-section review_show" style="display: none;">
                                            <div class="alert alert-info">
                                                <div class="correct-ans mb-2">
                                                    <strong id='ans_correct'>Ans: b</strong>
                                                </div>
                                                <div class="solution">
                                                    <span id='ans_reivew'>For a quadratic equation ax² + bx + c = 0, the sum of roots = -b/a. Here, a = 1, b = -3, so sum of roots = -(-3)/1 = 3.</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Navigation Controls -->
                                    <div class="text-center mt-4">
                                        <button class="btn btn-secondary me-2" id='previous'>
                                            <i class="fas fa-chevron-left me-2"></i>Previous
                                        </button>
                                        <button class="btn btn-primary me-2" id='mark_for_review'>
                                            Show Review
                                        </button>
                                        <button class="btn btn-secondary" id="next">
                                            Next<i class="fas fa-chevron-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Statistics Panel -->
                                <div class="col-lg-4">
                                    <div class="stats-card">
                                        <!-- Question Navigation Table -->
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead class="table-primary">
                                                    <tr class="bg-light">
                                                        <th></th>
                                                        <th>Q.No.</th>
                                                        <th>Mark</th>
                                                        <th>Time</th>
                                                        <th>Visits</th>
                                                        <th>Subject</th>
                                                        <th>Part</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Question 1 - Current/Correct -->
                                                    <tr class="question_number table-success current-question" id='ques_0' data-question="0">
                                                        <td class='arrow-cell'>→</td>
                                                        <td>1</td>
                                                        <td class="text-success fw-bold">+4</td>
                                                        <td>45s</td>
                                                        <td>1</td>
                                                        <td>Mathematics</td>
                                                        <td>A</td>
                                                    </tr>
                                                    <!-- Question 2 - Wrong -->
                                                    <tr class="question_number table-danger" id='ques_1' data-question="1">
                                                        <td class='arrow-cell'></td>
                                                        <td>2</td>
                                                        <td class="text-danger fw-bold">-1</td>
                                                        <td>67s</td>
                                                        <td>2</td>
                                                        <td>Physics</td>
                                                        <td>A</td>
                                                    </tr>
                                                    <!-- Question 3 - Skipped -->
                                                    <tr class="question_number table-secondary" id='ques_2' data-question="2">
                                                        <td class='arrow-cell'></td>
                                                        <td>3</td>
                                                        <td class="text-muted">Skip</td>
                                                        <td>12s</td>
                                                        <td>1</td>
                                                        <td>Chemistry</td>
                                                        <td>A</td>
                                                    </tr>
                                                    <!-- Question 4 - Correct -->
                                                    <tr class="question_number" id='ques_3' data-question="3">
                                                        <td class='arrow-cell'></td>
                                                        <td>4</td>
                                                        <td class="text-success fw-bold">+4</td>
                                                        <td>89s</td>
                                                        <td>3</td>
                                                        <td>Mathematics</td>
                                                        <td>B</td>
                                                    </tr>
                                                    <!-- Question 5 - Wrong -->
                                                    <tr class="question_number" id='ques_4' data-question="4">
                                                        <td class='arrow-cell'></td>
                                                        <td>5</td>
                                                        <td class="text-danger fw-bold">-1</td>
                                                        <td>34s</td>
                                                        <td>1</td>
                                                        <td>Physics</td>
                                                        <td>B</td>
                                                    </tr>
                                                    <!-- Question 6 - Correct -->
                                                    <tr class="question_number table-success" id='ques_5' data-question="5">
                                                        <td class='arrow-cell'></td>
                                                        <td>6</td>
                                                        <td class="text-success fw-bold">+4</td>
                                                        <td>56s</td>
                                                        <td>2</td>
                                                        <td>Chemistry</td>
                                                        <td>B</td>
                                                    </tr>
                                                    <!-- Question 7 - Skipped -->
                                                    <tr class="question_number" id='ques_6' data-question="6">
                                                        <td class='arrow-cell'></td>
                                                        <td>7</td>
                                                        <td class="text-muted">Skip</td>
                                                        <td>8s</td>
                                                        <td>1</td>
                                                        <td>Mathematics</td>
                                                        <td>A</td>
                                                    </tr>
                                                    <!-- Question 8 - Correct -->
                                                    <tr class="question_number" id='ques_7' data-question="7">
                                                        <td class='arrow-cell'></td>
                                                        <td>8</td>
                                                        <td class="text-success fw-bold">+4</td>
                                                        <td>78s</td>
                                                        <td>1</td>
                                                        <td>Physics</td>
                                                        <td>A</td>
                                                    </tr>
                                                    <!-- Question 9 - Wrong -->
                                                    <tr class="question_number table-danger" id='ques_8' data-question="8">
                                                        <td class='arrow-cell'></td>
                                                        <td>9</td>
                                                        <td class="text-danger fw-bold">-1</td>
                                                        <td>91s</td>
                                                        <td>4</td>
                                                        <td>Chemistry</td>
                                                        <td>A</td>
                                                    </tr>
                                                    <!-- Question 10 - Correct -->
                                                    <tr class="question_number" id='ques_9' data-question="9">
                                                        <td class='arrow-cell'></td>
                                                        <td>10</td>
                                                        <td class="text-success fw-bold">+4</td>
                                                        <td>43s</td>
                                                        <td>1</td>
                                                        <td>Mathematics</td>
                                                        <td>B</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Score Summary -->
                                        <div class="score-summary mt-3">
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <div class="score-box correct">
                                                        <div class="score-number">5</div>
                                                        <div class="score-label">Correct</div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="score-box wrong">
                                                        <div class="score-number">3</div>
                                                        <div class="score-label">Wrong</div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="score-box skipped">
                                                        <div class="score-number">2</div>
                                                        <div class="score-label">Skipped</div>
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
            </div>
        </div>
    </section>
</div>

<style>
    /* Clean and Simple Styling */
    .icon-box {
        width: 40px;
        height: 40px;
        color: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .question-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .question-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #002c54;
        margin-bottom: 20px;
    }

    .question-text {
        color: #2d3436;
        font-weight: 600;
        line-height: 1.5;
        margin: 0;
    }

    .options-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .option-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .option-row:hover {
        border-color: #002c54;
        background: #f8f9ff;
    }

    .option-label {
        background: #002c54;
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
    }

    .option-text {
        color: #2d3436;
        font-weight: 500;
    }

    .stats-card {
        background: white;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }



    .table td {
        font-size: 12px;
        padding: 8px 6px;
        border-color: #e9ecef;
    }

    .arrow-cell {
        color: #002c54;
        font-weight: bold;
        width: 20px;
    }

    .current-question {
        border-left: 3px solid #002c54;
    }

    .score-summary {
        border-top: 1px solid #e9ecef;
        padding-top: 15px;
    }

    .score-box {
        padding: 10px;
        border-radius: 8px;
        background: #f8f9fa;
    }

    .score-box.correct {
        background: #d1f2eb;
        color: #00b894;
    }

    .score-box.wrong {
        background: #fadbd8;
        color: #e74c3c;
    }

    .score-box.skipped {
        background: #f4f6f7;
        color: #636e72;
    }

    .score-number {
        font-size: 24px;
        font-weight: 700;
    }

    .score-label {
        font-size: 12px;
        font-weight: 600;
    }

    .review-section {
        margin-top: 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .content-grid {
            flex-direction: column;
        }

        .card-header {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }

        .table-responsive {
            font-size: 11px;
        }

        .score-summary .row {
            flex-direction: column;
            gap: 10px;
        }
    }

    /* Table hover effects */
    .question_number {
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .question_number:hover {
        background-color: #f8f9ff !important;
    }
</style>

@endsection