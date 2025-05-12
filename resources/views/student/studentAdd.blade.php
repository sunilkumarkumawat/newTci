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
                            <li class="breadcrumb-item">StudnetAdd</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="card card-outline card-orange col-md-12 c0l-12 p-0">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h4><i class="fa fa-address-book"></i> Students Admission</h4>
                            </div>
                            <div class="card-tools">
                                <a href="{{ url('studentView') }}" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i>
                                    <span class="Display_none_mobile"> {{ __('common.View') }} </span></a>
                                {{-- <a href="{{ url('studentDashboard') }}" class="btn btn-primary  btn-sm"><i
                                        class="fa fa-arrow-left"></i> <span class="Display_none_mobile">
                                        {{ __('common.Back') }} </span></a> --}}
                            </div>
                        </div>

                        <!-- Profile Upload Section -->
                        <div class="row">
                            <div class="col-md-3 box">
                                <div class="text-center py-4 ">
                                    <div class="card-body  d-flex flex-column justify-content-center align-items-center">
                                        <img id="profilePreview"
                                            src="{{ asset(env('IMAGE_SHOW_PATH') . 'Excel/excel.jpg') }}"
                                            class="img-fluid mb-3  border-dark p-2 larger shadow"
                                            style="width: 120px; height: 120px; object-fit: cover; border-radius:10px"
                                            alt="User Profile">

                                        <div class="custom-file mt-3 col-md-8 col-12    ">
                                            <input type="file" name="profile_photo" class="form-control bg-white"
                                                id="profilePhotoInput" onchange="previewImage(event)">

                                        </div>
                                        {{-- <small id="fileName" class="form-text text-muted mt-2">No file selected</small> --}}
                                    </div>
                                </div>
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
                                        <small class="d-block">Guardian Details</small>
                                    </div>
                                    <div class="step-line position-absolute w-100"
                                        style="top: 12px; left: 0; height: 2px; background: #dee2e6; z-index: 0;">
                                    </div>
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
                                                            <label>Admission No. </label>
                                                            <input type="text" class="form-control invalid"
                                                                id="admissionNo" name="admissionNo"
                                                                placeholder="Admission No." value=""
                                                                onkeypress="javascript:return isNumber(event)" required>
                                                            <span class="invalid-feedback" id="admissionNo_invalid"
                                                                role="alert">
                                                                <strong>The Admission No field is required</strong>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Student Name<span style="color:red;">*</span></label>
                                                            <input type="text" name="first_name" id="first_name"
                                                                class="form-control invalid" value=""
                                                                placeholder="Student Name"
                                                                onkeydown="return /[a-zA-Z ]/i.test(event.key)" required>
                                                            <span class="invalid-feedback" id="first_name_invalid"
                                                                role="alert">
                                                                <strong>The Student Name field is required</strong>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Gender<span style="color:red;">*</span></label>
                                                            <select class="form-control invalid" id="gender_id"
                                                                name="gender_id" required>
                                                                <option value="">Select</option>
                                                                <option value="1">Male</option>
                                                                <option value="2">Female</option>
                                                                <option value="3">Other</option>
                                                            </select>
                                                            <span class="invalid-feedback" id="gender_id_invalid"
                                                                role="alert">
                                                                <strong>The gender field is required</strong>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Date Of Birth<span style="color:red;">*</span></label>
                                                            <input type="date" class="form-control invalid"
                                                                id="dob" name="dob" placeholder="Date Of Birth"
                                                                value="" required>
                                                            <span class="invalid-feedback" id="dob_invalid"
                                                                role="alert">
                                                                <strong>The dob field is required</strong>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Mobile No.<span style="color:red;">*</span></label>
                                                            <input type="text" class="form-control" id="mobile"
                                                                name="mobile" placeholder="Mobile No." value=""
                                                                maxlength="10"
                                                                onkeypress="javascript:return isNumber(event)" required>
                                                            <div id="mobileValidationMessage"
                                                                style="color: red; display: none; font-size:13px;">must be
                                                                at
                                                                least 10 characters</div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Email *</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" placeholder="Email" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Aadhaar No.</label>
                                                            <input type="text" class="form-control" id="aadhaar"
                                                                name="aadhaar" placeholder="Aadhaar No." value=""
                                                                maxlength="12"
                                                                onkeypress="javascript:return isNumber(event)">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Date Of Admission</label>
                                                            <input type="date" class="form-control"
                                                                id="admission_date" name="admission_date" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Students Address</label>
                                                            <input type="text" class="form-control" id="address"
                                                                name="address" placeholder="Students Address"
                                                                value="">
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

                                            <!-- Step 2: Additional Details -->
                                            <div id="step-2" class="wizard-step">
                                                <h5><i class="fa fa-info-circle"></i> Additional Details</h5>
                                                <div class="row">
                                                    <div id="additionalDetailsSection" class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <h6 class="text-primary">Personal Information</h6>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Religion</label>
                                                                    <select class="form-control" id="religion"
                                                                        name="religion">
                                                                        <option value="Select">Select</option>
                                                                        <option value="Hindu" selected>Hindu</option>
                                                                        <option value="Islam">Islam</option>
                                                                        <option value="Sikh">Sikh</option>
                                                                        <option value="Buddhism">Buddhism</option>
                                                                        <option value="Adivasi">Adivasi</option>
                                                                        <option value="Jain">Jain</option>
                                                                        <option value="Christianity">Christianity</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Category</label>
                                                                    <select class="form-control" id="category"
                                                                        name="category">
                                                                        <option value="">Select</option>
                                                                        <option value="OBC" selected>OBC</option>
                                                                        <option value="ST">ST</option>
                                                                        <option value="SC">SC</option>
                                                                        <option value="BC">BC</option>
                                                                        <option value="GEN">GEN</option>
                                                                        <option value="SBC">SBC</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Caste</label>
                                                                    <input type="text" class="form-control"
                                                                        id="caste_category" name="caste_category"
                                                                        placeholder="Caste" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Blood Group</label>
                                                                    <select class="form-control" id="blood_group"
                                                                        name="blood_group">
                                                                        <option value="">Select</option>
                                                                        <option value="A+">A+</option>
                                                                        <option value="A-">A-</option>
                                                                        <option value="B+">B+</option>
                                                                        <option value="B-">B-</option>
                                                                        <option value="AB+">AB+</option>
                                                                        <option value="AB-">AB-</option>
                                                                        <option value="O+">O+</option>
                                                                        <option value="O-">O-</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-2 mt-3">
                                                                <h6 class="text-primary">Location Information</h6>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Country</label>
                                                                    <select class="form-control" name="country"
                                                                        id="country_id">
                                                                        <option value="">Select</option>
                                                                        <option value="1" selected>India</option>
                                                                        <option value="2">USA</option>
                                                                        <option value="3">UK</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="State">State</label>
                                                                    <select class="form-control" id="state_id"
                                                                        name="state">
                                                                        <option value="">Select</option>
                                                                        <option value="1" selected>Rajasthan</option>
                                                                        <option value="2">Delhi</option>
                                                                        <option value="3">Gujarat</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="City">City</label>
                                                                    <select class="form-control" name="city"
                                                                        id="city_id">
                                                                        <option value="">Select</option>
                                                                        <option value="1" selected>Jaipur</option>
                                                                        <option value="2">Jodhpur</option>
                                                                        <option value="3">Udaipur</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Village/City</label>
                                                                    <select class="form-control" id="village_city"
                                                                        name="village_city">
                                                                        <option value="">Select</option>
                                                                        <option value="Jaipur">Jaipur</option>
                                                                        <option value="Sanganer">Sanganer</option>
                                                                        <option value="Mansarovar">Mansarovar</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>District</label>
                                                                    <input type="text" class="form-control"
                                                                        id="district" name="district"
                                                                        placeholder="District" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Tehsil</label>
                                                                    <input type="text" class="form-control"
                                                                        id="tehsil" name="tehsil"
                                                                        placeholder="Tehsil" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Urban/Rural</label>
                                                                    <input type="text" class="form-control"
                                                                        id="urban" name="urban"
                                                                        placeholder="Urban/Rural" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Pin Code</label>
                                                                    <input type="text" class="form-control"
                                                                        id="pincode" name="pincode"
                                                                        placeholder="Pin Code" value=""
                                                                        maxlength="6"
                                                                        onkeypress="javascript:return isNumber(event)">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Step 3: Guardian Details -->
                                            <div id="step-3" class="wizard-step ">
                                                <h5><i class="fa fa-hands-holding-child"></i> Guardian Details</h5>
                                                <div class="row">
                                                    <!-- Required Guardian Details -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Father's Name<span style="color:red;">*</span></label>
                                                            <input type="text" class="form-control invalid"
                                                                id="father_name" name="father_name"
                                                                placeholder="Father's Name" value=""
                                                                onkeydown="return /[a-zA-Z ]/i.test(event.key)" required>
                                                            <span class="invalid-feedback" id="father_name_invalid"
                                                                role="alert">
                                                                <strong>The Father's name field is required</strong>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Father's Contact No<span
                                                                    style="color:red;">*</span></label>
                                                            <input type="text" class="form-control invalid"
                                                                id="father_mobile" name="father_mobile"
                                                                placeholder="Father's Contact No" value=""
                                                                maxlength="10"
                                                                onkeypress="javascript:return isNumber(event)" required>
                                                            <div id="fathermobileValidationMessage"
                                                                style="color: red; display: none; font-size:13px;">
                                                                must
                                                                be at
                                                                least 10 characters</div>
                                                            <span class="invalid-feedback" id="father_mobile_invalid"
                                                                role="alert">
                                                                <strong>The Father's No is required</strong>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Father's Occupation</label>
                                                            <input type="text" class="form-control"
                                                                id="father_occupation" name="father_occupation"
                                                                placeholder="Father's Occupation" value="">
                                                        </div>
                                                    </div>

                                                    <!-- Additional Guardian Details -->
                                                    <div id="additionalGuardianDetails" class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Mother's Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="mother_name" name="mother_name"
                                                                        placeholder="Mother's Name" value=""
                                                                        onkeydown="return /[a-zA-Z ]/i.test(event.key)">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Mother's Contact No</label>
                                                                    <input type="text" class="form-control"
                                                                        id="mother_mobile" name="mother_mobile"
                                                                        placeholder="Mother's Contact No" value=""
                                                                        maxlength="10"
                                                                        onkeypress="javascript:return isNumber(event)">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Mother's Occupation</label>
                                                                    <input type="text" class="form-control"
                                                                        id="mother_occupation" name="mother_occupation"
                                                                        placeholder="Mother's Occupation" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Guardian's Name (If other than
                                                                        parent)</label>
                                                                    <input type="text" class="form-control"
                                                                        id="guardian_name" name="guardian_name"
                                                                        placeholder="Guardian's Name" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Guardian's Contact No</label>
                                                                    <input type="text" class="form-control"
                                                                        id="guardian_mobile" name="guardian_mobile"
                                                                        placeholder="Guardian's Contact No" value=""
                                                                        maxlength="10"
                                                                        onkeypress="javascript:return isNumber(event)">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Guardian's Relation</label>
                                                                    <select class="form-control" id="guardian_relation"
                                                                        name="guardian_relation">
                                                                        <option value="">Select</option>
                                                                        <option value="Grandfather">Grandfather
                                                                        </option>
                                                                        <option value="Grandmother">Grandmother
                                                                        </option>
                                                                        <option value="Uncle">Uncle</option>
                                                                        <option value="Aunt">Aunt</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Guardian's Address</label>
                                                                    <textarea class="form-control" id="guardian_address" name="guardian_address" placeholder="Guardian's Address"
                                                                        rows="2"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- </div> --}}

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

        // after changes

        // Function to restrict input to numbers only
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        // Initialize when the document is ready
        $(document).ready(function() {
            // Initialize select2 elements
            $('.select2').select2();

            // Toggle additional details section in step 2
            $('#showAdditionalDetails').change(function() {
                if ($(this).is(':checked')) {
                    $('#additionalDetailsSection').slideDown();
                } else {
                    $('#additionalDetailsSection').slideUp();
                }
            });

            // Toggle additional guardian details in step 3
            $('#showMoreGuardianDetails').change(function() {
                if ($(this).is(':checked')) {
                    $('#additionalGuardianDetails').slideDown();
                } else {
                    $('#additionalGuardianDetails').slideUp();
                }
            });

            // Mobile validation for student
            $('#mobile').on('input', function() {
                if ($(this).val().length < 10 && $(this).val().length > 0) {
                    $('#mobileValidationMessage').show();
                } else {
                    $('#mobileValidationMessage').hide();
                }
            });

            // Mobile validation for father
            $('#father_mobile').on('input', function() {
                if ($(this).val().length < 10 && $(this).val().length > 0) {
                    $('#fathermobileValidationMessage').show();
                } else {
                    $('#fathermobileValidationMessage').hide();
                }
            });

            // Form submission handler
            $('#quickForm_addmission').submit(function(e) {
                e.preventDefault();
                if (validateStep3()) {
                    // Here you would normally submit the form
                    // For testing, we'll just show an alert
                    alert('Form submitted successfully!');
                    // You can replace with AJAX submission:
                    // $.ajax({
                    //     url: "your-submission-url",
                    //     type: "POST",
                    //     data: $(this).serialize(),
                    //     success: function(response) {
                    //         // Handle success
                    //     },
                    //     error: function(error) {
                    //         // Handle error
                    //     }
                    // });
                }
            });

            // Initialize the student search functionality
            $('#searchName, #registration_no').on('keypress', function(e) {
                if (e.which === 13) {
                    SearchValue();
                }
            });
        });

        // Search students function
        function SearchValue() {
            const registrationNo = $('#registration_no').val();
            const searchKeyword = $('#searchName').val();

            if (!registrationNo && !searchKeyword) {
                alert('Please enter a registration number or search keyword');
                return;
            }

            // Show loading indicator (optional)
            $('.student_list_show').html(
                '<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Searching...</div>');

            // This would be your actual AJAX call to search for students
            // For demo purposes, we'll simulate it
            setTimeout(function() {
                // Simulate no results
                if (!registrationNo && searchKeyword === 'test') {
                    $('.student_list_show').html(
                        '<div class="alert alert-warning">No students found matching your criteria.</div>');
                    $('#studentList').css('visibility', 'hidden');
                    return;
                }

                // Simulate found results - in a real scenario, this would come from your server
                const dummyResults = [{
                        registration_no: '2023001',
                        name: 'John Doe',
                        class: '10th',
                        mobile: '9876543210'
                    },
                    {
                        registration_no: '2023002',
                        name: 'Jane Smith',
                        class: '9th',
                        mobile: '8765432109'
                    }
                ];

                // Display the results
                let html = '';
                dummyResults.forEach(student => {
                    html += `<tr>
                <td>${student.registration_no}</td>
                <td>${student.name}</td>
                <td>${student.class}</td>
                <td>${student.mobile}</td>
            </tr>`;
                });

                $('#product_list_show').html(html);
                $('#studentList').css('visibility', 'visible');
                $('.student_list_show').html('');
            }, 1000);
        }

        // Navigate to next step
        function nextStep(currentStep) {
            // Validate current step before proceeding
            if (currentStep === 1) {
                if (!validateStep1()) return;
            } else if (currentStep === 2) {
                // Step 2 is optional, so we don't need strict validation
            }

            // Hide current step
            $(`#step${currentStep}`).removeClass('active');

            // Update step indicators
            $(`#step${currentStep}-indicator`).removeClass('active').addClass('completed');
            $(`#step${currentStep + 1}-indicator`).addClass('active');

            // Show next step
            $(`#step${currentStep + 1}`).addClass('active');
        }

        // Navigate to previous step
        function prevStep(currentStep) {
            // Hide current step
            $(`#step${currentStep}`).removeClass('active');

            // Update step indicators
            $(`#step${currentStep}-indicator`).removeClass('active');
            $(`#step${currentStep - 1}-indicator`).removeClass('completed').addClass('active');

            // Show previous step
            $(`#step${currentStep - 1}`).addClass('active');
        }

        // Validation for Step 1
        function validateStep1() {
            let isValid = true;

            // Required fields validation
            const requiredFields = ['admissionNo', 'first_name', 'gender_id', 'dob', 'mobile'];

            requiredFields.forEach(field => {
                const value = $(`#${field}`).val();
                if (!value || value.trim() === '') {
                    $(`#${field}`).addClass('is-invalid');
                    $(`#${field}_invalid`).show();
                    isValid = false;
                } else {
                    $(`#${field}`).removeClass('is-invalid');
                    $(`#${field}_invalid`).hide();
                }
            });

            // Mobile validation
            if ($('#mobile').val().length > 0 && $('#mobile').val().length < 10) {
                $('#mobileValidationMessage').show();
                isValid = false;
            }

            return isValid;
        }

        // Validation for Step 3
        function validateStep3() {
            let isValid = true;

            // Required fields validation
            const requiredFields = ['father_name', 'father_mobile'];

            requiredFields.forEach(field => {
                const value = $(`#${field}`).val();
                if (!value || value.trim() === '') {
                    $(`#${field}`).addClass('is-invalid');
                    $(`#${field}_invalid`).show();
                    isValid = false;
                } else {
                    $(`#${field}`).removeClass('is-invalid');
                    $(`#${field}_invalid`).hide();
                }
            });

            // Father's mobile validation
            if ($('#father_mobile').val().length > 0 && $('#father_mobile').val().length < 10) {
                $('#fathermobileValidationMessage').show();
                isValid = false;
            }

            return isValid;
        }
    </script>
@endsection
