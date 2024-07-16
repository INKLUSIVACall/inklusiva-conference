<a href="{{ route('base.home') }}" class="outline"
   @guest aria-label="Weiter zum Login" @endguest @auth aria-label="Weiter zur Startseite" @endauth>
    <img role="button" class="logo-img" src="{{ Vite::asset('resources/images/logo-inklusiva-call.svg') }}" @guest alt="Weiter zum Login" @endguest @auth alt="Weiter zur Startseite" @endauth>
</a>
