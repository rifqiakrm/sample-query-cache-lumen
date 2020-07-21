<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class Tag extends Model
{
    use Cachable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sort', 'status', 'type',
    ];

    /**
     * Hidden attribute.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'updated_at',
    ];

    /**
     * Append attributes.
     *
     * @var array
     */
    protected $appends = [
        'hashed_id',
    ];

    /**
     * Get hashed ID
     *
     * @return string
     */
    public function hashedId()
    {
        return Hashids::encode($this->attributes['id']);
    }

    /**
     * Get hashed id attribute.
     *
     * @return string
     */
    public function getHashedIdAttribute()
    {
        return $this->hashedId();
    }

    /**
     * Find by hashed id.
     *
     * @return mixed
     */
    public static function findByHashedId($hashed = '')
    {
        $hashed = Hashids::decode($hashed);
        if (count($hashed) == 0) {
            return null;
        }
        return self::withTrashed()->find($hashed[0]);
    }
}
