@extends('adminlte::page')

@section('title', 'Sorteo 4.0 | Crear inspección')

@section('content_header')
    <h1>Crear inspección</h1>
@stop

@section('content')
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label for="">Area de trabajo: </label>
                        <input type="text" name="area_trabajo" id="area_trabajo" class="form-control">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="">Inspector: </label>
                        <select class="form-control" name="inspector" id="inspector">
                                <option value="">Selecciona un inspector</option>
                            @foreach ($inspectors as $inspector)
                                <option value="{{$inspector->id}}">{{$inspector->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="Empresa">Empresa: </label>
                        <select name="company" id="company" class="form-control">
                            <option value="">Selecciona una empresa</option>
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="product">Proyecto: </label>
                        <select class="form-control" name="product" id="product">
                            <option value="">Selecciona un proyecto</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="">Imagen: </label>
                        <input type="file" name="area_trabajo" id="area_trabajo" class="form-control">
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button class="btn btn-primary col-md-offset-5" id="submitInspeccion">Guardar</button>
            </div>
        </div>

        <div class="box box-info">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="col-md-4 form-group">
                        <label for="">Serial/Serie: </label>
                        <input type="text" class="form-control" id="box_number" name="box_number">
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="">Aceptables: </label>
                        <input type="number" class="form-control" id="good_pieces" name="good_pieces">
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="">Defectos: </label>
                        <input type="number" class="form-control" id="bad_pieces" name="bad_pieces">
                    </div>
                </div>

                <div class="col-md-6" id="table-container">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Serial/Serie</th>
                                <th>Aceptables</th>
                                <th>Defectos</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                            
                        <tbody id="revisions-table">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('footer')
    <div class="pull-right hidden-xs">
        Anything you want
    </div>
      
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
@endsection

@section('js')
    <script type="text/javascript">

        var inspection_id = null;
        
        $('#submitInspeccion').on('click', function(e) {
            e.preventDefault();
            
            var area_trabajo = $('#area_trabajo').val();
            var inspector = $('#inspector').val();
            var company = $('#company').val();
            var product = $('#product').val();

            axios.post('{{route('inspection.store')}}', {
                area_trabajo: area_trabajo,
                inspector: inspector,
                company: company,
                product: product
            }).then(response => {
                $('#area_trabajo').prop('disabled', true);
                $('#inspector').prop('disabled', true);
                $('#company').prop('disabled', true);
                $('#product').prop('disabled', true);
                $('#submitInspeccion').prop('disabled', true);

                inspection_id = response.data.inspection.id;

                Swal.fire({
                    title: 'Continua haciendo las revisiónes',
                    type: 'success'
                })
            }).catch(response => {
                console.log(response);
            })
        })

        $('#box_number').on('change', function() {
            $('#good_pieces').focus();
        });

        $('#good_pieces').on('change', function() {
            $('#bad_pieces').focus();
        });

        $('#bad_pieces').on('blur', function(e) {
            e.preventDefault();

            var box_number = $('#box_number').val();
            var good_pieces = $('#good_pieces').val();
            var bad_pieces = $('#bad_pieces').val();

            axios.post('{{route('revisions.store')}}', {
                inspection_id: inspection_id,
                box_number: box_number,
                good_pieces: good_pieces,
                bad_pieces: bad_pieces
            }).then(response => {
                $('#box_number').val('');
                $('#good_pieces').val('');
                $('#bad_pieces').val('');
                $('#box_number').focus();

                axios.get(`http://localhost/sorteo/public/revisions/show/${inspection_id}`).then(res => {
                    console.log(res.data);

                    $('#revisions-table').empty();
                    // res.data.forEach(element => {
                    //     $('#revisions-table').append(`<tr><td>${element.box_number}</td><td>${element.good_pieces}</td><td>${element.bad_pieces}</td><td>${element.total}</td></tr>`);
                    // });
                    $.each(res.data, function(idx, el) {
                        $('#revisions-table').append(`<tr><td>${el.box_number}</td><td>${el.good_pieces}</td><td>${el.bad_pieces}</td><td>${el.total}</td></tr>`);
                    })
                });

            }).catch(response => {
                console.log(response);
            });

        })
    </script>
@endsection
