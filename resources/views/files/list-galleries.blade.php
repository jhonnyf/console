@extends('layouts.vertical')

@section('breadcrumb')
    <x-breadcrumb :id="$id_link" :route="$route" :name="$name" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">       

                    <x-nav :id="$id_link" :nav="$nav" />

                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane show active" id="main">
                             
                            <p class="mb-0">Selecione abaixo uma galeria para fazer upload</p>

                        </div>
                    </div>                    

                </div>
            </div>
        </div>
    </div>
@endsection