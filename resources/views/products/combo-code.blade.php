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
                        
                        {!!$form!!}

                        <p class="text-right mt-3">                            
                            <button data-url="{{ route('products.search-product', ['combo_code' => $Product->combo_code]) }}" class="btn btn-dark btn-search-product"><i data-feather="search"></i> adicionar produto </button>
                        </p>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">Nenhum registro foi localizado</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/fancybox/fancybox.min.css') }}">
@endsection

@section('script-bottom')
    <script src="{{ URL::asset('assets/libs/fancybox/fancybox.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/product.js') }}"></script>
@endsection