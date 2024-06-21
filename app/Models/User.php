<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed $id
 * @method static create(array $array)
 * @method static whereNotIn(string $string, array|int[]|string[] $array_merge)
 */
class User extends Authenticate
{
    use Notifiable;

    protected $fillable = [
        'username', 'email', 'password', 'name', 'image_url'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'user1_id')
            ->orWhere('user2_id', $this->id);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}

