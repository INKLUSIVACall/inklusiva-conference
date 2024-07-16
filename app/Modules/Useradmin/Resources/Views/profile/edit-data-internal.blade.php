<x-component-form id="editPersonalData" method="post" action="{{ route('useradmin.profile.updateData') }}"
                  :meeting="null">


    <x-component-whitebox
        format="{{__('backend/personaldata.edit.whitebox.format')}}"
        title="{{__('backend/personaldata.edit.whitebox.title')}}"
        ariaLabel="{{__('backend/personaldata.edit.whitebox.ariaLabel')}}"
    >
        <x-inputs.inputfield
            elementTitleText="{{__('backend/personaldata.edit.input.name')}}"
            elementTitleSmall="true"
            elementAsLabel="true"
            elementIcon=""
            elementDesc=""
            elementId="name"
            elementName="name"
            elementPlaceholder="{{__('backend/personaldata.edit.input.namePlaceholder')}}"
            :elementValue="old('name', $user['name'] ?? '')">
        </x-inputs.inputfield>

        <x-inputs.radio
            elementTitleText="{{__('backend/personaldata.edit.input.occupationName')}}"
            elementTitleSmall="true"
            elementAsLabel=""
            elementAsLegend="true"
            elementIcon=""
            elementDesc="{{__('backend/personaldata.edit.input.occupationDesc')}}"
            elementId="occupation"
            elementName="occupation"
            radioRow="true"
            :options="[
                    'privat' => __('backend/personaldata.edit.input.occupationValuePrivate'),
                    'organisation' => __('backend/personaldata.edit.input.occupationValueOrganisation'),
                ]"
            :selected="$user->occupation ?? ''"/>


        <x-inputs.inputfield
            elementTitleText="{{__('backend/personaldata.edit.input.nameOrganisation')}}"
            elementTitleSmall="true"
            elementAsLabel="true"
            elementIcon=""
            elementDesc=""
            elementId="organisation_name"
            elementName="organisation_name"
            elementPlaceholder="{{__('backend/personaldata.edit.input.nameOrganisationPlaceholdder')}}"
            :elementValue="old('name', $user['organisation_name'] ?? '')">
        </x-inputs.inputfield>
    </x-component-whitebox>
</x-component-form>

@section('formcontrols')
    <a class="btn btn-secondary component-button"
       href="{{ route('useradmin.profile.index') }}">{{__('backend/personaldata.edit.button.cancel')}}</a>
    <input type="submit" class="btn btn-primary component-button"
           value="{{__('backend/personaldata.edit.button.save')}}"
           form="editPersonalData">
@endsection
