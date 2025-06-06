@if (!empty($data) && count($data) > 0)

@foreach ($data as $index => $batch)


<tr id="row-{{ $batch->id }}">
    <td>{{ $index + 1 }}</td>
    <td>{{ $batch->session_name ?? '' }}</td>
    <td>{{ $batch->name ?? '' }}</td>
    <td>{{ $batch->exam_pattern_name ?? '' }}</td>
    <td>
        <div class="btn-group">

            <a href="{{ url('commonEdit/batches/' . $batch->id) }}" class="btn btn-xs">
                <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
            </a>
            <a class="btn-xs delete-btn" data-modal="Batches" data-id="{{ $batch->id }}">
                <i class="fa fa-trash fs-6 text-danger"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
@else
@include('common.noDataFound')
@endif