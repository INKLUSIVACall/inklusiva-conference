<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Modules\Lag\Helpers\JibriInstance as HelpersJibriInstance;
use App\Modules\Lag\Http\Controllers\Backend\InstantMeetingController;
use App\Modules\Lag\Http\Controllers\Backend\MeetingController;
use App\Modules\Lag\Http\Controllers\Backend\RecordingController;
use App\Modules\Lag\Http\Controllers\General\HelpButtonController;
use App\Modules\Lag\Http\Controllers\Wizard\AboutController;
use App\Modules\Lag\Http\Controllers\Wizard\AudioController;
use App\Modules\Lag\Http\Controllers\Wizard\CaptioningController;
use App\Modules\Lag\Http\Controllers\Wizard\DistressController;
use App\Modules\Lag\Http\Controllers\Wizard\EndscreenController;
use App\Modules\Lag\Http\Controllers\Wizard\IntroController;
use App\Modules\Lag\Http\Controllers\Wizard\SummaryController;
use App\Modules\Lag\Http\Controllers\Wizard\TranslateController;
use App\Modules\Lag\Http\Controllers\Wizard\VisualController;
use App\Modules\Lag\Models\Meeting;
use App\Modules\Lag\Helpers\Meeting as MeetingHelper;
use App\Modules\Lag\Models\JibriInstance;
use App\Modules\Lag\Helpers\JibriInstance as JibriInstanceHelper;
use App\Modules\Lag\Http\Controllers\Backend\BarrierReportController;
use App\Modules\Lag\Http\Controllers\Backend\SitemapController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::group(
    [
        'middleware' => ['web'],
        'prefex' => 'general',
        'as' => 'lag.general.'
    ],
    function () {
        Route::get('/helpButton/{helpLink?}', [HelpButtonController::class, 'index'])->name('helpButton');
    }
);

Route::group(
    [
        'middleware' => ['web'],
        'prefix' => 'wizard',
        'as' => 'lag.wizard.',
    ],
    function () {
        Route::get('/intro/{id?}', [IntroController::class, 'index'])->name('intro');
        Route::post('/intro', [IntroController::class, 'store'])->name('intropost');

        Route::get('/about/{id?}', [AboutController::class, 'index'])->name('about');
        Route::post('/about', [AboutController::class, 'store'])->name('aboutpost');

        Route::get('/visual/{id?}', [VisualController::class, 'index'])->name('visual');
        Route::post('/visual', [VisualController::class, 'store'])->name('visualpost');

        Route::get('/audio/{id?}', [AudioController::class, 'index'])->name('audio');
        Route::post('/audio', [AudioController::class, 'store'])->name('audiopost');

        Route::get('/distress/{id?}', [DistressController::class, 'index'])->name('distress');
        Route::post('/distress', [DistressController::class, 'store'])->name('distresspost');

        Route::get('/translate/{id?}', [TranslateController::class, 'index'])->name('translate');
        Route::post('/translate', [TranslateController::class, 'store'])->name('translatepost');

        Route::get('/captioning/{id?}', [CaptioningController::class, 'index'])->name('captioning');
        Route::post('/captioning', [CaptioningController::class, 'store'])->name('captioningpost');

        Route::get('/summary/{id?}', [SummaryController::class, 'index'])->name('summary');
        Route::post('/summary', [SummaryController::class, 'store'])->name('summarypost');

        Route::get('/{id?}', function ($id = null) {
            if ($id !== null) {
                return redirect(route('lag.wizard.intro', ['id' => $id]));
            } else {
                return redirect(route('lag.wizard.intro'));
            }
        })->name('index');
    }
);

