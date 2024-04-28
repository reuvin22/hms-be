<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'roles'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'password',
        'updated_at',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function notifications() {
        return $this->belongsToMany(Notification::class, 'user_notifications')
                    ->withPivot('read_at')
                    ->withTimestamps();
    }

    public function identity() {
        return $this->belongsTo(Identity::class, 'user_id', 'user_id');
    }

    public function personal_information() {
        return $this->hasOne(PersonalInformation::class, 'personal_id', 'user_id');
    }

    public function scopeSearch($query, $request) {
        return $query->where('name', 'LIKE', "%$request->q%")
                    ->orWhere('email', 'LIKE', "%$request->q%")
                    ->orWhere('user_id', 'LIKE', "%$request->q%");
    }

    public function scopeUserDetails($query, $request) {
        return $query->with(['identity'])->where('email', Auth::user()->email);
    }

    public function scopePersonalInformation($query) {
        return $query->with('personal_information')->where('email', Auth::user()->email);
    }

    public function scopeUserDetailById($query, $request) {
        return $query->with(['identity'])->where('user_id', $request->user_id);
    }

    public function scopeUserByRoles($query, $request) {
        return $query->with(['identity'])->where('roles', $request->roles);
    }
}
