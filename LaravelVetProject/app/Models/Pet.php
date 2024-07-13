<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "Pet";
    protected $primaryKey = "PetId";

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'PetId');
    }

}
