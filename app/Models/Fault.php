<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fault extends Model
{
    use HasFactory;
    protected $table = 'faults';

    // Define any relationships or fillable attributes here
    public function equipment()
{
    return $this->belongsTo(Equipment::class);
}

}

