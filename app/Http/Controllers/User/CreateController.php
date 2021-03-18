<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'nohp' => 'required|max:12',
            'address' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required',
            'photo'=>'required'
        ]);

        if($validator->fails()){
            return $this->response()->failMessage(422,$validator->errors()->all());
        }

        $data=[
            'name'=>$request->input('name'),
            'nohp'=>$request->input('nohp'),
            'address'=>$request->input('address'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'role_id'=>$request->input('role_id'),
            'photo'=>$request->input('photo')
        ];        

        if (!Role::find($data['role_id'])) {
            return $this->response()->failMessage(404,'role not found');
        }

        if (User::where('nohp','=',$data['nohp'])->first()) {
            return $this->response()->failMessage(442,'User with this number phone is already exist');
        }

        if (User::where('email','=',$data['email'])->first()) {
            return $this->response()->failMessage(442,'User with this email is already exist');
        }   

        $this->create($data);

        return $this->response()->successMessage('success create user');

    }

    private function create($data)
    {
        User::insert([
            'name'=>$data['name'],
            'nohp'=>$data['nohp'],
            'address'=>$data['address'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'role_id'=>$data['role_id'],
            'photo'=>$data['photo']
        ]);

        
    }
}
