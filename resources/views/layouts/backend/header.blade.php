<div data-type="area" data-area-type="header" data-area-id="header">
    <div data-type="area-wrapper">
        <header aria-label="Headerbereich">
            <div class="component header header-backend">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="items">
                                <div class="item logo">
                                    @include('layouts.includes.logo')
                                </div>
                                <div class="item navigation-language">
                                    <div class="item navigation">
                                        <nav aria-label="Seitenhauptnavigation">
                                            @include(config('laravel-menu.views.bootstrap-items'), [
                                                'items' => Menu::get('mainMenu')->roots(),
                                                'ulid' => 'mainMenu',
                                                'ulclass' => 'component-navigation-main',
                                                'liclass' => '',
                                            ])
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>
