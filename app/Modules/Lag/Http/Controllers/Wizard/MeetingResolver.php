<?php

namespace App\Modules\Lag\Http\Controllers\Wizard;

use App\Modules\Lag\Models\Meeting;

trait MeetingResolver
{
    function getMeetingAndRole($id)
    {

        $meeting = Meeting::where('uuid', $id)
            ->orWhere('uuid_comoderator', $id)
            ->orWhere('uuid_participant', $id)
            ->orWhere('uuid_signlang_translator', $id)
            ->orWhere('uuid_captioner', $id)
            ->first();

        $role = null;
        if ($meeting !== null) {
            if ($id === $meeting->uuid) {
                $role = Meeting::ROLE_MODERATOR;
            }
            if ($id === $meeting->uuid_comoderator) {
                $role = Meeting::ROLE_CO_MODERATOR;
            }
            if ($id === $meeting->uuid_participant) {
                $role = Meeting::ROLE_PARTICIPANT;
            }
            if ($id === $meeting->uuid_signlang_translator) {
                $role = Meeting::ROLE_SIGN_LANG_TRANSLATOR;
            }
            if ($id === $meeting->uuid_captioner) {
                $role = Meeting::ROLE_CAPTIONER;
            }
        }

        return [$meeting, $role];
    }
}
