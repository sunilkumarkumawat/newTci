@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
         {{-- breadcrumb --}}
         <div class="row">
            <div class="col-md-12 col-12 p-0">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{url('studentView')}}">StudnentView</a></li> 
                    <li class="breadcrumb-item">StudnentEdit</li> 
                </ul>
            </div>
        </div>
    </section>
</div>

@endsection