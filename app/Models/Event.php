<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 * @property string header
 * @property string text
 * @property int creator_id
 * @property string|null created_at
 * @property string|null updated_at
 * @property string|null deleted_at
 */
class Event extends Model
{
    use SoftDeletes;

    public $timestamps = true;
    protected $guarded = false;

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_event', 'event_id', 'user_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
