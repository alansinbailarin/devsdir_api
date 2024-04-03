<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'logo',
        'banner',
    ];

    public function companyType()
    {
        return $this->belongsTo(CompanyType::class);
    }
}
