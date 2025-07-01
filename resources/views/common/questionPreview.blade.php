<div class="card" id="questionpreview">
    <div class="card-header">
        <div class="card-title">
            <h4>Questions By Subject</h4>
        </div>
        <div class="card-tools">
            <button id="previewhide" class="btn btn-outline-primary" type="button">Close</button>
        </div>
    </div>
    <div class="card-body">

        @foreach ($questionsBySubject as $subject => $questions)
            <div class="row my-4">
                <div class="col-md-12 text-center fw-bold fs-5 text-primary">
                    {{ $subject }}
                </div>
                <div class="col-md-6 text-center text-muted">
                    Section A (English)
                </div>
                <div class="col-md-6 text-center text-muted">
                    Section B (Hindi)
                </div>
            </div>

            @foreach ($questions as $index => $question)
                <div class="row ">
                    <div class="col-md-6 border py-1">
                        <div style="display: grid;">
                            <span class="fw-bold" style="font-size: 14px">
                                Q. {{ $index + 1 }}&#41; {!! $question->name !!}

                            </span>
                            {{-- @php
                                    dd(($question));
                                @endphp --}}
                            @php
                                $options = [
                                    'a)' => $question->ans_a,
                                    'b)' => $question->ans_b,
                                    'c)' => $question->ans_c,
                                    'd)' => $question->ans_d,
                                ];
                            @endphp
                            @foreach ($options as $key => $opt)
                                <span class="py-1" style="font-size: 14px">
                                    <b>{{ $key }}. {!! $opt !!}</b>
                                </span>
                            @endforeach

                        </div>
                    </div>
                    <div class="col-md-6 border">
                        <div style="display: grid;">
                            <span class="fw-bold" style="font-size: 14px">
                                Q. {{ $index + 1 }}) {!! $question->hi_name !!}
                            </span>
                            @php
                                $options = [
                                    'a)' => $question->hi_ans_a,
                                    'b)' => $question->hi_ans_b,
                                    'c)' => $question->hi_ans_c,
                                    'd)' => $question->hi_ans_d,
                                ];
                            @endphp
                            @foreach ($options as $key => $opt)
                                <span class="py-1" style="font-size: 14px">
                                    <b>{{ $key }}. {!! $opt !!}</b>
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>

<script>
    $(document).on('click', '#previewhide', function() {
        $(this).closest('.card').hide();
    });
</script>
