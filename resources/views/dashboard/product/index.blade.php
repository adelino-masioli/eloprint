@extends('dashboard.layouts.app')

@section('content')
@component('dashboard.layouts.breadcrumbs')        
        <a class="nav-link" href="{{route('product.create')}}">Novo</a>
        <a class="nav-link ml-auto text-muted" href="{{route('products')}}">Listagem de produtos</a>
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
                                <th class="col-md-7 text-center">NOME DO PRODUTO</th>
                                <th class="col-md-1 text-center">PREÇO</th>
                                <th class="col-md-1 text-center">STATUS</th>
                                <th class="col-md-2 text-center">AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center">{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{number_format($product->price, 2, ',', '.')}}</td>
                                    <td>{{$product->status->status}}</td>
                                    <td class="text-center">
                                        <a href="{{route('product.edit', $product->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        <a href="{{route('product.duplicate', $product->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-clone"></i></a>
                                        <a href="{{route('product.destroy', $product->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
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
