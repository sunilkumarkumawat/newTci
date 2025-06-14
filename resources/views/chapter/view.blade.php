@if (!empty($data) && count($data) > 0)
    @foreach ($data as $index => $chapter)
        <tr id="row-{{ $chapter->id }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ $chapter->name ?? '' }}</td>
            <td>{{ Helper::getName('ClassType', $chapter->class_type_id)->name ?? '' }}</td>
            <td>{{ Helper::getName('Subject', $chapter->subject_id)->name ?? '' }} <small class="text-primary">Total Q : </small></td>
            <td>
  
    <div class="btn-group">
        <a href="{{ url('commonEdit/Chapter/' . $chapter->id) }}" class="btn btn-xs">
            <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
        </a>
 
        
        <a class="btn-xs delete-btn" data-modal='Chapter' data-id='{{ $chapter->id }}'>
            <i class="fa fa-trash fs-6 text-danger"></i>
        </a>
    </div>

   
            </td>
        </tr>
    @endforeach
@else
    @include('common.noDataFound')
@endif
