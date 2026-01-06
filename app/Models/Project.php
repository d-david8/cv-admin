<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'name',
        'description',
        'link'
    ];
    
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function techstacks()
    {
        return $this->belongsToMany(TechStack::class, 'project_techstack');
    }
}
