<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentService extends Model
{
    use HasFactory;
    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "Appointment_Service";
    protected $primaryKey = "IdAppointmentService";

    public function Appointment() {
        return $this->belongsTo(Appointment::class, "AppointmentId");
    }

    public function Service() {
        return $this->belongsTo(Service::class, "ServiceId");
    }
}
