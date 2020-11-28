<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Console</a></li>
                <li class="breadcrumb-item"><a href="{{ route("{$route}.index") }}">{{ $name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ is_null($id) ? "Novo" : "Editar" }}</li>
            </ol>
        </nav>
        <h4 class="mb-1 mt-0">{{ $name }}</h4>
    </div>
</div>