Route::group([
    'middleware' => ['web', 'activated', 'auth', 'activated'],
    'prefix' => 'admin/meeting',
    'as' => 'lag.meeting.',
], function () {
    Route::get('/', [MeetingController::class, 'index'])->name('index');
    Route::get('/create', [MeetingController::class, 'create'])->name('create');
    Route::post('/create', [MeetingController::class, 'store'])->name('store');
    Route::get('/confirmdestroy/{id}', [MeetingController::class, 'confirmDestroy'])->name('confirmdestroy');
    Route::post('/destroy', [MeetingController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{meeting}', [MeetingController::class, 'edit'])->name('edit');
    Route::post('/update/{meeting}', [MeetingController::class, 'update'])->name('update');
    Route::get('/detail/{meeting}', [MeetingController::class, 'detail'])->name('detail');
    Route::get('/start/{meeting}', [MeetingController::class, 'start'])->name('start');
    Route::get('/mailtemplate/{meeting}/{role}/{link}', [MeetingController::class, 'createMailTemplate'])->name('mailtemplate');
});

Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'admin/recording',
    'as' => 'lag.recording.',
], function () {
    Route::get('/', [RecordingController::class, 'index'])->name('index');
    Route::get('/confirmdestroy/{recording}', [RecordingController::class, 'confirmDestroy'])->name('confirmdestroy');
    Route::post('/destroy/{recording}', [RecordingController::class, 'destroy'])->name('destroy');
    Route::get('/detail/{id}', [RecordingController::class, 'detail'])->name('detail');
    Route::get('/mailtemplate/{recording}', [RecordingController::class, 'mailTemplate'])->name('mailTemplate');
});

Route::get('/endscreen/{meeting}/{thankyou?}', [EndscreenController::class, 'index'])->name('endscreen');
Route::post('/endscreen/{meeting}', [EndscreenController::class, 'store'])->name('endscreen.store');
Route::get('/meeting/download/{meeting}', [MeetingController::class, 'downloadRecording'])->name('meeting.download');
Route::get('/meeting/videostate/{meeting}', [EndscreenController::class, 'refreshVideoState'])->name('meeting.refreshVideoState');

Route::get('/getRecordingPath/{meetingName}', function ($meetingName) {
    $meetings = Meeting::byJitsiRoomNames($meetingName)->get();

    if ($meetings->count() <= 0) {
        return false;
    }

    $meetingId = $meetings[0]->id;

    if (!file_exists(storage_path('app/recordings/'.$meetingId))) {
        mkdir(storage_path('app/recordings/'.$meetingId), 0777, true);
    }

    return storage_path('app/recordings/'.$meetingId);
});
Route::get('/getJitsiMeetingName/{phoneId}', function ($phoneId) {
    /** @var Meeting $meeting */
    $meeting = Meeting::where('phone_id', $phoneId)->first();
    if ($meeting === null) {
        return false;
    }

    return $meeting->getJitsiMeetingName();
});
Route::get('/jibri/markReady/{instanceId}', function ($instanceId) {
    /** @var JibriInstance $instance */
    $instance = JibriInstance::find($instanceId);

    if ($instance === null) {
        return '';
    }

    $instance->status = JibriInstance::STATUS_READY;
    $instance->save();

    return '';
});
Route::get('/jibri/instanceStatus', function () {
    $instances = JibriInstanceHelper::fetchJibriInstanceStatus(filterBooting: false);

    $bootCount = 0;
    $idleCount = 0;
    foreach ($instances as $instance) {
        if ($instance->status === JibriInstance::STATUS_BOOTING) {
            $bootCount++;
        } elseif (in_array($instance->status, [JibriInstance::STATUS_IDLE, JibriInstance::STATUS_READY])) {
            $idleCount++;
        }
    }

    return response()->json([
        'availableInstances' => $idleCount,
        'bootingInstances' => $bootCount,
        'ready' => $idleCount > 0,
    ]);
});

Route::group([
    'middleware' => ['web'],
    'prefix' => 'instantmeeting',
    'as' => 'lag.instantmeeting.',
], function () {
    Route::get('/', [InstantMeetingController::class, 'register'])->name('register');
    Route::post('/', [InstantMeetingController::class, 'sendRegistration'])->name('sendRegistration');
    Route::get('/{meetinguuid}', [InstantMeetingController::class, 'showMeeting'])->name('showMeeting');
});

Route::get('/switchLanguage/{language?}', function ($language) {
    session(['language' => $language]);
    return redirect()->back();
})->name('switchLanguage');

Route::get('/barrierreport', [BarrierReportController::class, 'index'])->name('barrier.index');
Route::post('/barrierreport', [BarrierReportController::class, 'store'])->name('barrier.store');

Route::get('/sitemap', [SitemapController::class, 'index'])->name('lag.sitemap.index');

