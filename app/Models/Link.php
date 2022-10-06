<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = "links";

    protected $fillable = [
        'user_id',
        'key',
        'url'
    ];

    public $incrementing = false;

    public $timestamps = false;

    public function getLinkByKey(string $key): object | null
    {
        return $this->query()->where('key', $key)->first();
    }
}
