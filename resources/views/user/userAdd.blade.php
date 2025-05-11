@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12 p-0">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">UserAdd</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="card card-outline card-orange col-md-12 col-12 p-0">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><i class="fa fa-desktop"></i> &nbsp;Add User</h3>
                            <div class="card-tools">
                                <a href="{{ url('userView') }}" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i>
                                    <span class="Display_none_mobile"> {{ __('common.View') }} </span></a>
                                {{-- <a href="{{ url('dashboard') }}" class="btn btn-primary  btn-sm"><i
                                        class="fa fa-arrow-left"></i> <span class="Display_none_mobile">
                                        {{ __('common.Back') }} </span></a> --}}
                            </div>
                        </div>
                        <!-- Profile Upload Section -->
                        <div class="row">
                            <div class="col-md-3 col-12 box">
                                {{-- <div class=" "> --}}
                                <div class="d-grid text-center py-4 ">
                                    <img id="profilePreview" src="{{ asset(env('IMAGE_SHOW_PATH') . 'Excel/excel.jpg') }}"
                                        class="img-fluid mb-3 p-1 border shadow-lg"
                                        style="width: 120px; height: 120px; object-fit: cover; border-radius:10px; border-color: #b3b3b37a "
                                        alt="User Profile">

                                    <div class="custom-file mt-3 col-md-8 col-12    ">
                                        <input type="file" name="profile_photo" class="form-control bg-white"
                                            id="profilePhotoInput" onchange="previewImage(event)">

                                    </div>
                                    {{-- <small id="fileName" class="form-text text-muted mt-2">No file selected</small> --}}
                                </div>
                                {{-- </div> --}}
                            </div>

                            <!-- Form Section -->
                            <div class="col-md-9 py-2">
                                <!-- Wizard Circle Bar -->

                                <div class="wizard-steps d-flex justify-content-between position-relative">
                                    <div class="wizard-step-indicator text-center flex-fill">
                                        <div class="circle step-circle active">1</div>
                                        <small class="d-block">Basic Details</small>
                                    </div>
                                    <div class="wizard-step-indicator text-center flex-fill">
                                        <div class="circle step-circle">2</div>
                                        <small class="d-block">Additional Details</small>
                                    </div>
                                    <div class="wizard-step-indicator text-center flex-fill">
                                        <div class="circle step-circle">3</div>
                                        <small class="d-block">Permissions</small>
                                    </div>
                                    <div class="step-line position-absolute w-100"
                                        style="top: 12px; left: 0; height: 2px; background: #dee2e6; z-index: 0;"></div>
                                </div>


                                <form action="#" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="card-body">

                                        <div class="bg-item border p-3 rounded">
                                            <!-- Step 1: Basic Details -->
                                            <div id="step-1" class="wizard-step">
                                                <h5><i class="fa fa-user"></i> Basic Details</h5>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Branch ID *</label>
                                                            <select class="form-control">
                                                                <option value="">Select</option>
                                                                <option>Branch A</option>
                                                                <option>Branch B</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>First Name *</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="First Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Last Name *</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Mobile *</label>
                                                            <input type="text" class="form-control" placeholder="Mobile">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Email *</label>
                                                            <input type="email" class="form-control" placeholder="Email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Step 2: Additional Details -->
                                            <div id="step-2" class="wizard-step d-none">
                                                <h5><i class="fa fa-info-circle"></i> Additional Details</h5>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>State *</label>
                                                            <select class="form-control">
                                                                <option value="">Select</option>
                                                                <option>State A</option>
                                                                <option>State B</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>City *</label>
                                                            <select class="form-control">
                                                                <option value="">Select</option>
                                                                <option>City X</option>
                                                                <option>City Y</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Address *</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Username *</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Username">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Password *</label>
                                                            <input type="password" class="form-control"
                                                                placeholder="Password">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Role *</label>
                                                            <select class="form-control">
                                                                <option value="">Select</option>
                                                                <option>Manager</option>
                                                                <option>Staff</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Salary</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Salary">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Photo</label>
                                                            <input type="file" class="form-control" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Step 3: Permissions -->
                                            <div id="step-3" class="wizard-step d-none">
                                                <h5><i class="fa fa-lock"></i> User Permissions</h5>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Sidebar Access</label>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="dashboard">
                                                                <label class="form-check-label"
                                                                    for="dashboard">Dashboard</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="reports">
                                                                <label class="form-check-label"
                                                                    for="reports">Reports</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Actions</label>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="edit">
                                                                <label class="form-check-label"
                                                                    for="edit">Edit</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="delete">
                                                                <label class="form-check-label"
                                                                    for="delete">Delete</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="download">
                                                                <label class="form-check-label"
                                                                    for="download">Download</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Sub Panel Access</label>
                                                            <select class="form-control" multiple>
                                                                <optgroup label="Dashboard">
                                                                    <option value="1">Overview</option>
                                                                    <option value="2">Stats</option>
                                                                </optgroup>
                                                                <optgroup label="Reports">
                                                                    <option value="3">Sales Report</option>
                                                                    <option value="4">User Activity</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Navigation Buttons -->
                                            <div class="card-footer text-center bg-transparent">
                                                <button type="button" class="btn btn-secondary" id="prevStep"
                                                    disabled>Previous</button>
                                                <button type="button" class="btn btn-primary"
                                                    id="nextStep">Next</button>
                                                <button type="submit" class="btn btn-success d-none"
                                                    id="submitBtn">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <!-- JS Script -->
    <script>
        let currentStep = 1;
        const totalSteps = 3;

        function showStep(step) {
            document.querySelectorAll('.wizard-step').forEach(el => el.classList.add('d-none'));
            document.querySelector(`#step-${step}`).classList.remove('d-none');

            document.getElementById('prevStep').disabled = (step === 1);
            document.getElementById('nextStep').classList.toggle('d-none', step === totalSteps);
            document.getElementById('submitBtn').classList.toggle('d-none', step !== totalSteps);

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
