@extends('layouts.app')
@section('content')
<div class="content mt-3">
    <div class="alerts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title text-uppercase">Show CRUD</strong>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">Show Crud</div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="rounded-circle mx-auto d-block" src="images/admin.jpg" alt="Card image cap">
                                    <h5 class="text-sm-center mt-2 mb-1">{{$crud->name}}</h5>
                                    <div class="location text-sm-center"><i class="fa fa-map-marker"></i> {{$crud->address}}</div>
                                </div>
                                <hr>
                                <div class="card-text text-sm-center">
                                    <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                                    <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                                    <a href="#"><i class="fa fa-linkedin pr-1"></i></a>
                                    <a href="#"><i class="fa fa-pinterest pr-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-actions form-group">
                    <a href="{{route('crud.index')}}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-reply"></i> Back</a>
                </div>
            </div>
        </div>

    </div>
</div> <!-- .content -->
@push('scripts')
<script type="text/javascript">
jQuery(document).ready(function($) {
    "use strict";
    /*MY SCRIPT SHOW CRUD*/
});
</script>
@endpush
@endsection

