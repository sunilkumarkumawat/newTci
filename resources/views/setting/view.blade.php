@if (!empty($data) && count($data) > 0)
    @foreach ($data as $index => $setting)
        <tr id="row-{{ $setting->id }}">
            <td>{{ $index + 1 }}</td>
            <td>
                     @include('common.imageViewer', [
                      'modal' => 'Setting',
                      'id' => $setting->id,
                      'field' => 'left_logo',
                      'defaultImage' => 'defaultImages/imageError.png',
                      'alt' => 'Setting Image',
                  ])

            </td>
            <td>{{ $setting->name ?? '' }}</td>
            <td>{{ $setting->gmail ?? '' }}</td>
            <td>{{ $setting->mobile ?? '' }}</td>
            <td>{{ $setting->address ?? '' }}</td>
            <td>
  
    <div class="btn-group">
        <a href="{{ url('commonEdit/Setting/' . $setting->id) }}" class="btn btn-xs">
            <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
        </a>
        <!-- <a class="btn-xs delete-btn" data-modal='Setting' data-id='{{ $setting->id }}'>
            <i class="fa fa-trash fs-6 text-danger"></i>
        </a> -->
    </div>


            </td>
        </tr>
    @endforeach
@else
    @include('common.noDataFound')
@endif
