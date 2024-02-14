<?php

namespace App\Models;


use App\Http\Interfaces\BlockableInterface;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * @property integer $id
 * @property string $first_name
 * @property string $second_name
 * @property string $last_name
 * @property string $email
 * @property boolean $blocked
 * @property integer $activated_at
 *
 * @property-read boolean $activated
 *
 * @method static UserFactory factory($count = null, $state = [])
 */
class User extends Authenticatable implements BlockableInterface
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasRoles,
        SoftDeletes,
        RevisionableTrait;

    protected $fillable = [
        'first_name',
        'second_name',
        'last_name',
        'email',
        'password',
        'blocked',
        'activated_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'blocked' => 'boolean',
        'activated_at' => 'datetime'
    ];

    public function block(): bool
    {
        $this->blocked = true;

        return $this->save();
    }

    public function unblock(): bool
    {
        $this->blocked = false;

        return $this->save();
    }

    public function scopeBlocked($query)
    {
        return $query->where('blocked', true);
    }

    public function scopeNotBlocked($query)
    {
        return $query->where('blocked', false);
    }

    public function activated(): Attribute
    {
        return new Attribute(
            get: fn() => !empty($this->activated_at)
        );
    }
}
