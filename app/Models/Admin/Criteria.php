<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'weight', 'type'];

    public function alternatives()
    {
        return $this->belongsToMany(Alternative::class);
    }

    public function getTypeAttribute()
    {
        return ($this->attributes['type'] == 0) ? 'Cost' : 'Benefit';
    }
}
