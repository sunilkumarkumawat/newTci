@php
    $permissions = Helper::getPermissions();
@endphp

<tbody>
    @if (empty($data))
        @include('common.noDataFound')
    @else
        @foreach ($data as $index => $studentAdd)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @include('common.imageViewer', [
                        'modal' => 'Student',
                        'id' => $studentAdd->id,
                        'field' => 'image',
                        'defaultImage' => 'defaultImages/imageError.png',
                        'alt' => 'Student Photo',
                    ])


                </td>
                <td>
                    @include('commoninputs.inputs', [
                        'modal' => 'ClassType', // This decides the data source
                        'name' => 'class_id',
                        'selected' => $student->class_id ?? null,
                        'label' => 'Class',
                        'required' => true,
                        'label' => false,
                    ])</td>
                </td>
                <td>{{ $studentAdd->name ?? '' }}</td>
                <td>{{ $studentAdd->mobile ?? '' }}</td>
                <td>{{ $studentAdd->email ?? '' }}</td>
                <td>{{ $studentAdd->gender ?? '' }}</td>
                <td>
                <td>
                    @include('common.dateViewer', ['date' => $studentAdd->admission_date])
                </td>
                </td>
                <td>{{ $studentAdd->city_id ?? '' }}</td>
                <td>
                    @if (in_array('student_management.status', $permissions) || Auth::user()->role_id == 1)
                        <button
                            class="student_management.status btn btn-sm w-75 status-change-btn {{ $studentAdd->status == 1 ? 'btn-success' : 'btn-danger' }}"
                            id="status-Student-{{ $studentAdd->id }}" data-modal="Student" data-id="{{ $studentAdd->id }}"
                            data-status="{{ $studentAdd->status }}">
                            {{ $studentAdd->status == 1 ? 'Active' : 'Inactive' }}
                        </button>
                    @else
                        <span
                            class="{{ $studentAdd->status == 1 ? 'text-success' : 'text-danger' }}">{{ $studentAdd->status == 1 ? 'Active' : 'Inactive' }}</span>
                    @endif
                </td>
                <td>
                    @if (in_array('student_management.edit', $permissions) || Auth::user()->role_id == 1)
                        <a href="{{ url('commonEdit/Student/' . $studentAdd->id) }}"
                            class="student_management.edit btn btn-xs"><i class="fa fa-edit text-primary"></i></a>
                    @endif
                    @if (in_array('student_management.delete', $permissions) || Auth::user()->role_id == 1)
                        <a class="student_management.delete btn-xs delete-btn" data-modal="Student"
                            data-id="{{ $studentAdd->id }}">
                            <i class="fa fa-trash fs-6 text-danger"></i></a>
                    @endif
                </td>
            </tr>
        @endforeach
</tbody>
@endif
