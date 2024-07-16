<?php

namespace App\Modules\Lag\Http\Controllers\Wizard;

use App\Modules\Lag\Models\Meeting;

trait StepResolver
{
    function getNumberOfStepsByRole($role)
    {
        if($role === null) {
            return 6;
        }
        $steps = [
            Meeting::ROLE_MODERATOR => 6,
            Meeting::ROLE_CO_MODERATOR => 6,
            Meeting::ROLE_PARTICIPANT => 6,
            Meeting::ROLE_SIGN_LANG_TRANSLATOR => 6,
            Meeting::ROLE_CAPTIONER => 7,
        ];

        return $steps[$role];
    }
}
