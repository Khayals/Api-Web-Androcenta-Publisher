<?php

namespace App\Http\Controllers\Book;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetController extends Controller
{
    public function __invoke($id)
    {
        if (!$book=Book::find($id)) {
            return $this->response()->failMessage(404,'Book not found');
        }        
        return $this->response()->successData('success get detail book','data',$book);
    }
}
