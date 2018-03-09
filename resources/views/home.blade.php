@extends('dashboard.layouts.app')

@section('content')
@component('dashboard.layouts.breadcrumbs')        
        <a class="nav-link ml-auto text-muted" href="/dashboard">Dashboard</a>
@endcomponent

<div class="container-fluid  my-3">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    Dashboard
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
