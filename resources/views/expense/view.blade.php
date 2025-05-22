@if (!empty($data) && count($data) > 0)


    @foreach ($data as $index => $expense)
        <tr
            class="{{ !empty($isEdit) && isset($data->id, $expense->id) && $data->id == $expense->id ? 'bg-primary' : '' }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ $expense->expense_name ?? '' }}</td>
            <td>
                {{ $expense->expense_date ? \Carbon\Carbon::parse($expense->expense_date)->format('d-m-Y') : '' }}
            </td>
            <td>{{ $expense->quantity ?? '' }}</td>
            <td>{{ $expense->rate ?? '' }}</td>
            <td>{{ $expense->total_amt ?? '' }}</td>
            <td class="text-center">
                <img src="{{ $expense->attachment ? asset($expense->attachment) : asset('defaultImages/attachment.png') }}"
                    class="profileImg" alt="Expense File"
                    onerror="this.onerror=null; this.src='{{ asset('defaultImages/attachment.png') }}';">
            </td>
            <td>
                <div class="btn-group">
                    {{-- <a href="#" class="btn-xs">
                                                                    <i class="fa fa-eye  fs-6  text-info"></i>
                                                                </a> --}}

                    <a href="{{ url('expenseEdit/' . $expense->id) }}" class="btn btn-xs">
                        <i class="fa fa-edit text-primary"></i>
                    </a>
                    <a class=" btn-xs delete-btn" data-modal='Expense' data-id='{{ $expense->id }}'>
                        <i class="fa fa-trash fs-6 text-danger"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
@else
    @include('common.noDataFound')
@endif
