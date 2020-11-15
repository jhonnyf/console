@extends('layouts.vertical')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Console</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuário</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ is_null($id) ? "Novo" : "Editar" }}</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Usuário</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">       

                    <x-nav :id="$id" :nav="$nav" />

                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane show active" id="main">
                            <x-form-fields :formFields="$formFields" :id="$id" :route="$route" :extraData="$extraData" />
                        </div>
                    </div>                    

                </div>
            </div>

        </div>
    </div>
@endsection