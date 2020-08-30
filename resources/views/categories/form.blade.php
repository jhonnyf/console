@extends('layouts.vertical')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Console</a></li>
                    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Categoria</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ is_null($id) ? "Novo" : "Editar" }}</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Categoria</h4>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#main" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <span class="d-block d-sm-none"><i class="uil-home-alt"></i></span>
                                <span class="d-none d-sm-block ">Principal</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane show active" id="main">
                            <x-form-fields :formFields="$formFields" :id="$id" :route="$route" />
                        </div>
                    </div>                    

                </div>
            </div>

        </div>
    </div>

@endsection