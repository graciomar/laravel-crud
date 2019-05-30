@extends('layouts.app')
@section('content')
<div class="content mt-3">
    <div class="alerts">
    	<div class="row mb-3">
    		<div class="col-md-12">
    			<button type="button" class="btn btn-success btn-sm" id="bt-add"><i class="fa fa-plus" ></i>&nbsp; Add</button>
    			<button type="button" class="btn btn-secondary  btn-sm"  id="bt-edit"><i class="fa fa-edit"></i>&nbsp; Edit</button>
    			<button type="button" class="btn btn-danger  btn-sm"  id="bt-delete"><i class="fa fa-trash"></i>&nbsp; Delete</button>
    		</div>
    	</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title text-uppercase">CRUD EXAMPLE</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="list-registers">
                            <thead>
                                <tr>
                                    <th scope="col">Cod.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cruds as $crud)
                                <tr>
                                    <th scope="row" data-id="{{$crud->id}}">{{$crud->id}}</th>
                                    <td>{{$crud->name}}</td>
                                    <td>{{$crud->email}}</td>
                                    <td>{{$crud->phone}}</td>
                                    <td>{{$crud->address}}</td>
                                    <td>{{$crud->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(isset($cruds)) {{-- Pagination laravel --}}
                            <h5 id="links" class="pull-right">
                                {{$cruds->links()}}
                            </h5>
                        @endif
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

