  <div class="row">
        {{-- Documentos adjuntos --}}
        @if ($docList)
            <div class="col-12 col-md-5 mb-5">
                <div class="card">
                    <div class="card-header text-center bg-transparent text-dark fs-6">
                        <i class="fas fa-paperclip"></i> Documentos adjuntos
                    </div>
                    <div class="p-3" style="max-height: 400px; overflow-y: auto;">
                        <div class="row g-3">
                            @foreach ($docList as $key => $docName)
                                @php
                                    $file = basename($docName);
                                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                    $isPreviewable = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'pdf']);
                                @endphp
                                <div class="col-6 col-md-6">
                                    @if ($isPreviewable)
                                        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#fileModal"
                                            data-file="{{ asset($docName) }}" data-filename="{{ $file }}"
                                            data-extension="{{ $extension }}"
                                            onclick="showFileOptions(event, '{{ asset($docName) }}', '{{ $file }}', '{{ $extension }}')">
                                            <div class="border rounded p-2 text-center h-100 d-flex flex-column justify-content-center"
                                                style="height: 120px; background-color: #f8f9fa; transition: all 0.3s; cursor: pointer;"
                                                onmouseover="this.style.backgroundColor='#e9ecef'" onmouseout="this.style.backgroundColor='#f8f9fa'">

                                                {{-- Imagen --}}
                                                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($docName) }}" alt="{{ $file }}"
                                                        style="max-width: 100%; max-height: 80px; object-fit: cover;">

                                                    {{-- PDF --}}
                                                @elseif ($extension === 'pdf')
                                                    <i class="fas fa-file-pdf" style="font-size: 2.5rem; color: #dc3545;"></i>
                                                @endif

                                                <small class="mt-2 text-muted d-block text-truncate">{{ $file }}</small>
                                            </div>
                                        </a>
                                    @else
                                        <a href="{{ asset($docName) }}" download class="text-decoration-none">
                                            <div class="border rounded p-2 text-center h-100 d-flex flex-column justify-content-center"
                                                style="height: 120px; background-color: #f8f9fa; transition: all 0.3s; cursor: pointer;"
                                                onmouseover="this.style.backgroundColor='#e9ecef'" onmouseout="this.style.backgroundColor='#f8f9fa'">

                                                {{-- Excel --}}
                                                @if (in_array($extension, ['xls', 'xlsm', 'xlsx']))
                                                    <i class="fas fa-file-excel" style="font-size: 2.5rem; color: #28a745;"></i>

                                                    {{-- Word --}}
                                                @elseif (in_array($extension, ['doc', 'docx']))
                                                    <i class="fas fa-file-word" style="font-size: 2.5rem; color: #0066cc;"></i>

                                                    {{-- Por defecto --}}
                                                @else
                                                    <i class="fas fa-file" style="font-size: 2.5rem; color: #6c757d;"></i>
                                                @endif

                                                <small class="mt-2 text-muted d-block text-truncate">{{ $file }}</small>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-0"></div>
                </div>
            </div>
        @endif
    </div>


   @include('admin.actividadcliente.preview-modal')