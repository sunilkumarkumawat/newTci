@if (!empty($data) && count($data) > 0)
    @foreach ($data as $index => $topic)
        <tr id="row-{{ $topic->id }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ $topic->name ?? '' }} <small class="text-primary">Total Q : {{ Helper::getThisCount('Question', 'topic_id', $topic->id) ?? '0' }}</small></td>
            <td>{{ Helper::getName('ClassType', $topic->class_type_id)->name ?? '' }}</td>
            <td>{{ Helper::getName('Subject', $topic->subject_id)->name ?? '' }} </td>
            <td>{{ Helper::getName('Chapter', $topic->chapter_id)->name ?? '' }}</td>
            <td>
  
    <div class="btn-group">
        <a href="{{ url('commonEdit/Topic/' . $topic->id) }}" class="btn btn-xs">
            <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
        </a>
 
        
        <a class="btn-xs delete-btn" data-modal='Topic' data-id='{{ $topic->id }}'>
            <i class="fa fa-trash fs-6 text-danger"></i>
        </a>
    </div>

   
            </td>
        </tr>
    @endforeach
@else
    @include('common.noDataFound')
@endif
