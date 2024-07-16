<?php

use App\Modules\Lag\Models\Meeting;
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
        Schema::table('meetings', function (Blueprint $table) {
            $table->uuid('uuid_comoderator')->nullable();
            $table->uuid('uuid_participant')->nullable();
            $table->uuid('uuid_signlang_translator')->nullable();
            $table->uuid('uuid_captioner')->nullable();
        });

        $meetings = Meeting::all();
        foreach ($meetings as $m) {
            $m->uuid_comoderator = (string) \Illuminate\Support\Str::uuid();
            $m->uuid_participant = (string) \Illuminate\Support\Str::uuid();
            $m->uuid_signlang_translator = (string) \Illuminate\Support\Str::uuid();
            $m->uuid_captioner = (string) \Illuminate\Support\Str::uuid();
            $m->save();
        }
    }

};
