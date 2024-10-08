<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'surname',
        'username',
        'avatar',
        'email',
        'password',
        'user_status_id',
        'user_type_id',
        'job_type_id',
        'skill_level_id',
        'experience_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userStatus()
    {
        return $this->belongsTo(UserStatus::class);
    }

    public function userInformation()
    {
        return $this->hasOne(UserInformation::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function userSalary()
    {
        return $this->hasOne(UserSalary::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function skillLevel()
    {
        return $this->belongsTo(SkillLevel::class);
    }

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}
