<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class GetAllController extends Controller
{
    public function __invoke()
    {
        $user=User::all();
        return $this->response()->successData('success get all user','data',$user);
    }
}
