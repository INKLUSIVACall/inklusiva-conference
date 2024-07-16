<x-component-form id="editPersonalDataPassword" method="post" action="{{ route('useradmin.profile.updatePassword') }}"
    :meeting="null">

    <x-component-whitebox format="{{ __('backend/accessdata.editPassword.whitebox.format') }}"
        title="{{ __('backend/accessdata.editPassword.whitebox.title') }}"
        ariaLabel="{{ __('backend/accessdata.editPassword.whitebox.ariaLabel') }}">
        <x-inputs.inputfield elementTitleText="{{ __('backend/accessdata.editPassword.input.currentPassword') }}"
            elementTitleSmall="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="current_password"
            elementName="current_password"
            elementPlaceholder="{{ __('backend/accessdata.editPassword.input.currentPasswordPlaceholder') }}"
            elementValue="" elementType="password">
        </x-inputs.inputfield>

        <x-inputs.inputfield elementTitleText="{{ __('backend/accessdata.editPassword.input.newPassword') }}"
            elementTitleSmall="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="new_password"
            elementName="new_password"
            elementPlaceholder="{{ __('backend/accessdata.editPassword.input.newPasswordPlaceholder') }}"
            elementValue="" elementType="password">
        </x-inputs.inputfield>

        <x-inputs.inputfield
            elementTitleText="{{ __('backend/accessdata.editPassword.input.newPasswordConfirmation') }}"
            elementTitleSmall="true" elementAsLabel="true" elementIcon="" elementDesc=""
            elementId="new_password_confirmation" elementName="new_password_confirmation"
            elementPlaceholder="{{ __('backend/accessdata.editPassword.input.newPasswordConfirmationPlaceholder') }}"
            elementValue="" elementType="password">
        </x-inputs.inputfield>

        <div class="mb-3">
            <strong>{{ __('auth.password.length') }}</strong>
        </div>

    </x-component-whitebox>
</x-component-form>




@section('formcontrols')
    <a class="btn btn-secondary component-button"
        href="{{ route('useradmin.profile.accessDataIndex') }}">{{ __('backend/personaldata.edit.button.cancel') }}</a>
    <input type="submit" class="btn btn-primary component-button"
        value="{{ __('backend/accessdata.editPassword.button.save') }}" form="editPersonalDataPassword">
@endsection
