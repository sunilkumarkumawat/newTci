@if (!empty($data) && count($data) > 0)
    @foreach ($data as $index => $role)
        <tr id="row-{{ $role->id }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ $role->name ?? '' }}</td>
            <td>
   @if(!in_array($role->id, [1, 2,3]))
    <div class="btn-group">
        <a href="{{ url('commonEdit/Role/' . $role->id) }}" class="btn btn-xs">
            <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
        </a>
        <a class="btn-xs delete-btn" data-modal='Role' data-id='{{ $role->id }}'>
            <i class="fa fa-trash fs-6 text-danger"></i>
        </a>
    </div>

    @else
    <!-- <span class='text-danger'>You can't modify or delete this role</span> -->
       @if(!in_array($role->id, [1]))
    <button type="button" class="open-permission-modal" data-id="{{ $role->id }}">
    <i class="fa fa-lock fs-6 text-info"></i> Permission
</button>

@endif
@endif
            </td>
        </tr>
    @endforeach
@else
    @include('common.noDataFound')
@endif
