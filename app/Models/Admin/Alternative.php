<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'job_id'];

    public function criterias()
    {
        return $this->belongsToMany(Criteria::class, 'alternative_criteria')->withPivot('value')->withTimestamps();
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
