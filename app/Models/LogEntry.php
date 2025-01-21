<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_type',
        'time',
        'ip_src',
        'username',
        'msg',
        'device_type',
        'host_dst',
        'event_desc',
        'event_type',
    ];
}
