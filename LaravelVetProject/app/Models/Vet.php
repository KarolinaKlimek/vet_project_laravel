<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vet extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "Vet";
    protected $primaryKey = "VetId";

    public function TrainingsVets() {
        return $this->hasMany(TrainingVet::class, "VetId");
    }

    public function Appointments()
    {
        return $this->hasMany(Appointment::class, 'VetId');
    }

}
