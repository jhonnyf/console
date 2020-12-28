<div class="container p-0 bg-transparent">
    <div class="card mb-0">
        <div class="card-header text-right">
            <button data-fancybox-close class="bg-transparent fancybox-button fancybox-button--close" title="Fechar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 10.6L6.6 5.2 5.2 6.6l5.4 5.4-5.4 5.4 1.4 1.4 5.4-5.4 5.4 5.4 1.4-1.4-5.4-5.4 5.4-5.4-1.4-1.4-5.4 5.4z"/></svg>
            </button>
        </div>
        <div class="card-body">
            @if ($languages->exists())
                <ul class="nav nav-pills navtab-bg nav-justified mb-3">
                @foreach ($languages->get() as $language)
                    <li class="nav-item">
                        <a data-url="{{ route('files.form', ['id' => $id, 'language_id' => $language->id]) }}" class="nav-link edit-form {{ $LanguageDefault->id == $language->id ? 'active' : '' }}">
                            {{ $language->language }}
                        </a>
                    </li>
                @endforeach
                </ul>
            @endif
            {!! $form !!}          
        </div>
    </div>
</div>