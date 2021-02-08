<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use JWTAuth;

class GetController extends Controller
{
    public function __invoke()
    {
        $user=auth('api')->user();
        return $this->response()->successData('success get detail user','data',$user);
    }
}
