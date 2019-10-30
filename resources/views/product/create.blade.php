@extends('adminlte::page')

@section('title', 'Pluss | Sorteo 4.0')

@section('content_header')
    <h1>Crear producto</h1>
@stop

@section('content')
    <div class="col-md-12">
        <div class="box box-info">
            <form action="{{route('product.store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="name" id="name" required placeholder="Nombre del producto">
                        </div>
        
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="description" id="description" required placeholder="Da una descripción">
                        </div>
        
                        <div class="col-md-3">
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
    
                        <div class="col-md-3">
                            <select name="company_id" id="company_id" class="form-control">
                                <option value="">Seleccionar la empresa</option>
                                @foreach ($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="col-md-offset-5 btn btn-primary">Guardar</button>
                </div>
            </form>
            
        </div>
    </div>
@stop
