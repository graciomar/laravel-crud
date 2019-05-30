@extends('layouts.app')
@section('content')
<div class="content mt-3">
    <div class="alerts">
        <div class="row">
            <div class="col-md-12">
                @auth
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Welcome to {{ config('app.name', 'Laravel') }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light" role="alert">
                            Hi, {{Auth::user()->name}}, today is <strong>{{ strftime('%A', date('d') )}}</strong>, {{date('d')}} of {{ strftime('%B', date('d') )}} of {{date('Y')}}.
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div> <!-- .content -->
@endsection

