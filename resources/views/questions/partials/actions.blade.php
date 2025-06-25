
<div class="btn-group">
    <a class="btn btn-xs showQuestion" data-id="{{ $row->id }}" data-question="{{ $row->name ?? '' }}" data-ans_a="{{ $row->ans_a ?? '' }}" data-ans_b="{{ $row->ans_b ?? '' }}" data-ans_c="{{ $row->ans_c ?? '' }}" data-ans_d="{{ $row->ans_d ?? '' }}" data-correct_ans="{{ $row->correct_ans ?? '' }}" >
        <i class="fa fa-eye fs-6 mx-2 text-success"></i>
    </a>
    <a href="{{ url('commonEdit/Question/' . $row->id) }}" class="btn btn-xs">
        <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
    </a>
    <a class="btn-xs delete-btn btn"
        data-modal="Question"
        data-id="{{ $row->id }}"
        data-deleted="{{ $row->deleted_at ? '1' : '0' }}">
        <i class="fa fa-trash fs-6 mx-2 {{ $row->deleted_at ? 'text-warning' : 'text-danger' }}"></i>
    </a>
    @if($row->deleted_at)
        <a class="btn-xs restore-btn btn"
        data-modal="Question"
        data-id="{{ $row->id }}">
            <i class="fa fa-undo fs-6 mx-2 text-info"></i>
        </a>
    @endif


</div>