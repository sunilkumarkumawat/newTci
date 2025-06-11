
<div class="btn-group">
    <a class="btn btn-xs showQuestion" data-id="{{ $row->id }}" data-question="{{ $row->name ?? '' }}" data-ans_a="{{ $row->ans_a ?? '' }}" data-ans_b="{{ $row->ans_b ?? '' }}" data-ans_c="{{ $row->ans_c ?? '' }}" data-ans_d="{{ $row->ans_d ?? '' }}" data-correct_ans="{{ $row->correct_ans ?? '' }}" >
        <i class="fa fa-eye fs-6 mx-2 text-success"></i>
    </a>
    <a href="{{ url('commonEdit/Question/' . $row->id) }}" class="btn btn-xs">
        <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
    </a>
    <a class="btn-xs delete-btn" data-modal="Question" data-id="{{ $row->id }}">
        <i class="fa fa-trash fs-6 mx-2 text-danger"></i>
    </a>
</div>