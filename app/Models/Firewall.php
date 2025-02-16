<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firewall extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'Firewall';

    // If you want to define which columns can be mass-assigned
    protected $fillable = [
        'time',
        'ip_src',
        'ip_dst',
        'action',
        'country_src',
        'country_dst',
        'city_src',
        'city_dst',
        'url',
        'direction',
        'org_src',
        'org_dst',
        'user_agent',
        'event_desc',
        'bytes_src',
        'domain_src',
        'device_class',
        'ip_dstport',
        'severity_action',
    ];

    // If you want to handle timestamps automatically (if you have them in your table)
    public $timestamps = true;
}
