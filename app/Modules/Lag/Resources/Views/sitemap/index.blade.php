@extends('layouts.backend')
@section('pagetitle')
    Sitemap
@endsection


@section('content')
    <div class="container mt-5">

        @foreach ($menus as $menu)
            <ul class="mt-5">
                @foreach ($menu as $pageName => $pageData)
                    @if (isset($pageData['attributes']['route']))
                        <li>
                            @if (isset($pageData['data']['onclick']))
                                <a href="javascript:void(0)" class="outline component-textlink"
                                    onclick="{{ $pageData['data']['onclick'] }}">{{ $pageName }}</a>
                            @else
                                <a href="{{ route($pageData['attributes']['route']) }}"
                                    class="outline component-textlink">{{ $pageName }}</a>
                            @endif

                            @if (isset($pageData['children']))
                                <ul class="mt-1 mb-3">
                                    @foreach ($pageData['children'] as $childName => $childData)
                                        <li>
                                            @if (isset($childData['attributes']['route']))
                                                <a href="{{ route($childData['attributes']['route']) }}"
                                                    class="outline component-textlink">{{ $childName }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        @endforeach

    </div>
@endsection
