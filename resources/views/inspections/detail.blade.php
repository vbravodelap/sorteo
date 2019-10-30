@extends('adminlte::page')

@section('title', 'Sorteo 4.0 | Detalle de la inspección')

@section('content_header')
    <h1>Inspección {{$inspection->id}}</h1>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">

                <div class="row">
                    <div class="col-md-6 text-center">
                        <h4><span class="text-bold">Empresa: </span>{{$inspection->company->name}}</h4>
                        <h4><span class="text-bold">Producto: </span>{{$inspection->product->name}}</h4>
                        <h4><span class="text-bold">Inspector: </span>{{$inspection->user->name}}</h4>
                        <h4><span class="text-bold">Area de trabajo: </span>{{$inspection->area_trabajo}}</h4>
                    </div>

                    <div id="table-container" class="col-md-5">
                        <table style="margin-top:15px;" class="table table-bordered table-striped table-hover ">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Serial/Serie</th>
                                    <th>Piezas aceptables</th>
                                    <th>Piezas defectuosas</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inspection->revisions as $revisions)
                                    <tr>
                                        <td>
                                            {{$revisions->box_number}}
                                        </td>

                                        <td>
                                            {{$revisions->good_pieces}}
                                        </td>

                                        <td>
                                            {{$revisions->bad_pieces}}
                                        </td>

                                        <td>
                                            {{$revisions->total}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-5">
                        <input type="hidden" value="{{$inspection->id}}" id="inspection_id">
                        <canvas id="badAndGoodpieces" width="350" height="200"></canvas>
                    </div>

                    <div class="col-md-3">
                        <div class="small-box bg-blue">
                            <div class="inner">
                            <h3>{{number_format((float)$porcentaje_buenas, 2, '.', '').' %'}}</h3>
                
                            <p>Porcentajes de piezas aceptables</p>
                            </div>
                            <div class="icon">
                            <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="row">
                            <div class="small-box bg-red">
                                <div class="inner">
                                <h3>{{number_format((float)$porcentaje_malas, 2, '.', '').' %'}}</h3>
                    
                                <p>Porcentaje de piezas defectuosas</p>
                                </div>
                                <div class="icon">
                                <i class="fas fa-times"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>{{number_format((float)$ppms, 2, '.', '')}}</h3>
                            
                                    <p>PPMS</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-puzzle-piece"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset($inspection->product->image)}}" alt="{{$inspection->product->name}}" class="img-thumbnail">
                        </div>
                    </div>
                </div>
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

@section('js')
    <script>
        $(document).ready(function() {
            var inspection_id = $('#inspection_id').val();
            var data = [];
            var buenas = null;
            var malas = null;
            var piezas = [];

            axios.get(`http://localhost/sorteo/public/revisions/getpieces/${inspection_id}`).then(response => {
                data = response.data;

                console.log(data);
                buenas = data.piezas_buenas;
                malas = data.piezas_malas;
                piezas.push(buenas, malas);
                console.log(piezas);

                var ctx = document.getElementById('badAndGoodpieces');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Piezas aceptables', 'Piezas defectuosas'],
                        datasets: [{
                            label: '# de piezas',
                            data: piezas,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }).catch(response => {
                console.log(response);
            })

            
        });

        
    </script>
@endsection