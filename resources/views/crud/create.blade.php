@extends('layouts.app')
@section('content')
@if(Session::get('message'))
<div class="col-sm-12">
    <div class="alert  alert-{{Session::get('message')['class']}} alert-dismissible fade show" role="alert">
        <span class="badge badge-pill badge-{{Session::get('message')['class']}}">{{Session::get('message')['class']}}</span> {{Session::get('message')['msg']}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
</div>
@endif

<div class="content mt-3">
    <div class="alerts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title text-uppercase">CREATE CRUD</strong>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">Form Crud</div>
                            <div class="card-body card-block">
                                <form action="{{route('crud.store')}}" method="post" class="">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Name</div>
                                                    <input type="text" id="name" name="name" class="form-control">
                                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                </div>
                                                @if($errors->has('name'))
                                                    <span class="help-block alert-danger">
                                                        <strong>*  {{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6"> 
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Email</div>
                                                    <input type="text" id="email" name="email" class="form-control">
                                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                </div>
                                                @if($errors->has('email'))
                                                    <span class="help-block alert-danger">
                                                        <strong>* {{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Phone</div>
                                                    <input type="text" id="phone" name="phone" class="form-control">
                                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Address</div>
                                                    <input type="text" id="address" name="address" class="form-control">
                                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-actions form-group">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-plus"></i> Submit</button>
                                                <a href="{{route('crud.index')}}" class="btn btn-secondary btn-sm">
                                                <i class="fa fa-reply"></i> Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- .content -->
@push('scripts')
<script type="text/javascript">
jQuery(document).ready(function($) {
    "use strict";
    /*MY SCRIPT CREATE CRUD*/
});
</script>
@endpush
@endsection

