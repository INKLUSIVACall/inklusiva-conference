<div data-type="component" class="functionality d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="items">
                    <div class="item item-language-switch">
                        <div data-type="component" class="language-switch header-functions">
                            <div class="title">
                                <i class="fa-solid fa-globe"></i>
                                <span>Sprache</span>
                            </div>
                            <div class="values">
                                <ul>
                                    <li class="de @if(session('language', 'de-DE') == 'de-DE') active @endif">
                                        <a href="{{route('switchLanguage', ['language' => 'de-DE'])}}"><span>Alltagssprache</span></a>
                                    </li>
                                    <li class="de-simple @if(session('language') == 'de-ES') active @endif">
                                        <a href="{{route('switchLanguage', ['language' => 'de-ES'])}}"><span>Einfache Sprache</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
