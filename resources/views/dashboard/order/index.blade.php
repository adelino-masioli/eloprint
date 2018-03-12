@extends('dashboard.layouts.app')

@section('content')
@component('dashboard.layouts.breadcrumbs')        
        <a class="nav-link" href="{{route('order.create')}}">Novo Orçamento</a>
        <a class="nav-link ml-auto text-muted" href="{{route('orders')}}">Listagem de orçamentos</a>
@endcomponent

<div class="container-fluid  my-3">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('dashboard.layouts.messages')
                    
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1 text-center">ID</th>
                                <th class="col-md-7 text-center">NOME DO CLIENTE</th>
                                <th class="col-md-2 text-center">TOTAL</th>
                                <th class="col-md-1 text-center">STATUS</th>
                                <th class="col-md-1 text-center">AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">{{$order->id}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{number_format($order->total, 2, ',', '.')}}</td>
                                    <td>{{$order->status->status}}</td>
                                    <td class="text-center">
                                        <a href="{{route('order.edit', $order->transaction)}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        <a href="{{route('order.destroy', $order->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
