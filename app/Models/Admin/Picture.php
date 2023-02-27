<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'path', 'condition_report_id'];

    public function conditionReport()
    {
        return $this->belongsTo(ConditionReport::class);
    }
}
