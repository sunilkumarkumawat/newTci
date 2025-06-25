@if (!empty($data) && count($data) > 0)
    @foreach ($data as $index => $tags)
        <tr id="row-{{ $tags->id }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ $tags->name ?? '' }}</td>
            <td>
  
    <div class="btn-group">
        <a href="{{ url('commonEdit/Tags/' . $tags->id) }}" class="btn btn-xs">
            <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
        </a>
 
        
        <a class="btn-xs delete-btn" data-modal='Tags' data-id='{{ $tags->id }}'>
            <i class="fa fa-trash fs-6 text-danger"></i>
        </a>
    </div>

   
            </td>
        </tr>
    @endforeach
@else
    @include('common.noDataFound')
@endif
