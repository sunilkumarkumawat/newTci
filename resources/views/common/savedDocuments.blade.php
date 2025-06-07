@php
$savedDocuments = Helper::getSavedDocuments($getDocumentFromModal,$modal,$userId);

@endphp

@foreach($savedDocuments as $doc)
    <div class="col-md-3 mb-3 text-center border rounded p-2 position-relative">
        <strong>{{ $doc->category ?? 'Document' }}
        </strong><br>
        
       <img src="{{ asset($doc->file_path) }}"
     class="img-thumbnail"
     style="width:100px; height:100px; object-fit:cover;"
      onerror="this.src='{{ asset('defaultImages/imageError.png') }}'"><br>
        
        <strong>{{ $doc->file_name }}</strong>
        
        <button type="button" 
                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 delete-saved-doc" 
                data-id="{{ $doc->id }}">×</button>
    </div>
@endforeach