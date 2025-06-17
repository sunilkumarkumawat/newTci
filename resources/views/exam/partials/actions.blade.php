<div class="btn-group">
    {{-- View Exam --}}
    <a class="btn btn-xs showExam" data-id="{{ $row->id }}"
        data-name="{{ $row->exam_name ?? '' }}"
        data-status="{{ $row->status ?? '' }}"
        data-created_at="{{ $row->created_at ?? '' }}">
        <i class="fa fa-eye fs-6 mx-2 text-success"></i>
    </a>

    {{-- Edit Exam --}}
    <a href="{{ url('createExam?query=' . $row->id) }}" class="btn btn-xs">
        <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
    </a>

    {{-- Delete Exam --}}
    <a class="btn-xs delete-btn btn"
        data-modal="Exam"
        data-id="{{ $row->id }}"
        data-deleted="{{ $row->deleted_at ? '1' : '0' }}">
        <i class="fa fa-trash fs-6 mx-2 {{ $row->deleted_at ? 'text-warning' : 'text-danger' }}"></i>
    </a>

    {{-- Restore Exam --}}
    @if($row->deleted_at)
        <a class="btn-xs restore-btn btn"
            data-modal="Exam"
            data-id="{{ $row->id }}">
            <i class="fa fa-undo fs-6 mx-2 text-info"></i>
        </a>
    @endif
</div>
