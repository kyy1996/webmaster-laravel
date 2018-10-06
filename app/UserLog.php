<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserLog
 *
 * @property int $id
 * @property int $uid 用户UID
 * @property string $description 行为描述
 * @property string $loggable_type
 * @property int $loggable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereLoggableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereLoggableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserLog extends Model
{
    //
}
