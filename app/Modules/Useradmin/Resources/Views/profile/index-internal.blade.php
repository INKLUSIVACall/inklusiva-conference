<x-component-whitebox
    title="{{__('backend/personaldata.index.whitebox.title')}}"
    format="{{__('backend/personaldata.index.whitebox.format')}}"
    ariaLabel="{{__('backend/personaldata.index.whitebox.ariaLabel')}}">

    <x-component-datacollection
        id="personal-data"
        headline="{{__('backend/personaldata.index.datacollection.headline')}}"
    >
        <x-component-datacollection-item
            icon=""
            title="{{__('backend/personaldata.edit.input.name')}}"
            value="{!! $user->getFullName() !!}"
            ariaLabelForTitle="Angabe {!!__('backend/personaldata.edit.input.name')!!} Ihre Eingabe war {!! $user->getFullName() !!}"
        />

        <x-component-datacollection-item
            icon=""
            title="{{__('backend/personaldata.edit.input.occupationName')}}"
            value="{!! $user->getOccupation() !!}"
            ariaLabelForTitle="Angabe {!!__('backend/personaldata.edit.input.occupationName')!!} Ihre Eingabe war {!! $user->getOccupation() !!}"
        />

        @if ($user->occupation === 'organisation')
            <x-component-datacollection-item
                icon=""
                title="{{__('backend/personaldata.edit.input.nameOrganisation')}}"
                value="{!! $user->organisation_name !!}"
                ariaLabelForTitle="Angabe {{__('backend/personaldata.edit.input.nameOrganisation')}} Ihre Eingabe war {!! $user->organisation_name !!}"
            />
        @endif

        <x-component-textlink
            linkName="{{__('backend/personaldata.index.datacollection.linkTitle')}}"
            linkHref="{{ route('useradmin.profile.editData') }}"
        />
    </x-component-datacollection>
</x-component-whitebox>
