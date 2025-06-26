
            @if($questions->isEmpty())
            <tr>
                <td colspan="5" class="text-center">No questions found.</td>
            </tr>
            @else
            @foreach ($questions as $question)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{!! $question->name ?? '' !!}</td> {{-- Use {!! !!} for LaTeX support --}}
                <td>{{ $question->total_questions ?? '' }}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
            @endif
       

<script>
window.MathJax = {
  tex: {
    inlineMath: [['$', '$'], ['\\(', '\\)']],
    displayMath: [['$$', '$$'], ['\\[', '\\]']],
    processEscapes: true
  },
  svg: {
    fontCache: 'global'
  }
};
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>