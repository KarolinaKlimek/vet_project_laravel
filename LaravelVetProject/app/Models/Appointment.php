<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "Appointment";
    protected $primaryKey = "AppointmentId";

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'PetId');
    }

    public function vet()
    {
        return $this->belongsTo(Vet::class, 'VetId');
    }

    public function AppointmentsServices() {
        return $this->hasMany(AppointmentService::class, "AppointmentId");
    }
}
