@extends('layout.app')
@section('content')
@php
    $filterable_columns = [
        'class_type_id'=>false, 
        'subject_id'=>false, 
        'chapter_id'=>false, 
        'topic_id'=>false, 
        'level_id'=>false, 
        'suka_id'=>false, 
        'question_type_id'=>false, 
        'status'=>false, 
        'language'=>false, 
        'use'=>false, 
        'tags'=>false, 
        'source_id'=>false, 
        'is_deleted'=>false,
        'select_exam'=>true,
        'batches'=>true,
        'keyword'=>false,
        'from_date'=>true,
        'to_date'=>true,
    ];
@endphp
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12 p-0">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Test Reports</li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title">
                            <h4><i class="fa fa-desktop"></i> &nbsp;Test Reports</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="bg-item border p-3 rounded">
                            <form id="quickForm" method="post" action="{{ url('get-report-data')}}">
                                <div class="row">
                                    
                                    @include('commoninputs.filterinputs', [
                                        'filters' => $filterable_columns
                                    ])
                                    
                                    <!-- <div class="col-md-2 col-12">
                                        <label>Report Type</label>
                                        <select name="report_type" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">Student Wise Marks</option>
                                            <option value="2">Accuracy</option>
                                            <option value="3">Attempted</option>
                                            <option value="4">Unattempted</option>
                                            <option value="5">Topper Report</option>
                                        </select>
                                    </div> -->

                                    <div class="col-md-1 col-12 mt-4">
                                        <button type="submit" class="btn btn-primary w-100">Search</button>
                                    </div>
                                    <div class="col-md-1 col-12 mt-4">
                                        <button type="button" id="exportExcel" class="btn btn-info w-100 export_button d-none">Excel</button>
                                    </div>
                                    <div class="col-md-1 col-12 mt-4">
                                        <button type="button" id="downloadPDF" class="btn btn-success w-100 export_button d-none">PDF</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div id="report_data"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
  $(document).ready(function() {
    $('#quickForm').on('submit', function(e) {
      e.preventDefault(); // prevent default form submission

      let form = $(this);
      let actionUrl = form.attr('action');
      let formData = form.serialize(); // serialize form inputs

      $.ajax({
        type: 'POST',
        url: actionUrl,
        data: formData,
        success: function(response) {
          // handle success response
          $('#report_data').html(response);
          $('.export_button').removeClass('d-none');

        },
        error: function(xhr) {
          // handle error response
          alert('An error occurred!');
          console.log(xhr.responseText);
        }
      });
    });
  
    $('#downloadPDF').on('click', function() {
        var element = document.getElementById('report_data');
        
        var opt = {
            margin:       0.5,
            filename:     'exam-report.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().from(element).set(opt).save();
    });
});


    $('#exportExcel').on('click', function () {
        let table_html = document.getElementById('report_data').outerHTML;
        let data_type = 'application/vnd.ms-excel';
        let table_html_utf = '<html xmlns:o="urn:schemas-microsoft-com:office:office" ' +
                             'xmlns:x="urn:schemas-microsoft-com:office:excel" ' +
                             'xmlns="http://www.w3.org/TR/REC-html40">' +
                             '<head><meta charset="UTF-8"></head><body>' + table_html + '</body></html>';

        let blob = new Blob([table_html_utf], { type: data_type });
        let url = URL.createObjectURL(blob);

        let a = document.createElement('a');
        a.href = url;
        a.download = 'exam-report.xls';
        a.click();
    });
</script>
@endsection