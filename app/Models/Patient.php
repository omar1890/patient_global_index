<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const BLOOD_TYPE_SELECT = [
        'a_plus'    => 'A+',
        'a_minus'   => 'A-',
        'b_plus'    => 'B+',
        'b_minus'   => 'B-',
        'o_plus'    => 'O+',
        'o_minus'   => 'O-',
        'a_b_plus'  => 'AB+',
        'a_b_minus' => 'AB-',
    ];

    public $table = 'patients';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'weight',
        'height',
        'smoking',
        'blood_type',
        'avg_blood_pressure',
        'user_id',
        'name',
        'identity_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function patientSurgeries()
    {
        return $this->hasMany(Surgery::class, 'patient_id', 'id');
    }

    public function patientDiseases()
    {
        return $this->hasMany(Disease::class, 'patient_id', 'id');
    }

    public function patientVaccines()
    {
        return $this->hasMany(Vaccine::class, 'patient_id', 'id');
    }

    public function patientAllergies()
    {
        return $this->hasMany(Allergy::class, 'patient_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
