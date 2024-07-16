<x-component-form id="updateEMail" method="post" action="{{ route('useradmin.profile.updateEmail') }}" :meeting="null">
    <x-component-whitebox
        format="{{__('backend/accessdata.editEmail.whitebox.format')}}"
        title="{{__('backend/accessdata.editEmail.whitebox.title')}}"
        ariaLabel="{{__('backend/accessdata.editEmail.whitebox.ariaLabel')}}"
    >
        <x-inputs.inputfield
            elementTitleText="{{__('backend/accessdata.editEmail.input.eMail')}}"
            elementTitleSmall="true"
            elementAsLabel="true"
            elementIcon=""
            elementDesc=""
            elementId="email"
            elementName="email"
            elementPlaceholder="{{__('backend/accessdata.editEmail.input.eMailPlaceholder')}}"
            :elementValue="old('email')">
        </x-inputs.inputfield>

        <x-inputs.inputfield
            elementTitleText="{{__('backend/accessdata.editEmail.input.eMailConfirm')}}"
            elementTitleSmall="true"
            elementAsLabel="true"
            elementIcon=""
            elementDesc=""
            elementId="emailconfirm"
            elementName="emailconfirm"
            elementPlaceholder="{{__('backend/accessdata.editEmail.input.eMailConfirmPlaceholder')}}"
            :elementValue="old('emailconfirm')">
        </x-inputs.inputfield>
    </x-component-whitebox>
</x-component-form>


@section('formcontrols')
    <a class="btn btn-secondary component-button"
       href="{{ route('useradmin.profile.accessDataIndex') }}">{{__('backend/personaldata.edit.button.cancel')}}</a>
    <input type="submit" class="btn btn-primary component-button"
           value="{{__('backend/accessdata.editEmail.button.save')}}" form="updateEMail">
@endsection
