<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    const COLUMN_ID             = 'id';
    const COLUMN_USER_ID        = 'user_id';
    const COLUMN_NAME           = 'name';
    const COLUMN_DESCRIPTION    = 'description';
    const COLUMN_DATE           = 'date';
    const COLUMN_STATUS         = 'status';

    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_DESCRIPTION,
        self::COLUMN_DATE,
        self::COLUMN_STATUS,
    ];

    protected $casts = [
        self::COLUMN_DATE => 'datetime',
    ];

    const STATUS_NEW = 'new';
    const STATUS_COMPLETED = 'completed';

    const STATUS_LIST = [
        self::STATUS_NEW,
        self::STATUS_COMPLETED
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where(self::COLUMN_USER_ID, auth()->id());
        });
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
