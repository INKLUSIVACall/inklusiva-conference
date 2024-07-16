<?php

namespace App\Modules\Lag\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Sushi\Sushi;

class Recording extends Model
{
    use Sushi;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'startTime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'startTime' => 'datetime:d.m.Y, H:i Uhr',
    ];

    // Datum im deutschen Format
    public function getStartDateFormatted()
    {
        if ($this->start != null) {
            return $this->start->format('d.m.Y, H:i').' Uhr';
        } else {
            return 'Dauerhaftes Meeting';
        }
    }

    public function getRows()
    {
        $result = [];
        $user = Auth::user();

        foreach ($user->meetings as $meeting) {
            $recordingPath = storage_path('app/recordings/'.$meeting->id.'/video.mp4');
            if (file_exists($recordingPath)) {
                $rec = [
                    'name' => $meeting->name_display,
                    'startTime' => $meeting->start,
                    'meetingUUID' => $meeting->uuid,
                ];

                $result[] = $rec;
            }
        }

        return $result;

    }

    public function getMailTemplate($link)
    {
        $template = "Sehr geehrte Teilnehmerin, sehr geehrter Teilnehmer,\n\n".
            'für das Meeting '.$this->name." wurde ein Video aufgezeichnet.\n".
            "Bitte klicken Sie auf den folgenden Link, um die Aufzeichnung herunter zu laden:\n".
            $link."\n\n".
            "Mit freundlichen Grüßen,\n".
            'Ihr Team von '.env('APP_NAME')."\n\n".
            "Dies ist eine automatisch generierte E-Mail. Bitte antworten Sie nicht auf diese E-Mail.\n\n";

        return $template;

    }
}
