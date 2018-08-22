@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <label class="control-label">Crear Pregunta</label>
                </div>
    <div class="panel-body">
     
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form role="form" method="POST" action="{{ action('PreguntaController@store') }}">
                {!! csrf_field() !!}

                <div class="form-group">
                   <label class="control-label">Pregunta</label>
                   <input type="text" class="form-control" name="nombre" value="" required 
                   onfocus="this.value=''" placeholder="Escribe aqui..">
                </div>
<div class="form-group">
                <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Nivel</label>
                    <select class="form-control" name="niv" id="nivel" required>
                      <option value="">=== Select Nivel ===</option>
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->id }}">
                                {{ $nivel->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
        <div class="row col-md-6" style="margin-left: 20px">
              <label for="color">Respuesta:</label>
                <br>
                <input type="radio" required name="respuesta" id="respuesta" value="Si">Si<br>
                <input type="radio" required name="respuesta" id="respuesta" value="No">No<br>
        </div>
</div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Guardar</button>
                <a href="{{ action('PreguntaController@index') }}" class="btn btn-default" style="margin-top: 20px;">Cancelar</a>
            </div>
        </form>
       
    </div>

            </div>
        </div>
    </div>
</div>

    <style type="text/css">
        .bar {
            height: 18px;
            background: green;
        }
    </style>


    <script>
        /*jslint unparam: true */
        /*global window, $ 
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
        });*/
    </script>
@endsection

