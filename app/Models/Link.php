<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = "links";

    protected $fillable = [
        'user_id',
        'url'
    ];

    public $incrementing = false;

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        
        self::creating(function ($model) {
            $model->key = \hash('md5', $model->url);
        });
    }

    public function getLinkByKey(string $key): object | null
    {
        return $this->query()->where('key', $key)->first();
    }
}
