<footer id="footerMenu" aria-label="Footerbereich">
    <div class="component footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 order-2 order-md-1">
                    <nav aria-label="Rechtliches" class="footer-navigation">
                        @include(config('laravel-menu.views.bootstrap-items'), ['items' => Menu::get('footerMenu')->roots(), 'ulid' => 'mainMenuFooter', 'ulclass' => 'component-textlink-list', 'liclass' => ''])
                    </nav>
                </div>
                <div class="col-12 col-md-6 order-1 order-md-2">
                    <div class="nav-item-buttons">
                        <nav aria-label="Hilfsoptionen" class="footer-buttons">
                            @include(config('laravel-menu.views.bootstrap-items'), ['items' => Menu::get('helpMenu')->roots(), 'ulid' => 'helpMenu', 'ulclass' => 'component-border-button-list', 'liclass' => ''])
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
