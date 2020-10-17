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
                            <a href="{{ route('categories.form', ['id' => $id]) }}" class="nav-link ">
                                <span class="d-block d-sm-none"><i class="uil-home-alt"></i></span>
                                <span class="d-none d-sm-block ">Principal</span>
                            </a>                            
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.tree', ['id' => $id]) }}"  class="nav-link active">
                                <span class="d-block d-sm-none"><i class="uil-home-alt"></i></span>
                                <span class="d-none d-sm-block ">Árvore</span>
                            </a>    
                        </li>
                    </ul>

                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane show active">
                            @if ($errors->any())       
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{$error}}</div>
                                @endforeach
                            @endif

                            <form action="{{ route('categories.save-tree', ['id' => $id]) }}" method="post">
                                <input type="hidden" name="secondary_id" value="{{ $id }}">
                                @csrf
                                <div class="form-group">
                                    <label>Selecione as categorias superiores</label>
                                    <select name="primary_id[]" class="form-control wide" data-plugin="customselect" multiple>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" {{ in_array($item->id, $links) ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <a href="{{ route("{$route}.index") }}" class="btn btn-primary">Voltar</a>
                                <button class="btn btn-dark">Salvar</button>
                            </form>
                        </div>
                    </div>                    

                </div>
            </div>

        </div>
    </div>

@endsection

@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>
@endsection