@extends('layout.app')
@section('content')
    @php
        $filterable_columns = ['class_type_id' => true, 'keyword' => true];
    @endphp
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-orange card-outline">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4>Generate Admit Card</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="bg-item border p-3 rounded">
                                    <form action="">
                                        <div class="row">
                                            @include('commoninputs.filterinputs', [
                                                'filters' => $filterable_columns,
                                            ])

                                            <div class="col-md-1 mt-4">
                                                <button type="button" id="filterForm"
                                                    class="btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="card card-orange card-outline">
                                            <div class="card-header bg-light">
                                                <div class="card-title">
                                                    <h4>ID & Password</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="{{ url('admitCard') }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="student_id" class="form-label">Student
                                                            ID</label>
                                                        <input type="text" name="student_id" class="form-control"
                                                            placeholder="Student ID" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" name="password" placeholder="Password"
                                                            class="form-control" required>

                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Generate</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card card-orange card-outline">
                                            <div class="card-header bg-light">
                                                <div class="card-title">
                                                    <h4>Admit Card</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="admit-card">
                                                    <!-- Header Section -->
                                                    <div class="header">
                                                        <div class="logo">RukmaniSoft</div>
                                                        <div class="school-name">Demo School</div>
                                                        <div class="contact-info">
                                                            Address C-15 E, at Tejaji Mandir, Narayan Puri, Sirsi Rd,
                                                            Raghunath<br>
                                                            Vihar, Panchyawala, Jaipur, Rajasthan ,302016<br>
                                                            Phone:- 9828542778<br>
                                                            Email:- democlasses.com<br>
                                                            Website:- -
                                                        </div>
                                                    </div>

                                                    <!-- Exam Title -->
                                                    <div class="exam-title">
                                                        Examination Admit Card<br>
                                                        (Academic Session 2024-25) - Final Examination
                                                    </div>

                                                    <!-- Student Information -->
                                                    <div class="student-info">
                                                        <div class="student-details">
                                                            <div class="info-row">
                                                                <div class="info-cell">
                                                                    <strong>Exam Roll No. :- 46</strong>
                                                                </div>
                                                                <div class="info-cell">
                                                                    <strong>Class :- Nursery</strong>
                                                                </div>
                                                            </div>
                                                            <div class="info-row">
                                                                <div class="info-cell">
                                                                    <strong>Student Name :- rahul</strong>
                                                                </div>
                                                                <div class="info-cell">
                                                                    <strong>Father's Name :- ffff</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="student-photo">
                                                            <div class="person-icon"></div>
                                                        </div>
                                                    </div>

                                                    <!-- Examination Schedule -->
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>Subject</th>
                                                                <th>Examination Date</th>
                                                                <th>Day</th>
                                                                <th>Timing</th>
                                                                <th>Checked By</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>English</td>
                                                                <td>14-Mar-2024</td>
                                                                <td>Thursday</td>
                                                                <td>09:21 PM to 09:21 PM</td>
                                                                <td>--</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Other1</td>
                                                                <td>19-Mar-2024</td>
                                                                <td>Tuesday</td>
                                                                <td>12:12 PM to 12:12 PM</td>
                                                                <td>--</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Hindi</td>
                                                                <td>20-Mar-2024</td>
                                                                <td>Wednesday</td>
                                                                <td>12:12 PM to 12:12 PM</td>
                                                                <td>--</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Other2</td>
                                                                <td>21-Mar-2024</td>
                                                                <td>Thursday</td>
                                                                <td>09:21 PM to 12:12 PM</td>
                                                                <td>--</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Economics</td>
                                                                <td>22-Mar-2024</td>
                                                                <td>Friday</td>
                                                                <td>05:30 AM to 12:12 PM</td>
                                                                <td>--</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Geography</td>
                                                                <td>23-Mar-2024</td>
                                                                <td>Saturday</td>
                                                                <td>12:12 PM to 12:12 PM</td>
                                                                <td>--</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Other3</td>
                                                                <td>01-Mar-2026</td>
                                                                <td>Sunday</td>
                                                                <td>10:12 PM to 10:12 PM</td>
                                                                <td>--</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <!-- Footer Section -->
                                                    <div class="footer-section">
                                                        <div class="footer-cell">
                                                            <div class="footer-title">Date Of Issue</div>
                                                            <div>05-Mar-2024</div>
                                                        </div>
                                                        <div class="footer-cell">
                                                            <div class="footer-title">Class Teacher</div>
                                                            <div class="dashed-line"></div>
                                                        </div>
                                                        <div class="footer-cell">
                                                            <div class="footer-title">Rechecked By</div>
                                                            <div class="dashed-line"></div>
                                                        </div>
                                                        <div class="footer-cell">
                                                            <div class="footer-title">Director</div>
                                                            <div class="dashed-line"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12 text-center">
                                                        <button class="btn btn-primary" type="button">
                                                            Download
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
                </div>
            </div>
        </section>
    </div>


    <style>
        .admit-card {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border: 2px solid #333;
        }

        .header {
            background-color: #e8e8e8;
            padding: 15px;
            text-align: center;
            border-bottom: 2px solid #333;
        }

        .school-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .logo {
            float: left;
            color: #4a90e2;
            font-size: 18px;
            font-weight: bold;
        }

        .contact-info {
            font-size: 12px;
            line-height: 1.4;
            margin-bottom: 5px;
        }

        .exam-title {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border-bottom: 1px solid #333;
        }

        .student-info {
            display: flex;
            border-bottom: 2px solid #333;
        }

        .student-details {
            flex: 1;
        }

        .student-photo {
            width: 120px;
            padding: 10px;
            text-align: center;
            border-left: 1px solid #333;
        }

        .photo-placeholder {
            width: 80px;
            height: 100px;
            background-color: #e0e0e0;
            border: 1px solid #333;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
        }

        .info-row {
            display: flex;
            border-bottom: 1px solid #333;
        }

        .info-cell {
            padding: 10px;
            border-right: 1px solid #333;
            flex: 1;
        }

        .info-cell:last-child {
            border-right: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .footer-section {
            display: flex;
            border-top: 2px solid #333;
        }

        .footer-cell {
            flex: 1;
            padding: 15px;
            border-right: 1px solid #333;
            text-align: center;
        }

        .footer-cell:last-child {
            border-right: none;
        }

        .footer-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .dashed-line {
            border-bottom: 2px dashed #333;
            margin-top: 10px;
        }

        .person-icon {
            width: 60px;
            height: 70px;
            background-color: #4a90e2;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            position: relative;
            margin: 0 auto;
        }

        .person-icon::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: #fff;
            border-radius: 50%;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
        }

        .person-icon::after {
            content: '';
            position: absolute;
            width: 35px;
            height: 25px;
            background-color: #fff;
            border-radius: 50px 50px 0 0;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
@endsection
