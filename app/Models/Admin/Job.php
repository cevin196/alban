<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'serial_number', 'unit_kilometer', 'date_in', 'date_out', 'customer_name', 'user_id', 'status'];

    public function alternative()
    {
        return $this->hasOne(Alternative::class);
    }
}
