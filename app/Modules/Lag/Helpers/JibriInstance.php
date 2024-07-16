<?php

namespace App\Modules\Lag\Helpers;

use App\Modules\Lag\Models\JibriInstance as JibriInstanceModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class JibriInstance {
    /**
     * Verifies the activity of currently registered Jibri instances.
     * @return Collection 
     */
    public static function fetchJibriInstanceStatus($filterBooting = true) : Collection {
        // Check all JibriInstance models of the database
        if ($filterBooting) {
            $instances = JibriInstanceModel::where('status', '<>', JibriInstanceModel::STATUS_BOOTING)->get();
        } else {
            $instances = JibriInstanceModel::all();
        }        

        // contact the endpoint /jibri/api/v1.0/health on all instances which don't have status BOOTING to see what Jibri is currently doing
        foreach ($instances as $instance) {
            if ($instance->status === JibriInstanceModel::STATUS_BOOTING) {
                continue;
            }

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => 'http://' . $instance->ipv4 . ':2222/jibri/api/v1.0/health',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 5
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode >= 400) {
                continue;
            }

            $response = json_decode($response, true);
            $status = $response['status']['busyStatus'];

            // update the model to reflect the status of each instance
            $newStatus = null;
            if (mb_strtoupper($status) === 'IDLE') {
                $newStatus = JibriInstanceModel::STATUS_IDLE;
            } elseif (mb_strtoupper($status) === 'BUSY') {
                $newStatus = JibriInstanceModel::STATUS_RECORDING;
            }

            if ($newStatus !== null && $newStatus !== $instance->status) {
                $instance->status = $newStatus;
                $instance->save();
            }
        }

        // return all instances
        return $instances;
    }
}