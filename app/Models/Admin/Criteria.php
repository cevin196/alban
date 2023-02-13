<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'weight', 'type', 'unit'];

    public function alternatives()
    {
        return $this->belongsToMany(Alternative::class, 'alternative_criteria')->withPivot('value')->withTimestamps();
        // return $this->belongsToMany(Criteria::class, 'alternative_criteria');
    }

    public function getTypeAttribute()
    {
        return ($this->attributes['type'] == 0) ? 'Cost' : 'Benefit';
    }

    public function getNormalizedWeight()
    {
        $total = Criteria::sum('weight');
        return $this->weight / $total;
    }
}
