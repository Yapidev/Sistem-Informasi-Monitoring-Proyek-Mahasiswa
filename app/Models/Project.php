<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function progresses()
    {
        return $this->hasMany(Progress::class, 'project_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'project_id');
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'not_started' => 'Sedang di ajukan',
            'in_progress' => 'Sedang berlangsung',
            'completed' => 'Selesai',
            default => 'Tidak Dikenal',
        };
    }

    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            'not_started' => 'bg-light-secondary text-secondary',
            'in_progress' => 'bg-light-warning text-warning',
            'completed' => 'bg-light-success text-success',
            default => 'bg-light-primary text-primary',
        };
    }
}
