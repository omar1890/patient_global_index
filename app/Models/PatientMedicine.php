<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientMedicine extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'patient_medicines';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'medicine_id',
        'patient_id',
        'patient_visit_id',
        'dose',
        'start_date',
        'end_date',
        'is_continuous',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function patient_visit()
    {
        return $this->belongsTo(PatientVisit::class, 'patient_visit_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
