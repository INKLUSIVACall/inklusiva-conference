<?php

namespace App\Modules\Lag\Helpers;

use App\Modules\Lag\Models\Meeting as MeetingModel;

class Meeting
{
    public static function generateNewPhoneId(): int
    {
        $usedPhoneIds = MeetingModel::pluck('phone_id')->unique()->toArray();

        if (count($usedPhoneIds) >= 900000) {
            throw new \Exception('No more phone ids available');
        }

        $allPhoneIds = range(100000, 999999);
        $availablePhoneIds = array_diff($allPhoneIds, $usedPhoneIds);

        if (empty($availablePhoneIds)) {
            throw new \Exception('No more phone ids available');
        }

        shuffle($availablePhoneIds);

        return $availablePhoneIds[0];
    }
}
