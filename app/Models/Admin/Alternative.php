<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    public function criterias()
    {
        return $this->hasOne(Criteria::class)->withPivot('value');
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
