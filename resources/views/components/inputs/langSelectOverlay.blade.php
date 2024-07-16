<ul
aria-label="Sprachauswahl"
aria-describedby="sprachauswahl-desc"
>
    <span id="sprachauswahl-desc" class="d-none">
    Hier kann zwischen einfacher Sprache und Alltagssprache gewechselt werden
    </span>
    <!-- Obs: Wenn Logik eingebaut wird ARIA-LABEL für aktives Item nicht vergessen! -->
    <li class="@if(session('language', 'de-DE') == 'de-ES') li-active @endif">
        <a id="burger-item1" class="burger-item" href="{{route('switchLanguage', ['language' => 'de-ES'])}}" aria-label="Aktuell gewählte Sprache: Einfache Sprache">
            Einfache Sprache
        </a>
    </li>
    <li class="@if(session('language', 'de-DE') == 'de-DE') li-active @endif">
        <a id="burger-item2" class="burger-item" href="{{route('switchLanguage', ['language' => 'de-DE'])}}">
            Alltagssprache
        </a>
    </li>
</ul>
