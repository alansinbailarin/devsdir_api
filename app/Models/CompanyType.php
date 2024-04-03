<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
