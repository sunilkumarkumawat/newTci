@extends('layout.app')
@section('content')
@php
$permissions = Helper::getPermissions();
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h4>
                                    <i class="fa fa-desktop"></i> &nbsp; Student Dashboard
                                </h4>
                            </div>
                            <div class="card-tools">
                                <!-- Optional button here -->
                            </div>
                        </div>
                        <div class="card-body ">


                        </div>
                    </div>


                    <div>

                    </div>



                </div>
            </div>
        </div>
    </section>
</div>



@endsection