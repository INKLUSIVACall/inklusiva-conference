<div data-type="area" data-area-type="overlay-navigation" data-area-id="overlay-navigation"
     class="overlay-navigation hide-xxl hide-xl hide-lg hide-md hide-sm hide-xs invisible" data-anim-time-xxl="220"
     data-anim-time-xl="220" data-anim-time-lg="220" data-anim-time-md="220" data-anim-time-sm="220"
     data-anim-time-xs="220" id="overlay-navigation">
    <div data-type="area-wrapper">
        <div class="content">
            <div class="items">
                <div class="item navigation">
                    @include(config('laravel-menu.views.bootstrap-items'), ['items' => Menu::get('mainMenu')->roots(), 'ulid' => 'mainMenu-overlay', 'ulclass' => 'component-navigation-main', 'liclass' => '', 'ariaLabel' => 'Seitennavigation'])
                </div>
                <div class="item language">
                    <x-inputs.langSelectOverlay></x-inputs.langSelectOverlay>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TODO: Javascript projektkonform auslagern, ggf eindampfen  -->

<script>
const itemExpandToggle = document.querySelector('#meinProfil_expand');
    itemExpandToggle.addEventListener("click", () =>{
        if(itemExpandToggle.getAttribute("aria-expanded") === "false"){
            itemExpandToggle.setAttribute("aria-expanded", "true")
        }else{
            itemExpandToggle.setAttribute("aria-expanded", "false")
        }
    })

</script>
