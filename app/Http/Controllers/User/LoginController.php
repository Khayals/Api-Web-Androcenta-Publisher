<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->response()->failMessage(422,$validator->errors()->all());
        }

        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {            
            return $this->response()->failMessage(422,'username or password wrong');
        }

        $update=tap(User::where('email','=',$credentials['email']))->update(['token'=>$token])->first();
        return $this->response()->successData('login success','data',$update);
    }
}
