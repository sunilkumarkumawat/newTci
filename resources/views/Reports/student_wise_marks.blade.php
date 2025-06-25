<div class="table-responsive mt-2 ">
    <table class="table table-bordered table-striped mt-4">
        <thead>
            <tr class="bg-light">
                <th>Sr.</th>
                <th>Admission No.</th>
                <th>Student Name</th>
                <th>Batch</th>
                <th>Exam Date</th>
                <th>Exam Name</th>
                <th>Total Questions</th>
                <th>Attempted</th>
                <th>Correct</th>
                <th>Incorrect</th>
                <th>Unattempted</th>
                <th>Marks Scored</th>
                <th>Accuracy</th>
                <th>Time Taken</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $sr = 1;
            @endphp
            @foreach($report_data as $data)
                <tr>
                    <td>{{ $sr++ }}</td>
                    <td>{{ $data['admission_no'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['batch'] }}</td>
                    <td>{{ $data['exam_date'] }}</td>
                    <td>{{ $data['exam_name'] }}</td>
                    <td>{{ $data['total_questions'] }}</td>
                    <td>{{ $data['attempted'] }}</td>
                    <td>{{ $data['correct'] }}</td>
                    <td>{{ $data['incorrect'] }}</td>
                    <td>{{ $data['unattempted'] }}</td>
                    <td>{{ $data['marks_scored'] }}</td>
                    <td>{{ $data['accuracy'] }}</td>
                    <td>{{ $data['time_taken'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>