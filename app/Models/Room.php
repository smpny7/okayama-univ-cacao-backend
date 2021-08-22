<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Passport\HasApiTokens;
use Webpatser\Uuid\Uuid;

/**
 * Room Notice
 *
 * @property string $id
 * @property string $name
 * @property string $login_id
 * @property string $password
 * @property bool   $is_admin
 * @property string $image_path
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Room extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable, HasApiTokens;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'login_id',
        'password',
        'image_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }

    /**
     * Change Laravel Passport authentication method.
     * @param $username
     * @return mixed
     */
    public function findForPassport($username)
    {
        return $this->query()->where('login_id', $username)->first();
    }

    public function getNumOfActive(): int
    {
        $room_id = $this->id;
        return Visitor::query()->where('room_id', $room_id)->count();
    }
}
