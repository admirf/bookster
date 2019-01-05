<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    protected $guard_name = 'api';

    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'buyer_id');
    }

    public function latestTransactions()
    {
        return $this->hasMany(Transaction::class, 'buyer_id')->latest();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function addBalance($credits)
    {
        $this->balance += $credits;
        $this->save();
    }

    public function buy($ids, $credits)
    {
        $transaction = Transaction::create([
            'buyer_id' => $this->id,
            'credits' => $credits
        ]);

        $transaction->books()->attach($ids);
        $this->attributes['balance'] -= $credits;
        $this->save();

        return $transaction;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
