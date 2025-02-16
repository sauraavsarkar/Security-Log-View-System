<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antivirus extends Model
{
    use HasFactory;

    // Define the table name explicitly for Antivirus logs
    protected $table = 'Antivirus';

    // Define fillable fields matching your table columns
    protected $fillable = [
        'time',
        'ip_src',
        'username',
        'host_dst',
        'event_desc',
        'event_type',
    ];

    public $timestamps = true; // Enable created_at and updated_at
}
