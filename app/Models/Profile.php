<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Profile Model representing a user's profile
class Profile extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'name', 
        'title', 
        'summary', 
        'email', 
        'phone', 
        'linkedin', 
        'github'
    ];

    // Relationship: Profile has many TechStacks
    public function techstacks()
    {
        return $this->hasMany(TechStack::class);
    }

    // Relationship: Profile has many Experiences
    public function experiences()
    {
        return $this->hasMany(Experience::class)->orderBy('start_date', 'desc');
    }
}
