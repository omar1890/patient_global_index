<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const TYPE_SELECT = [
        'swallowing'              => 'swallowing',
        'absorption_through_skin' => 'absorption through the skin',
        'injection'               => 'injection',
        'inhalation'              => 'inhalation',
    ];

    public $table = 'medicines';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function medicinePatientMedicines()
    {
        return $this->hasMany(PatientMedicine::class, 'medicine_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
