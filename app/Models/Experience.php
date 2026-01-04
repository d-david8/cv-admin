<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model for representing a work experience
class Experience extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'profile_id',
        'company',
        'role',
        'start_date',
        'end_date',
        'description',
    ];

    // Relationship: Experience belongs to a Profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    
    // Relationship: Experience has many TechStacks (many-to-many)
    public function techstacks()
    {
        return $this->belongsToMany(TechStack::class, 'experience_techstack');
    }
}
