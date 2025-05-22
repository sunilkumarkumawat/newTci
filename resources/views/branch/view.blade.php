<!-- Branch entries will be loaded here -->
@if (!empty($data))
    @foreach ($data as $index => $branch)
        <tr>
            <td>{{ $index + 1 ?? '' }}</td>
            <td>{{ $branch->branch_code ?? '' }}</td>
            <td>{{ $branch->name ?? '' }}</td>
            <td>{{ $branch->contact_person ?? '' }}</td>
            <td>{{ $branch->mobile ?? '' }}</td>
            <td>{{ $branch->email ?? '' }}</td>
            <td>{{ $branch->pin_code ?? '' }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ url('branchEdit/' . $branch->id) }}" class="btn-xs">
                        <i class="fa fa-edit fs-6 mx-2 text-primary"></i>
                    </a>
                    <a class=" btn-xs delete-btn" data-modal='branch' data-id='{{ $branch->id }}'>
                        <i class="fa fa-trash fs-6 text-danger"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
@else
    @include('common.noDataFound')
@endif



<style>
    table {
        border: 1px solid;
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid;
    }
</style>
