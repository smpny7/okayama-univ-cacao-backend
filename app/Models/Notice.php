<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Notice
 *
 * @property int $id
 * @property string $contents
 * @property string $sender_name
 * @property string $sender_icon_url
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $released_at
 * @property Carbon $deleted_at
 */
class Notice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['released_at', 'deleted_at'];
    protected $fillable = ['contents', 'sender_name', 'sender_icon_url'];

    public function isPublished(): bool
    {
        return $this->released_at->lte(Carbon::now());
    }

    /** @noinspection PhpUnused */
    public function getFuzzyTime(): string
    {
        $unix = strtotime($this->released_at);
        $now = time();
        $diff_sec = $now - $unix;

        if ($diff_sec < 60) {
            $time = $diff_sec;
            $unit = "秒前";
        } elseif ($diff_sec < 3600) {
            $time = $diff_sec / 60;
            $unit = "分前";
        } elseif ($diff_sec < 86400) {
            $time = $diff_sec / 3600;
            $unit = "時間前";
        } elseif ($diff_sec < 2764800) {
            $time = $diff_sec / 86400;
            $unit = "日前";
        } else {
            if (date("Y") != date("Y", $unix)) {
                $time = date("Y年n月j日", $unix);
            } else {
                $time = date("n月j日", $unix);
            }

            return $time;
        }

        return (int)$time . $unit;
    }
}
