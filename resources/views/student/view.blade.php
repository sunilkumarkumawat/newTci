@php
    $permissions = Helper::getPermissions();
@endphp

<tbody>
    @if (empty($data))
        @include('common.noDataFound')
    @else
        @foreach ($data as $index => $student)
            <tr>
                <td>
                    {{ $index + 1 ?? '' }}
                    <input type="hidden" id="modal_name" value="Student">
                </td>

                <td>
                    @include('common.imageViewer', [
                        'modal' => 'Student',
                        'id' => $student->id,
                        'field' => 'image',
                        'defaultImage' => 'defaultImages/imageError.png',
                        'alt' => 'Student Photo',
                    ])
                </td>
                @if (empty($data))
                    <td>{{ $student->admission_no ?? '' }}</td>
                @endif

                <td>{{ $student->name ?? '' }}</td>
                <td>
                    @include('commoninputs.inputs', [
                        'modal' => 'Batches',
                        'name' => 'class_type_id',
                        'selected' => $student->class_type_id ?? null,
                        'label' => 'Batch',
                        'required' => true,
                        'label' => false,
                        'className' => 'updateFieldOnChange',
                        'recordId' => $student->id ?? null,
                    ])
                </td>
                <td>{{ $student->mobile ?? '' }}</td>
                <td>{{ $student->email ?? '' }}</td>
                <td>
                    @include('commoninputs.inputs', [
                        'modal' => 'Gender',
                        'name' => 'gender',
                        'selected' => $student->gender ?? null,
                        'label' => 'Gender',
                        'required' => true,
                        'label' => false,
                        'className' => 'updateFieldOnChange',
                        'recordId' => $student->id ?? null,
                    ])
                </td>

                <td>
                    @include('common.dateViewer', ['date' => $student->dob ?? ''])
                </td>

                <td>
                    @if (in_array('student_management.status', $permissions) || Auth::user()->role_id == 1)
                        <button
                            class="student_management.status btn btn-sm w-75 status-change-btn {{ $student->status == 1 ? 'btn-success' : 'btn-danger' }}"
                            id="status-Student-{{ $student->id }}" data-modal="Student" data-id="{{ $student->id }}"
                            data-status="{{ $student->status }}">
                            {{ $student->status == 1 ? 'Active' : 'Inactive' }}
                        </button>
                    @else
                        <span class="{{ $student->status == 1 ? 'text-success' : 'text-danger' }}">
                            {{ $student->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    @endif
                </td>

                <td>
                    @if (in_array('student_management.edit', $permissions) || Auth::user()->role_id == 1)
                        <a href="{{ url('commonEdit/Student/' . $student->id) }}"
                            class="student_management.edit btn btn-xs">
                            <i class="fa fa-edit text-primary"></i>
                        </a>
                    @endif

                    @if (in_array('student_management.delete', $permissions) || Auth::user()->role_id == 1)
                        <a class="btn-xs delete-btn student_management.delete" data-modal="Student"
                            data-id="{{ $student->id }}">
                            <i class="fa fa-trash fs-6 text-danger"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    @endif
</tbody>

{{-- apply to all function --}}
{{-- <script>
    $(document).ready(function() {
        // Handle checkbox toggle
        $(document).on('change', '.apply-class-to-all', function() {
            const $row = $(this).closest('tr');
            const $select = $row.find('select[name="class_type_id"]');
            const selectedClass = $select.val();

            if ($(this).is(':checked')) {
                if (!selectedClass) {
                    alert('Please select a Class Type first.');
                    $(this).prop('checked', false);
                    return;
                }

                // Apply the selected class to all rows
                $('select[name="class_type_id"]').each(function() {
                    $(this).val(selectedClass).trigger('change').prop('disabled', true);
                });

                // Check all checkboxes
                $('.apply-class-to-all').prop('checked', true);
            } else {
                // Only uncheck and enable the current row's select
                $select.prop('disabled', false);
                $(this).prop('checked', false);
            }
        });
    });
</script> --}}
