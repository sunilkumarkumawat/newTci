@php
    $filters = $filters ?? ['keyword' => true, 'admission_no' => true, 'status' => true, 'gender_id' => true, 'class_type_id' => true, 'role_id' => true];
@endphp
   
   
    @if(!empty($filters['keyword']))
    <div class="col-md-2">
        <label>Search By Keyword</label>
        <input type="text" name="keyword" class="form-control" placeholder="Ex. Name, Mobile, Email, Aadhaar etc.">
    </div>
    @endif

    @if(!empty($filters['admission_no']))
    <div class="col-md-2">
        <label>Search By Admission No</label>
        <input type="text" name="admission_no" class="form-control" placeholder="Ex. Name, Mobile, Email, Aadhaar etc.">
    </div>
    @endif

    @if(!empty($filters['status']))
    <div class="col-md-2">
        <label>Search By Status</label>
        <select class="form-control" name="status">
            <option value="">Select</option>
            <option value="1">Active</option>
            <option value="2">InActive</option>
        </select>
    </div>
    @endif

    @if(!empty($filters['gender_id']))
    <div class="col-md-2">
        @include('commoninputs.inputs', [
            'modal' => 'Gender',
            'name' => 'gender_id',
            'selected' => null,
            'label' => 'Search By Gender',
            'required' => false,
        ])
    </div>
    @endif

    @if(!empty($filters['class_type_id']))
    <div class="col-md-2">
        @include('commoninputs.inputs', [
            'modal' => 'ClassType',
            'name' => 'class_type_id',
            'selected' => null,
            'label' => 'Search By Class',
            'required' => false,
        ])
    </div>
    @endif

    @if(!empty($filters['role_id']))
    <div class="col-md-2">
        @include('commoninputs.inputs', [
            'modal' => 'Role',
            'name' => 'role_id',
            'selected' => null,
            'label' => 'Search By Role',
            'required' => false,
        ])
    </div>
    @endif

    