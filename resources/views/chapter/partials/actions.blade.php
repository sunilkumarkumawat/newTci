
<div class="btn-group">
    <a href="{{ url('commonEdit/Chapter/' . $row->id) }}" class="btn btn-xs">
        <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
    </a>
    <a class="btn-xs delete-btn" data-modal="Chapter" data-id="{{ $row->id }}">
        <i class="fa fa-trash fs-6 text-danger"></i>
    </a>
</div>