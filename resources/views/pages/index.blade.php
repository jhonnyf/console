@extends('layouts.vertical')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Console</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Páginas</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Páginas</h4>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">

            @if ($pages->count())
                <div class="row">
                    @foreach ($pages as $item)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <?=$item->name?>
                                </div>
                            </div>    
                        </div>  
                    @endforeach
                </div>
            @endif 

        </div>
    </div>

@endsection