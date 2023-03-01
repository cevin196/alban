<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'type', 'ammount', 'date'];

    public function getTypeAttribute()
    {
        return ($this->attributes['type'] == 0) ? 'Outcome' : 'Income';
    }
}
