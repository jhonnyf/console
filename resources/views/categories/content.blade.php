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

                        @if ($languages->exists())
                            <ul class="nav nav-pills navtab-bg nav-justified mb-3">
                                @foreach ($languages->get() as $language)
                                    <li class="nav-item">
                                        <a href="{{ route('categories.content', ['id' => $id, 'language_id' => $language->id, 'category_id' => $category_id]) }}" class="nav-link {{ $language_id == $language->id ? 'active' : '' }}">
                                            {{ $language->language }}
                                        </a>
                                    </li>
                                @endforeach 
                            </ul>    
                        @endif

                        {!!$form!!}
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection