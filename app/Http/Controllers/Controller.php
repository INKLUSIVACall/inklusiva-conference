<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function renderMessage()
    {
        return view("components.backend.alert-messages", [
            "success" => session("success"),
            "errors" => session("errors"),
        ]);
    }
}
