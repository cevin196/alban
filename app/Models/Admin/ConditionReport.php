<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionReport extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'date', 'job_id'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
