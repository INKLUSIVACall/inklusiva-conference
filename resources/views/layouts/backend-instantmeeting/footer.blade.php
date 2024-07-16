<footer id="footerMenu" aria-label="Footerbereich">
    <div class="component footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3 order-2 order-md-1">
                </div>
                <div class="col-12 col-md-3 order-3 order-md-2">
                    <div id="footer-navigation-aside-label" aria-hidden="true" class="nav-title d-none d-md-block">
                        {{ __('backend/footer.footerTitleNavigationLinks') }}
                    </div>
                    <nav aria-labelledby="footer-navigation-aside-label" class="footer-navigation">
                        @include(config('laravel-menu.views.bootstrap-items'), ['items' => Menu::get('footerMenu')->roots(), 'ulid' => 'mainMenuFooter', 'ulclass' => 'component-textlink-list', 'liclass' => ''])
                    </nav>
                </div>
                <div class="col-12 col-md-6 order-1 order-md-3">
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
