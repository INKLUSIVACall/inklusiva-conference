<?php

namespace App\Modules\Lag\Models;

use App\Models\TempUser;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Meeting.
 *
 * @property int id
 * @property string name
 * @property \DateTime start
 * @property int creator_id
 * @property bool should_record
 * @property string sign_language_interpreter
 * @property string text_interpreter
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 * @property User creator
 * @property string uuid
 * @property string uuid_comoderator
 * @property string uuid_participant
 * @property string uuid_signlang_translator
 * @property string uuid_captioner
 * @property int phone_id
 * @property string jitsi_room_name
 */
class Meeting extends Model
{
    const ROLE_MODERATOR = 'moderator';

    const ROLE_CO_MODERATOR = 'comoderator';

    const ROLE_PARTICIPANT = 'participant';

    const ROLE_SIGN_LANG_TRANSLATOR = 'signlangtranslator';

    const ROLE_CAPTIONER = 'captioner';

    private function getJitsiRole($userData)
    {
        if (isset($userData['role'])) {
            switch ($userData['role']) {
                case self::ROLE_MODERATOR:
                    return '';
                case self::ROLE_CO_MODERATOR:
                    return 'IC_ROLE_COHOST';
                case self::ROLE_PARTICIPANT:
                    return '';
                case self::ROLE_CAPTIONER:
                    return 'IC_ROLE_CAPTIONER';
                case self::ROLE_SIGN_LANG_TRANSLATOR:
                    return 'IC_ROLE_SIGN_LANG_TRANSLATOR';
            }
        }
    }

    private function getJitsiAffiliation($userData)
    {
        if (isset($userData['role'])) {
            switch ($userData['role']) {
                case self::ROLE_MODERATOR:
                    return 'owner';
                case self::ROLE_CO_MODERATOR:
                    return 'owner';
                case self::ROLE_PARTICIPANT:
                    return 'member';
                case self::ROLE_CAPTIONER:
                    return 'member';
                case self::ROLE_SIGN_LANG_TRANSLATOR:
                    return 'member';
            }
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'start',
        'creator_id',
        'should_record',
        'sign_language_interpreter',
        'text_interpreter',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start' => 'datetime:d.m.Y, H:i Uhr',
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

    /**
     * Returns whether the meeting is running.
     * Non existing meetings are not running. Also meeting that are older than 3 hours are not running.
     */
    public function isRunning()
    {
        if ($this->start != null && $this->start < now() && now() < \Carbon\Carbon::parse($this->start)->addMinutes(180)) {
            return true;
        }

        return false;
    }

    public function isPermanent()
    {
        return $this->start == null;
    }

    /**
     * Returns whether the meeting exists.
     * A Meeting exists, when it was created and not ended, whether there are users in it or not.
     */
    public function exists()
    {
        // is this even possibe with jitsi?
        return true;
    }

    /**
     * Generates a new Jitsi Room name for the meeting.
     * @return void
     */
    public function proposeJitsiRoomName() : string
    {
        return mb_strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $this->name_display . $this->id));
    }

