@extends('dashboard.layouts.app')

@section('content')
@component('dashboard.layouts.breadcrumbs')        
        <a class="nav-link" href="{{route('customer.create')}}">Novo</a>
        <a class="nav-link ml-auto text-muted" href="{{route('customers')}}">Listagem de clientes</a>
@endcomponent

<div class="container  my-3">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('dashboard.layouts.messages')
                    
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1 text-center">ID</th>
                                <th class="col-md-4 text-center">NOME</th>
                                <th class="col-md-1 text-center">TELEFONE</th>
                                <th class="col-md-4 text-center">E-MAIL</th>
                                <th class="col-md-2 text-center">AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="text-center">{{$customer->id}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->telephone}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td class="text-center">
                                        <a href="{{route('customer.edit', $customer->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        <a href="{{route('customer.destroy', $customer->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
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
