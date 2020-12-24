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
                            

                            <ul class="nav nav-pills navtab-bg nav-justified mb-3">
                                <li class="nav-item">
                                    <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        <span class="d-block d-sm-none"><i class="uil-home-alt"></i></span>
                                        <span class="d-none d-sm-block">PT</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                        <span class="d-block d-sm-none"><i class="uil-user"></i></span>
                                        <span class="d-none d-sm-block">IN</span>
                                    </a>
                                </li>
                            </ul>

                            <x-form-fields :formFields="$formFields" :id="$id" :route="$route" :extraData="$extraData" />
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection