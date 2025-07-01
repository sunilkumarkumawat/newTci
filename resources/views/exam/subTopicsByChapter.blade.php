<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Topic's Name</th>
            <th>Availability</th>
            <th>Objective</th>
            <th>Numeric</th>
            <th>Preivew</th>
        </tr>
    </thead>
    <tbody>
        @if(empty($topicStats))
            <tr>
                <td colspan="5" class="text-center">No topic found.</td>
            </tr>
        @else
            @foreach ($topicStats as $topic)
                <tr data-objective_ids="{{ $topic['objective_question_ids'] }}"
                    data-numeric_ids="{{ $topic['numeric_question_ids'] }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {!! $topic['topic_name'] ?? '' !!}
                        <a href="javascript:void(0);" class="text-info ms-2"
                            title="View Sub-topics Questions List"
                            onclick="questionsListBySubtopic({{ $topic['topic_id'] }})">
                            <i class="fas fa-folder-open"></i>
                        </a>
                    </td>
                       <td><b>Objective: </b>{{ $topic['objective_count'] }} <br /><b>Numeric: </b>{{ $topic['numeric_count'] }}</td>
                    <td>
                        <input type='text'
                               class='form-control selected_topic_objective_questions'
                               data-topic_id='{{ $topic['topic_id'] }}'
                               data-chapter_id='{{ $chapterId }}' />
                    </td>
                    <td>
                        <input type='text'
                               class='form-control selected_topic_numeric_questions'
                               data-topic_id='{{ $topic['topic_id'] }}'
                               data-chapter_id='{{ $chapterId }}' />
                    </td>
                    <td class='topic_preview' data-chapter_id="{{$chapterId}}"></td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
