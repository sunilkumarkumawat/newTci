  @if (!empty($data))
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
              <td>{{ $studentAdd->student_name ?? '' }}</td>
              <td>{{ $studentAdd->mobile ?? '' }}</td>
              <td>{{ $studentAdd->email ?? '' }}</td>
              <td>{{ $studentAdd->admission_date ?? '' }}</td>
              <td>{{ $studentAdd->city_id ?? '' }}</td>
              <td>
                  <button
                      class="btn btn-sm w-75 status-change-btn {{ $studentAdd->status == 1 ? 'btn-success' : 'btn-danger' }}"
                      id="status-Student-{{ $studentAdd->id }}" data-modal="Student" data-id="{{ $studentAdd->id }}"
                      data-status="{{ $studentAdd->status }}">
                      {{ $studentAdd->status == 1 ? 'Active' : 'Inactive' }}
                  </button>
              </td>
              <td>
                  <a href="{{ url('commonEdit/Student/' . $studentAdd->id) }}" class="btn btn-xs"><i
                          class="fa fa-edit text-primary"></i></a>
                  <a class=" btn-xs delete-btn" data-modal="Student" data-id="{{ $studentAdd->id }}">
                      <i class="fa fa-trash fs-6 text-danger"></i></a>
              </td>
          </tr>
      @endforeach
  @else
      @include('common.noDataFound')
  @endif
