<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "Training";
    protected $primaryKey = "TrainingId";

    public function TrainingsVets() {
        return $this->hasMany(TrainingVet::class, "TrainingId");
    }

}
