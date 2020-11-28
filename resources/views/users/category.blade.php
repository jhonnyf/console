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

                            @php
                                $action = route("{$route}.category-store", ['id' => $id]);                                    
                            @endphp
                            
                            <form action="{{ $action }}" method="POST" class="form-horizontal" autocomplete="off">
                                @csrf

                                @if ($categories->count() > 0)                                
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label">{{ $categories->category }}</label>
                                        <div class="col-lg-10">
                                            <select name="category_id" class="form-control custom-select">
                                                @if ($categories->categorySecondary->count() > 0)
                                                    @foreach ($categories->categorySecondary as $row)                
                                                        <option value="{{ $row->id }}" {{ $category->id === $row->id ? 'selected' : ''  }}>{{ $row->category }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                @endif

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