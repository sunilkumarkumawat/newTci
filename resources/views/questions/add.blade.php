@extends('layout.app')
@section('content')
    @php
        $isEdit = isset($data);
    @endphp

<style>
.border_editor{

    border:1px solid black;
}
    body {
        /* max-width: 1400px;
        padding: 0 20px;
        margin: 20px auto; */
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        overflow-y: scroll;
    }
    /* Set the minimum height of Classic editor */
    .ck.ck-editor__editable_inline:not(.ck-editor__nested-editable) {
        min-height: 400px;
    }
    /* Styles to render an editor with a sidebar for comments & suggestions */
    .container {
        display: flex;
        flex-direction: row;
    }
    .document-outline-container {
        background-color: #f3f7fb;
        width: 200px;
    }
    .sidebar {
        width: 320px;
    }
    #editor-container .ck.ck-editor {
        width: 860px;
    }
    #editor-container .sidebar {
        margin-left: 20px;
    }
    #editor-container .sidebar.narrow {
        width: 30px;
    }
    /* Keep the automatic height of the editor for adding comments */
    .ck-annotation-wrapper .ck.ck-editor__editable_inline {
        min-height: auto;
    }
    /* Styles for viewing revision history */
    #revision-viewer-container {
        display: none;
    }
    #revision-viewer-container .ck.ck-editor {
        width: 860px;
    }
    #revision-viewer-container .ck.ck-content {
        min-height: 400px;
    }
    #revision-viewer-container .sidebar {
        border: 1px #c4c4c4 solid;
        margin-left: -1px;
        width: 320px;
    }
    #revision-viewer-container .ck.ck-revision-history-sidebar__header {
        height: 39px;
        background: #FAFAFA;
    }
    .hidden {
        display: none!important;
    }

    .MathJax_Display {
        display: inline !important; /* Force inline */
    }
    .cke_notifications_area{
        display: none !important
        ;
    }
