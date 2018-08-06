@extends ('layouts.dashboard')
@section('page_heading','Nuevo Paciente')
@section('section')
@section ('panel1_panel_title', 'Datos')

    <div class="col-md-12">
        @if (Session::get('status'))
            <div class="alert alert-success  alert-dismissable " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {!! Session::get('status') !!}.
            </div>
        @endif
    </div>
    <div class="col-sm-6">
        @section ('panel1_panel_body')
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form role="form" method="POST" action="{{ action('PacientesController@store') }}">
                {!! csrf_field() !!}


                <div class="form-group {{$errors->has('nombre') ? 'has-error' : ''}}">
                    <label class="control-label">Nombre</label>
                    {!! Form::text('nombre', null, ["class" => "form-control", "placeholder"=>"Nombre del Paciente"]) !!}

                </div>

                <div class="form-group {{$errors->has('apellido') ? 'has-error' : ''}}">
                    <label class="control-label">Apellido</label>
                    {!! Form::text('apellido', null, ["class" => "form-control", "placeholder"=>"Apellido del Paciente"]) !!}

                </div>

                <div class="form-group {{$errors->has('telefono') ? 'has-error' : ''}}">
                    <label class="control-label">Telefono</label>
                    {!! Form::text('telefono', null, ["class" => "form-control", "placeholder"=>"Telefono del Paciente"]) !!}
                </div>
                <div class="form-group {{$errors->has('dni') ? 'has-error' : ''}}">
                    <label class="control-label">DNI</label>
                    {!! Form::text('dni', null, ["class" => "form-control", "placeholder"=>"DNI del Paciente"]) !!}
                </div>

                <div class="form-group {{$errors->has('observaciones') ? 'has-error' : ''}}">
                    <label class="control-label">Observaciones</label>
                    {!! Form::textarea('observaciones', null, ["class" => "form-control", "placeholder"=>"Observaciones del Paciente"]) !!}
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ action('PacientesController@index') }}" class="btn btn-default">Cancelar</a>
            </form>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'panel1'))
    </div>
    <style type="text/css">
        .bar {
            height: 18px;
            background: green;
        }
    </style>


    <script>
        /*jslint unparam: true */
        /*global window, $ */
        $(function () {
            'use strict';
            // Change this to the location of your server-side upload handler:
            var url = 'http://localhost/intranet/public/uploadFile';
            $('#fileupload').fileupload({
                url: url,
                dataType: 'multipart/form-data',
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo('#files');
                    });
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                            'width',
                            progress + '%'
                    );
                }
            }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });
    </script>
@endsection
@endsection
@stop
