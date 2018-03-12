@extends('dashboard.layouts.app')

@section('content')

@component('dashboard.layouts.breadcrumbs')        
        <a class="nav-link" href="{{route('orders')}}">Voltar</a>
        <a class="nav-link ml-auto text-muted" href="{{route('orders')}}">Listagem de orçamentos</a>
@endcomponent

<div class="container-fluid my-3">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('dashboard.layouts.messages')
                    
                    <form class="needs-validation" novalidate  method="POST" action="{{route('order.store')}}" id="formvalidate">
                        {{ csrf_field() }}
                        @include('dashboard.order.partials.form_customer')
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
