@extends('layouts.admin')
@section('title', 'Info comunicado')
@section('content')

    <div class="form-group">
        <a class="btn  btn-back  border btn-radius px-4" href="{{ route('admin.comunicados.index') }}">
            <i class="fas fa-arrow-circle-left"></i> Atrás
        </a>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Información del comunicado
                </div>

                <div class="card-body">
                    <h5>Comunicado N° {{ $comunicado->id }}</h5><br>
                    @if($comunicado->clientes != 'null' && $comunicado->clientes )
                    <p><strong>Clientes:</strong> {{ $comunicado->clientes }}</p>
                    @endif
                    @if($comunicado->usuarios != 'null' && $comunicado->usuarios)
                    <p><strong>Usuarios:</strong> {{ $comunicado->usuarios }}</p>
                    @endif
                    <p><strong>Correos enviados:</strong> {{ $comunicado->correos_enviados }}</p>
                    <p><strong>Usuario que notifica:</strong> {{ $comunicado->user->nombres }}
                        {{ $comunicado->user->apellidos }}</p>
                    <p><strong>Fecha de envió:</strong>
                        {{ \Carbon\Carbon::parse($comunicado->created_at)->format('d-m-Y H:i A') }}</p>
                    <hr>
                    <div><strong>Comunicado:</strong></div>
                    <div>{!! $comunicado->comunicado !!}</div>
                </div>

                @if ($docList)
                    <div class="card-body">
                        <h6><i class="fas fa-paperclip"></i> Documentos adjuntos </h6>
                        <table class="table table-hover table-sm">
                            <tbody>
                                @foreach ($docList as $key => $docName)
                                    <tr>
                                        <td class="pl-4 border border-top-0 border-left-0 border-right-0">
                                            {{ basename($docName) }}
                                        </td>
                                        <td class=" border border-top-0 border-left-0 border-right-0 text-center">

                                            {{-- Descarga directa si la extensión es zip o rar --}}
                                            @if (pathinfo($docName, PATHINFO_EXTENSION) == 'zip' ||
                                                    pathinfo($docName, PATHINFO_EXTENSION) == 'rar' ||
                                                    pathinfo($docName, PATHINFO_EXTENSION) == 'xlsx' ||
                                                    pathinfo($docName, PATHINFO_EXTENSION) == 'xls')
                                                <a type="button" class="btn-ver px-3" href="{{ asset($docName) }}"
                                                    download>
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @else
                                                <!-- Button trigger modal -->
                                                <a type="button" class="btn-ver px-3" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $key }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif


                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Documento
                                                        {{ basename($docName) }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-0 d-flex justify-content-center">

                                                    @if (pathinfo($docName, PATHINFO_EXTENSION) == 'pdf')
                                                        <iframe src="{{ asset($docName) }}"
                                                            style="width:100%;height:637px;" frameborder="0">
                                                        </iframe>
                                                    @else
                                                        <img src="{{ asset($docName) }}" alt="" width="100%"
                                                            style="max-width: 750px;"">
                                                    @endif

                                                </div>
                                                <div class="modal-footer border-0">
                                                    <a class="btn btn-save text-white shadow-none mx-auto"
                                                        href="{{ asset($docName) }}" download>
                                                        <i class="fas fa-arrow-alt-circle-down"></i>
                                                        Descargar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>



@endsection
