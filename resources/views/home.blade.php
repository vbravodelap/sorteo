@extends('adminlte::page')

@section('title', 'Pluss | Sorteo 4.0')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box box-body">
                <div class="row">

                    <div class="col-md-3">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{$total_inspections}}</h3>

                                <p>Total de inspecciones</p>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>{{$total_revisions}}</h3>

                                <p>Total de revisiones</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{$bad_pieces.' piezas'}}</h3>

                                <p>Piezas en mal estado encontradas.</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{$total_pieces.' piezas'}}</h3>

                                <p>Total de piezas revisadas.</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

@stop
