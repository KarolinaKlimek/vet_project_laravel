<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "Service";
    protected $primaryKey = "ServiceId";

    public function AppointmentsServices() {
        return $this->hasMany(AppointmentService::class, "ServiceId");
    }

}
