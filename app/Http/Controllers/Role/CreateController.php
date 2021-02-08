<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $data=[
            'name'=>$request->input('name')
        ];
        $this->create($data);
        return $this->response()->successMessage('success create role');
    }

    private function create($data)
    {
        Role::insert([
            'name'=>$data['name']
        ]);
    }
}
