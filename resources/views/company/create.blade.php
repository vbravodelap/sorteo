@extends('adminlte::page')

@section('title', 'Pluss | Sorteo 4.0')

@section('content_header')
    <h1>Crear empresa</h1>
@stop

@section('content')
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nombre de la empresa" required>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="address" id="address" placeholder="Dirección" required>
                    </div>

                    <div class="form-group col-md-4">
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">Seleccionar usuario</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button id="submitCompany" class="col-md-offset-5 btn btn-primary">
                    Guardar
                </button>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $('#submitCompany').on('click', function(e) {
            e.preventDefault();

            var name = $('#name').val();
            var address = $('#address').val();
            var user_id = $('#user_id').val();
            var token = '{{ csrf_token() }}';

            axios.post('{{route('company.store')}}', {
                name: name,
                address: address,
                user_id: user_id,
                _token: token
            }).then(response => {
                Swal.fire({
                    title: 'La empresa se creo correctamente',
                    type: 'success'
                });

                $('#name').val('');
                $('#address').val('');
                $('#user_id').val('');

            }).catch(response => {
                Swal.fire({
                    title: 'La empresa no se creo correctamente',
                    text: 'Revisa que todos los campos esten llenados correctamente.',
                    type: 'error'
                });
            })
        })
    </script>
@stop