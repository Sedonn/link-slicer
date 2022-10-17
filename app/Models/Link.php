<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class which describes link model. 
 */
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
        
        // Creating the key of link from hashing of a link
        self::creating(function ($model) {
            $model->key = \hash('md5', $model->url);
        });
    }

    /**
     * Get a link by it key.
     *
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Model|object|static|null
     */
    public function getLinkByKey(string $key): object | null
    {
        return $this->query()->where('key', $key)->first();
    }
}
