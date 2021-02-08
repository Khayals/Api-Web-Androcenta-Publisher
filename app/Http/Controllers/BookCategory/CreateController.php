<?php

namespace App\Http\Controllers\BookCategory;

use App\BookCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return $this->response()->failMessage(422,$validator->errors()->all());
        }

        $data=[
            'name'=>$request->input('name'),
            'description'=>$request->input('description')
        ];

        $user=auth('api')->user();
        if ($user->role_id != 1) {
            return $this->response()->failMessage(403,'sorry only admin can create book category');
        }

        $this->create($data);

        return $this->response()->successMessage('success create book category');

    }

    private function create($data)
    {
        BookCategory::insert([
            'name'=>$data['name'],
            'description'=>$data['description']
        ]);
    }
}
