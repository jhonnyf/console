@extends('layouts.vertical')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Console</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tipo de usuário</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Tipo de usuário</h4>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">           

                    <div class="text-right mb-3">
                        <a href="{{route('usersTypes.form')}}" class="btn btn-dark width-lg">novo</a>
                    </div>

                    <x-table-list :list="$list"/>
                    
                </div>
            </div>

        </div>
    </div>

@endsection