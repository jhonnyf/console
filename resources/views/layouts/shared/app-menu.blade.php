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
            <i data-feather="inbox"></i>
            <span> Usuário </span>
            <span class="menu-arrow"></span>
        </a>

        <ul class="nav-second-level" aria-expanded="false">
            <li>
                <a href="<?=route('users.index')?>">Usuário</a>
                <a href="<?=route('usersTypes.index')?>">Tipo de usuário</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="<?=route('categories.index')?>">
            <i data-feather="sliders"></i>
            <span>Categoria</span>            
        </a>        
    </li>
    <li>
        <a href="<?=route('pages.index')?>">
            <i data-feather="file-text"></i>
            <span>Páginas</span>            
        </a>        
    </li>
</ul>
