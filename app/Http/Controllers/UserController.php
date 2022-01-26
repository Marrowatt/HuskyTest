<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getDelivers () {
        return User::select('id', 'name')->where('user_type_id', 3)->get()->toArray();
    }

    public function getClients () {
        return User::select('id', 'name')->where('user_type_id', 1)->get()->toArray();
    }
}
