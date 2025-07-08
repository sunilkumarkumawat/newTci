    @php
        $permissions = Helper::getPermissions();

    @endphp
    <tbody>
        @if (empty($data))
            @include('common.noDataFound')
        @else
            @foreach ($data as $index => $user)
                <tr>
                    <td>{{ $index + 1 ?? '' }}</td>
                    <td>
                        @include('common.imageViewer', [
                            'modal' => 'User',
                            'id' => $user->id,
                            'field' => 'image',
                            'defaultImage' => 'defaultImages/imageError.png',
                            'alt' => 'User Image',
                        ])

        @foreach ($data as $index => $user)
        <tr>
            <td>{{ $index + 1 ?? '' }}
                <input type="hidden" id='modal_name' value="User">
            </td>
            <td>
                @include('common.imageViewer', [
                'modal' => 'User',
                'id' => $user->id,
                'field' => 'image',
                'defaultImage' => 'defaultImages/imageError.png',
                'alt' => 'User Image',
                ])

            </td>
            <td> @include('commoninputs.inputs', [
                'modal' => 'Role', // This decides the data source
                'name' => 'role_id',
                'selected' => $user->role_id ?? null,
                'label' => 'Role',
                'required' => true,
                'label'=>false,
                'className'=>'updateFieldOnChange',
                'recordId'=> $user->id ?? null,
                ])</td>
            <td>{{ $user->name ?? '' }} {{ $user->last_name ?? '' }}</td>
            <td>{{ $user->mobile ?? '' }}</td>
            <td>{{ $user->email ?? '' }}</td>
            <td>{{ $user->gender_id ?? '' }}</td>
            <td> @include('common.dateViewer', ['date' => $user->dob ?? ''])</td>
            <td>
                @if(in_array('user_management.status', $permissions) || Auth::user()->role_id == 1)
                <button
                    class="user_management.status btn btn-sm w-75 status-change-btn {{ $user->status == 1 ? 'btn-success' : 'btn-danger' }}"
                    id="status-User-{{ $user->id }}" data-modal="User" data-id="{{ $user->id }}"
                    data-status="{{ $user->status }}">
                    {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                </button>
                @else
                {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                @endif
            </td>
            <td>
                @if(in_array('user_management.edit', $permissions) || Auth::user()->role_id == 1)
                <a href="{{ url('commonEdit/User/' . $user->id) }}" class="user_management.edit btn btn-xs">
                    <i class="fa fa-edit text-primary"></i>
                </a>
                @endif
                @if(in_array('user_management.delete', $permissions) || Auth::user()->role_id == 1)
                <a class=" btn-xs delete-btn user_management.delete" data-modal='User' data-id='{{ $user->id }}'>
                    <i class="fa fa-trash fs-6 text-danger"></i></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>

    @endif
