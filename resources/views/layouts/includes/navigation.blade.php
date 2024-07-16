@if ($type == 'mainMenu')
    @include(config('laravel-menu.views.bootstrap-items'), ['items' => Menu::get('mainMenu')->roots(), 'ulid' => $ulid, 'ulclass' => $ulclass, 'liclass' => $liclass])

    <!--<li class="nav-item">
        <a class="nav-link" href="{{ route('useradmin.profile.index') }}">Mein Profil</a>
    </li>
    <li class="nav-item">
        <form action="{!! route('logout') !!}" method="post">
            @csrf
            <button class="nav-item" type="submit">logout</button>
        </form>
    </li>-->
@endif
