<?php

namespace App\Models;

use App\Http\Controllers\TodoController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Todo extends Model
{
    const COLUMN_ID             = 'id';
    const COLUMN_USER_ID        = 'user_id';
    const COLUMN_NAME           = 'name';
    const COLUMN_DESCRIPTION    = 'description';
    const COLUMN_DATE           = 'todo_date';
    const COLUMN_STATUS         = 'status';

    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_DESCRIPTION,
        self::COLUMN_DATE,
        self::COLUMN_STATUS,
    ];

    protected $dates = [
        self::COLUMN_DATE
    ];

    const STATUS_NEW = 'new';
    const STATUS_COMPLETED = 'completed';

    const STATUS_LIST = [
        self::STATUS_NEW,
        self::STATUS_COMPLETED
    ];

    public function getDateAttribute()
    {
        return $this->todo_date->format('Y-m-d');
    }

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


    /**
     * @param $query
     * @param Request $request
     * @return mixed
     */
    public function scopeFilterBySearch($query, Request $request)
    {
        return $query->when($request->filled(TodoController::REQUEST_SEARCH), function (Builder $query) use($request) {
            $query->where(function (Builder $q) use($request) {
                $q->where(Todo::COLUMN_NAME, 'like', '%' . $request->{TodoController::REQUEST_SEARCH} . '%');
                $q->orWhere(Todo::COLUMN_DESCRIPTION, 'like', '%' . $request->{TodoController::REQUEST_SEARCH} . '%');
            });
        });
    }

    /**
     * @param $query
     * @param Request $request
     * @return mixed
     */
    public function scopeFilterByDate($query, Request $request)
    {
        return $query->when($request->filled(TodoController::REQUEST_DATE), function (Builder $query) use($request) {
            $query->where(Todo::COLUMN_DATE, $request->{TodoController::REQUEST_DATE});
        });
    }
}
