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
                            {{-- <a href="{{ url('studentDashboard') }}" class="btn btn-primary btn-sm"><i
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
                                            id="excelFile" onchange="previewImage(event)">

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
                            <div class="card-body">
                                <form id="createCommon">
                                    <input type="hidden" value="Admission" name="modal_type" />
                                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id" />
                                    <input type="hidden" id="branch_id" name="branch_id" />
                                    @csrf


                                    <div class="bg-item border p-3 rounded">
                                        <!-- Step 1: Basic Details -->
                                        <div id="step-1" class="wizard-step">
                                            <h5><i class="fa fa-user"></i> Basic Details</h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Admission No. </label>
                                                        <input type="text" class="form-control "
                                                            id="admissionNo" name="admission_no"
                                                            placeholder="Admission No." value="">

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="student_name">Student Name <span style="color:red;">*</span></label>
                                                        <input type="text" name="student_name" id="student_name"
                                                            class="form-control invalid" value=""
                                                            placeholder="Student Name" data-required="true">

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="gender" >Gender<span style="color:red;">*</span></label>
                                                        <select class="form-control " id="gender"
                                                            name="gender" data-required="true" >
                                                            <option value="">Select</option>
                                                            <option value="1">Male</option>
                                                            <option value="2">Female</option>
                                                            <option value="3">Other</option>
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="dob" >Date Of Birth<span style="color:red;">*</span></label>
                                                        <input type="date" class="form-control"
                                                            id="dob" name="dob" placeholder="Date Of Birth" data-required="true">

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mobile" >Mobile No.<span style="color:red;">*</span></label>
                                                        <input type="text" class="form-control" id="mobile"
                                                            name="mobile" placeholder="Mobile No." data-required="true" >

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="email" >Email <span style="color:red;">*</span></label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" placeholder="Email" data-required="true" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="aadhaar">Aadhaar No.<span style="color:red;">*</span></label>
                                                        <input type="text" class="form-control" id="aadhaar"
                                                            name="aadhaar" placeholder="Aadhaar No." data-required="true">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="admission_date">Date Of Admission</label>
                                                        <input type="date" class="form-control"
                                                            id="admission_date" name="admission_date">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="student_address">Students Address<span style="color:red;">*</span></label>
                                                        <input type="text" class="form-control" id="student_address"
                                                            name="student_address" placeholder="Students Address" data-required="true">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Photo</label>
                                                        <input type="file" class="form-control" name="stImage" accept="image/*">
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
                                                                <label for="religion">Religion<span style="color:red;">*</span></label>
                                                                <select class="form-control" id="religion"
                                                                    name="religion" data-required="true">
                                                                    <option value="" >Select</option>
                                                                    <option value="Hindu" >Hindu</option>
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
                                                                <label for="category">Category<span style="color:red;">*</span></label>
                                                                <select class="form-control" id="category"
                                                                    name="category" data-required="true">
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
                                                                <label for="caste" >Caste</label>
                                                                <input type="text" class="form-control"
                                                                    id="caste" name="caste"
                                                                    placeholder="Caste" value="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="blood_group" >Blood Group</label>
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
                                                                <label for="country" >Country</label>
                                                                <select class="form-control" name="country"
                                                                    id="country">
                                                                    <option value="">Select</option>
                                                                    <option value="1" selected>India</option>
                                                                    <option value="2">USA</option>
                                                                    <option value="3">UK</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="state">State<span style="color:red;">*</span></label>
                                                                <select class="form-control" id="state"
                                                                    name="state" data-required="true">
                                                                    <option value="">Select</option>
                                                                    <option value="1" selected>Rajasthan</option>
                                                                    <option value="2">Delhi</option>
                                                                    <option value="3">Gujarat</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="city">City<span style="color:red;">*</span></label>
                                                                <select class="form-control" name="city"
                                                                    id="city" data-required="true">
                                                                    <option value="">Select</option>
                                                                    <option value="1" selected>Jaipur</option>
                                                                    <option value="2">Jodhpur</option>
                                                                    <option value="3">Udaipur</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="village" >Village/City</label>
                                                                <select class="form-control" id="village"
                                                                    name="village">
                                                                    <option value="">Select</option>
                                                                    <option value="Jaipur">Jaipur</option>
                                                                    <option value="Sanganer">Sanganer</option>
                                                                    <option value="Mansarovar">Mansarovar</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- <div class="col-md-3">
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
                                                                    id="urban" name="urban/rural"
                                                                    placeholder="Urban/Rural" value="">
                                                            </div>
                                                        </div> -->

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="pincode" >Pin Code</label>
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
                                                        <label for="father_name" >Father's Name<span style="color:red;">*</span></label>
                                                        <input type="text" class="form-control "
                                                            id="father_name" name="father_name"
                                                            placeholder="Father's Name" data-required="true" >

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_mobile">Father's Contact No<span style="color:red;">*</span></label>
                                                        <input type="text" class="form-control "
                                                            id="father_mobile" name="father_mobile"
                                                            placeholder="Father's Contact No" data-required="true">

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_occupation" >Father's Occupation</label>
                                                        <input type="text" class="form-control"
                                                            id="father_occupation" name="father_occupation"
                                                            placeholder="Father's Occupation">
                                                    </div>
                                                </div>

                                                <!-- Additional Guardian Details -->
                                                <div id="additionalGuardianDetails" class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mother_name">Mother's Name<span style="color:red;">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="mother_name" name="mother_name"
                                                                    placeholder="Mother's Name" data-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Mother's Contact No</label>
                                                                <input type="text" class="form-control"
                                                                    id="mother_mobile" name="mother_mobile"
                                                                    placeholder="Mother's Contact No">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Mother's Occupation</label>
                                                                <input type="text" class="form-control"
                                                                    id="mother_occupation" name="m_occupation"
                                                                    placeholder="Mother's Occupation">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="guardian_name">Guardian's Name<span style="color:red;">*</span> (If other than
                                                                    parent)</label>
                                                                <input type="text" class="form-control"
                                                                    id="guardian_name" name="guardian_name"
                                                                    placeholder="Guardian's Name" data-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="guardian_mobile">Guardian's Contact No<span style="color:red;">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="guardian_mobile" name="guardian_mobile"
                                                                    placeholder="Guardian's Contact No" data-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="guardian_relation" >Guardian's Relation</label>
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
                                                                <label for="guardian_address">Guardian's Address<span style="color:red;">*</span></label>
                                                                <textarea class="form-control" id="guardian_address" name="guardian_address" placeholder="Guardian's Address"
                                                                    rows="2" data-required="true"></textarea>
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