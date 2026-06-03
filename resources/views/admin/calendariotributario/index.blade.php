@extends('layouts.admin')
@section('title', 'Calendario Tributario')
@section('library')
    @include('cdn.fullcalendar-head')
@endsection
@section('content')


    <div style="margin-bottom: 30px;" class="row">
        <div class="col-lg-12">
            @can('CREAR_CALENDARIO_TRIBUTARIO')
                <a class="btn btn-back  border btn-radius" href="{{ route('admin.calendario.create') }}">
                    <i class="fas fa-circle-plus"></i>
                    Cargue Masivo
                </a>
                <a class="btn btn-back  border btn-radius" href="{{ route('admin.calendario.table') }}">
                    <i class="fa-solid fa-table"></i>
                    Datos Cargados
                </a>
            @endcan
            <a class="btn btn-back  border btn-radius" href="{{ route('admin.calendario.notificacion') }}">
                <i class="fa-solid fa-table"></i>
                Notificaciones
            </a>
        </div>
    </div>

    @include('admin.calendariotributario.calendario')

@endsection
