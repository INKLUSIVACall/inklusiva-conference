<x-component-whitebox title="Benutzer bearbeiten">
    <form class="component component-form" action="{{ route('useradmin.user.update', $user->id) }}" method="POST"
        id="updateUserForm">
        @csrf

        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="row">
            <div class="col-12">
                <x-inputs.inputfield elementTitleText="Name" elementTitleSmall="true" elementAsLabel="true"
                    elementIcon="" elementDesc="" elementId="firstname" elementName="firstname"
                    elementPlaceholder="Vorname" :elementValue="old('firstname', $user['firstname'])">
                </x-inputs.inputfield>
                <x-inputs.inputfield elementTitleText="Name" elementTitleSmall="true" elementAsLabel="true"
                    elementIcon="" elementDesc="" elementId="lastname" elementName="lastname"
                    elementPlaceholder="Nachname" :elementValue="old('lastname', $user['lastname'])">
                </x-inputs.inputfield>
                <x-inputs.radio elementTitleText="{{ __('backend/personaldata.edit.input.occupationName') }}"
                    elementTitleSmall="true" elementAsLabel="" elementAsLegend="true" elementIcon=""
                    elementDesc="{{ __('backend/personaldata.edit.input.occupationDesc') }}" elementId="occupation"
                    elementName="occupation" radioRow="true" :options="[
                        'privat' => __('backend/personaldata.edit.input.occupationValuePrivate'),
                        'organisation' => __('backend/personaldata.edit.input.occupationValueOrganisation'),
                    ]" :selected="$user->occupation ?? ''" />

                <x-inputs.inputfield elementTitleText="{{ __('backend/personaldata.edit.input.nameOrganisation') }}"
                    elementTitleSmall="true" elementAsLabel="true" elementIcon="" elementDesc=""
                    elementId="organisation_name" elementName="organisation_name"
                    elementPlaceholder="{{ __('backend/personaldata.edit.input.nameOrganisationPlaceholdder') }}"
                    :elementValue="old('name', $user['organisation_name'] ?? '')">
                </x-inputs.inputfield>

                <x-inputs.inputfield elementTitleText="E-Mail" elementTitleSmall="true" elementAsLabel="true"
                    elementTitleSmall="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="email"
                    elementName="email" elementPlaceholder="E-Mail" :elementValue="old('email', $user['email'] ?? '')">
                </x-inputs.inputfield>

                <x-inputs.inputfield elementTitleText="Passwort" elementTitleSmall="true" elementAsLabel="true"
                    elementTitleSmall="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="password"
                    elementType="password" elementName="password" elementPlaceholder="Passwort">
                </x-inputs.inputfield>

                <i>Hinweis: Passwort wird nur geändert, wenn ein neues Passwort eingegeben wird.</i>
            </div>
            <div class="col-12 mt-5">
                <x-inputs.toggle-simple elementLabel="Freigeschaltet" elementId="is_active" elementName="is_active"
                    :value="$user->activated_at" />
            </div>

            <div class="col-12 mt-5">
                <div class="component component-form-element component-form-element-text mb-3">
                    <div class="element-title-desc">
                        <div class="element-title">
                            <div class="title small">
                                <legend>Rollenzuordnung</legend>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($roles as $role)
                    <x-inputs.toggle-simple elementLabel="{{ $role->name }}" elementId="role_{{ $role->id }}"
                        class="mb-3" elementName="roles[]" :customCheckedState="true" :checked="in_array($role['id'], old('roles', [])) || $user->hasRole($role->name)" :elementValue="$role->id" />
                @endforeach
            </div>
            <div class="col-12 mt-5">
                <div class="form-info">Mit einem <i class="fas fa-asterisk"></i> markierte Felder sind Pflichtfelder.
                </div>
            </div>
        </div>
    </form>
</x-component-whitebox>
