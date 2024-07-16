<?php
namespace App\Modules\Lag\Services;

use App\Models\User;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\DeleteRecordingsParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;

class RecordingService {
    /**
     * Wrapper for BigBlueButton::getRecordings() to return a collection of recordings.
     *
     * @param GetRecordingsParameters|null $recordingParams
     * @return \Illuminate\Support\Collection|null
     */
    public function fetchRecordings(GetRecordingsParameters $recordingParams = null)
    {
        if(!isset($recordingParams)) {
            $recordingParams = new GetRecordingsParameters();
        } else {
            $recordingParams = $recordingParams;
        }

        $bbb = new BigBlueButton();

        $response = $bbb->getRecordings($recordingParams);
        if ($response->getReturnCode() == 'SUCCESS') {
            $recordings = collect();
            foreach ($response->getRawXml()->recordings->recording as $recording) {
                $recordings->push($recording);
            }
            return $recordings;
        }
        return null;
    }

    /**
     * Fetch recordings for a given user.
     */
    public function fetchRecordingsForUser($userId)
    {
        $user = User::find($userId);
        $meetings = $user->meetings;

        $recordingParams = new GetRecordingsParameters();
        $meetingIds = '';
        foreach ($meetings as $meeting) {
            $meetingIds .= $meeting->internal_meeting_id . ',';
        }
        $recordingParams->setMeetingId($meetingIds);
        $recordings = $this->fetchRecordings($recordingParams);

        return $recordings;
    }

    public function deleteRecording($id)
    {
        $bbb = new BigBlueButton();
        $deleteRecordingsParams = new DeleteRecordingsParameters($id);
        $response = $bbb->deleteRecordings($deleteRecordingsParams);

        return $response->getReturnCode() == 'SUCCESS';
    }

    /**
     * Fetch Recording data and create string for aria-label
     */
    public static function getRecordingAriaLabel($recording){
        return "Aufzeichnung mit dem Titel ". $recording->name . " vom ";
    }
}
