@props( [
'listTitle' => '',
'listFormat' => '',
'listActionRoute' => '',
'listActionTitle' => '',
'listActionClass' => '',
])
<div class="component component-listtitle">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="items">
                    <div class="title">
                        <x-component-generate-title
                            title="{{$listTitle}}"
                            format="{{$listFormat}}"/>
                    </div>
                    @if ($listActionRoute != null)
                        <a role="button" href="{{route($listActionRoute)}}" class=" ">{{ $listActionTitle }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
