<ul @if (isset($ulclass)) class="{!! $ulclass !!}" @endif
    @if (isset($ulid)) id="{!! $ulid !!}" @endif
    @if (isset($ariaLabel)) aria-label="{!! $ariaLabel !!}" @endif>
    @foreach ($items as $item)
        @if (isset($item->attributes['method']) && $item->attributes['method'] === 'post')
            <li class="outline @if ($item->active) li-active @endif @if (isset($liclass)) {!! $liclass !!} @endif @if (isset($item->data['aliclass'])) {!! $item->data['aliclass'] !!} @endif"
                @lm_attrs($item) @if ($item->hasChildren())  @endif @lm_endattrs>
                @if ($item->link)
                    <form @lm_attrs($item->link) @lm_endattrs action="{!! $item->url() !!}" method="post">
                        @csrf
                        <a class="@if (isset($item->data['aclass'])) {!! $item->data['aclass'] !!} @endif " href="javascript:;"
                            onclick="this.closest('form').submit()">
                            @if (isset($item->data['icon']))
                                <i class="icon {!! $item->data['icon'] !!}"></i>
                            @endif
                            @if (isset($item->data['img']))
                                <div class="image"><img aria-hidden="true" src="{!! $item->data['img'] !!}" /></div>
                            @endif
                            <span class="title"
                                @if ($item->active) aria-label=" Derzeit aktive Seite: {!! $item->title !!} " @endif>{!! $item->title !!}</span>
                        </a>
                    </form>
                @else
                    <span
                        class="title"@if ($item->active) aria-label=" Derzeit aktive Seite: {!! $item->title !!} " @endif>{!! $item->title !!}</span>
                @endif

            </li>
        @else
            <li class="outline @if ($item->active) li-active @endif @if (isset($liclass)) {!! $liclass !!} @endif @if (isset($item->data['aliclass'])) {!! $item->data['aliclass'] !!} @endif"
                @lm_attrs($item) @lm_endattrs>

                @if (isset($item->data['demolink']) && $item->data['demolink'] == true)
                    <a href="javascript:void(0)" aria-describedby="demolink" style="cursor: pointer;"
                        class="{!! $item->data['aclass'] !!}">
                        @if (isset($item->data['icon']))
                            <i class="icon {!! $item->data['icon'] !!}"></i>
                        @endif

                        @if (isset($item->data['img']))
                            <div class="image">
                                <img aria-hidden="true" src="{!! $item->data['img'] !!}"
                                    @if (isset($item->data['alt'])) alt="{!! $item->data['alt'] !!}" @endif />
                            </div>
                        @endif

                        <span class="title">{!! $item->title !!}</span>
                    </a>
                @else
                    @if (isset($item->data['onclick']) && $item->data['onclick'] == true)
                        <a @lm_attrs($item->link) @lm_endattrs href="javascript:void(0)" @if (isset($item->data['aclass']))
                            class="{!! $item->data['aclass'] !!}"
                    @endif
                    @if (isset($item->data['target']))
                        target="{!! $item->data['target'] !!}"
                    @endif
                    @if ($item->hasChildren())
                        id="{!! $item->nickname !!}_expand" aria-controls="navbarCollapse"
                        aria-expanded="false"
                    @endif
                    onclick="{!! $item->data['onclick'] !!}">
                    @if (isset($item->data['icon']))
                        <i class="icon {!! $item->data['icon'] !!}"></i>
                    @endif
                    @if (isset($item->data['img']))
                        <div class="image"><img aria-hidden="true" src="{!! $item->data['img'] !!}" /></div>
                    @endif

                    <span class="title"
                        @if ($item->active) aria-label=" Derzeit aktive Seite: {!! $item->title !!} " @endif>
                        {!! $item->title !!}</span>
                    </a>
                @elseif ($item->link)
                    <a @lm_attrs($item->link) @lm_endattrs href="{!! $item->url() !!}" @if (isset($item->data['aclass']))
                        class="{!! $item->data['aclass'] !!}"
                @endif
                @if (isset($item->data['target']))
                    target="{!! $item->data['target'] !!}"
                @endif
                @if ($item->hasChildren())
                    id="{!! $item->nickname !!}_expand" aria-controls="navbarCollapse" aria-expanded="false"
                @endif >

                <!-- ID required so aria-expanded can be toggled through javascript/queryselector -->
                @if (isset($item->data['icon']))
                    <i class="icon {!! $item->data['icon'] !!}"></i>
                @endif

                @if (isset($item->data['img']))
                    <div class="image"><img aria-hidden="true" src="{!! $item->data['img'] !!}" /></div>
                @endif

                <span class="title"
                    @if ($item->active) aria-label=" Derzeit aktive Seite: {!! $item->title !!} " @endif>
                    {!! $item->title !!}</span>
                </a>
            @else
                <span class="title"
                    @if ($item->active) aria-label=" Derzeit aktive Seite: {!! $item->title !!} " @endif>{!! $item->title !!}</span>
        @endif

        @if ($item->hasChildren())
            @include(config('laravel-menu.views.bootstrap-items'), ['items' => $item->children()])
        @endif
    @endif
    </li>
    @if ($item->divider)
        <li{!! Lavary\Menu\Builder::attributes($item->divider) !!}>
            </li>
    @endif
    @endif
    @endforeach
</ul>
