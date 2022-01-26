<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['street', 'number', 'complement', 'neighborhood', 'zipcode', 'latitude', 'longitude', 'city', 'state', 'country'];

    public function address () {
        return $this->street . ", " . $this->number . ", " . $this->neighborhood . ", " . $this->zipcode; 
    }
}
