@extends('dashboard.layouts.app')

@section('content')

@component('dashboard.layouts.breadcrumbs')        
        <a class="nav-link" href="{{route('products')}}">Voltar</a>
        <a class="nav-link ml-auto text-muted" href="{{route('products')}}">Listagem de produtos</a>
@endcomponent

<div class="container  my-3">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default"></div>
                <div class="panel-body">
                    @include('dashboard.layouts.messages')
                    
                    <form class="needs-validation" novalidate  method="POST" action="{{route('product.update')}}" id="formvalidate">
                        {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="id" name="id" value="{{$product ? $product->id : ''}}">
                        @include('dashboard.product.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
