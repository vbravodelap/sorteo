@extends('adminlte::page')

@section('title', 'Pluss | Sorteo 4.0')

@section('content_header')
    <h1>Lista de productos</h1>
@stop

@section('content')
    <div class="col-md-12">
        @if(session('message'))
            <div class="alert alert-success alert-dismissible">
              {{ session('message') }}
            </div>
        @endif
        <div class="box box-info">
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Empresa</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    {{$product->id}}
                                </td>
                
                                <td>
                                    {{$product->name}}
                                </td>
                
                                <td>
                                    {{$product->description}}
                                </td>

                                <td>
                                    {{$product->company->name}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
@stop

@section('js')
    
@stop