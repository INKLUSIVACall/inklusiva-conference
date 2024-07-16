<?php

namespace App\Modules\Lag\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JibriInstance.
 *
 * @property int id
 * @property string cloud_id
 * @property int status
 */
class JibriInstance extends Model
{
    const STATUS_BOOTING = 1;
    const STATUS_IDLE = 2;
    const STATUS_RECORDING = 3;
    const STATUS_READY = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cloud_id',
        'ipv4',
        'status'
    ];
}
