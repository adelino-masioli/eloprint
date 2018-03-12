@extends('dashboard.layouts.app') 
@section('content') @component('dashboard.layouts.breadcrumbs')
<a class="nav-link" href="{{route('orders')}}">Voltar</a>
<a class="nav-link ml-auto text-muted" href="{{route('orders')}}">Listagem de Orçamentos</a> @endcomponent
<div class="container-fluid  my-3">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('dashboard.layouts.messages')
                    <form class="needs-validation" novalidate method="POST" action="{{route('order.update')}}" id="formvalidate">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$order ? $order->id : ''}}">
                        @include('dashboard.order.partials.form_customer')
                    </form>
                    @include('dashboard.order.partials.form_product')
                    @include('dashboard.order.partials.table_products')

                </div>
            </div>
        </div>

        @include('dashboard.order.partials.confirm_order')
    </div>
</div>
@endsection