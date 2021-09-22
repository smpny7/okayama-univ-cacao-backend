<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Activity
 *
 * @property int $id
 * @property string $student_id
 * @property string $club_id
 * @property float $body_temp
 * @property string $physical_condition
 * @property string $stifling
 * @property string $fatigue
 * @property Carbon $created_at
 * @property Carbon $in_time
 * @property Carbon $out_time
 * @property Carbon $updated_at
 */
class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'room_id',
        'body_temp',
        'physical_condition',
        'stifling',
        'fatigue',
        'in_time',
        'out_time',
    ];

    protected $dates = [
        'in_time',
        'out_time',
    ];

    /**
     * Get the visitor associated with the activity.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
