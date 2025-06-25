@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-12">
                        <div class="card card-orange card-outline">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa-solid fa-money-bill"></i> Library Bill Management</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Wizard Circle Bar -->
                                <div class="wizard-steps d-flex justify-content-between position-relative ">
                                    <div class="wizard-step-indicator text-center flex-fill">
                                        <div class="circle step-circle active">1</div>
                                        <small class="d-block">Choose Plan Type</small>
                                    </div>
                                    <div class="wizard-step-indicator text-center flex-fill">
                                        <div class="circle step-circle">2</div>
                                        <small class="d-block">Select Seat or Locker</small>
                                    </div>
                                    
                                    <div class="step-line position-absolute w-100"
                                        style="top: 12px; left: 0; height: 2px; background: #dee2e6; z-index: 0;"></div>
                                </div>

                                <!-- Step 1: plan type -->
                                <div id="step-1" class="wizard-step">
                                    <div class="row">
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="student_name">Student</label>
                                            <select class="form-control" name="student_name" id="student_name">
                                                <option selected>Select student</option>
                                                <option value="1">Aalock kumawat</option>
                                                <option value="2">Hansraj kumawat</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="time_duration">Time Duration in Months</label>
                                            <select name="time_duration" id="time_duration" class="form-control">
                                                <option selected>select</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control" name="start_date" id="start_date">
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="last_date">Last Date</label>
                                            <input type="date" class="form-control" id="last_date" name="last_date">
                                        </div>

                                        <div class="d-flex align-items-center text-center col-md-12 col-12 py-2">
                                            <div class="flex-grow-1" style="border-bottom: 1px solid #949faa"></div>
                                            <div class="px-2" style="color: #002c54">Assign Locker</div>
                                            <div class="flex-grow-1" style="border-bottom: 1px solid #949faa"></div>
                                        </div>

                                        <div class="col-md-12 col-12 form-group">
                                            <input type="checkbox" class="form-input-check" id="locker" name="locker">
                                            <label for="locker">Locker</label>
                                        </div>

                                        <div class="d-flex align-items-center text-center col-md-12 col-12 pb-2">
                                            <div class="flex-grow-1" style="border-bottom: 1px solid #949faa"></div>
                                            <div class="px-2" style="color: #002c54">Choose Plan</div>
                                            <div class="flex-grow-1" style="border-bottom: 1px solid #949faa"></div>
                                        </div>
                                        {{-- basic plan --}}
                                        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                            <div class="card mb-3 subscription-plan-card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h4 class="font-weight-bold">Platinum</h4>
                                                            <p class="text-muted m-0 fs-5">10:00 AM to 10:00 PM</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <h4 class="font-weight-bold">₹200<span
                                                                    class="text-muted">/month</span></h4>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <ul class="list-unstyled">
                                                                <li class="fs-6"><i
                                                                        class="fa fa-check text-success mr-2"></i>
                                                                    2 active member</li>
                                                                <li class="fs-6"><i
                                                                        class="fa fa-check text-success mr-2"></i>
                                                                    Access to
                                                                    reading rooms (2 hours/day)</li>
                                                                <li class="fs-6"><i
                                                                        class="fa fa-check text-success mr-2"></i>
                                                                    Online reservation system
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div
                                                            class="col-md-12 col-sm-12 d-flex align-items-end action-buttons">
                                                            <button
                                                                class="btn btn-outline-primary action-btn mr-2">Edit</button>
                                                            <button
                                                                class="btn btn-outline-danger action-btn">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Premium/gold Plan -->
                                        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                            <div class="card mb-3 subscription-plan-card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h4 class="font-weight-bold">Gold</h4>
                                                            <p class="text-muted mb-0 fs-5">10:00 AM to 10:00 PM</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <h4 class="font-weight-bold">₹300<span
                                                                    class="text-muted">/month</span></h4>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <ul class="list-unstyled">
                                                                <li class="fs-6"><i
                                                                        class="fa fa-check text-success mr-2"></i> 1 active
                                                                    member</li>
                                                                <li class="fs-6"><i
                                                                        class="fa fa-check text-success mr-2"></i>
                                                                    Access to reading rooms(5hr/day)</li>
                                                                <li class="fs-6"><i
                                                                        class="fa fa-check text-success mr-2"></i>
                                                                    Priority reservation system</li>
                                                            </ul>
                                                        </div>
                                                        <div
                                                            class="col-md-12 col-sm-12 d-flex align-items-end action-buttons">
                                                            <button
                                                                class="btn btn-outline-primary action-btn mr-2">Edit</button>
                                                            <button
                                                                class="btn btn-outline-danger action-btn">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- diamond Plan -->
                                        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                            <div class="card mb-3 subscription-plan-card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h4 class="font-weight-bold">Diamond</h4>
                                                            <p class="text-muted mb-0 fs-5">10:00 AM to 10:00 PM</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <h4 class="font-weight-bold">₹500<span
                                                                    class="text-muted">/month</span></h4>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <ul class="list-unstyled">
                                                                <li class="fs-6"><i
                                                                        class="fa fa-check text-success mr-2"></i> 3 active
                                                                    member</li>
                                                                <li class="fs-6"><i
                                                                        class="fa fa-check text-success mr-2"></i>
                                                                    Unlimited access to reading rooms</li>
                                                                <li class="fs-6"><i
                                                                        class="fa fa-check text-success mr-2"></i>
                                                                    Priority reservation system</li>
                                                            </ul>
                                                        </div>
                                                        <div
                                                            class="col-md-12 col-sm-12 d-flex align-items-end action-buttons">
                                                            <button
                                                                class="btn btn-outline-primary action-btn mr-2">Edit</button>
                                                            <button
                                                                class="btn btn-outline-danger action-btn">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- step 2 select seat or locker --}}
                                <div class="wizard-step" id="step-2">
                                    {{-- seat list --}}
                                    <div class="mt-3" id="assignseat">
                                        <h5 class="mb-2"><i class="fa-solid fa-couch"></i> Select a Seat</h5>
                                        <div class="row">
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S1
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S2
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S3
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S4
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S5
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S6
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat occupied">
                                                    <div class="seat-action"></div>
                                                    S7
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S8
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S9
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat occupied">
                                                    <div class="seat-action"></div>
                                                    S10
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S11
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S12
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat occupied">
                                                    <div class="seat-action"></div>
                                                    S13
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S14
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S15
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat occupied">
                                                    <div class="seat-action"></div>
                                                    S16
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S17
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S18
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S19
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S20
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S21
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S22
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S23
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-3">
                                                <div class="seat">
                                                    <div class="seat-action"></div>
                                                    S24
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Locker add --}}
                                    <div class="locker-grid">
                                        <h5 class="mb-2"><i class="fa-solid fa-lock"></i> Select a Locker</h5>
                                        <div class="row">
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L1</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L2</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L3</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L4</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box occupied locker" data-type="locker">L5</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L6</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L7</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L8</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L9</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box occupied locker" data-type="locker">L10</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L11</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L12</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L13</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L14</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box occupied locker" data-type="locker">L15</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L16</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L17</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L18</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box available locker" data-type="locker">L19</div>
                                            </div>
                                            <div class="col-md-1 col-sm-4 col-3  ">
                                                <div class="item-box occupied locker" data-type="locker">L20</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="card-footer text-center bg-transparent">
                                    <button type="button" class="btn btn-secondary" id="prevStep"
                                        disabled>Previous</button>
                                    <button type="button" class="btn btn-primary" id="nextStep">Next</button>
                                    {{-- <button type="submit" class="btn btn-success d-none"
                                            id="submitBtn">Submit</button> --}}
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- billing --}}
                    <div class="col-md-4">
                        <div class="card card-orange card-outline">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa-solid fa-receipt"></i> Billing</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row pb-1 mb-1 border-bottom">
                                    <div class="col-md-6 col-6">
                                        <p class="mb-1 fs-5 fw-bold text-secondary">Student Name</p>
                                        <p class="mb-0 fs-6">John Doe</p>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <p class="mb-1 fs-5 fw-bold text-secondary">Plan Type</p>
                                        <p class="mb-0 fs-6">Monthly</p>
                                    </div>
                                </div>
                                <div class="row mb-1 pb-1 border-bottom">
                                    <div class="col-md-6 col-6">
                                        <p class="mb-1  fs-5 fw-bold text-secondary">Start Date</p>
                                        <p class="mb-0 fs-6">01-May-2025</p>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <p class="mb-1 fs-5 fw-bold text-secondary">Last Date</p>
                                        <p class="mb-0 fs-6">31-May-2025</p>
                                    </div>
                                </div>
                                <div class="row mb-1 pb-1 border-bottom">
                                    <div class="col-md-6 col-6">
                                        <p class="mb-1 fs-5 fw-bold text-secondary">Time Duration</p>
                                        <p class="mb-0 fs-6">9:00 AM - 5:00 PM</p>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <p class="mb-1 fs-5 fw-bold text-secondary">Seat No</p>
                                        <p class="mb-0 fs-6">A12</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <p class="mb-1 fs-5 fw-bold text-secondary">Locker No</p>
                                        <p class="mb-0 fs-6">L7</p>
                                    </div>
                                </div>

                                <!-- Billing Breakdown -->
                                <hr class="my-2">
                                <h4 class="fw-bold mb-2 text-secondary" style="font-size: 16px">Billing Details</h4>
                                <div class="row fs-5">
                                    <div class="col-md-8 col-8">Plan Charges (Monthly)</div>
                                    <div class="col-md-4 col-4 text-end">₹1000</div>
                                </div>
                                <div class="row fs-5">
                                    <div class="col-md-8 col-8">Seat Charges</div>
                                    <div class="col-md-4 col-4 text-end">₹200</div>
                                </div>
                                <div class="row mb-2 fs-5">
                                    <div class="col-md-8 col-8">Locker Charges</div>
                                    <div class="col-md-4 col-4 text-end">₹100</div>
                                </div>
                                <hr class="my-2">
                                <div class="row fw-bold fs-5">
                                    <div class="col-md-8 col-8">Total Bill</div>
                                    <div class="col-md-4 col-4 text-end text-success">₹1300</div>
                                </div>
                            </div>

                            <div class="card-footer bg-light text-end py-3 rounded-bottom">
                                <a href="{{url('printbill')}}" class="btn btn-success px-4">Confirm & Print</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 2;

        function showStep(step) {
            document.querySelectorAll('.wizard-step').forEach(el => el.classList.add('d-none'));
            document.querySelector(`#step-${step}`).classList.remove('d-none');

            document.getElementById('prevStep').disabled = (step === 1);
            document.getElementById('nextStep').classList.toggle('d-none', step === totalSteps);
            // document.getElementById('submitBtn').classList.toggle('d-none', step !== totalSteps);

            const circles = document.querySelectorAll('.step-circle');
            circles.forEach((circle, index) => {
                circle.classList.remove('active', 'completed');
                if (index + 1 < step) {
                    circle.classList.add('completed');
                } else if (index + 1 === step) {
                    circle.classList.add('active');
                }
            });

            const progress = Math.round((step / totalSteps) * 100);
            document.getElementById('wizardProgressBar').style.width = progress + '%';
        }

        document.getElementById('nextStep').addEventListener('click', () => {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            }
        });

        document.getElementById('prevStep').addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
        });

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('profilePreview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            document.getElementById('fileName').innerText = event.target.files[0].name;
        }
    </script>
@endsection
