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
                            
                            @if (is_null($id) === false)
                                @php
                                    $languages = \App\Models\Languages::where('active', '<>', 2);
                                @endphp
                                @if ($languages->exists())
                                    <ul class="nav nav-pills navtab-bg nav-justified mb-3">
                                        @foreach ($languages->get() as $language)
                                            <li class="nav-item">
                                                <a href="{{ route('contents.form', ['id' => $formFields['id']['value'], 'language_id' => $language->id, 'category_id' => $category_id]) }}" class="nav-link {{ $formFields['language_id']['value'] == $language->id ? 'active' : '' }}">
                                                    {{ $language->language }}
                                                </a>
                                            </li>
                                        @endforeach 
                                    </ul>    
                                @endif
                            @endif

                            <x-form-fields :formFields="$formFields" :id="$id" :route="$route" :extraData="$extraData" />
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection