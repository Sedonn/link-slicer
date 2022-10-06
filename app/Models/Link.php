<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = "links";

    protected $fillable = [
        'added_by',
        'key',
        'url'
    ];

    public $incrementing = false;

    public $timestamps = false;
}
