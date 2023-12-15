<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
