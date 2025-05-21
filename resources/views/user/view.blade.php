     @if (!empty($data))
         @foreach ($data as $index => $user)
             <tr>
                 <td>{{ $index + 1 ?? '' }}</td>
                 <td class="text-center">
                <img src="{{ $user->image ? asset($user->image) : asset('defaultImages/imageError.png') }}"
     class="profileImg" alt="User Image"
     onerror="this.onerror=null; this.src='{{ asset('defaultImages/imageError.png') }}';" />

                 </td>
                 <td>{{ $user->role_id ?? '' }}</td>
                 <td>{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</td>
                 <td>{{ $user->mobile ?? '' }}</td>
                 <td>{{ $user->email ?? '' }}</td>
                 <td>{{ $user->gender ?? '' }}</td>
                 <td>{{ $user->dob ?? '' }}</td>
                 <td>
                     <button
                         class="btn btn-sm w-75 status-change-btn {{ $user->status == 1 ? 'btn-success' : 'btn-danger' }}"
                         id="status-User-{{ $user->id }}" data-modal="User" data-id="{{ $user->id }}"
                         data-status="{{ $user->status }}">
                         {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                     </button>
                 </td>
                 <td>
                     <a href="{{ url('commonEdit/User/' . $user->id) }}" class="btn btn-xs">
                         <i class="fa fa-edit text-primary"></i>
                     </a>
                     <a class=" btn-xs delete-btn" data-modal='User' data-id='{{ $user->id }}'>
                         <i class="fa fa-trash fs-6 text-danger"></i></a>
                 </td>
             </tr>
         @endforeach
     @endif
