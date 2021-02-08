<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class GetAllController extends Controller
{
    public function __invoke()
    {
        $role=Role::all();
        return $this->response()->successData('success create role','data',$role);
    }
}
