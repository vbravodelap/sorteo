@extends('adminlte::page')

@section('title', 'Pluss | Sorteo 4.0')

@section('content_header')
    <h1>Lista de empresas</h1>
@stop

@section('content')
    <div class="col-md-12 responsive">
        <div class="box box-info">
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Inspecciónes</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>
                                    {{$company->id}}
                                </td>

                                <td>
                                    {{$company->name}}
                                </td>

                                <td>
                                    {{$company->address}}
                                </td>

                                <td>
                                    {{$company->created_at->diffForHumans()}}
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