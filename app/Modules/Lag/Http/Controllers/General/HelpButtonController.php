<?php

namespace App\Modules\Lag\Http\Controllers\General;

use App\Modules\Lag\Helpers\Text;
use App\Modules\Lag\Helpers\UserData;
use App\Modules\Lag\Models\Meeting;
use Illuminate\Http\Request;

class HelpButtonController
{
    public function index(Request $request, $helpLink = null)
    {
        return view('components.modal-help-button', [
            'helpLink' => $request->get('link'),
        ]);
    }
}
