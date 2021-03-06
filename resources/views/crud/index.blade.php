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
    	<div class="row mb-3">
    		<div class="col-md-12">
    			<button type="button" class="btn btn-success btn-sm" id="bt-add"><i class="fa fa-plus" ></i>&nbsp; Add</button>
    			<button type="button" class="btn btn-secondary btn-sm"  id="bt-edit"><i class="fa fa-edit"></i>&nbsp; Edit</button>
                <button type="button" class="btn btn-primary btn-sm"  id="bt-show"><i class="fa fa-eye"></i>&nbsp; Show</button>
    			<button type="button" class="btn btn-danger btn-sm"  id="bt-delete"><i class="fa fa-trash"></i>&nbsp; Delete</button>
                <button data-toogle="modal" data-target="#largeModal" type="button" class="btn btn-info btn-sm"  id="bt-filter"><i class="fa fa-search"></i>&nbsp; Filter</button>
    		</div>
    	</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title text-uppercase">LIST CRUD</strong>
                        <select name="selectLimit" id="selectLimit">
                            @foreach($arrayLimites as $limit)
                            <option @if(isset($_GET['limit']) && $_GET['limit'] == $limit)  selected="selected" @endif value="{{$limit}}">{{$limit}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="list-registers">
                            <thead>
                                <tr>
                                    @php
                                        $page = 1;
                                        $order = 'ASC';
                                        $limit = '';
                                        $icon = '<i class="fa fa-chevron-down"></i>';
                                        if(isset($request->page)) $page = $request->page;
                                        if(isset($request->limit)) $limit = $request->limit;
                                        if(isset($request->order) && $request->order == 'ASC') {
                                            $icon = '<i class="fa fa-chevron-up"></i>'; 
                                            $order = 'DESC'; 
                                        }
                                    @endphp
                                    <th scope="col">Cod <a href="crud/index?by=id&page={{$page}}&order={{$order}}&limit={{$limit}}"><?php echo $icon;?></a></th>
                                    <th scope="col">Name <a href="crud/index?by=name&page={{$page}}&order={{$order}}&limit={{$limit}}"><?php echo $icon;?></a> </th>
                                    <th scope="col">Email <a href="crud/index?by=email&page={{$page}}&order={{$order}}&limit={{$limit}}"><?php echo $icon;?></a></th>
                                    <th scope="col">Phone <a href="crud/index?by=phone&page={{$page}}&order={{$order}}&limit={{$limit}}"><?php echo $icon;?></a></th>
                                    <th scope="col">Address <a href="crud/index?by=address&page={{$page}}&order={{$order}}&limit={{$limit}}"><?php echo $icon;?></a></th>
                                    <th scope="col">Created at <a href="crud/index?by=created_at&page={{$page}}&order={{$order}}&limit={{$limit}}"><?php echo $icon;?></a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registers as $register)
                                <tr>
                                    <th scope="row" data-id="{{$register->id}}">{{$register->id}}</th>
                                    <td>{{$register->name}}</td>
                                    <td>{{$register->email}}</td>
                                    <td>{{$register->phone}}</td>
                                    <td>{{$register->address}}</td>
                                    <td>{{$register->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(isset($registers) && (empty($request->limit) || $request->limit == 'All') ) {{-- Pagination laravel --}}
                            <h5 id="links" class="pull-right">
                                {{$registers->links()}}
                            </h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- .content -->

<!-- begin modal filter -->
<div class="modal fade show" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Filter Crud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-filter" method="get" action="">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label for="cc-name" class="control-label mb-1">Code:</label>
                                <input id="codeFilter" name="codeFilter" type="text" class="form-control valid" data-val="true" data-val-required="Please enter the code" autocomplete="code" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" @if(isset($request)) @if(isset($request->codeFilter)) value="{{$request->codeFilter}}" @endif @endif >
                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true">
                                    
                                </span>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group has-success">
                                <label for="cc-name" class="control-label mb-1">Name:</label>
                                <input id="nameFilter" name="nameFilter" type="text" class="form-control valid" data-val="true" data-val-required="Please enter the nameFilter" autocomplete="nameFilter" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" @if(isset($request)) @if(isset($request->nameFilter)) value="{{$request->nameFilter}}" @endif @endif >
                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true">
                                    
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label for="cc-name" class="control-label mb-1">Email:</label>
                                <input id="emailFilter" name="emailFilter" type="text" class="form-control valid" data-val="true" data-val-required="Please enter the email" autocomplete="emailFilter" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" @if(isset($request)) @if(isset($request->emailFilter)) value="{{$request->emailFilter}}" @endif @endif >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label for="cc-name" class="control-label mb-1">Address:</label>
                                <input id="addressFilter" name="addressFilter" type="text" class="form-control valid" @if(isset($request)) @if(isset($request->addressFilter)) value="{{$request->addressFilter}}" @endif @endif>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal filter -->

<!-- begin modal Notify -->
<div class="modal fade show" id="notifyModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Notify</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Missing select a register.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal Notify -->

<!-- begin modal Confirm -->
<div class="modal fade show" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Notify</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Do you really want to delete this record?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="bt-confirm">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal Confirm -->

@push('scripts')
<script type="text/javascript">
jQuery(document).ready(function($) {
    "use strict";
    var tr = $('#list-registers tbody tr');
    var btAdd = $('#bt-add');
    var btEdit = $('#bt-edit');
    var btShow = $('#bt-show');
    var btDelete = $('#bt-delete');
    var btFilter = $('#bt-filter');
    var btConfirm = $('#bt-confirm');
    var selectLimit = $('#selectLimit');

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
            $('#notifyModal').modal('show');
        }else{
            var rota = "{{route('crud.edit', ['id'=> '#id'])}}";
            rota = rota.replace('#id', idRegister);
            window.location.href = rota;
        }
    });

    btShow.on('click', function(event) {
        if(idRegister == ""){
            $('#notifyModal').modal('show');
        }else{
            var rota = "{{route('crud.show', ['id'=> '#id'])}}";
            rota = rota.replace('#id', idRegister);
            window.location.href = rota;
        }
    });

    btDelete.on('click', function(event) {
        if(idRegister == ""){
            $('#notifyModal').modal('show');
        }else{
            $('#confirmModal').modal('show');
        }
    });

    btConfirm.on('click', function(event) {
        var rota = "{{route('crud.destroy', ['id'=> '#id'])}}";
        rota = rota.replace('#id', idRegister);
        window.location.href = rota;
    });

    selectLimit.on('change', function(event) {
        var rota = "{{route('crud.index')}}?limit=#";
        rota = rota.replace('#', $(this).val() );
        window.location.href = rota;
    });

    btFilter.on('click', function(event) {
        $('#filterModal').modal('show');
    });
});
</script>
@endpush
@endsection

