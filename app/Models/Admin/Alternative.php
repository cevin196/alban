<?php

namespace App\Models\Admin;

use Carbon\Carbon;
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

    public function lateCheck()
    {
        if ($this->job) {
            $estimateDay = Carbon::create($this->job->date_in)->addDays($this->job->work_estimation);
            if ((Carbon::now()->diffInDays($estimateDay, false)) < 1) {
                return true;
            }
        }
        return false;
    }

    public function lateValue()
    {
        // dd(Carbon::now()->diffInDays(Carbon::create($this->job->date_in)->addDays($this->job->work_estimation)));
        return Carbon::now()->diffInDays(Carbon::create($this->job->date_in)->addDays($this->job->work_estimation));
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
