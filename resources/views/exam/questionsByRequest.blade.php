<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Question</th>
        </tr>
    </thead>
    <tbody>

@if(empty($questions))
    <tr>
        <td colspan="5" class="text-center">No Chapter found.</td>
    </tr>
@else
    @foreach ($questions as $question)
       <tr>
    <td>{{ $loop->iteration }}</td>
    <td>
        {!! $question['name'] ?? '' !!}
    </td>
</tr>

    @endforeach
@endif

    </tbody>
</table>
