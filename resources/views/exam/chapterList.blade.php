@if(empty($chapterStats))
    <tr>
        <td colspan="5" class="text-center">No Chapter found.</td>
    </tr>
@else
    @foreach ($chapterStats as $chapter)
       <tr 
       data-total_questions="{{ $chapter['total_questions'] }}"
       data-objective_ids="{{ $chapter['objective_question_ids'] }}"
       data-numberic_ids="{{ $chapter['numeric_question_ids'] }}"
       data-chapter_id="{{ $chapter['chapter_id'] }}"
       >
    <td>{{ $loop->iteration }}</td>
    <td >
        {!! $chapter['chapter_name'] ?? '' !!}

        <!-- Sub-topic List Icon -->
        <a href="javascript:void(0);" 
           class="text-info ms-2"
           title="View Sub-topics"
           onclick="openSubTopics({{ $chapter['chapter_id'] }})">
            <i class="fas fa-folder-open"></i>
        </a>

        <!-- Questions List Icon -->
        <a href="javascript:void(0);" 
           class="text-success ms-2"
           title="View Questions"
           onclick="openQuestionsList({{ $chapter['chapter_id'] }})">
            <i class="fas fa-list"></i>
        </a>
    </td>

    <td><b>Objective: </b>{{ $chapter['objective_count'] }} <br /><b>Numeric: </b>{{ $chapter['numeric_count'] }}</td>
    <td><input type='text' class='form-control selected_objective_questions'  /></td>
    <td><input type='text' class='form-control selected_numeric_questions'  /></td>
    <td class='preview'></td>
</tr>

    @endforeach
@endif
