@if (!empty($data) && count($data) > 0)
    @foreach ($data as $index => $subject)
        <tr id="row-{{ $subject->id }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ $subject->name ?? '' }}</td>
            <td>
  
    <div class="btn-group">
        <a href="{{ url('commonEdit/Subject/' . $subject->id) }}" class="btn btn-xs">
            <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
        </a>
 
        
        <a class="btn-xs delete-btn" data-modal='Subject' data-id='{{ $subject->id }}'>
            <i class="fa fa-trash fs-6 text-danger"></i>
        </a>
    </div>

   
            </td>
        </tr>
    @endforeach
@else
    @include('common.noDataFound')
@endif
