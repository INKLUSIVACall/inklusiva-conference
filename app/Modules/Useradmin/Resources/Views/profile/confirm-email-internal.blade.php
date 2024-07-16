<x-component-form id="confirmPin" method="post" action="{{ route('useradmin.profile.switchEmail') }}" :meeting="null">
    <x-component-whitebox
        format="{{__('backend/accessdata.confirmEmail.whitebox.format')}}"
        title="{{__('backend/accessdata.confirmEmail.whitebox.title')}}"
        ariaLabel="{{__('backend/accessdata.confirmEmail.whitebox.ariaLabel')}}"
    >

        <x-inputs.title-description
            elementTitleText="{{__('backend/accessdata.confirmEmail.titleDesc.title')}}"
            elementTitleSmall=""
            elementTitleBook=""
            elementIcon=""
            elementDesc="{{__('backend/accessdata.confirmEmail.titleDesc.desc')}}"
        >
        </x-inputs.title-description>

        <x-inputs.inputfield
            elementTitleText="{{__('backend/accessdata.confirmEmail.input.Pin')}}"
            elementTitleSmall="true"
            elementTitleBook="true"
            elementAsLabel="true"
            elementIcon=""
            elementDesc=""
            elementId="pin"
            elementName="pin"
            elementPlaceholder="{{__('backend/accessdata.confirmEmail.input.PinPlaceholder')}}"
            :elementValue="old('pin')">


            <div class="component-textlink-list-wb">
                <x-component-textlink
                    linkName="{{__('backend/accessdata.confirmEmail.linkGeneratePin')}}"
                    linkHref="{{ route('useradmin.profile.sendPinAgain') }}"
                />
                <x-component-textlink
                    linkName="{{__('backend/accessdata.confirmEmail.linkEmailUpdate')}}"
                    linkHref="{{ route('useradmin.profile.editEmail') }}"
                />
            </div>
        </x-inputs.inputfield>

    </x-component-whitebox>
</x-component-form>



@section('formcontrols')
    <a class="btn btn-secondary component-button"
       href="{{ route('useradmin.profile.accessDataIndex') }}">{{__('backend/personaldata.edit.button.cancel')}}</a>
    <input type="submit" class="btn btn-primary component-button"
           value="{{__('backend/accessdata.confirmEmail.button.save')}}"
           form="confirmPin">
@endsection
