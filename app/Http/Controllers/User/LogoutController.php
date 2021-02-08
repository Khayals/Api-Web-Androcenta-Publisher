<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class LogoutController extends Controller
{
    public function __invoke()
    {
        $auth=auth('api');
        $user=$auth->user();
        User::where('email','=',$user->email)->update(['token'=>null]);
        $auth->logout();
        return $this->response()->successMessage('logout success');
    }
}
