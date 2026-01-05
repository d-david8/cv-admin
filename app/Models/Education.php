<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory;
    protected $table = 'educations';

    protected $fillable = [
        'profile_id',
        'school',
        'degree',
        'start_date',
        'end_date',
        'description',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}

