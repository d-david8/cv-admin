<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// TechStack Model representing a technology stack used in experiences and projects
class Techstack extends Model
{
    use HasFactory;

    protected $table = 'techstacks';

    // Mass assignable attributes
    protected $fillable = [
        'profile_id',
        'name',
        'level',
    ];

    //  Relationship: TechStack belongs to a Profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // Relationship: TechStack belongs to many Experiences
    public function experiences()
    {
        return $this->belongsToMany(Experience::class, 'experience_techstack');
    }

    // Relationship: TechStack belongs to many Projects
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_techstack');
    }
}
