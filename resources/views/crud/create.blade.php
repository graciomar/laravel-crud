@extends('layouts.app')
@section('content')
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
                                                            <strong>* {{ $errors->first('name') }}</strong>
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
                                                    <button type="submit" class="btn btn-secondary btn-sm">
                                                    <i class="fa fa-reply"></i> Back</button>
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
    var tr = $('#list-registers tbody tr');
    var btAdd = $('#bt-add');
    var btEdit = $('#bt-edit');
    var btDelete = $('#bt-delete');

    var idRegister = "";

    tr.on('click', function(event) {
        tr.removeClass('tr-selected');
        $(this).addClass('tr-selected');
        idRegister = $(this).find('th').attr('data-id');
    });

    btAdd.on('click', function(event) {
        window.location.href = "{{route('crud.create')}}";
    });

    btEdit.on('click', function(event) {
        if(idRegister == ""){
            alert('Select a record to edit.');
        }else{
            var rota = "{{route('crud.edit', ['id'=> '#id'])}}";
            rota = rota.replace('#id', idRegister);
            window.location.href = rota;
        }
    });

    btDelete.on('click', function(event) {
        if(idRegister == ""){
            alert('Select a record to delete.');
        }else{
            var rota = "{{route('crud.destroy', ['id'=> '#id'])}}";
            rota = rota.replace('#id', idRegister);
            if(confirm('Do you really want to delete this record?')){
                window.location.href = rota;
            }
        }
    });
});
</script>
@endpush
@endsection