</style>


    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Question Bank</li>
                            <li class="breadcrumb-item">Add New Question </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <!-- Question Form Column -->
                    <div class="col-md-12 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa fa-user-circle-o"></i> &nbsp;Add Questions</h4>
                                </div>
                                <div class="card-tools">
                                <a href="{{ url('questionView') }}" class="btn btn-primary  btn-sm"><i class="fa fa-plus"></i>
                                    <span class="Display_none_mobile"> {{ __('common.View') }} </span></a>
                            </div>
                            </div>

                            <div class="card-body">
                                <form id="createCommon" data-modal="Question">
                                    @if ($isEdit)
                                        <input type='hidden' value="{{ $data->id ?? '' }}" name='id' />
                                    @endif
                                    <input type='hidden' value='Question' name='modal_type' />
                                    <!-- <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" /> -->
                                    <!-- <input type='hidden' id="branch_id" name='branch_id' /> -->
                                    <div id="expense-container" class="bg-item mb-3 border p-3 rounded">
                                        <div class="row">
                                            <div class="col-md-3 col-12 ">
                                                @include('commoninputs.inputs', [
                                                    'modal' => 'ClassType', 
                                                    'name' => 'class_type_id',
                                                    'selected' => $data->class_type_id ?? null,
                                                    'label' => 'Class',
                                                    'required' => true,
                                                    'attributes' => [
                                                        'data-dependent' => 'subject_id',
                                                        'data-url' => url(
                                                            '/get-dependent-options'),
                                                        'data-modal' => 'Subject',
                                                        'data-field' => 'class_type_id',
                                                    ],
                                                ])
                                            </div>
                                            <div class="col-md-3 col-12 ">
                                                @include('commoninputs.inputs', [
                                                    'modal' => 'Subject',
                                                    'name' => 'subject_id',
                                                    'selected' => $data->subject_id ?? null,
                                                    'label' => 'Subject',
                                                    'required' => true,
                                                    'isRequestSent' => isset($data->class_type_id),
                                                    'dependentId' => $data->class_type_id ?? null,
                                                    'foreignKey' => 'class_type_id',
                                                    'attributes' => [
                                                        'data-dependent' => 'chapter_id',
                                                        'data-url' => url(
                                                            '/get-dependent-options'),
                                                        'data-modal' => 'Chapter',
                                                        'data-field' => 'subject_id',
                                                    ],
                                                ])
                                            </div>
                                            <div class="col-md-3 col-12 ">
                                                @include('commoninputs.dependentInputs', [
                                                    'modal' => 'Chapter',
                                                    'name' => 'chapter_id',
                                                    'selected' => $data->chapter_id ?? null,
                                                    'label' => 'Chapter',
                                                    'required' => true,
                                                    'isRequestSent' => isset($data->subject_id),
                                                    'dependentId' => $data->subject_id ?? null,
                                                    'foreignKey' => 'subject_id',
                                                    'attributes' => [
                                                        'data-dependent' => 'topic_id',
                                                        'data-url' => url(
                                                            '/get-dependent-options'),
                                                        'data-modal' => 'Topic',
                                                        'data-field' => 'chapter_id',
                                                    ],
                                                ])
                                            </div>
                                            <div class="col-md-3 col-12 ">
                                                @include('commoninputs.dependentInputs', [
                                                    'modal' => 'Topic',
                                                    'name' => 'topic_id',
                                                    'selected' => $data->topic_id ?? null,
                                                    'label' => 'Topic',
                                                    'required' => true,
                                                    'isRequestSent' => isset($data->chapter_id),
                                                    'dependentId' => $data->chapter_id ?? null,
                                                    'foreignKey' => 'chapter_id',
                                                ])
                                            </div>
                                            <div class="col-md-3 col-12 ">
                                                @include('commoninputs.inputs',[
                                                    'modal' => 'Level',
                                                    'name' => 'level_id',
                                                    'selected' => $data->level_id ?? null,
                                                    'label' => 'Level',
                                                    'required' => true,
                                                ])
                                            </div>
                                            <div class="col-md-3 col-12 ">
                                                @include('commoninputs.inputs',[
                                                    'modal' => 'Suka',
                                                    'name' => 'suka_id',
                                                    'selected' => $data->suka_id ?? null,
                                                    'label' => 'Suka',
                                                    'required' => true,
                                                ])
                                            </div>
                                            <div class="col-md-3 col-12 ">
                                                @include('commoninputs.inputs',[
                                                    'modal' => 'QuestionType',
                                                    'name' => 'question_type_id',
                                                    'selected' => $data->question_type_id ?? null,
                                                    'label' => 'Question Type',
                                                    'required' => true,
                                                ])
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div id="parentDiv">
                    
                                                    <div class='row mt-2'>
                                                        
                                                        <div class='col-md-6'>
                                                            
                                                            <textarea name="editor1"></textarea>
                                                        </div>
                                                        <div class='col-md-6'>
                                                            
                                                            <div id ="editor_data" >
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                 
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-12 text-center mt-2">
                                                <button type="submit" id="" class="btn btn-primary">Save Questions</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                   
                
                </div>
            </div>
        </section>
    </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-AMS_HTML"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
 
 
   var result = [];
   
  
                         CKEDITOR.replace( 'editor1' );
                        
                      
                   
                        
                   CKEDITOR.instances.editor1.on('change', function() {
var data = CKEDITOR.instances.editor1.getData();


    

    
    
var tempDiv = document.createElement('div');
tempDiv.innerHTML = data;

var tableCells = tempDiv.querySelectorAll('td, th');

tableCells.forEach(function(cell) {
    var combinedText = '';

    Array.from(cell.childNodes).forEach(function(node) {
        if (node.tagName === 'P') {
            combinedText += node.innerHTML;
        } else if (node.tagName === 'IMG') {
            // Add inline CSS to ensure the image is aligned with text
            var imgHTML = node.outerHTML;
            imgHTML = imgHTML.replace('<img', '<img style="max-width:50px; height:auto; vertical-align:middle; display:inline-block;"');
            combinedText += imgHTML;
        }
    });

    cell.innerHTML = ''; // Clear existing content
    var newParagraph = document.createElement('p');
    newParagraph.innerHTML = combinedText.trim(); // Set combined content
    cell.appendChild(newParagraph);
});

            
            // Extract all <p> elements
            var paragraphs = tempDiv.getElementsByTagName('p');
            
            
        
    
            // Initialize an array to store the formatted result
          
            result =[];
            // Process paragraphs in groups of 5
            for (var i = 0; i < paragraphs.length-1; i += 13) {
                // Create an object for each set of 5 paragraphs
                var obj = { 
                    ques: '',
                    ans1: '',
                    ans2: '',
                    ans3: '',
                    ans4: '',
                    hi_name: '',
                    hi_ans_a: '',
                    hi_ans_b: '',
                    hi_ans_c: '',
                    hi_ans_d: '',
                    correct: '',
                    solution: '',
                    hi_solution: '',
                };
            
            
            
            function convert(html){
                
            
              var html =html;
//     const imgIndex = html.indexOf('<img');
//     if (imgIndex === -1) return html; // No <img> tag found
    
//     const textBeforeImg = html.substring(0, imgIndex);
//         const textAfterImg = html.substring(imgIndex , html.length);
 
//   let segments = textBeforeImg.split(/ /);
//     segments.pop();
//     const updatedText = segments.join(' ')+' '+ textAfterImg;
 
 

 return html;
            }
            
          
    
                if (i < paragraphs.length) obj.ques = convert(paragraphs[i].innerHTML);
                if (i + 1 < paragraphs.length) obj.ans1 = convert(paragraphs[i+1].innerHTML);
                if (i + 2 < paragraphs.length) obj.ans2 = convert(paragraphs[i+2].innerHTML);
                if (i + 3 < paragraphs.length) obj.ans3 = convert(paragraphs[i+3].innerHTML);
                if (i + 4 < paragraphs.length) obj.ans4 = convert(paragraphs[i+4].innerHTML);
                if (i + 5 < paragraphs.length) obj.hi_name = convert(paragraphs[i+5].innerHTML);
                if (i + 6 < paragraphs.length) obj.hi_ans_a = convert(paragraphs[i+6].innerHTML);
                if (i + 7 < paragraphs.length) obj.hi_ans_b = convert(paragraphs[i+7].innerHTML);
                if (i + 8 < paragraphs.length) obj.hi_ans_c = convert(paragraphs[i+8].innerHTML);
                if (i + 9 < paragraphs.length) obj.hi_ans_d = convert(paragraphs[i+9].innerHTML);
                if (i + 10 < paragraphs.length) obj.correct = convert(paragraphs[i+10].innerHTML);
                if (i + 11 < paragraphs.length) obj.solution = convert(paragraphs[i+11].innerHTML);
                if (i + 12 < paragraphs.length) obj.hi_solution = convert(paragraphs[i+12].innerHTML);
                
              
                
                // Add the object to the result array
                result.push(obj);
            }
            
                  generateTableRows(result);
               
    var targetHeight = $('#editor_data').outerHeight(); // or .height() if you prefer
    CKEDITOR.instances.editor1.resize('100%', (targetHeight-107), true);

        });
        
