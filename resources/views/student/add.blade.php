@extends('layout.app')
@section('content')
    @php
        $isEdit = isset($data);
        $student = $isEdit ? $data ?? [] : [];
        $permissions = Helper::getPermissions();
    @endphp
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12 p-0">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">StudentAdd</li>
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
                                @if(in_array('student_management.view', $permissions)  || Auth::user()->role_id == 1)
                                <a href="{{ url('studentView') }}" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i>
                                    <span class="Display_none_mobile"> {{ __('common.View') }} </span></a>
                                @endif
                            </div>
                        </div>

                        <!-- Profile Upload Section -->
                        <div class="row">
                            <div class="col-md-3 box">
                                <div class="text-center py-4 ">
                                    <div class="card-body  d-flex flex-column justify-content-center align-items-center">
                                        <img id="profilePreview"
                                            src="{{ asset('defaultImages/excel.jpg') }}"
                                            class="img-fluid mb-3  border-dark p-2 larger shadow"
                                            style="width: 120px; height: 120px; object-fit: cover; border-radius:10px"
                                            alt="Excel Upload">

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

                                    <form id="createCommon" enctype="multipart/form-data" data-step="1" data-total_steps='3'> 
                                        @if ($isEdit)
                                            <input type='hidden' value='{{ $student->id }}' name='id' />
                                        @endif
                                        <input type='hidden' value='Student' name='modal_type' />
                                        <input type='hidden' id="branch_id" name='branch_id'
                                            value="{{ old('branch_id', $data->branch_id ?? '') }}" />
                                        <input type="hidden" id="session_id" name="session_id"
                                                value="{{ old('session_id', $data->session_id ?? Session::get('current_session')) }}" />


                                        @csrf


                                        <div class="bg-item border p-3 rounded">
                                            <!-- Step 1: Basic Details -->
                                            <div id="step-1" class="wizard-step">
                                                <h5><i class="fa fa-user"></i> Basic Details</h5>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Admission No.</label>
                                                            <input type="text" class="form-control" id="admissionNo"
                                                                name="admissionNo" placeholder="Admission No."
                                                                value="{{ old('admissionNo', $student->admissionNo ?? '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="name">Student Name <span
                                                                    style="color:red;">*</span></label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control invalid"
                                                                value="{{ old('name', $student->name ?? '') }}"
                                                                placeholder="Student Name" data-required="true">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="mobile">Mobile No. <span
                                                                    style="color:red;">*</span></label>
                                                            <input type="tel" class="form-control" id="mobile"
                                                                name="mobile" placeholder="Mobile No."
                                                                data-required="true" onkeypress="javascript:return isNumber(event)" maxlength="10" minlength="10"
                                                                value="{{ old('mobile', $student->mobile ?? '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        @include('commoninputs.inputs', [
                                                            'modal' => 'Batches', // This decides the data source
                                                            'name' => 'class_type_id',
                                                            'selected' => $student->class_type_id ?? null,
                                                            'label' => 'Batch',
                                                            'required' => true,
                                                        ])
                                                    </div>

                                                    <div class="col-md-4">
                                                        @include('commoninputs.inputs', [
                                                            'modal' => 'Gender', // This decides the data source
                                                            'name' => 'gender_id',
                                                            'selected' => $student->gender_id ?? null,
                                                            'label' => 'Gender',
                                                            'required' => true,
                                                        ])
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="dob">Date Of Birth <span
                                                                    style="color:red;">*</span></label>
                                                            <input type="date" class="form-control" id="dob"
                                                                name="dob" placeholder="Date Of Birth"
                                                                data-required="true"
                                                                value="{{ old('dob', $student->dob ?? '') }}">
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="admission_date">Date Of Admission  <span
                                                                    style="color:red;">*</span></label>
                                                            <input type="date" class="form-control"
                                                                id="admission_date" name="admission_date"
                                                                data-required="true"
                                                                value="{{ old('admission_date', $student->admission_date ?? date('Y-m-d')) }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Email <span
                                                                    style="color:red;">*</span></label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" placeholder="Email" data-required="true"
                                                                value="{{ old('email', $student->email ?? '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="address">Students Address <span
                                                                    style="color:red;">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="address" name="address"
                                                                placeholder="Students Address" data-required="true"
                                                                value="{{ old('address', $student->address ?? '') }}">
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
                                                            <!-- <div class="col-md-12 mb-2">
                                                                <h6 class="text-primary">Personal Information</h6>
                                                            </div> -->

                                                            <!-- <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="religion">Religion<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control" id="religion"
                                                                        name="religion" data-required="true">
                                                                        <option value="">Select</option>
                                                                        <option value="Hindu"
                                                                            {{ old('religion', $student->religion ?? '') == 'Hindu' ? 'selected' : '' }}>
                                                                            Hindu</option>
                                                                        <option value="Islam"
                                                                            {{ old('religion', $student->religion ?? '') == 'Islam' ? 'selected' : '' }}>
                                                                            Islam</option>
                                                                        <option value="Sikh"
                                                                            {{ old('religion', $student->religion ?? '') == 'Sikh' ? 'selected' : '' }}>
                                                                            Sikh</option>
                                                                        <option value="Buddhism"
                                                                            {{ old('religion', $student->religion ?? '') == 'Buddhism' ? 'selected' : '' }}>
                                                                            Buddhism</option>
                                                                        <option value="Adivasi"
                                                                            {{ old('religion', $student->religion ?? '') == 'Adivasi' ? 'selected' : '' }}>
                                                                            Adivasi</option>
                                                                        <option value="Jain"
                                                                            {{ old('religion', $student->religion ?? '') == 'Jain' ? 'selected' : '' }}>
                                                                            Jain</option>
                                                                        <option value="Christianity"
                                                                            {{ old('religion', $student->religion ?? '') == 'Christianity' ? 'selected' : '' }}>
                                                                            Christianity</option>
                                                                        <option value="Other"
                                                                            {{ old('religion', $student->religion ?? '') == 'Other' ? 'selected' : '' }}>
                                                                            Other</option>
                                                                    </select>
                                                                </div>
                                                            </div> -->

                                                            <!-- <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="category">Category<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control" id="category"
                                                                        name="category" data-required="true">
                                                                        <option value="">Select</option>
                                                                        <option value="OBC"
                                                                            {{ old('category', $student->category ?? '') == 'OBC' ? 'selected' : '' }}>
                                                                            OBC</option>
                                                                        <option value="ST"
                                                                            {{ old('category', $student->category ?? '') == 'ST' ? 'selected' : '' }}>
                                                                            ST</option>
                                                                        <option value="SC"
                                                                            {{ old('category', $student->category ?? '') == 'SC' ? 'selected' : '' }}>
                                                                            SC</option>
                                                                        <option value="BC"
                                                                            {{ old('category', $student->category ?? '') == 'BC' ? 'selected' : '' }}>
                                                                            BC</option>
                                                                        <option value="GEN"
                                                                            {{ old('category', $student->category ?? '') == 'GEN' ? 'selected' : '' }}>
                                                                            GEN</option>
                                                                        <option value="SBC"
                                                                            {{ old('category', $student->category ?? '') == 'SBC' ? 'selected' : '' }}>
                                                                            SBC</option>
                                                                        <option value="Other"
                                                                            {{ old('category', $student->category ?? '') == 'Other' ? 'selected' : '' }}>
                                                                            Other</option>
                                                                    </select>
                                                                </div>
                                                            </div> -->

                                                            <!-- <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="caste">Caste</label>
                                                                    <input type="text" class="form-control"
                                                                        id="caste" name="caste" placeholder="Caste"
                                                                        value="{{ old('caste', $student->caste ?? '') }}">
                                                                </div>
                                                            </div> -->

                                                            <!-- <div class="col-md-3">
                                                                @include('commoninputs.inputs', [
                                                                    'modal' => 'BloodGroup', // This decides the data source
                                                                    'name' => 'bloodgroup_id',
                                                                    'selected' => $student->bloodgroup_id ?? null,
                                                                    'label' => 'Select Blood Group',
                                                                    'required' => false,
                                                                ])
                                                            </div> -->

                                                            <div class="col-md-12 mb-2 mt-3">
                                                                <h6 class="text-primary">Location Information</h6>
                                                            </div>

                                                            <!-- <div class="col-md-3">
                                                                @include('commoninputs.inputs', [
                                                                    'modal' => 'Country', // This decides the data source
                                                                    'name' => 'country_id',
                                                                    'selected' => $student->country_id ?? null,
                                                                    'label' => 'Country',
                                                                    'required' => true,
                                                                    'attributes' => [
                                                                        'data-dependent' => 'state_id',
                                                                        'data-url' => url(
                                                                            '/get-dependent-options'),
                                                                        'data-modal' => 'State',
                                                                        'data-field' => 'country_id',
                                                                    ],
                                                                ])
                                                            </div> -->

                                                            <div class="col-md-3">
                                                                @include('commoninputs.dependentInputs', [
                                                                    'modal' => 'State',
                                                                    'name' => 'state_id',
                                                                    'selected' => $student->state_id ?? null,
                                                                    'label' => 'State',
                                                                    'required' => false,
                                                                    'isRequestSent' => 101,
                                                                    'dependentId' => 101,
                                                                    'foreignKey' => 'country_id',
                                                                    'attributes' => [
                                                                        'data-dependent' => 'city_id',
                                                                        'data-url' => url(
                                                                            '/get-dependent-options'),
                                                                        'data-modal' => 'City',
                                                                        'data-field' => 'state_id',
                                                                    ],
                                                                ])
                                                            </div>

                                                            <div class="col-md-3">
                                                                @include('commoninputs.dependentInputs', [
                                                                    'modal' => 'City',
                                                                    'name' => 'city_id',
                                                                    'selected' => $student->city_id ?? null,
                                                                    'label' => 'City',
                                                                    'required' => false,
                                                                    'isRequestSent' => isset($student->state_id),
                                                                    'dependentId' => $student->state_id ?? null,
                                                                    'foreignKey' => 'state_id',
                                                                ])
                                                            </div>

                                                            <!-- <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="village">Village/City</label>
                                                                    <select class="form-control" id="village"
                                                                        name="village">
                                                                        <option value="">Select</option>
                                                                        <option value="Jaipur"
                                                                            {{ old('village', $student->village ?? '') == 'Jaipur' ? 'selected' : '' }}>
                                                                            Jaipur</option>
                                                                        <option value="Sanganer"
                                                                            {{ old('village', $student->village ?? '') == 'Sanganer' ? 'selected' : '' }}>
                                                                            Sanganer</option>
                                                                        <option value="Mansarovar"
                                                                            {{ old('village', $student->village ?? '') == 'Mansarovar' ? 'selected' : '' }}>
                                                                            Mansarovar</option>
                                                                    </select>
                                                                </div>
                                                            </div> -->

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="pincode">Pin Code</label>
                                                                    <input type="tel" class="form-control"
                                                                        id="pincode" name="pincode"
                                                                        placeholder="Pin Code" onkeypress="javascript:return isNumber(event)" 
                                                                        value="{{ old('pincode', $student->pincode ?? '') }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="aadhaar">Aadhaar No. </label>
                                                                    <input type="tel" class="form-control" id="aadhaar"
                                                                        name="aadhaar" placeholder="Aadhaar No."
                                                                        data-required="false" onkeypress="javascript:return isNumber(event)" maxlength="12" minlength="12"
                                                                        value="{{ old('aadhaar', $student->aadhaar ?? '') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Photo</label>
                                                                    <input type="file" class="form-control" name="image"
                                                                        accept="image/*">
                                                                    <!-- No value for file inputs for security reasons -->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Aadhaar Image</label>
                                                                    <input type="file" class="form-control" name="aadhaar_image"
                                                                        accept="image/*">
                                                                    <!-- No value for file inputs for security reasons -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Step 3: Guardian Details -->
                                            <div id="step-3" class="wizard-step">
                                                <h5><i class="fa fa-hands-holding-child"></i> Guardian Details</h5>
                                                <div class="row">
                                                    <!-- Required Guardian Details -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="father_name">Father's Name <span
                                                                    style="color:red;">*</span></label>
                                                            <input type="text" class="form-control" id="father_name"
                                                                name="father_name" placeholder="Father's Name"
                                                                value="{{ old('father_name', $student->father_name ?? '') }}"
                                                                data-required="true">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="father_mobile">Father's Contact No <span
                                                                    style="color:red;">*</span></label>
                                                            <input type="tel" class="form-control" id="father_mobile"
                                                                name="father_mobile" placeholder="Father's Contact No"
                                                                value="{{ old('father_mobile', $student->father_mobile ?? '') }}"
                                                                data-required="true" onkeypress="javascript:return isNumber(event)" maxlength="10" minlegth="10">
                                                        </div>
                                                    </div>

                                                    <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="father_occupation">Father's Occupation</label>
                                                            <input type="text" class="form-control"
                                                                id="father_occupation" name="father_occupation"
                                                                placeholder="Father's Occupation"
                                                                value="{{ old('father_occupation', $student->father_occupation ?? '') }}">
                                                        </div>
                                                    </div> -->

                                                    <!-- Additional Guardian Details -->
                                                    <div id="additionalGuardianDetails" class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="mother_name">Mother's Name <span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="mother_name" name="mother_name"
                                                                        placeholder="Mother's Name"
                                                                        value="{{ old('mother_name', $student->mother_name ?? '') }}"
                                                                        data-required="true">
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="mother_mobile">Mother's Contact No</label>
                                                                    <input type="text" class="form-control"
                                                                        id="mother_mobile" name="mother_mobile"
                                                                        placeholder="Mother's Contact No"
                                                                        value="{{ old('mother_mobile', $student->mother_mobile ?? '') }}">
                                                                </div>
                                                            </div> -->

                                                            <!-- <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="mother_occupation">Mother's
                                                                        Occupation</label>
                                                                    <input type="text" class="form-control"
                                                                        id="mother_occupation" name="mother_occupation"
                                                                        placeholder="Mother's Occupation"
                                                                        value="{{ old('mother_occupation', $student->mother_occupation ?? '') }}">
                                                                </div>
                                                            </div> -->

                                                            <!-- <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="guardian_name">Guardian's Name <span
                                                                            style="color:red;">*</span> (If other than
                                                                        parent)</label>
                                                                    <input type="text" class="form-control"
                                                                        id="guardian_name" name="guardian_name"
                                                                        placeholder="Guardian's Name"
                                                                        
                                                                        value="{{ old('guardian_name', $student->guardian_name ?? '') }}"
                                                                        required>
                                                                </div>
                                                            </div> -->

                                                            <!-- <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="guardian_mobile">Guardian's Contact No
                                                                        <span style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="guardian_mobile" name="guardian_mobile"
                                                                        placeholder="Guardian's Contact No"
                                                                        value="{{ old('guardian_mobile', $student->guardian_mobile ?? '') }}"
                                                                        required>
                                                                </div>
                                                            </div> -->

                                                            <!-- <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="guardian_relation">Guardian's
                                                                        Relation</label>
                                                                    <select class="form-control" id="guardian_relation"
                                                                        name="guardian_relation">
                                                                        <option value="">Select</option>
                                                                        <option value="Grandfather"
                                                                            {{ old('guardian_relation', $student->guardian_relation ?? '') == 'Grandfather' ? 'selected' : '' }}>
                                                                            Grandfather</option>
                                                                        <option value="Grandmother"
                                                                            {{ old('guardian_relation', $student->guardian_relation ?? '') == 'Grandmother' ? 'selected' : '' }}>
                                                                            Grandmother</option>
                                                                        <option value="Uncle"
                                                                            {{ old('guardian_relation', $student->guardian_relation ?? '') == 'Uncle' ? 'selected' : '' }}>
                                                                            Uncle</option>
                                                                        <option value="Aunt"
                                                                            {{ old('guardian_relation', $student->guardian_relation ?? '') == 'Aunt' ? 'selected' : '' }}>
                                                                            Aunt</option>
                                                                        <option value="Other"
                                                                            {{ old('guardian_relation', $student->guardian_relation ?? '') == 'Other' ? 'selected' : '' }}>
                                                                            Other</option>
                                                                    </select>
                                                                </div>
                                                            </div> -->

                                                            <!-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="guardian_address">Guardian's Address <span
                                                                            style="color:red;">*</span></label>
                                                                    <textarea class="form-control" id="guardian_address" name="guardian_address" placeholder="Guardian's Address"
                                                                        rows="2" required>{{ old('guardian_address', $student->guardian_address ?? '') }}</textarea>
                                                                </div>
                                                            </div> -->
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
                 $('#createCommon').attr('data-step',currentStep);
            }
        });



        document.getElementById('prevStep').addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
                $('#createCommon').attr('data-step',currentStep);
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
