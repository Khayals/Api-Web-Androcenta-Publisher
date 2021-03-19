<?php

namespace App\Http\Controllers\Book;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JD\Cloudder\Facades\Cloudder;
use Validator;

class DeleteController extends Controller
{
    public function __invoke(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'publicId' => 'required'
        ]);

        if($validator->fails()) {
            return $this->response()->failMessage(442,$validator->errors()->all());
        }

        $data=[
            'publicId'=>$request->input('publicId')
        ];
        
        $user=auth('api')->user();
        if ($user->role_id != 1) {
            return $this->response()->failMessage(403,'sorry only admin can create book category');
        }

        if (!$book=Book::find($id)) {
            return $this->response()->failMessage(404,'book not found');
        }
        Cloudder::destroyImage($data['publicId']);
        $book->delete();
        // Cloudder::destroyImage('cover_book/kfzehgwlm1oywtzhrqt8');
        return $this->response()->successMessage('success delete book');
    }
}