function generateTableRows(data) {
    var container = document.getElementById('editor_data');
    container.innerHTML = ''; // Clear existing content
    
const keyboardMapping = {
    '`': 'ृ', 
    '1': '1', 
    '2': '2', 
    '3': '3', 
    '4': '4', 
    '5': '5', 
    '6': '6', 
    '7': '7', 
    '8': '8', 
    '9': '9', 
    '0': '0', 
    '-': '.', 
    '=': 'त्र', 
    '~': '्',
    '!': '!', 
    '@': '/', 
    '#': 'रु', 
    '$': '$', 
    '%': 'ः', 
    '^': '‘', 
    '&': '-', 
    '*': '’', 
    '(': ';', 
    ')': 'द्ध', 
    '_': 'ऋ', 
    '+': '़', 
    'q': 'ुँ', 
    'w': 'ू', 
    'e': 'म', 
    'r': 'त', 
    't': 'ज', 
    'y': 'ल', 
    'u': 'न', 
    'i': 'प', 
    'o': 'व', 
    'p': 'च', 
    '[': 'ख्', 
    ']': ',', 
    '\\': '?', 
    'Q': 'फ', 
    'W': 'ॅ', 
    'E': 'म्', 
    'R': 'त्', 
    'T': 'ज्', 
    'Y': 'ल्', 
    'U': 'न्', 
    'I': 'प्', 
    'O': 'व्', 
    'P': 'च्', 
    '{': 'क्ष्', 
    '}': 'द्व', 
    '|': 'द्य', 
    'a': 'ंं', 
    's': 'े', 
    'd': 'क', 
    'f': 'ि', 
    'g': 'ह', 
    'h': 'ी', 
    'j': 'र', 
    'k': 'ा', 
    'l': 'स', 
    ';': 'य', 
    "'": 'श्', 
    'A': '।', 
    'S': 'ै', 
    'D': 'क्', 
    'F': 'थ्', 
    'G': 'ळ', 
    'H': 'भ्', 
    'J': 'श्र', 
    'K': 'ज्ञ', 
    'L': 'स्', 
    ':': 'रू', 
    '"': 'ष्', 
    'z': '्र', 
    'x': 'ग', 
    'c': 'ब', 
    'v': 'अ', 
    'b': 'इ', 
    'n': 'द', 
    'm': 'उ', 
    ',': 'ए', 
    '.': 'ण्', 
    '/': 'ध्', 
    // 'Z': 'ग्', 
    'Z': 'र्य्', 
    'X': 'ब्', 
    'C': 'ट', 
    'V': 'ठ', 
    'B': 'छ', 
    'N': 'ड', 
    'M': 'ढ', 
    '<': 'झ', 
    '>': 'घ्',
      'Ø':'क्र',
    'æ':'द्र',
    'Ù':'त्त्',
    '?': '',
   
};

    //alert(JSON.stringify(data))
     
    data.forEach(function(item ,index) {
        // Create a row container
        var row = document.createElement('div');
        row.className = 'row'; 
        
        
             const inputText = ' dflh oLrq esa cy   U;wVu }kjk ofLFkkiu   ehVj mRiUu gksrk gSA cy }kjk df;k x;k dkZ gS';
            let hindiOutput = '';

            // Convert each character based on the mapping
            for (let char of inputText) {
                hindiOutput += keyboardMapping[char] || char; // Use the mapped character or the original if not found
            }

       // alert(hindiOutput);
        
        function modifiedString(item){
            const originalString =  item;
         const regex = /\$(.*?)\$/g;

        const modifiedString1 = originalString.replace(regex, (match, p1) => {
            return `\\(${p1}\\)`; 
        });
        
        
        return modifiedString1
      
        }
              

       

        var cellsHtml = `
            <div class="col-md-12 border_editor">Q.${index+1}) ${modifiedString(item.ques)}</div>
            <div class="col-md-12 border_editor">A.) ${modifiedString(item.ans1)}</div>
            <div class="col-md-12 border_editor">B.) ${modifiedString(item.ans2)}</div>
            <div class="col-md-12 border_editor">C.) ${modifiedString(item.ans3)}</div>
            <div class="col-md-12 border_editor">D.) ${modifiedString(item.ans4)}</div>
            <div class="col-md-12 border_editor">Q.${index+1}) ${modifiedString(item.hi_name)}</div>
            <div class="col-md-12 border_editor">A.) ${modifiedString(item.hi_ans_a)}</div>
            <div class="col-md-12 border_editor">B.) ${modifiedString(item.hi_ans_b)}</div>
            <div class="col-md-12 border_editor">C.) ${modifiedString(item.hi_ans_c)}</div>
            <div class="col-md-12 border_editor">D.) ${modifiedString(item.hi_ans_d)}</div>
            <div class="col-md-12 border_editor">Ans.) ${modifiedString(item.correct)}</div>
            <div class="col-md-12 border_editor mb-1">EN:) ${modifiedString(item.solution)}</div>
            <div class="col-md-12 border_editor mb-1">HI:) ${modifiedString(item.hi_solution)}</div>
        `;
        
        // Set the inner HTML of the row
        row.innerHTML = cellsHtml;
        
        // Append the row to the container
        container.appendChild(row);
    });
                MathJax.Hub.Queue(["Typeset", MathJax.Hub, ".border_editor"]);
                
           
}

        // Call the function with the example data
  $(document).ready(function(){
  $("#saveQuestions").click(function(){ 
      
      var class_type_id = $('#class_type_id').val();
      var subject_id = $('#subject_id').val();
      var chapter_id = $('#chapter_id').val();
      var topic_id = $('#topic_id').val();
      var level_id = $('#level_id').val();
      var suka_id = $('#suka_id').val();
      var question_type_id = $('#question_type_id').val();
      
  
          var baseurl = "{{ url('/') }}";
        
          const btn = $('#saveQuestions');
          const originalBtnText = btn.text();
          btn.prop("disabled", true).html(`<i class="fa fa-spinner fa-spin"></i> ${originalBtnText}`);
   $.ajax({
                headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        	    url: baseurl + '/save_question_ajax',
        	    data: {data:JSON.stringify(result),
        	    class_type_id:class_type_id,
        	    subject_id:subject_id,
        	    chapter_id:chapter_id,
        	    topic_id:topic_id, 
        	    level_id:level_id,
        	    suka_id:suka_id,
        	    question_type_id:question_type_id,
        	    
        	    },
        	    method: 'post',
        	    success: function(response){
                 btn.prop("disabled", false).text(originalBtnText);
        	        toastr.success('Questions Saved Successfully.')
        	setTimeout(function() {
    window.location.href = '/add/question';
}, 1000); 
        	          
        	    }
        	});
  });
});

                </script>
@endsection
