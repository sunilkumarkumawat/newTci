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
      <tr 
    onclick="selectQuestion({{ $question['id'] ?? 'null' }}, {{ $question['question_type_id'] ?? 'null' }}, {{ $question['chapter_id'] ?? 'null' }})"
    class="question-row"
    data-id="{{ $question['id'] ?? '' }}"
    data-type="{{ $question['question_type_id'] ?? '' }}"
    data-chapterid="{{ $question['chapter_id'] ?? '' }}"
>
    <td>{{ $loop->iteration }}</td>
    <td>
        {!! $question['name'] ?? '' !!}
    </td>
</tr>

    @endforeach
@endif

    </tbody>
</table>
