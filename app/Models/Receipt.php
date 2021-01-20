<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = 'receipts';
    protected $fillable = [
        'user_id',
        'date',
        'time',
        'date_go',
        'time_go',
        'service_id',
        'note',
    ];
}
