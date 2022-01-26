<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'deliver_id', 'collect_point_id', 'destination_point_id', 'status_id'];

    public function client () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function deliver () {
        return $this->belongsTo(User::class, 'deliver_id');
    }

    public function collect_point () {
        return $this->belongsTo(Address::class, 'collect_point_id');
    }

    public function destination_point () {
        return $this->belongsTo(Address::class, 'destination_point_id');
    }

    public function status () {
        return $this->belongsTo(Status::class);
    }
}
