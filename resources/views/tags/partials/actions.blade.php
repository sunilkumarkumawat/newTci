
<div class="btn-group">
  
    <a href="{{ url('commonEdit/Tags/' . $row->id) }}" class="btn btn-xs">
        <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
    </a>
    <a class="btn-xs delete-btn btn"
        data-modal="Tags"
        data-id="{{ $row->id }}"
        data-deleted="{{ $row->deleted_at ? '1' : '0' }}">
        <i class="fa fa-trash fs-6 mx-2 {{ $row->deleted_at ? 'text-warning' : 'text-danger' }}"></i>
    </a>
    @if($row->deleted_at)
        <a class="btn-xs restore-btn btn"
        data-modal="Tags"
        data-id="{{ $row->id }}">
            <i class="fa fa-undo fs-6 mx-2 text-info"></i>
        </a>
    @endif


</div>