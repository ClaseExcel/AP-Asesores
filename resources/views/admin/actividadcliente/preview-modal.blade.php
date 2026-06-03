 <!-- Modal para vista previa de archivo -->
    <div class="modal fade" id="filePreviewModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewTitle">Vista previa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="previewContent">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" onclick="downloadFile()">
                        <i class="fas fa-download"></i> Descargar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentFile = {
            url: null,
            name: null,
            extension: null
        };

        function showFileOptions(event, fileUrl, fileName, extension) {
            event.preventDefault();
            currentFile = {
                url: fileUrl,
                name: fileName,
                extension: extension
            };

            previewFile();
        }

        function previewFile() {
            const previewContent = document.getElementById('previewContent');
            const previewTitle = document.getElementById('previewTitle');

            previewTitle.textContent = 'Vista previa: ' + currentFile.name;

            if (['jpg', 'jpeg', 'png', 'gif'].includes(currentFile.extension)) {
                previewContent.innerHTML = '<img src="' + currentFile.url + '" class="img-fluid" style="max-width: 100%;">';
            } else if (currentFile.extension === 'pdf') {
                previewContent.innerHTML = '<iframe src="' + currentFile.url + '" style="width: 100%; height: 600px; border: none;"></iframe>';
            }

            const previewModal = new bootstrap.Modal(document.getElementById('filePreviewModal'));
            previewModal.show();
        }

        function downloadFile() {
            const a = document.createElement('a');
            a.href = currentFile.url;
            a.download = currentFile.name;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    </script>
