<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingVet extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "training_vet";
    protected $primaryKey = "IdTrainingVet";

    public function Training() {
        return $this->belongsTo(Training::class, "TrainingId");
    }

    public function Vet() {
        return $this->belongsTo(Vet::class, "VetId");
    }
}
