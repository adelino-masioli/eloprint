@extends('dashboard.layouts.app')

@section('content')

@component('dashboard.layouts.breadcrumbs')        
        <a class="nav-link" href="{{route('customers')}}">Voltar</a>
        <a class="nav-link ml-auto text-muted" href="{{route('customers')}}">Listagem de clientes</a>
@endcomponent

<div class="container  my-3">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default"></div>
                <div class="panel-body">
                    @include('dashboard.layouts.messages')
                    
                    <form class="needs-validation" novalidate  method="POST" action="{{route('customer.store')}}" id="formvalidate">
                        {{ csrf_field() }}
                        @include('dashboard.customer.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
