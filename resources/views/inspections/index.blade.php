@extends('adminlte::page')

@section('title', 'Sorteo 4.0 | Listado de inspecciónes')

@section('content_header')
    <h1>Listado de inspecciónes</h1>
@endsection

@section('content')

    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>
                                Id
                            </th>
                                    
                            <th>
                                Area de trabajo
                            </th>
            
                            <th>
                                Inspector
                            </th>
            
                            <th>
                                Empresa
                            </th>
            
                            <th>
                                Producto
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($inspections as $inspection)
                            <tr>
                                <td>
                                    <a href="{{route('inspection.detail', ['id' => $inspection->id])}}">
                                        {{$inspection->id}}
                                    </a>
                                    
                                </td>

                                <td>
                                    {{$inspection->area_trabajo}}
                                </td>

                                <td>
                                    {{$inspection->user->name}}
                                </td>

                                <td>
                                    {{$inspection->company->name}}
                                </td>

                                <td>
                                    {{$inspection->product->name}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <div class="pull-right hidden-xs">
        Anything you want
    </div>
      
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
@endsection