    /**
     * Returns the meeting name within Jitsi.
     * @return string
     */
    public function getJitsiMeetingName()
    {
        if ($this->jitsi_room_name === null) {
            $this->jitsi_room_name = mb_strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $this->name_display . $this->id));
            $this->save();
        }
        return $this->jitsi_room_name;
    }

    public function getJitsiLink($userData, $meeting)
    {
        // strip all non-alphanumeric characters from meeting name, so that jitsi can handle it.
        $meetingName = $this->getJitsiMeetingName();

        $jitsiRole = $this->getJitsiRole($userData);
        $payload = [
            'context' => [
                'user' => [
                    'name' => $userData['name'],    // name needs to be extracted from userData because its used by jitsi in other places too.
                    'affiliation' => $this->getJitsiAffiliation($userData),
                ],
                'userData' => $userData,
                'meetingName' => $meeting->name_display,
                'recordingEnabled' => $meeting->should_record,
            ],
            'iss' => env('JITSI_SERVER_APPID'),  // Issuer (who creates the token)
            //'iat' => time(),                        // Issued at time
            'exp' => time() + 86400,                // Expiration time
            'aud' => env('JITSI_SERVER_BASE_URL'),  // Audience (who or what the token is intended for)
            'sub' => '*',  // Subject (whom the token refers to) <-- contains either the tenant, the domain or * for all tenants and domains.
            'room' => '*',                          // Room name
        ];

        if (isset($jitsiRole) && ($jitsiRole !== '')) {
            $payload['context']['user']['ic_roles'][0]['role'] = $jitsiRole;
        }

        if ($this->getJitsiAffiliation($userData) === 'owner') {
            $payload['context']['user']['lobby_bypass'] = true;
        }

        $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
        $url = env('JITSI_SERVER_BASE_URL').'/'.$meetingName.'?jwt='.$jwt;

        return $url;
    }

    /**
     * Opens the meeting on our instance of BigBlueButton.
     */
    public function openMeeting()
    {
        // is this even possibe with jitsi?
        return true;
    }

    /**
     * Return the meeting uuid or id with or without the prefix.
     */
    public function getMeetingId()
    {
        return $this->id;
    }

    public function getMeetingUUID($role = null)
    {
        switch ($role) {
            case self::ROLE_MODERATOR:
                return $this->getMeetingUUIDModerator();
            case self::ROLE_CO_MODERATOR:
                return $this->getMeetingUUIDCoModerator();
            case self::ROLE_PARTICIPANT:
                return $this->getMeetingUUIDParticipant();
            case self::ROLE_SIGN_LANG_TRANSLATOR:
                return $this->getMeetingUUIDSignLangTranslator();
            case self::ROLE_CAPTIONER:
                return $this->getMeetingUUIDCaptioner();
            default:
                return $this->getMeetingUUIDModerator();
        }
    }

    public function getMeetingUUIDModerator()
    {
        return $this->uuid;
    }

    public function getMeetingUUIDCoModerator()
    {
        return $this->uuid_comoderator;
    }

    public function getMeetingUUIDParticipant()
    {
        return $this->uuid_participant;
    }

    public function getMeetingUUIDSignLangTranslator()
    {
        return $this->uuid_signlang_translator;
    }

    public function getMeetingUUIDCaptioner()
    {
        return $this->uuid_captioner;
    }

    public function scopeRunning($query)
    {
        return $query->whereNull('start')->orWhere('start', '>', now()->subDays(2));
    }

    /**
     *   Combines a meeting's title and name into an ARIA-lable
     *   for use with screenreaders in the meetings overview
     */
    public function getMeetingAriaLabel()
    {
        return 'Meeting mit dem Titel '.$this->name.'. Start am '.$this->getStartDateFormatted();
    }

    public function getMailTemplateAndRoleName($role, $link)
    {
        $roleName = '';
        switch ($role) {
            case self::ROLE_MODERATOR:
                $roleName = 'Moderator';
                break;
            case self::ROLE_CO_MODERATOR:
                $roleName = 'Co-Moderator';
                break;
            case self::ROLE_PARTICIPANT:
                $roleName = 'Teilnehmer';
                break;
            case self::ROLE_SIGN_LANG_TRANSLATOR:
                $roleName = 'Gebärdensprachdolmetscher';
                break;
            case self::ROLE_CAPTIONER:
                $roleName = 'Schriftsprachdolmetscher';
                break;
        }

        $user = Auth::user();

        if ($this->isPermanent()) {
            $meetingText = 'Sie wurden von '.$user->name.' als '.$roleName.' für das dauerhafte Meeting "'.$this->name_display."\" eingeladen.\n\n";
        } else {
            $meetingText = 'Sie wurden von '.$user->name.' als '.$roleName.' für das Meeting "'.$this->name_display.'" am '.$this->getStartDateFormatted()." eingeladen.\n\n";
        }

        $template = "Sehr geehrte Teilnehmerin, sehr geehrter Teilnehmer,\n\n".
            $meetingText.
            "Bitte klicken Sie auf den folgenden Link, um dem Meeting beizutreten:\n".
            "$link.\n\n" .
            "Sie können sich auch per Telefon unter 06131-7960455 in das Meeting einwählen. Die Konferenznummer lautet: $this->phone_id.\n\n".

            "Mit freundlichen Grüßen,\n".
            'Ihr Team von '.env('APP_NAME')."\n\n".
            "Dies ist eine automatisch generierte E-Mail. Bitte antworten Sie nicht auf diese E-Mail.\n\n";

        return [
            $template,
            $roleName,
        ];
    }

    ////////////////////////////
    // Relationships
    ////////////////////////////

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function tempCreator()
    {
        return $this->belongsTo(TempUser::class, 'temp_creator_id');
    }

    public function scopeByJitsiRoomNames($query, $jitsiRoomNames)
    {
        if (!is_array($jitsiRoomNames)) {
            $jitsiRoomNames = [$jitsiRoomNames];
        }

        $lowerCaseJitsiRoomNames = array_map('mb_strtolower', $jitsiRoomNames);

        if (count($lowerCaseJitsiRoomNames) === 0) {
            return $query->where('jitsi_room_name', $lowerCaseJitsiRoomNames[0]);
        } else {
            return $query->whereIn('jitsi_room_name', $lowerCaseJitsiRoomNames);
        }
    }
}
