<div class="container p-0 bg-transparent">
    <div class="card mb-0">
        <div class="card-body">
            <h4 class="header-title mt-0 mb-4">Upload de arquivos</h4>                                      

            <form action="{{ route('files.upload-submit', ['module' => $module, 'link_id' => $link_id, 'file_gallery_id' => $file_gallery_id]) }}" method="post" class="dropzone mb-3" id="dropzone-form">
                @csrf   
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>

                <div class="dz-message needsclick">
                    <i class="h1 text-muted  uil-cloud-upload"></i>
                    <h3>Solte os arquivos aqui ou clique para fazer o upload.</h3>                               
                </div>
            </form>

            <div class="text-right">
                <button type="button" class="btn btn-dark">FECHAR</button>
            </div>

        </div>
    </div>
</div>