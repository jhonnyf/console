@extends('layouts.vertical')

@section('breadcrumb')
    <x-breadcrumb :id="$id" :route="$route" :name="$name" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">       

                    <x-nav :id="$id" :nav="$nav" />

                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane show active" id="main">
                            
                            <form action="{{ route("{$route}.category-store", ['id' => $id]) }}" method="POST" class="form-horizontal" autocomplete="off">
                                @csrf
                                
                                <div class="text-right">
                                    <a href="{{ route("users.index") }}" class="btn btn-primary">Voltar</a>
                                    <button type="submit" class="btn btn-dark">Salvar</button>
                                </div>

                            </form>

                        </div>
                    </div>                    

                </div>
            </div>

        </div>
    </div>
@endsection