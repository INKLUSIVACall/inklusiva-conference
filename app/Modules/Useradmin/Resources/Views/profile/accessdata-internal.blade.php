<x-component-whitebox
    title="{{__('backend/accessdata.whitebox.title')}}"
    format="{{__('backend/accessdata.whitebox.format')}}"
    ariaLabel="{{__('backend/accessdata.whitebox.ariaLabel')}}">

    <x-component-datacollection
        id="personal-data-mail"
        headline=""
    >
        <x-component-datacollection-item
            icon=""
            title="{{__('backend/accessdata.edit.input.email')}}"
            value="{!! $user->email !!}"
            ariaLabelForTitle="Angabe {!!__('backend/accessdata.edit.input.email')!!} Ihre Eingabe war {!! $user->email !!}"
        />

        @if (isset($user->new_email))
            <x-component-datacollection-item
                icon=""
                title="{{__('backend/accessdata.edit.input.emailNew')}}"
                value="{!! $user->new_email !!}"
            />
        @endif

        @if (isset($user->new_email))
            <x-component-textlink
                linkName="{{__('backend/accessdata.datacollection.linkEmailConfirm')}}"
                linkHref="{{ route('useradmin.profile.confirmEmail') }}"
            />
        @endif
        <x-component-textlink
            linkName="{{__('backend/accessdata.datacollection.linkEmailEdit')}}"
            linkHref="{{ route('useradmin.profile.editEmail') }}"
        />
    </x-component-datacollection>

    <x-component-datacollection
        id="personal-data-password"
        headline=""
    >
        <x-component-datacollection-item
            icon=""
            title="{{__('backend/accessdata.edit.input.password')}}"
            value="************"
            ariaLabelForTitle="Angabe {!!__('backend/accessdata.edit.input.password')!!}"
        />


        <x-component-textlink
            linkName="{{__('backend/accessdata.datacollection.linkPasswordEdit')}}"
            linkHref="{{ route('useradmin.profile.editPassword') }}"
        />

    </x-component-datacollection>
</x-component-whitebox>

