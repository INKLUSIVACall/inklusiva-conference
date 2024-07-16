<?php

use App\Modules\Lag\Helpers\Meeting;
use App\Modules\Lag\Models\Meeting as ModelsMeeting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $meetings = ModelsMeeting::whereNull('phone_id')->get();
        foreach ($meetings as $meeting) {
            $meeting->phone_id = Meeting::generateNewPhoneId();
            $meeting->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
