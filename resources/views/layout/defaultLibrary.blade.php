<!-- @php
 $getLibrary = Helper::getLibrary();
 @endphp
 
 @if(!empty($getLibrary))
 @foreach($getLibrary as $library)
   <a href='{{url("default_library")}}/{{$library->id}}' ><button type='button' class='btn btn-{{$library->id ==Session::get("defaultLibrary") ? "primary" : "outline-primary"}}' >{{$library->name ?? ''}}</button></a>     
 @endforeach
 @endif-->