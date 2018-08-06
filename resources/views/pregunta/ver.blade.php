@extends ('layouts.dashboard')
@section('page_heading','Paciente')
@section('section')

<div class="row">
    <div class="col-sm-12">
        @section ('cotable_panel_title','Listado de Turnos')
        @section ('cotable_panel_body')

                <table class="table">
                    <thead>
                    <tr>
                        <th>Medico</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($paciente->turnos as $turno)
                        <tr id="row-{{$turno->id}}">
                            <td>{{ $turno->medico->nombre  }}</td>
                            <td> {{ $turno->fecha->format('d-m-Y') }} </td>
                            <td>{{ $turno->hora  }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        @include('widgets.popup_delete')
        @endsection
        @include('widgets.panel', array('class'=>'default','header'=>true, 'as'=>'cotable'))
    </div>
</div>

@endsection
@endsection
@stop
