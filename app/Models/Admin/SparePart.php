<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'qty', 'ammount', 'job_id'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
