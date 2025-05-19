@extends('layout.app')
@section('content')
    @php
        $isEdit = isset($data);

    @endphp
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
                            <div class="card-title">
                                <h4><i class="fa fa-desktop"></i> &nbsp;Add User</h4>
                            </div>
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
                                            id="excelFile" accept=".xlsx, .xls" />

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


                                <form id="createCommon" enctype="multipart/form-data">
                                    @if ($isEdit)
                                        <input type='hidden' value='{{ $data->id }}' name='id' />
                                    @endif
                                    <input type='hidden' value='User' name='modal_type' />
                                    <input type='hidden' id="branch_id" name='branch_id'
                                        value="{{ old('branch_id', $data->branch_id ?? '') }}" />
                                    <div class="card-body">
                                        <div class="bg-item border p-3 rounded">
                                            <!-- Step 1: Basic Details -->
                                            <div id="step-1" class="wizard-step">
                                                <h5><i class="fa fa-user"></i> Basic Details</h5>
                                                <div class="row">
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="first_name">First Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="first_name"
                                                                placeholder="First Name" name="first_name"
                                                                data-required="true"
                                                                value="{{ old('first_name', $data->first_name ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="last_name">Last Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Last Name" name="last_name" id="last_name"
                                                                data-required="true"
                                                                value="{{ old('last_name', $data->last_name ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="mobile">Mobile <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" placeholder="Mobile"
                                                                id="mobile" data-required="true" name="mobile"
                                                                value="{{ old('mobile', $data->mobile ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Email <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="email" class="form-control"
                                                                placeholder="Email" id="email" data-required="true"
                                                                name="email"
                                                                value="{{ old('email', $data->email ?? '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="userName">Username <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Username" name="userName" id="userName"
                                                                data-required="true"
                                                                value="{{ old('userName', $data->userName ?? '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="password">Password <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="password" class="form-control"
                                                                placeholder="Password" name="password" id="password"
                                                                data-required="true" value="{{ old('password') }}">
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
                                                            <label for="dob">DOB <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" name="dob"
                                                                id="dob" data-required="true"
                                                                value="{{ old('dob', $data->dob ?? '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="father_name">Father
                                                                Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="father_name"
                                                                id="father_name" placeholder="Father Name"
                                                                data-required="true"
                                                                value="{{ old('father_name', $data->father_name ?? '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="gender">Gender <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="gender" id="gender" class="form-control">
                                                                <option value="M"
                                                                    {{ old('gender', $data->gender ?? '') == 'M' ? 'selected' : '' }}>
                                                                    Male</option>
                                                                <option value="F"
                                                                    {{ old('gender', $data->gender ?? '') == 'F' ? 'selected' : '' }}>
                                                                    Female</option>
                                                                <option value="other"
                                                                    {{ old('gender', $data->gender ?? '') == 'other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="state_id">State <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control" name="state_id" id="state_id"
                                                                data-required="true">
                                                                <option value="0"
                                                                    {{ old('state_id', $data->state_id ?? '') == 0 ? 'selected' : '' }}>
                                                                    Select</option>
                                                                <option value="1"
                                                                    {{ old('state_id', $data->state_id ?? '') == 1 ? 'selected' : '' }}>
                                                                    State A</option>
                                                                <option value="2"
                                                                    {{ old('state_id', $data->state_id ?? '') == 2 ? 'selected' : '' }}>
                                                                    State B</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="city_id">City <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control" name="city_id" id="city_id"
                                                                data-required="true">
                                                                <option value="0"
                                                                    {{ old('city_id', $data->city_id ?? '') == 0 ? 'selected' : '' }}>
                                                                    Select</option>
                                                                <option value="1"
                                                                    {{ old('city_id', $data->city_id ?? '') == 1 ? 'selected' : '' }}>
                                                                    City X</option>
                                                                <option value="2"
                                                                    {{ old('city_id', $data->city_id ?? '') == 2 ? 'selected' : '' }}>
                                                                    City Y</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="address">Address <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Address" name="address" id="address"
                                                                data-required="true"
                                                                value="{{ old('address', $data->address ?? '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="role_id">Role <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control" name="role_id" id="role_id"
                                                                data-required="true">
                                                                <option value=""
                                                                    {{ old('role_id', $data->role_id ?? '') == '' ? 'selected' : '' }}>
                                                                    Select</option>
                                                                <option value="Manager"
                                                                    {{ old('role_id', $data->role_id ?? '') == 'Manager' ? 'selected' : '' }}>
                                                                    Manager</option>
                                                                <option value="Staff"
                                                                    {{ old('role_id', $data->role_id ?? '') == 'Staff' ? 'selected' : '' }}>
                                                                    Staff</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Salary</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Salary" name="salary"
                                                                value="{{ old('salary', $data->salary ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Photo</label>
                                                            <input type="file" class="form-control" accept="image/*"
                                                                id="image" name="image">
                                                            {{-- Note: old value doesn't apply for file inputs --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Step 3: Permissions -->
                                            <div id="step-3" class="wizard-step d-none">
                                                <h5><i class="fa fa-lock"></i> User Permissions</h5>
                                                <div class="row">
                                                    {{-- Permissions content here (if needed) --}}
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

            // const progress = Math.round((step / totalSteps) * 100);
            // document.getElementById('wizardProgressBar').style.width = progress + '%';
        }
        document.getElementById('nextStep').addEventListener('click', () => {

            $('#createCommon').trigger('submit');
            var smallTags = $('#step-' + currentStep).find('small');

            if (smallTags.length > 0) {
                return
            }
            // document.getElementById('nextStep').addEventListener('click', () => {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
                $('#step-' + currentStep).find('small').remove();
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
