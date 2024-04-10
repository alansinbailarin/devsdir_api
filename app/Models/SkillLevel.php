<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
