<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visitor extends Model
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
        'activity_id',
    ];

    /**
     * Get the activity associated with the visitor.
     */
    public function activity(): belongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
