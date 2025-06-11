@php
$filters = $filters ?? ['keyword' => true,'batches'=>true, 'admission_no' => true, 'status' => true, 'gender_id' => true, 'class_type_id' => true, 'role_id' => true, 'question_type_id' => true, 'suka_id' => true, 'level_id' => true, 'topic_id' => true, 'chapter_id' => true, 'subject_id' => true, 'batches' => true, 'tags' =>true, 'source_id' => true];
@endphp


@foreach($filters as $filterKey => $enabled)
@if(!$enabled) @continue @endif

@switch($filterKey)

@case('keyword')
<div class="col-md-2">
    <label>Search By Keyword</label>
    <input type="text" name="keyword" class="form-control" placeholder="Ex. Name, Mobile, Email, Aadhaar etc.">
</div>
@break

@case('admission_no')
<div class="col-md-2">
    <label>Search By Admission No</label>
    <input type="text" name="admission_no" class="form-control" placeholder="Ex. Name, Mobile, Email, Aadhaar etc.">
</div>
@break

@case('status')
<div class="col-md-2">
    <label>Search By Status</label>
    <select class="form-control" name="status">
        <option value="">Select</option>
        <option value="1">Active</option>
        <option value="2">InActive</option>
    </select>
</div>
@break

@case('gender_id')
<div class="col-md-2">
    @include('commoninputs.inputs', [
    'modal' => 'Gender',
    'name' => 'gender_id',
    'selected' => null,
    'label' => 'Search By Gender',
    'required' => false,
    ])
</div>
@break

@case('class_type_id')
<div class="col-md-2">
@include('commoninputs.inputs', [
'modal' => 'ClassType',
'name' => 'class_type_id',
'selected' => $data->class_type_id ?? null,
'label' => 'Search By Class',
'required' => true,
'attributes' => [
'data-dependent' => 'subject_id',
'data-url' => url(
'/get-dependent-options'),
'data-modal' => 'AssignedSubjects',
'data-field' => 'class_type_id',
],
])
</div>
@break

@case('batches')
<div class="col-md-2">
    @include('commoninputs.inputs', [
    'modal' => 'Batches',
    'name' => 'class_type_id',
    'selected' => null,
    'label' => 'Search By Batch',
    'required' => false,
    ])
</div>
@break

@case('subject_id')
<div class="col-md-2">
    @include('commoninputs.dependentInputs', [
    'modal' => 'AssignedSubjects',
    'name' => 'subject_id',
    'selected' => $data->subject_id ?? null,
    'label' => 'Subject',
    'required' => true,
    'isRequestSent' => isset($data->class_type_id),
    'dependentId' => $data->class_type_id ?? null,
    'foreignKey' => 'class_type_id',
    'attributes' => [
    'data-dependent' => 'chapter_id',
    'data-url' => url(
    '/get-dependent-options'),
    'data-modal' => 'Chapter',
    'data-field' => 'subject_id',
    ],
    ])
</div>
@break

@case('chapter_id')
<div class="col-md-2">
    @include('commoninputs.dependentInputs', [
    'modal' => 'Chapter',
    'name' => 'chapter_id',
    'selected' => $data->chapter_id ?? null,
    'label' => 'Chapter',
    'required' => true,
    'isRequestSent' => isset($data->subject_id),
    'dependentId' => $data->subject_id ?? null,
    'foreignKey' => 'subject_id',
    'attributes' => [
    'data-dependent' => 'topic_id',
    'data-url' => url(
    '/get-dependent-options'),
    'data-modal' => 'Topic',
    'data-field' => 'chapter_id',
    ],
    ])
</div>
@break

@case('topic_id')
<div class="col-md-2">
    @include('commoninputs.dependentInputs', [
    'modal' => 'Topic',
    'name' => 'topic_id',
    'selected' => $data->topic_id ?? null,
    'label' => 'Topic',
    'required' => true,
    'isRequestSent' => isset($data->chapter_id),
    'dependentId' => $data->chapter_id ?? null,
    'foreignKey' => 'chapter_id',
    ])
</div>
@break

@case('level_id')
<div class="col-md-2">
    @include('commoninputs.inputs', [
    'modal' => 'Level',
    'name' => 'level_id',
    'selected' => null,
    'label' => 'Search By Level',
    'required' => false,
    ])
</div>
@break

@case('suka_id')
<div class="col-md-2">
    @include('commoninputs.inputs', [
    'modal' => 'Suka',
    'name' => 'suka_id',
    'selected' => null,
    'label' => 'Search By Suka',
    'required' => false,
    ])
</div>
@break

@case('question_type_id')
<div class="col-md-2">
    @include('commoninputs.inputs', [
    'modal' => 'QuestionType',
    'name' => 'question_type_id',
    'selected' => null,
    'label' => 'Search By Question Type',
    'required' => false,
    ])
</div>
@break

@case('role_id')
<div class="col-md-2">
    @include('commoninputs.inputs', [
    'modal' => 'Role',
    'name' => 'role_id',
    'selected' => null,
    'label' => 'Search By Role',
    'required' => false,
    ])
</div>
@break

@case('language')
<div class="col-md-2">
    <label>Search By Language</label>
    <select class="form-control" name="language">
        <option value="">Select</option>
        <option value="1">English</option>
        <option value="2">Hindi</option>
    </select>
</div>
@break

@case('use')
<div class="col-md-2">
    <label>Search By Use</label>
    <select class="form-control" name="use">
        <option value="">Select</option>
        <option value="1">Used In Test</option>
        <option value="2">Unused</option>
    </select>
</div>
@break

@case('tags')
<div class="col-md-2">
    @include('commoninputs.inputs', [
    'modal' => 'Tags',
    'name' => 'tags',
    'selected' => null,
    'label' => 'Search By Tags',
    'required' => false,
    ])
</div>
@break

@case('source_id')
<div class="col-md-2">
    @include('commoninputs.inputs', [
    'modal' => 'Source',
    'name' => 'source_id',
    'selected' => null,
    'label' => 'Search By Source',
    'required' => false,
    ])
</div>
@break

@endswitch
@endforeach