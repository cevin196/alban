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
        return $this->belongsToMany(Criteria::class, 'alternative_criteria')
            ->withPivot('value', 'criteria_id');
    }


    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function normalCheck()
    {
        $status = true;
        $alternativeCritera = AlternativeCriteria::where(['alternative_id' => $this->id, 'criteria_id' => 5])->first();
        $alternativeCritera->value == 0 ? '' : $status = false;
        return $status;
    }

    public function checkStatus()
    {
        $status = true;
        foreach (Criteria::all() as $criteria) {
            (AlternativeCriteria::where(['alternative_id' => $this->id, 'criteria_id' => $criteria->id])->first()) ? "" : $status = false;
        }

        return $status;
    }

    // public function vectorS()
    // {
    //     $vectorS = 1;
    //     foreach ($this->criterias as $alternativeCriteria) {
    //         $value = $alternativeCriteria->pivot->value;
    //         $pangkat = $alternativeCriteria->type == 'Cost' ? $alternativeCriteria->getNormalizedWeight() * -1 : $alternativeCriteria->getNormalizedWeight();
    //         $vectorS *= pow($value, $pangkat);
    //     }
    //     return $vectorS;
    // }
}
