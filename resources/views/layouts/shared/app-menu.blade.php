<ul class="metismenu" id="menu-bar">
    <li class="menu-title">Navigation</li>

    <li>
        <a href="/">
            <i data-feather="home"></i>
            <span class="badge badge-success float-right">1</span>
            <span> Dashboard </span>
        </a>
    </li>
    <li class="menu-title">Apps</li>
    <li>
        <a href="javascript: void(0);">
            <i data-feather="users"></i>
            <span>Usuário</span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="nav-second-level" aria-expanded="false">
            @php
                $usersTypes = \App\Models\Categories::find(2)->categorySecondary;                
            @endphp
            @if ($usersTypes->count() > 0)
                @foreach ($usersTypes as $item)
                    <li>
                        <a href="{{ route('users.index', ['category_id' => $item->id ]) }}">{{ $item->category }}</a>
                    </li>
                @endforeach
            @endif            
        </ul>
    </li>
    <li>
        <a href="{{ route('categories.index') }}">
            <i data-feather="sliders"></i>
            <span>Categoria</span>            
        </a>        
    </li>
    <li>
        <a href="{{ route('contents.list-categories') }}">
            <i data-feather="file-text"></i>
            <span>Conteúdo</span>            
        </a>        
    </li>
</ul>
